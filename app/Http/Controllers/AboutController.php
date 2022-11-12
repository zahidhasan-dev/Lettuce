<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Http\Requests\AboutFormRequest;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view-any', About::class);

        $abouts = About::orderBy('created_at','desc')->paginate(20);

        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('create', About::class);

        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutFormRequest $request)
    {
        Gate::authorize('create',About::class);

        DB::beginTransaction();

        try {

            $about = About::create($request->except(['about_image']));
    
    
            if($request->hasFile('about_image')){

                $uploaded_img = $request->file('about_image');
                $img_extension = $uploaded_img->getClientOriginalExtension();
                $new_img_name = 'about_'.$about->id.'_'.Carbon::now()->timestamp.rand(10,100).'.'.$img_extension;
                $new_about_img = base_path('public/uploads/about/'.$new_img_name);

                Image::make($uploaded_img)->save($new_about_img);

                $about->about_image = $new_img_name;
                $about->save();
    
            }

            DB::commit();

            return redirect()->route('about.index')->with('success','Created successfully!');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['error'=>'Something went wrong!'])->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        Gate::authorize('view',$about);

        return view('admin.about.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        Gate::authorize('update',$about);

        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {   
        Gate::authorize('update',$about);

        $image_validation_rule = '';

        if($about->about_image == null){
            $image_validation_rule = 'required';
        }

        $request->validate([
            'about_sub_title'=>'required|string|max:40',
            'about_title'=>'required|string|max:40',
            'about_desc_1'=>'required_without:about_desc_2|string|max:2000',
            'about_desc_2'=>'required_without:about_desc_1|string|max:2000',
            'about_author_name'=>'max:30',
            'about_author_title'=>'max:30',
            'about_image'=>[$image_validation_rule,'mimes:jpg,jpeg,png','max:512'],
        ]);

        DB::beginTransaction();

        try {

            $about->about_sub_title = $request->about_sub_title;
            $about->about_title = $request->about_title;
            $about->about_desc_1 = $request->about_desc_1;
            $about->about_desc_2 = $request->about_desc_2;
            $about->about_author_name = $request->about_author_name;
            $about->about_author_title = $request->about_author_title;
    
            if($request->hasFile('about_image')){

                if($about->about_image != null){
                    $delete_img = base_path('public/uploads/about/'.$about->about_image);
                    unlink($delete_img);
                }

                $uploaded_img = $request->file('about_image');
                $img_extension = $uploaded_img->getClientOriginalExtension();
                $new_img_name = 'about_'.$about->id.'_'.Carbon::now()->timestamp.rand(10,100).'.'.$img_extension;
                $new_about_img = base_path('public/uploads/about/'.$new_img_name);

                Image::make($uploaded_img)->save($new_about_img);

                $about->about_image = $new_img_name;
                
            }

            $about->save();

            DB::commit();

            return redirect()->route('about.index')->with('success','Updated successfully!');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['error'=>'Something went wrong!'])->withInput();
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        Gate::authorize('delete',$about);

        if($about->about_image != null){
            $delete_img = base_path('public/uploads/about/'.$about->about_image);
            unlink($delete_img);
        }

        $about->delete();

        return response()->json(['success'=>'About Deleted!']);
    }


    public function updateAboutStatus(About $about)
    {
        Gate::authorize('update-about-status',$about);

        if($about->is_active == 0){
            $about->is_active = 1;

            About::where('id','!=',$about->id)->update([
                'is_active' => 0,
            ]);
        }
        else{
            $about->is_active = 0;
        }

        $about->save();

        return response()->json(['success'=>'Status updated successfully!','about_status'=>$about->is_active]);
    }


}
