<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderShipped;
use App\Mail\OrderDelivered;
use Illuminate\Http\Request;
use App\Jobs\OrderShippedJob;
use App\Jobs\OrderDeliveredJob;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view-any', Order::class);

        $orders = Order::orderBy('created_at','desc')->paginate(20);

        return view('admin.order.index', compact('orders'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        Gate::authorize('view', $order);

        $order->load('order_items');

        return view('admin.order.order_details', compact('order'))->render();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Gate::authorize('delete', $order);

        if(request()->ajax()){

            $order->delete();

            $order_sort_btn_data = [
                'order_sort_default_btn'=>'('.total_orders_count().')',
                'order_sort_pending_btn'=>'('.pending_orders_count().')',
                'order_sort_processing_btn'=>'('.processing_orders_count().')',
                'order_sort_delivering_btn'=>'('.delivering_orders_count().')',
                'order_sort_completed_btn'=>'('.completed_orders_count().')',
            ];

            return response()->json(['success'=>'Deleted Successfully!','order_sort_btn_data'=>$order_sort_btn_data]);

        }

        return redirect()->back();
    }


    public function queryOrder(Request $request)
    {
        $orders = Order::where('id','LIKE','%'.$request->order_query.'%')
                        ->orWhere('billing_email','LIKE','%'.$request->order_query.'%')
                        ->orderBy('created_at','desc')->paginate(20);

        if($request->order_query == ''){
            $orders = Order::orderBy('created_at','desc')->paginate(20);
        }

        if($request->order_sort_by != 'default'){
            $orders = Order::where('id','LIKE','%'.$request->order_query.'%')
                            ->where('order_status',$request->order_sort_by)
                            ->orWhere('billing_email','LIKE','%'.$request->order_query.'%')
                            ->where('order_status',$request->order_sort_by)
                            ->orderBy('created_at','desc')->paginate(20);
        }

        return view('admin.order.query_data', compact('orders'))->render();
    }


    public function updateOrderStatus(Order $order)
    {
        Gate::authorize('update'); 

        if(request()->ajax()){

            $status = $order->order_status;

            if( $status == 'pending'){
                $order->order_status = 'processing';
            }
            elseif($status == 'processing') {
                $order->order_status = 'delivering';

                $delay = DB::table('jobs')->count()*10;

                dispatch(new OrderShippedJob($order))->delay($delay);
            }
            elseif($status == 'delivering'){
                $order->order_status = 'completed';

                if($order->payment_status == 'due'){
                    $order->payment_status = 'paid';
                }
                
                $delay = DB::table('jobs')->count()*10;

                dispatch(new OrderDeliveredJob($order))->delay($delay);
            }

            $order->save();

            $order_sort_btn_data = [
                'order_sort_default_btn'=>'('.total_orders_count().')',
                'order_sort_pending_btn'=>'('.pending_orders_count().')',
                'order_sort_processing_btn'=>'('.processing_orders_count().')',
                'order_sort_delivering_btn'=>'('.delivering_orders_count().')',
                'order_sort_completed_btn'=>'('.completed_orders_count().')',
            ];
            
            return response()->json(['status'=>'success','order_sort_btn_data'=>$order_sort_btn_data]);
        }

        return redirect()->back();
    }


    public function orderInvoice(Order $order)
    {
        Gate::authorize('view', $order);

        $order->load('order_items');

        Pdf::setOptions([
            'dpi'=>150,
            'isHtml5ParserEnabled'  =>true,
        ]);

        $invoice = view('admin.order.invoice', compact('order'))->render();

        $pdf = Pdf::loadHTML($invoice)->setPaper('a4','portrait')->save(public_path().'/uploads/invoice/order/invoice.pdf');

        return $pdf->stream('invoice.pdf');
    }




    


}
