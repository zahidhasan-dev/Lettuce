<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountFormPost;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $discounts = Discount::orderBy('created_at','desc')->paginate(10);

        return view('admin.offers.discount.index', compact('discounts'));

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
    public function store(DiscountFormPost $request)
    {   

        // $discount_slug = Str::slug($request->discount_name);

        $create_discount = Discount::create($request->all());

        if($create_discount){
            return redirect()->back()->with(['success'=>'Created successfully!']);
        }

        return redirect()->back()->with(['error'=>'Something went wrong!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        $discount_type = '<option value="" selected disabled>-- Select Type --</option>
                            <option value="fixed" '.(($discount->discount_type == 'fixed')?'selected':'').'>Fixed</option>
                            <option value="percent" '.(($discount->discount_type == 'percent')?'selected':'').' >Percent</option>';

        $data_array = [
            'discount'=>$discount,
            'discount_type'=>$discount_type,
        ];

        return response()->json($data_array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $discount_exists = Discount::where('id','!=',$discount->id)->where('discount_name',$discount->discount_name)->first();

        if($discount_exists != true){

            $discount->discount_type = $request->discount_type;
            $discount->discount_name = $request->discount_name;
            $discount->discount_slug = $request->discount_slug;
            $discount->discount_value = $request->discount_value;
            $discount->discount_validity = $request->discount_validity;


            $update = $discount->save();

            if($update){
                return response()->json(['success'=>'Successfully updated!']);
            }

            return response()->json(['error'=>'Something went wrong!']);
            
        }

        return response()->json(['discount_exists'=>'Discount already exists!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $delete = $discount->delete();

        if($delete)
        {
            return response()->json(['success'=>'Deleted successfully!']);
        }

        return response()->json(['error'=>'Something went wrong']);
        
    }


    public function updateDiscountStatus($disocunt_id)
    {
        $discount = Discount::where('id',$disocunt_id)->first();

        if($discount->status == 0){
            $discount->status = 1;
        }
        else{
            $discount->status = 0;
        }

        $status_update = $discount->save();

        if($status_update){
            return response()->json(['success'=>'Status updated!']);
        }

        return response()->json(['error'=>'Something went wrong!']);

    }


    public function updateStatusOnExpiry($discount_id)
    {

        $discount = Discount::where('id',$discount_id)->first();

        if($discount->status == 1){
            $discount->status = 0;
            $discount->save();

            $data_array = [
                'updated'=>'status updated',
                'discount_id'=>$discount->id,
            ];

            return response()->json($data_array);
        }

        return response()->json(['notUpdated'=>'status not updated.']);
        
    }




    public function queryDiscountData(Request $request)
    {

        if($request->ajax()){

            $query = $request->discount_query;

            $discounts = Discount::where('discount_name','like','%'.$query.'%')
                                ->orWhere('discount_value','like','%'.$query.'%')
                                ->orWhere('discount_type','like','%'.$query.'%')
                                ->orWhere('discount_slug','like','%'.$query.'%')
                                ->orderBy('created_at','desc')->paginate(10);

            return view('admin.offers.discount.query_data', compact('discounts'))->render();
        }

        return response()->json(['error'=>'Something went wrong!']);

    }





    
}
