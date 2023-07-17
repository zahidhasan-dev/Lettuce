<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }


    public function index()
    {
        $growth_data = [
            'today' => Order::today()->countTotal(),
            'yesterday' => Order::yesterday()->countTotal(),
            'current_week' => Order::weekly(now()->subWeek(),now())->countTotal(),
            'last_week' => Order::weekly(now()->subWeeks(2),now()->subWeek())->countTotal(),
            'current_month' => Order::monthly(now()->subMonth(),now())->countTotal(),
            'last_month' => Order::monthly(now()->subMonths(2),now()->subMonth())->countTotal(),
            'current_year' => Order::yearly(now()->subYear(),now())->countTotal(),
            'last_year' => Order::yearly(now()->subYears(2),now()->subYear())->countTotal(),
        ];

        $total_customer = User::where('is_admin',0)->count();

        $total_product = Product::where('status',1)->count();

        $count_total_order = Order::countTotal();

        $top_cities_by_order = City::select('city_name')
                                ->whereHas('orders')
                                ->withCount('orders')
                                ->orderBy('orders_count','desc')
                                ->limit(3)
                                ->get();

        $top_rated_products = top_rated_products()->limit(3)->get();                        
        
        $best_seller_products = best_selling_products()->limit(3)->get();  
        
        $most_viewed_products = most_viewed_products()->limit(3)->get();

        $latest_orders = Order::orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();

        return view('admin.home', compact(
            'latest_orders',
            'growth_data',
            'top_cities_by_order',
            'count_total_order',
            'total_product',
            'total_customer',
            'top_rated_products',
            'best_seller_products',
            'most_viewed_products',
        ));
    }



    public function chart_data()
    {
        if(request()->isXmlHttpRequest()){  

            $get_data = $this->getChartData();
    
            $data = array_map(function($d){

                return [Carbon::createFromFormat('Y-m-d', $d['date'])->timestamp*1000, $d['order'],number_format($d['revenue']/100,2)];

            },(array)$get_data,[]);
    
            return response()->json($data);
            
        }

        return response()->json(['error' => 'Bad Request'], 400);
    }



    protected function getChartData()
    {
        $data = [];
        $start_from = "2022-01-01";
        $current = Carbon::createFromFormat('Y-m-d', $start_from)->format('Y-m-d');
        $add_days = 0;

        while($current < now()->format('Y-m-d')){
            $current = Carbon::createFromFormat('Y-m-d', $start_from)->addDays($add_days)->format('Y-m-d');

            $data[$current] = [
                'date'=>$current,
                'order'=>0,
                'revenue'=>0,
            ];

            $add_days++;
        }

        $orders_data =  Order::select('order_total',DB::raw('DATE(created_at) as date'))
                                ->get()
                                ->groupBy('date')
                                ->map(function($orders){
                                    $revenue = 0;
                                    $new_data = [];

                                    foreach ($orders as $order) {
                                        $revenue += $order->order_total;

                                        $new_data = [
                                            'date' =>$order->date,
                                            'order' =>count($orders),
                                            'revenue' =>$revenue,
                                        ];
                                    }

                                    return $new_data;
                                });

        forEach($orders_data as $key => $d){
            if(isset($data[$key])){
                $data[$key] = $d;
            }    
        }

        return $data;
    }

}
