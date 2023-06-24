<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;
use Illuminate\Support\Facades\DB;
use App\Models\ProductMultiplePhoto;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductFormPost;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\ProductUpdateFormRequest;
use App\Http\Requests\ProductDiscountFormRequest;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        Gate::authorize('view-any', Product::class);
        
        $products = Product::all();

        $products->load('categories','size','product_discount');

        return view('admin.product.index',compact('products'));
    }


    public function product_trash()
    {
        Gate::authorize('view-any', Product::class);

        $trashed_products = Product::onlyTrashed()->get();
        return view('admin.product.trash',compact('trashed_products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('create', Product::class);

        $categories = Category::whereNull('parent_category')->where('status',1)->with('sub_category', function($query){
            $query->select('id','parent_category','category_name')->where('status',1);
        })->orderBy('category_name','asc')->get();

        $sizes = ProductSize::orderBy('scale_name','asc')->get();
        
        $discounts = Discount::where('status',1)->where('discount_validity','>=',Carbon::now())->get();

        return view('admin.product.create', compact('categories','sizes','discounts'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormPost $request)
    {   
        Gate::authorize('create', Product::class);

        if (isset($request->validator) && $request->validator->fails()) {
            // return response()->json($request->validator->messages(), 422);    // for ajax request
            return redirect()->back()->withErrors($request->validator)->withInput();
        }


        DB::beginTransaction();

        try{

            $has_discount = 0;
            $is_featured = 0;
            $status = 0;

            if(isset($request->product_has_discount)){
                $has_discount = $request->product_has_discount;
            }

            if(isset($request->product_featured)){
                $is_featured = $request->product_featured;;
            }

            if(isset($request->product_status)){
                $status = $request->product_status;
            }
            

            $scale = ProductSize::where('id',$request->product_scale)->first();
        
            $product_size = $request->size_value.$scale->scale_name;

            $slug = Str::slug($request->product_name,'-').'-'.$product_size.'-'.Carbon::now()->timestamp;

            
            $product = Product::create([
                'product_name'=>$request->product_name,
                'product_desc'=>$request->product_desc,
                'price'=>$request->price * 100,
                'stock'=>$request->stock,
                'in_stock'=>$request->stock,
                'slug'=>$slug,
                'has_discount'=>$has_discount,
                'is_featured'=>$is_featured,
                'status'=>$status,
                'created_at'=>Carbon::now(),
            ]);

            if($request->hasFile('product_thumbnail')){

                $uploaded_img = $request->file('product_thumbnail');
                $img_extension = $uploaded_img->getClientOriginalExtension();
                $img_new_name = "product"."_".$product->id."_".Carbon::now()->timestamp.".".$img_extension;
                $new_location = base_path('public/uploads/product/'.$img_new_name);

                Image::make($uploaded_img)->resize(600,600)->save($new_location);

                $product->thumbnail = $img_new_name;
                $product->save();

            }

            if($request->hasFile('product_multiple_photo')){
                $multiple_photos = $request->file('product_multiple_photo');
                $count = 0;
                foreach($multiple_photos as $photo){
                    $count++;
                    $photo_extension = $photo->getClientOriginalExtension();
                    $new_photo_name = 'product'.'_'.$product->id.'_'.Carbon::now()->timestamp.rand(10,100).'_'.$count.'.'.$photo_extension;
                    $photo_new_location = base_path('public/uploads/product/'.$new_photo_name);

                    Image::make($photo)->resize(600,600)->save($photo_new_location);

                    ProductMultiplePhoto::create([
                        'product_id'=>$product->id,
                        'multiple_photo'=>$new_photo_name,
                        'created_at'=>Carbon::now(),
                    ]);
                }
            }

            if($request->product_has_discount == 1 && $request->product_discount != null){

                ProductDiscount::insert([
                    'product_id'=>$product->id,
                    'discount_id'=>$request->product_discount,
                ]);
            }

            $product->categories()->sync($request->input('product_category'));
            // $product->size()->syncWithPivotValues($request->product_scale,['size_value'=>$request->size_value]);
            $product->size()->sync([$request->product_scale => ['size_value' => $request->size_value]]);

            DB::commit();
            
            return redirect()->route('product.create')->with('success','Product Added!');

        } catch(Exception $exception){

            DB::rollback();

            return redirect()->back()->with('error','Something went wrong!');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {         
        Gate::authorize('view', $product);

        $product->load('categories','size','multiple_photos','reviews.author.userDetails');

        return view('admin.product.show',compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {   
        Gate::authorize('update', $product);

        $categories = Category::whereNull('parent_category')->where('status',1)->with('sub_category', function($query){
            $query->select('id','parent_category','category_name')->where('status',1);
        })->orderBy('category_name','asc')->get();

        $sizes = ProductSize::orderBy('scale_name','asc')->get();

        $discounts = Discount::where('status',1)->where('discount_validity','>=',Carbon::now())->get();

        $product->load('categories','size','multiple_photos');

        return view('admin.product.edit', compact('product','categories','sizes','discounts'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateFormRequest $request, Product $product)
    {
        Gate::authorize('update', $product);

        DB::beginTransaction();

        try {

            $scale = ProductSize::where('id',$request->product_scale)->first();
            $product_size = $request->size_value.$scale->scale_name;

            $slug = Str::slug($request->product_name,'-').'-'.$product_size.'-'.Carbon::now()->timestamp;

            $has_discount = 0;
            $is_featured = 0;
            $status = 0;

            if(isset($request->product_has_discount)){
                $has_discount = $request->product_has_discount;
            }

            if(isset($request->product_featured)){
                $is_featured = $request->product_featured;;
            }

            if(isset($request->product_status)){
                $status = $request->product_status;
            }

            $product->update([
                'product_name' => $request->product_name,
                'product_desc' => $request->product_desc,
                'price' => $request->price * 100,
                'stock' => $request->stock,
                'in_stock' => $request->stock,
                'slug' => $slug,
                'has_discount'=>$has_discount,
                'is_featured'=>$is_featured,
                'status'=>$status,
            ]);


            if($has_discount == 1 && $request->product_discount != null){

                if($product->product_discount != null){

                    ProductDiscount::where('product_id',$product->id)->update([
                        'discount_id'=>$request->product_discount,
                    ]);

                }
                else{

                    ProductDiscount::create([
                        'product_id'=>$product->id,
                        'discount_id'=>$request->product_discount,
                    ]);

                }
            }
            elseif( $has_discount == 0 && $product->product_discount != null ){

                ProductDiscount::where('product_id',$product->id)->delete();

            }


            $product->categories()->sync($request->input('product_category'));

            $product->size()->syncWithPivotValues($request->product_scale,['size_value'=>$request->size_value]);


            if($request->hasFile('product_multiple_photo')){

                $multiple_photos = $request->file('product_multiple_photo');
                $count = $product->multiple_photos->count();

                foreach($multiple_photos as $photo){
                    $count++;
                    $photo_extension = $photo->getClientOriginalExtension();
                    $photo_new_name = 'product'.'_'.$product->id.'_'.Carbon::now()->timestamp.rand(10,100).'_'.$count.'.'.$photo_extension;
                    $new_photo = base_path('public/uploads/product/'.$photo_new_name);

                    Image::make($photo)->resize(600,600)->save($new_photo);

                    ProductMultiplePhoto::create([
                        'product_id'=>$product->id,
                        'multiple_photo'=>$photo_new_name,
                        'created_at'=>Carbon::now(),
                    ]);

                }
            }

            $thumbnail_updated = false;

            if($request->hasFile('product_thumbnail')){

                define('PRODUCT_THUMBNAIL',$product->thumbnail);

                $uploaded_thumbnail = $request->file('product_thumbnail');
                $thumbnail_extension = $uploaded_thumbnail->getClientOriginalExtension();
                $thumbnail_new_name = 'product'.'_'.$product->id.'_'.Carbon::now()->timestamp.'.'.$thumbnail_extension;
                $new_thumbnail_image = base_path('public/uploads/product/'.$thumbnail_new_name);

                Image::make($uploaded_thumbnail)->resize(600,600)->save($new_thumbnail_image);

                $product->thumbnail = $thumbnail_new_name;
                $product->save();

                $thumbnail_updated = true;

            }

            if($thumbnail_updated === true && PRODUCT_THUMBNAIL != null){
                $delete_thumbnail = base_path('public/uploads/product/'.PRODUCT_THUMBNAIL);
                unlink($delete_thumbnail);
            }

            DB::commit();

            return redirect()->route('product.show',$product->id)->with('success','Product Updated!');

        } catch (\Throwable $th) {

            DB::rollBack();

            // return redirect()->route('product.show',$product->id)->with('error','Something went wrong!');

            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->back()->with(['success'=>'Product Deleted!']);
    }


    public function productMassDestroy(Request $request)
    {
        Gate::authorize('product-mass-destroy', Product::class);

        Product::whereIn('id',$request->ids)->delete();

        session()->flash('success','Products Deleted!');

        return response(null, Response::HTTP_NO_CONTENT);
    }



    public function forceDelete($id)
    {
        $product = Product::withTrashed()->where('id',$id)->firstOrFail();

        Gate::authorize('delete', $product);

        if($product->thumbnail != null){
            $delete_thumbnail = base_path('public/uploads/product/'.$product->thumbnail);
            unlink($delete_thumbnail);
        }

        if($product->multiple_photos->count() > 0){

            foreach($product->multiple_photos as $photo){
                $delete_photo = base_path('public/uploads/product/'.$photo->multiple_photo);
                unlink($delete_photo);
            }

        }

        $product->forceDelete();
        
        return redirect()->back()->with(['success'=>'Product Permanently Deleted!']);

    }



    public function productForceDeleteAll(Request $request)
    {

        Gate::authorize('product-force-delete-all', Product::class);

        $products = Product::withTrashed()->whereIn('id',$request->ids)->get();

        foreach($products as $product){
            
            if($product->thumbnail != null){
                $delete_thumbnail = base_path('public/uploads/product/'.$product->thumbnail);
                unlink($delete_thumbnail);
            }

            if($product->multiple_photos->count() > 0){

                foreach($product->multiple_photos as $photo){
                    $delete_photo = base_path('public/uploads/product/'.$photo->multiple_photo);
                    unlink($delete_photo);
                }

            }

            $product->forceDelete();

        }

        session()->flash('success','Products Deleted Permanently!');

        return response(null, Response::HTTP_NO_CONTENT);

    }



    public function restore($id)
    {   
        $product = Product::withTrashed()->where('id',$id)->first();

        Gate::authorize('delete', $product);

        $product->restore();

        session()->flash('success','Product Restored!');

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function product_restore_all(Request $request)
    {

        Gate::authorize('product-restore-all', Product::class);

        Product::withTrashed()->whereIn('id',$request->ids)->restore();

        session()->flash('success','Products Restored!');

        return response(null, Response::HTTP_NO_CONTENT);
    }



    public function deleteProductPhoto(Request $request)
    {

        Gate::authorize('delete-product-photo', Product::class);

        $photo = ProductMultiplePhoto::where('id',$request->photo_id)->where('product_id',$request->product_id)->firstOrFail();


        if($photo->multiple_photo != null){
            $delete_photo = base_path('public/uploads/product/'.$photo->multiple_photo);
            unlink($delete_photo);
        }

        $photo->delete();

        return response()->json(['success'=>'Photo Deleted!']);

    }



    public function updateProductFeature($id)
    {
        $product = Product::where('id',$id)->firstOrFail();

        Gate::authorize('update', $product);

        if($product->is_featured == 0){
            $product->is_featured = 1;
        }
        else{
            $product->is_featured = 0;
        }

        $product->save();

        return response()->json(['success'=>'Product Updated!']);

    }



    public function updateProductStatus($id)
    {
        
        $product = Product::where('id',$id)->firstOrFail();

        Gate::authorize('update', $product);

        if($product->status == 0){
            $product->status = 1;
        }
        else{
            $product->status = 0;
        }

        $product->save();

        return response()->json(['success'=>'Product Status Updated!']);
       
    }



    public function create_product_discount()
    {

        Gate::authorize('create-product-discount', Product::class);

        $products = Product::where('has_discount',0)->where('status',1)->get();

        $categories = Category::whereNull('parent_category')->where('status',1)->with('sub_category', function($query){
            $query->select('id','parent_category','category_name')->where('status',1);
        })->orderBy('category_name','asc')->get();

        $discounts = Discount::where('discount_validity','>=',Carbon::now())->where('status',1)->get();

        // $product_discounts = \App\Models\Product::where('has_discount',1)->paginate(10);
        // $product_discounts->load('product_discount.discount');

        $product_discounts = Product::where('has_discount',1)->with(['product_discount.discount' => function($query){
            $query->select('id','discount_name');
        }])->select('id','product_name','price','thumbnail','has_discount')->get();

        return view('admin.product.product_discount', compact('categories','products','discounts','product_discounts'));
        
    }


    public function store_product_discount(ProductDiscountFormRequest $request)
    {

        Gate::authorize('create-product-discount', Product::class);
        
        $product_ids = $request->product_id;

        DB::beginTransaction();

        try {

            foreach($product_ids as $id){

                ProductDiscount::create([
                    'product_id'=>$id,
                    'discount_id'=>$request->product_discount,
                ]);

                Product::where('id',$id)->update(['has_discount'=>1,]);

            }

            DB::commit();

            return redirect()->back()->with('success','Added Successfully!');

        } catch (\Throwable $th) {
            
            DB::rollback();

            return redirect()->back()->with('error','Something went wrong!')->withInput();

        }

        
    }



    public function edit_product_discount($discount_id)
    {   

        Gate::authorize('update-product-discount', Product::class);

        $discount_results = '';
        $discounts = Discount::where('status',1)->where('discount_validity','>=',Carbon::now())->get();

        foreach($discounts as $discount){
            $discount_results .= '<option '.($discount->id == $discount_id ? "selected" : "").' value="'.$discount->id.'">'.$discount->discount_name." ( ". discountValueType($discount->id)." )".'</option>';
        }

        return response()->json($discount_results);

    }


    public function update_product_discount($product_id,Request $request)
    {   

        Gate::authorize('update-product-discount', Product::class);

        ProductDiscount::where('product_id',$product_id)->update([
            'discount_id'=>$request->discount_id,
        ]);

        $discount = getProductDiscount($product_id)->discount_name.' ( '.discountValueType($request->discount_id).' )';

        return response()->json($discount);

    }


    public function deleteProductDiscount($product_id)
    {

        DB::beginTransaction();

        try {

            ProductDiscount::where('product_id',$product_id)->delete();

            Product::where('id',$product_id)->update([
                'has_discount'=>0,
            ]);

            DB::commit();

            session()->flash('product_discount_delete','Deleted Successfully!');

            return response(null, Response::HTTP_NO_CONTENT);

        } catch (\Throwable $th) {

            DB::rollback();
            
            throw $th;
        }

    
        return $product_id;
    }



    public function products_by_category(Request $request)
    {   
        $product_result = '';

        if($request->category_id == null){
            return response()->json(['null_category'=>'null']);
        }

        $category = Category::where('id',$request->category_id)->with('sub_category' , function($query){
            $query->where('status',1);
        })->where('status',1)->firstOrFail();

        $ids = collect($category->id);

        if($category->sub_category->count() > 0){
            foreach($category->sub_category as $sub_category){
                $ids  = $ids->merge($sub_category->id);
            }
        }

        $products = Product::whereHas('categories', function($query) use ($ids){
            $query->whereIn('id',$ids);
        })->where('has_discount',0)->where('status',1)->get();

        foreach($products as $product){
            $product_result .= '<option selected value="'.$product->id.'" data-image="'.asset("uploads/product/".$product->thumbnail).'">'.$product->product_name.'</option>';
        }

        return response()->json($product_result);
    }
}
