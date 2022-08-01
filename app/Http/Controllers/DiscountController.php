<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\DiscountFormPost;

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

        $validityDateTimeUTC  = localDateTimeToUTC($request->discount_validity);
   
        // $discount_slug = Str::slug($request->discount_name);

        $discount_value = $request->discount_value;

        if($request->discount_type === 'fixed'){
            $discount_value = $request->discount_value * 100;
        }

        $create_discount = Discount::create($request->except(['discount_validity','discount_value'])+[
            'discount_validity'=>$validityDateTimeUTC,
            'discount_value'=>$discount_value,
        ]);

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

        $discount_validity = UTCdateTimeToLocal($discount->discount_validity);

        $data_array = [
            'discount'=>$discount,
            'discount_type'=>$discount_type,
            'discount_validity'=>$discount_validity,
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

        $validityDateTimeUTC  = localDateTimeToUTC($request->discount_validity);

        $discount_value = $request->discount_value;
        
        if($request->discount_type === 'fixed'){
            $discount_value = $request->discount_value * 100;
        }

        if($discount_exists != true){

            $discount->discount_type = $request->discount_type;
            $discount->discount_name = $request->discount_name;
            $discount->discount_slug = $request->discount_slug;
            $discount->discount_value = $discount_value;
            $discount->discount_validity = $validityDateTimeUTC;

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


    // public function updateStatusOnExpiry()
    // {

    //     updateDiscountStatusOnExpiry();

    //     return response(null, Response::HTTP_NO_CONTENT);
        
    // }




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
