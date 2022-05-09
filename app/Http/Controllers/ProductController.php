<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductFormPost;
use App\Models\ProductMultiplePhoto;
use Sven\ArtisanView\Blocks\Push;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::whereNull('parent_category')->with('sub_category', function($query){
            $query->select('id','parent_category','category_name');
        })->orderBy('category_name','asc')->get();

        $sizes = ProductSize::orderBy('scale_name','asc')->get();
        
        return view('admin.product.create', compact('categories','sizes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormPost $request)
    {   

        if (isset($request->validator) && $request->validator->fails()) {
            // return response()->json($request->validator->messages(), 422);
            return redirect()->back()->withErrors($request->validator)->withInput();
        }
        else{

            DB::beginTransaction();

            try{
                $slug = Str::slug($request->product_name,'-').'-'.Carbon::now()->timestamp;

                
                $product = Product::create([
                    'product_name'=>$request->product_name,
                    'product_desc'=>$request->product_desc,
                    'price'=>$request->price,
                    'stock'=>$request->stock,
                    'in_stock'=>$request->stock,
                    'slug'=>$slug,
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
                        $new_photo_name = 'product'.'_'.$product->id.'_'.Carbon::now()->timestamp.'_'.$count.'.'.$photo_extension;
                        $photo_new_location = base_path('public/uploads/product/'.$new_photo_name);

                        Image::make($photo)->resize(600,600)->save($photo_new_location);

                        ProductMultiplePhoto::create([
                            'product_id'=>$product->id,
                            'multiple_photo'=>$new_photo_name,
                            'created_at'=>Carbon::now(),
                        ]);
                    }
                }

                $product->categories()->sync($request->input('product_category'));
                // $product->size()->syncWithPivotValues($request->product_scale,['size_value'=>$request->size_value]);
                $product->size()->sync([$request->product_scale => ['size_value' => $request->size_value]]);

                DB::commit();

                return redirect()->back()->with(['success'=>'Product Added.']);

            } catch(Exception $exception){

                DB::rollback();
                return redirect()->back()->with(['error'=>'Something went wrong!']);

            }

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
        return view('admin.product.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }



    public function updateProductFeature($id)
    {
        $product = Product::where('id',$id)->firstOrFail();

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

       if($product->status == 0){
           $product->status = 1;
       }
       else{
           $product->status = 0;
       }

       $product->save();

       return response()->json(['success'=>'Product Status Updated!']);
       
    }
}
