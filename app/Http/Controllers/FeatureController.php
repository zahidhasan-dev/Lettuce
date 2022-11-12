<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Requests\FeatureFormRequest;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $features = Feature::orderBy('created_at','desc')->paginate(20);
        
        return view('admin.feature.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureFormRequest $request)
    {
        DB::beginTransaction();

        try {

            $feature = Feature::create($request->except(['feature_image']));

            if($request->hasFile('feature_image')){
                
                $uploaded_img = $request->file('feature_image');
                $img_extension = $uploaded_img->getClientOriginalExtension();
                $img_new_name = 'feature_'.$feature->id.'_'.Carbon::now()->timestamp.rand(10,100).'.'.$img_extension;
                $new_feature_img = base_path('public/uploads/feature/'.$img_new_name);

                Image::make($uploaded_img)->save($new_feature_img);

                $feature->feature_image = $img_new_name;
                $feature->save();

            }

            DB::commit();

            return redirect()->route('feature.index')->with('success','Created successfully!');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['error'=>'Something went wrong!'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        return view('admin.feature.show', compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        return view('admin.feature.edit',compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        $img_rule = '';

        if($feature->feature_image == null){
            $img_rule = 'required';
        }

        $request->validate([
            'feature_title'=>'required|string|max:30',
            'feature_desc'=>'required|string|max:150',
            'feature_image'=>[$img_rule,'mimes:jpg,jpeg,png','max:256'],
        ]);

        DB::beginTransaction();

        try {

            $feature->feature_title = $request->feature_title;
            $feature->feature_desc = $request->feature_desc;

            if($request->hasFile('feature_image')){
                
                $uploaded_img = $request->file('feature_image');
                $img_extension = $uploaded_img->getClientOriginalExtension();
                $img_new_name = 'feature_'.$feature->id.'_'.Carbon::now()->timestamp.rand(10,100).'.'.$img_extension;
                $new_feature_img = base_path('public/uploads/feature/'.$img_new_name);

                Image::make($uploaded_img)->save($new_feature_img);

                $feature->feature_image = $img_new_name;
                
            }

            $feature->save();

            DB::commit();

            return redirect()->route('feature.index')->with('success','Updated successfully!');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['error'=>'Something went wrong!'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {   
        if($feature->feature_image != null){
            $delete_img = base_path('public/uploads/feature/'.$feature->feature_image);
            unlink($delete_img);
        }

        $feature->delete();

        return response()->json(['success'=>'About Deleted!']);
    }


    public function updateFeatureStatus($feature_id)
    {   
        $feature = Feature::where('id',$feature_id)->firstOrFail();
        
        if($feature->is_active){
            $feature->is_active = 0;
        }
        else{
            $feature->is_active = 1;
        }

        $feature->save();

        return response()->json(['success'=>'Status updated successfully!','feature_status'=>$feature->is_active]);
    }


}
