<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CategoryFormPost;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('category_name','asc')->paginate(10);

        $parent_categories = Category::whereNull('parent_category')->with('sub_category', function($query){
            $query->select('id','parent_category','category_name');
        })->orderBy('category_name','asc')->get();

        return view('admin.category.index', compact('categories','parent_categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormPost $request)
    {

        $category_slug = Str::slug($request->category_name);
        
        $create_category = Category::create($request->all()+['category_slug'=>$category_slug]);

        $category = Category::where('id',$create_category->id)->first();

        if($request->hasFile('category_photo')){
            
            $allowed_extension = ['jpg','jpeg','png','webp','svg'];
            $uploaded_img = $request->file('category_photo');
            $img_extension = $uploaded_img->getClientOriginalExtension();

            if(in_array($img_extension,$allowed_extension)){
                
                $new_img_name = 'category'.'_'.$create_category->id.'_'.Carbon::now()->timestamp.'.'.$img_extension;
                $new_img_location = base_path('public/uploads/category/'.$new_img_name);

                Image::make($uploaded_img)->resize(100,100)->save($new_img_location);

                $category->update([
                    'category_photo' => $new_img_name,
                ]);

                return redirect()->back()->with(['success'=>'Created Successfully!']);

            }

            return redirect()->back()->with(['extnsn_err'=>'Invalid file type.']);

            
        }

        return redirect()->back()->with(['error'=>'Empty Image.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $category_exists = Category::where('id','!=',$category->id)->where('category_name',$request->category_name)->exists();

        if(!$category_exists){
           
            if($request->hasFile('category_photo')){

                $allowed_extension = ['jpg','jpeg','png','webp','svg'];
                $uploaded_img = $request->file('category_photo');
                $img_extension = $uploaded_img->getClientOriginalExtension();

                if(in_array($img_extension,$allowed_extension)){

                    if($category->category_photo != null){
                        $delete_photo = base_path('public/uploads/category/'.$category->category_photo);
                        unlink($delete_photo);
                    }

                    $new_img_name = 'category'.'_'.$category->id.'_'.Carbon::now()->timestamp.'.'.$img_extension;
                    $new_img_location = base_path('public/uploads/category/'.$new_img_name);

                    Image::make($uploaded_img)->resize(100,100)->save($new_img_location);

                    $category->category_photo = $new_img_name;

                }
                else{
                    return response()->json(['extnsn_error'=>'Invalid file type.']);
                }

            }

            $category->parent_category = $request->parent_category;
            $category->category_name = $request->category_name;
            $category->category_slug = Str::slug($request->category_name);
            $category->save();

            return response()->json(['success'=>'Category updated.']);

        }
        else {
            return response()->json(['cat_exists'=>'Category already exists.']);
        }
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,Request $request)
    {
        $delete_photo = base_path('public/uploads/category/'.$category->category_photo);
        unlink($delete_photo);

        $delete = $category->delete();

        if($delete){

            if($request->category != ''){
                $categories = Category::where('category_name','like','%'.$request->category_query.'%')
                                        ->orWhere('parent_category','like','%'.$request->category_query.'%')
                                        ->orderBy('category_name','asc')
                                        ->paginate(10);
            }
            else{
                $categories = Category::orderBy('category_name','asc')->paginate(10);
            }

            return view('admin.category.query_data', compact('categories'))->render();

        }

        return response()->json(['error'=>'Something went wrong.']);

            
            
    }



    public function updateCategoryStatus($category_id)
    {
        $category = Category::where('id', $category_id)->first();

        if($category->status == 0){
            $category->status = 1;
        }
        else{
            $category->status = 0;
        }

        $update_status = $category->save();


        if($update_status){
            return response()->json(['success'=>'Status updated.']);
        }
        
        return response()->json(['error'=>'Something went wrong!']);

    }



    public function queryCategory(Request $request)
    {

        $categories = Category::orderBy('category_name','asc')->paginate(10);

        if($request->category_query != ''){
            $categories = Category::where('category_name','like','%'.$request->category_query.'%')
                                    ->orWhere('parent_category','like','%'.$request->category_query.'%')
                                    ->orderBy('category_name','asc')
                                    ->paginate(10);
        }

        return view('admin.category.query_data',compact('categories'))->render();
    }

    




}
