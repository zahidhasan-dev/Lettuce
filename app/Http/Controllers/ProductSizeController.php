<?php

namespace App\Http\Controllers;

use App\Http\Requests\sizeFormPost;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $sizes = ProductSize::all();
        return view('admin.size.index', compact('sizes'));
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
    public function store(sizeFormPost $request)
    {

       ProductSize::create($request->all());

       return redirect()->back()->with(['success'=>'Added Successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductSize  $size
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSize $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductSize  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSize $size)
    {
        return response()->json($size);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductSize  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSize $size)
    {
        $scale_exists = ProductSize::where('id','!=',$size->id)->where('scale_name',$request->scale_name)->exists();

       if(!$scale_exists){

            $size->scale_name = $request->scale_name;
            $size->save();

            return response()->json(['success'=>'Updated Successfully.']);

       }

       return response()->json(['scale_exists'=>'Already Exists!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductSize  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSize $size)
    {
        $size->delete();

        return redirect()->back()->with(['delete_success'=>'Deleted Successfully!']);
        
    }
}
