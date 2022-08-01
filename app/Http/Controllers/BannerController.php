<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Banner;
use App\Rules\SlugRule;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        $banners = Banner::orderBy('id','desc')->paginate(2);

        return view('admin.banner.index',compact('banners'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        $discounts = Discount::where('status',1)->where('discount_validity','>=',Carbon::now())->get();


        $categories = Category::whereNull('parent_category')->with('sub_category',function($query){
            $query->select('id','parent_category','category_name')->where('status',1);
        })->where('status',1)->orderBy('category_name','asc')->get();

        return view('admin.banner.create',compact('categories','discounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = $this->validateBanner($request->all());

        if($validator->fails()){

            $request['banner_slug'] = $request->banner_slug;
            $errors = $validator->errors();

            return redirect()->back()->withErrors($errors)->withInput();
        }

        $status = $request->banner_status ?? 0;
        $banner_slug = Str::slug($request->banner_slug,'-');

        DB::beginTransaction();

        try {
            
            $banner = Banner::create([
                'banner_type'=>$request->banner_type,
                'banner_title'=>$request->banner_title,
                'banner_button'=>$request->banner_button_text,
                'category_id'=>$request->banner_category,
                'discount_id'=>$request->banner_discount,
                'banner_slug'=>$banner_slug,
                'status'=>$status,
                'created_at'=>Carbon::now(),
            ]);
     
            if($request->hasFile('banner_image')){
                $uploaded_banner_img = $request->file('banner_image');
                $img_extension = $uploaded_banner_img->getClientOriginalExtension();
                $new_banner_img_name = 'banner_'.$request->banner_type.'_'.$banner->id.'_'.Carbon::now()->timestamp.rand(10,100).'.'.$img_extension;
                $new_banner_img = base_path('public/uploads/banner/'.$new_banner_img_name);
    
                Image::make($uploaded_banner_img)->save($new_banner_img);
    
                $banner->banner_image = $new_banner_img_name;
                $banner->save();
            }

            DB::commit();

            return redirect()->route('banner.index')->with('success','Created Successfully!');

        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error','Something went wrong!')->withInput();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('admin.banner.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {   
        $categories =Category::whereNull('parent_category')->with('sub_category', function($query){
            $query->select('id','parent_category','category_name')->where('status',1);
        })->where('status',1)->orderBy('category_name','asc')->get();

        $discounts = Discount::where('status',1)->where('discount_validity','>=',Carbon::now())->get();

        return view('admin.banner.edit', compact('banner','categories','discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {   
        $request['except_id'] = $banner->id;

        $validator = $this->validateBanner($request->all());

        if($validator->fails()){

            $request['banner_slug'] = $request->banner_slug;

            return redirect()->back()->withErrors($validator->errors())->withInput();

        }


        DB::beginTransaction();

        try {

            $banner_status = $request->banner_status ?? 0;
            $banner_slug = Str::slug($request->banner_slug,'-');
            
            $banner->banner_type = $request->banner_type;
            $banner->banner_title = $request->banner_title;
            $banner->banner_button = $request->banner_button_text;
            $banner->category_id = $request->banner_category;
            $banner->discount_id = $request->banner_discount;
            $banner->banner_slug = $banner_slug;
            $banner->status = $banner_status;
            $banner->save();

            if($request->hasFile('banner_image')){

                if($banner->banner_image != null){
                    $delete_banner = base_path('public/uploads/banner/'.$banner->banner_image);
                    unlink($delete_banner);
                }

                $uploaded_banner_img = $request->file('banner_image');
                $img_extension = $uploaded_banner_img->getClientOriginalExtension();
                $new_img_name = 'banner_'.$request->banner_type.'_'.$banner->id.'_'.Carbon::now()->timestamp.rand(10,100).'.'.$img_extension; 
                $new_image = base_path('public/uploads/banner/'.$new_img_name);

                Image::make($uploaded_banner_img)->save($new_image);

                $banner->banner_image = $new_img_name;
                $banner->save();

            }

            DB::commit();

            return redirect()->route('banner.index')->with('success','Updated Successfully');

        } catch (\Throwable $th) {

            DB::rollback();

            return redirect()->back()->with('error','Something went wrong!')->withInput();
        }
  
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {   
        if($banner->banner_image != null){
            $delete_photo = base_path('public/uploads/banner/'.$banner->banner_image);
            unlink($delete_photo);
        }

        $banner->delete();

        return response()->json(['success'=>'Banner Deleted!']);

    }


    public function updateBannerStatus($banner_id)
    {
        $banner = Banner::findOrFail($banner_id);

        if($banner->status == 0){
            $banner->status = 1;
        }
        else{
            $banner->status = 0;
        }

        $banner->save();

        return response()->json(['success'=>'Banner Status Updated!','banner_status'=>$banner->status]);

    }



    public function bannerQuery(Request $request)
    {

        $banners = Banner::orderBy('id','desc')->paginate(2);

        $banner_query = $request->query('banner_query');

        if($banner_query != ''){
            $banners = Banner::with(['discount','category'])
                            ->where('banner_type','LIKE','%'.$banner_query.'%')
                            ->orWhere('banner_title','LIKE','%'.$banner_query.'%')
                            ->orWhere(function($query) use ($banner_query){
                                $query->whereHas('discount',function($q) use ($banner_query){
                                    $q->where('discount_name','LIKE','%'.$banner_query.'%');
                                });
                            })
                            ->orWhere(function($query) use ($banner_query){
                                $query->whereHas('category',function($q) use ($banner_query){
                                    $q->where('category_name','LIKE','%'.$banner_query.'%');
                                });
                            })->orderBy('id','desc')->paginate(2);

        }

        return view('admin.banner.banner_data',compact('banners'))->render();

    }

    


    private function validateBanner(array $request)
    {
        $slug_input = $request['banner_slug'];
        $request['banner_slug'] = Str::slug($slug_input,'-');

        $except_id = null;

        if(isset($request['except_id'])){
           $except_id = $request['except_id'];
        }

        if($except_id != null){
            $image_rule = '';
        }
        else{
            $image_rule = 'required';
        }
    
        $validator = Validator::make($request,[
            'banner_type'=>'required|in:hero,campaign',
            'banner_title'=>'string|max:100|nullable',
            'banner_button_text'=>'string|max:20|nullable',
            'banner_category'=>'numeric|exists:categories,id',
            'banner_discount'=>'numeric|exists:discounts,id',
            'banner_slug'=>['required',new SlugRule('banners','banner_slug',$except_id)],
            'banner_image'=>[$image_rule,'mimes:jpg,jpeg,png','max:512','dimensions:min_width=360,min_height=240,max_width=1920,max_height=1200'],
            'banner_status'=>'boolean',
        ]);

        return $validator;

    }



}
