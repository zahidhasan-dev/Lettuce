<?php

    function countries()
    {
        return App\Models\Country::orderBy('country_name')->get();
    }

    function cityByCountry($country_id)
    {
        return App\Models\City::where('country_id',$country_id)->orderBy('city_name')->get();
    }


    function couponExpiryDate($coupon_id)
    {
        $coupon = App\Models\Coupon::where('id',$coupon_id)->first();


        if($coupon->coupon_validity >= Carbon\Carbon::now()){

            $couponValidityTime = \Carbon\Carbon::parse($coupon->coupon_validity)->diffInMilliseconds(\Carbon\Carbon::now()->format('Y-m-d h:i:s A'));
            
            $days = floor($couponValidityTime / (1000 * 60 * 60 * 24));
            $hours = floor(($couponValidityTime % (1000 * 60 * 60* 24)) / (1000 * 60 * 60));
            $minutes = floor(($couponValidityTime % (1000 * 60 * 60)) / (1000 * 60));
            $seconds = floor(($couponValidityTime % (1000 * 60 )) / 1000);

            $result = $days.'d '.$hours.'h '.$minutes.'m '.$seconds.'s';
            $data_array=[
                'result' => $result,
                'status' => 'active',
            ];
            
            return $data_array;

        } else{

            $result = "expired";
            $data_array=[
                'result' => $result,
                'status' => 'expired',
            ];
            
            return $data_array;
        }

    }


    function discountExpiryDate($discount_id)
    {
        $discount = App\Models\Discount::where('id',$discount_id)->first();


        if($discount->discount_validity >= \Carbon\Carbon::now()){

            $discountValidityTime = \Carbon\Carbon::parse($discount->discount_validity)->diffInMilliseconds(\Carbon\Carbon::now()->format('Y-m-d h:i:s A'));

            $days = floor($discountValidityTime / (1000 * 60 * 60* 24));
            $hours = floor($discountValidityTime % (1000 * 60 * 60* 24) / (1000 * 60 * 60));
            $minutes = floor($discountValidityTime % (1000 * 60 * 60) / (1000 * 60 ));
            $seconds = floor($discountValidityTime % (1000 * 60 ) / 1000);


            $result = $days.'d '.$hours.'h '.$minutes.'m '.$seconds.'s';

            $data_array = [
                'status'=>'active',
                'result'=>$result,
            ];

            return $data_array;

        }
        else{

            $result = 'expired';

            $data_array = [
                'status'=>'expired',
                'result'=>$result,
            ];

            return $data_array;

        }

        
    }



?>