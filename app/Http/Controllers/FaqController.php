<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderByDesc('id')->paginate(15);

        return view('admin.faq.index', compact('faqs'));
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
    public function store(Request $request)
    {
        if($request->ajax())
        {
            $create_faq = Faq::create($request->all());

            if($create_faq)
            {   
                return json_encode(['success'=>'Faq created successfully!']);
            }
            
            return json_encode(['error'=>'Something went wrong!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return response()->json($faq);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return response()->json($faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {

        
            $faq->faq_ques = $request->faq_ques;
            $faq->faq_ans = $request->faq_ans;

            $update_faq = $faq->save();

            if($update_faq)
            {
                return response()->json(['success'=>'Faq updated successfully!']);
            }
            
            return response()->json(['error'=>'Something went wrong!']);

    }


    public function updateStatus($id)
    {
        $faq = Faq::where('id',$id)->first();

        if($faq->is_active == 0)
        {
            $faq->is_active = 1;
            $update_faq_status = $faq->save();
        }
        else{
            $faq->is_active = 0;
            $update_faq_status = $faq->save();
        }

        if($update_faq_status)
        {
            return response()->json(['success'=>'Status updated!']);
        }

        return response()->json(['error'=>'Something went wrong!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq_delete = $faq->delete();

        if($faq_delete)
        {
            return response()->json(['success'=>'Deleted successfully!']); 
        }

        return response()->json(['error'=>'Something went wrong!']);
    }



    public function delete_all_faq($ids)
    {
        $faq_delete_all = Faq::whereIn('id',explode(',',$ids))->delete();

        if($faq_delete_all)
        {
            return response()->json(['success'=>'Deleted all successfully!']); 
        }

        return response()->json(['error'=>'Something went wrong!']);
    }
}
