<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponFormPost;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $coupons  = Coupon::orderBy('created_at','desc')->paginate(10);

        return view('admin.offers.coupon.index', compact('coupons'));

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
    public function store(CouponFormPost $request)
    {

        $coupon_validity = localDateTimeToUTC($request->coupon_validity);

        
        $coupon_value = $request->coupon_value;

        if($request->coupon_type === 'fixed'){
            $coupon_value = $request->coupon_value * 100;
        }

        $create_coupon = Coupon::create($request->except(['coupon_validity','coupon_value'])+[
            'coupon_validity'=>$coupon_validity,
            'coupon_value'=>$coupon_value,
        ]);

        if($create_coupon){
            return redirect()->back()->with(['success'=>'Created successfully!']);
        }

        return redirect()->back()->with(['error'=>'Something went wrong!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {

        $coupon_type = '<option value="" selected disabled>-- Select Type --</option>
                        <option value="fixed" '.(($coupon->coupon_type == 'fixed')?'selected':'').'>Fixed</option>
                        <option value="percent" '.(($coupon->coupon_type == 'percent')?'selected':'').'>Percent</option>';

        $coupon_validity = UTCdateTimeToLocal($coupon->coupon_validity);

        $data_array =[
            'coupon'=>$coupon,
            'coupon_type'=>$coupon_type,
            'coupon_validity'=>$coupon_validity,
        ];

        return response()->json($data_array);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $coupon_exists = Coupon::where('id','!=',$coupon->id)->where('coupon_code',$request->coupon_code)->first();

        $coupon_validity = localDateTimeToUTC($request->coupon_validity);

        $coupon_value = $request->coupon_value;

        if($request->coupon_type === 'fixed'){
            $coupon_value = $request->coupon_value * 100;
        }

        if($coupon_exists != true){

            $coupon->coupon_type = $request->coupon_type;
            $coupon->coupon_code = $request->coupon_code;
            $coupon->coupon_value = $coupon_value;
            $coupon->coupon_validity = $coupon_validity;

            $coupon_update = $coupon->save();

            if($coupon_update){
                return response()->json(['success'=>'Successfully updated']);
            }

            return response()->json(['error'=>'Something went wrong!']);

        }

        return response()->json(['coupon_exists'=>'Coupon already exists!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $delete = $coupon->delete();

        if($delete)
        {
            return response()->json(['success'=>'Deleted successfully!']);
        }

        return response()->json(['error'=>'Something went wrong']);
    }


    public function updateCouponStatus($coupon_id)
    {
        $coupon = Coupon::where('id',$coupon_id)->first();

        if($coupon->status == 0){
            $coupon->status = 1;
        }
        else{
            $coupon->status = 0;
        }

        $update_status = $coupon->save();

        if($update_status){
            return response()->json(['success'=>'Status updated successfully!']);
        }

        return response()->json(['error'=>'Something went wrong!']);

    }

    public function updateStatusOnExpiry($coupon_id)
    {
        $coupon = Coupon::where('id',$coupon_id)->first();

        if($coupon->status == 1){

            $coupon->status = 0;
            $coupon->save();
            $data_array = [
                'updated'=>'Status updated',
                'coupon_id'=>$coupon->id,
            ];

            return response()->json($data_array);

        }

       
        return response()->json(['notUpdated'=>'status not updated']);

    }



    public function queryCouponData(Request $request)
    {

        if($request->ajax()){

            $query =  $request->coupon_query;
            
            if($query != ''){
                $coupons = Coupon::where('coupon_code', 'like', '%'.$query.'%')
                                        ->orWhere('coupon_value', 'like', '%'.$query.'%')
                                        ->orWhere('coupon_type', 'like', '%'.$query.'%')
                                        ->orderBy('created_at','desc')
                                        ->paginate(10);
                
                return view('admin.offers.coupon.query_data',compact('coupons'))->render();

            }
        }

        return response()->json(['error'=>'Something went wrong!']);
    }
}
