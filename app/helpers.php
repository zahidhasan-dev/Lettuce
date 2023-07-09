<?php

    if(!function_exists('get_category_name')){

        function get_category_name(int $category_id){
            $category = \App\Models\Category::where('id',$category_id)->first();

            return $category->category_name;
        }

    }
    
    
    if(!function_exists('get_discount_name')){

        function get_discount_name(int $discount_id){
            $discount = \App\Models\Discount::where('id',$discount_id)->first();

            return $discount->discount_name;
        }

    }


    if(!function_exists('countries')){

        function countries()
        {
            return \App\Models\Country::orderBy('country_name')->get();
        }

    }

    
    if(!function_exists('cityByCountry')){

        function cityByCountry($country_id)
        {
            return \App\Models\City::where('country_id',$country_id)->orderBy('city_name')->get();
        }

    }


    if(!function_exists('get_city_name')){

        function get_city_name(int $city_id)
        {
            $city = \App\Models\City::where('id',$city_id)->first();

            return $city->city_name;
        }

    }


    if(!function_exists('get_country_name')){

        function get_country_name(int $country_id)
        {
            $country = \App\Models\Country::where('id',$country_id)->first();

            return $country->country_name;
        }

    }
    

    if(!function_exists('couponExpiryDate')){

        function couponExpiryDate($coupon_id)
        {
            $coupon = \App\Models\Coupon::where('id',$coupon_id)->first();
    
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

    }


    if(!function_exists('couponValue')){

        function couponValue($coupon_id)
        {
            $coupon = \App\Models\Coupon::where('id',$coupon_id)->first();
            $value = '';
    
            if($coupon->coupon_type === 'percent'){
                $value = $coupon->coupon_value;
            }
            else{
                $value = number_format(($coupon->coupon_value / 100),2);
            }
            
            return $value;

        }

    }


    if(!function_exists('couponValueType')){

        function couponValueType($coupon_id)
        {
            $coupon = \App\Models\Coupon::where('id',$coupon_id)->first();
            $value = '';
    
            if($coupon->coupon_type === 'percent'){
                $value = $coupon->coupon_value.'%';
            }
            else{
                $value = '$'.number_format(($coupon->coupon_value / 100),2);
            }
            
            return $value;

        }

    }


    if(!function_exists('discountExpiryDate')){

        function discountExpiryDate($discount_id)
        {
            $discount = \App\Models\Discount::where('id',$discount_id)->first();
    
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

    }
    

    if(!function_exists('discountValueType')){

        function discountValueType($discount_id)
        {
            $discount = \App\Models\Discount::where('id',$discount_id)->first();
            $value = '';
    
            if($discount->discount_type === 'percent'){
                $value = $discount->discount_value.'%';
            }
            else{
                $value = '$'.number_format(($discount->discount_value / 100),2);
            }
            
            return $value;

        }

    }


    if(!function_exists('discountValue')){

        function discountValue($discount_id)
        {
            $discount = \App\Models\Discount::where('id',$discount_id)->first();
            $value = '';
    
            if($discount->discount_type === 'percent'){
                $value = $discount->discount_value;
            }
            else{
                $value = round(($discount->discount_value / 100),2);
            }
            
            return $value;

        }

    }


    if(!function_exists('discountPrice')){

        function discountPrice($product_id)
        {
            $product = \App\Models\Product::where('id',$product_id)->first();
            
            if($product->product_discount){
                
                $discount = $product->product_discount->discount;

                if($discount->discount_type === 'percent'){
                    $discount_price = ($product->price - (($discount->discount_value / 100) * $product->price)) / 100;
                }
                else{
                    $discount_price = ($product->price - $discount->discount_value) / 100; 
                }

                if($discount_price < 0){
                    $discount_price = 0;
                }
                
                return number_format($discount_price,2);
                
            }

    
        }

    }

   
    if(!function_exists('validateDiscount')){

        function validateDiscount($discount_id)
        {
            $discount = \App\Models\Discount::where('id',$discount_id)->first();

            if($discount){

                $discountValidityTime = \Carbon\Carbon::parse($discount->discount_validity)->timestamp;
                
                if($discountValidityTime >= \Carbon\Carbon::now()->timestamp && $discount->status == 1){
                    return true;
                }

            }

            return false;

        }

    }


    if(!function_exists('getProductDiscount')){

        function getProductDiscount($product_id){

            $product = \App\Models\Product::where('id',$product_id)->first();

            if($product->product_discount){

                $discount = $product->product_discount->discount;

                return $discount;

            }

        }

    }


    if(!function_exists('productHasDiscount')){

        function productHasDiscount($product_id)
        {
            $product = \App\Models\Product::where('id',$product_id)->firstOrFail();

            if($product->has_discount && getProductDiscount($product->id) != null){
                if(validateDiscount(getProductDiscount($product->id)->id) === true){
                    return true;
                }
            }

            return false;
        }

    }

    if(!function_exists('deleteProductDiscountOnExpiry')){

        function deleteProductDiscountOnExpiry()
        {
            $discounted_products = \App\Models\Product::where('has_discount',1)->where('status',1)->with('product_discount.discount', function($query){
                $query->where('status',1)->where('discount_validity','>=',\Carbon\Carbon::now());
            })->get();

            foreach($discounted_products as $product){
                if(!productHasDiscount($product->id)){

                    \Illuminate\Support\Facades\DB::beginTransaction();

                    try {

                        \App\Models\ProductDiscount::where('product_id',$product->id)->delete();

                        \App\Models\Product::where('id',$product->id)->update([
                            'has_discount'=>0,
                        ]);

                        \Illuminate\Support\Facades\DB::commit();

                    } catch (\Throwable $th) {

                        \Illuminate\Support\Facades\DB::rollback();
                        
                    }

                }

            }

        }

    }


    if(!function_exists('product_size_value')){

        function product_size_value(\App\Models\Product $product){

            $size_value = 0;

            foreach($product->size as $size){
                $size_value = $size->pivot->size_value;
            }

            return $size_value;

        }

    }
    

    if(!function_exists('productSize')){

        function productSize($product_id){

            $product = \App\Models\Product::where('id',$product_id)->first();

            if($product){

                $product_size = $product->size[0]->pivot->size_value.' '.$product->size[0]->scale_name;

                return $product_size;

            }

            return false;
        }

    }

    
    if(!function_exists('productPrice')){

        function productPrice($product_id)
        {
            $product =  \App\Models\Product::where('id',$product_id)->first();
            
            $product_price = number_format(($product->price / 100), 2);

            return  $product_price;
        }

    }

    
    if(!function_exists('updateDiscountStatusOnExpiry')){

        function updateDiscountStatusOnExpiry(){

            $discounts = \App\Models\Discount::all();

            foreach($discounts as $discount){

                $discountValidityTime = \Carbon\Carbon::parse($discount->discount_validity)->timestamp;

                if($discountValidityTime < \Carbon\Carbon::now()->timestamp){
                    if($discount->status == 1){
                        $discount->status = 0;
                        $discount->save();
                    }
                }

            }
        }

    }

    
    if(!function_exists('localDateTimeToUTC')){

        function localDateTimeToUTC($dateTime = '')
        {
            if($dateTime != null){

                $dateTime = $dateTime; 
                $tz_from = 'Asia/Dhaka'; 
                $newDateTime = new DateTime($dateTime, new DateTimeZone($tz_from)); 
                $newDateTime->setTimezone(new DateTimeZone("UTC")); 
                $dateTimeUTC = $newDateTime->format("Y-m-d H:i:s");

                return $dateTimeUTC;
            }

            return false;
        }

    }


    if(!function_exists('UTCdateTimeToLocal')){

        function UTCdateTimeToLocal($dateTime = '')
        {
            if($dateTime != null){

                $date = date_create($dateTime,timezone_open("UTC"));
                date_timezone_set($date,timezone_open("Asia/Dhaka"));
                $dateTimeLocal = date_format($date,"Y-m-d H:i:s");
    
                return $dateTimeLocal;
            }
    
            return false;
        }

    }


    if(!function_exists('productsByCategory')){

        function productsByCategory(int $category_id)
        {   
            $category = \App\Models\Category::where('id',$category_id)->where('status',1)->firstOrFail();

            $ids = collect($category->id);

            if($category->sub_category->count() > 0){
                foreach($category->sub_category as $sub_category){
                    $ids = $ids->merge($sub_category->id);
                }
            }

            $products = \App\Models\Product::whereHas('categories', function($query) use ($ids){
                $query->whereIn('id',$ids)->where('status',1);
            })->with('categories.main_category')->where('status',1);

            return $products;
        }
        
    }


    if(!function_exists('product_is_latest')){

        function product_is_latest(int $product_id)
        {
            $product = \App\Models\Product::where('id',$product_id)->where('status',1)->where('created_at','>=',\Carbon\Carbon::now()->subDays(3))->first();

            if($product != null){
                return true;
            }
            return false;
        }

    }


    if(!function_exists('relatedProduct')){
        function relatedProduct($product_id)
        {
            $product = \App\Models\Product::with('categories')->where('id',$product_id)->where('status',1)->firstOrFail();

            $category_ids = collect();

            foreach($product->categories as $category){
                $category_ids = $category_ids->merge($category->id);
                if($category->sub_category->count() > 0){
                    foreach($category->sub_category as $sub_category){
                        $category_ids =$category_ids->merge($sub_category->id);
                    }
                }
            }
            
            $related_products = \App\Models\Product::whereHas('categories', function($query) use ($category_ids){
                                                        $query->whereIn('id',$category_ids);
                                                    })->where('id','!=',$product_id)->where('status',1)->inRandomOrder()->limit(6)->get();
                                       

            return $related_products;

        }
    }


    if(!function_exists('getWishlists')){

        function getWishlists()
        {

            $wishlists = [];

            if(auth()->check()){

                $ids =  collect();
                $get_wishlists = \App\Models\Wishlist::where('user_id',auth()->user()->id)->get();

                foreach($get_wishlists as $get_wishlist){
                    $ids = $ids->merge($get_wishlist->product_id);
                }

                $wishlists = \App\Models\Product::whereIn('id',$ids)->where('status',1)->select('id','product_name','thumbnail','price','in_stock','slug')->get();

            }
            else{

                if(session('wishlist') != null){
                    foreach(session('wishlist') as $wishlist){
                        $wishlists[] = (object)$wishlist;
                    }
                }

            }

            return $wishlists;

        }

    }


    if(!function_exists('insertSessionWishlistToDB')){

        function insertSessionWishlistToDB()
        {
            if(auth()->check() && !auth()->user()->is_admin){

                if(session()->has('wishlist') && session('wishlist') != null){

                    $wishlists = session('wishlist',[]);

                    foreach($wishlists as $wishlist){

                        $wishlist = (object)$wishlist;
                        $wishlist_exists = \App\Models\Wishlist::where('user_id',auth()->user()->id)->where('product_id',$wishlist->id)->exists();

                        if(!$wishlist_exists){

                            \App\Models\Wishlist::create([
                                'user_id'=>auth()->user()->id,
                                'product_id'=>$wishlist->id,
                                'created_at'=>\Carbon\Carbon::now()
                            ]);

                        }

                    }

                    session()->forget('wishlist');

                }

            }

        }

    }


    if(!function_exists('insertSessionCartToDB')){

        function insertSessionCartToDB()
        {
            if(auth()->check() && !auth()->user()->is_admin){

                if(session()->has('cart') && session('cart') != null){

                    $cart = session('cart',[]);

                    foreach($cart as $cart_item){
                        $cart_item = (object)$cart_item;
                        $check_cart_item = \App\Models\Cart::where('user_id',auth()->user()->id)->where('product_id',$cart_item->id)->first();

                        if($check_cart_item != null){
                            
                            if(getProductStock($cart_item->id) > 20){

                                $updated_quantity = $check_cart_item->quantity + $cart_item->quantity;

                                if($updated_quantity > 10){
                                    $updated_quantity = 10;
                                }

                                $check_cart_item->quantity = $updated_quantity;
                                $check_cart_item->save();

                            }

                        }
                        else {

                            if(getProductStock($cart_item->id) > 0){
                                
                                $cart_quantity = $cart_item->quantity;
    
                                if(getProductStock($cart_item->id) > 0 && getProductStock($cart_item->id) <= 20){
                                    $cart_quantity = 1;
                                }
                                else if(getProductStock($cart_item->id) > 20){
                                    if($cart_item->quantity > 10){
                                        $cart_quantity = 10;
                                    }
                                }
    
                                \App\Models\Cart::create([
                                    'user_id'=>auth()->user()->id,
                                    'product_id'=>$cart_item->id,
                                    'quantity'=>$cart_quantity,
                                    'created_at'=>\Carbon\Carbon::now(),
                                ]);

                            }
                        }

                        session()->forget('cart');

                    }

                }
            }
        }

    }


    if(!function_exists('getCart')){

        function getCart()
        {
            $cart_products = [];

            if(auth()->check()){

                $carts = \App\Models\Cart::where('user_id',auth()->user()->id)->get();

                foreach($carts as $cart){
                    $cart_product = \App\Models\Product::where('id',$cart->product_id)
                                                        ->where('status',1)
                                                        ->select('id','product_name','thumbnail','price','slug','in_stock')
                                                        ->first();

                    $cart_product['quantity'] = $cart->quantity;
                    $cart_products[] = $cart_product;
                }

            }
            else{

                if(session()->has('cart') && session('cart') != null ){

                    $carts = session('cart');

                    foreach($carts  as $cart){
                        $cart_product = \App\Models\Product::where('id',$cart['id'])
                                                            ->where('status',1)
                                                            ->select('id','product_name','thumbnail','price','slug','in_stock')
                                                            ->first();

                        $cart_product['quantity'] = $cart['quantity'];
                        $cart_products[] = $cart_product;
                    }

                }

            }

            return $cart_products;
        }

    }


    if(!function_exists('getCartNumber')){

        function getCartNumber()
        {   
            $cartNumber = 0;

            if(auth()->check()){
                $cartNumber = \App\Models\Cart::where('user_id',auth()->user()->id)->count();
            }
            else{
                if(session()->has('cart')){
                    $cartNumber = count(session('cart'));
                }
            }

            return $cartNumber;
        }

    }


    if(!function_exists('productTotalPrice')){

        function productTotalPrice($product_id,$product_quantity)
        {   

            $product_price = productPrice($product_id);

            if(productHasDiscount($product_id)){
                $product_price = discountPrice($product_id);
            }

            $total_price = number_format(($product_price * $product_quantity),2);

            return $total_price;
        }
        
    }


    if(!function_exists('getProductStock')){

        function getProductStock($product_id)
        {
            $product = \App\Models\Product::where('id',$product_id)->first();
            return $product->in_stock;
        }

    }


    if(!function_exists('getCartSubTotal')){

        function getCartSubTotal()
        {
            $cart_sub_total = 0 ;

            foreach(getCart() as $cart){

                $product_price = productTotalPrice($cart->id,$cart->quantity);

                $cart_sub_total += $product_price;

            }

            return $cart_sub_total;
        }

    }


    if(!function_exists('getCartTotal')){

        function getCartTotal(){

            $cartSubTotal =  (getCartSubTotal() * 100);
            $shipping = 10 * 100;
            
            if(getCartSubTotal() > 100 || getCartNumber() == 0){
                $shipping = 0;
            }

            $coupon_code = null;
            $coupon_value_type = null;
            $coupon_amount = 0;

            if(session()->has('coupon') && session()->get('coupon') != null){

                $coupon = session()->get('coupon');
                $coupon_code = $coupon['coupon_code'];
                $coupon_value_type = $coupon['coupon_type'];
                $coupon_amount = couponDiscountAmount($coupon_code);

            }

            $newSubTotal = $cartSubTotal - $coupon_amount;

            if($newSubTotal < 0){
                $newSubTotal = 0;
            }

            $vat = 15 / 100;
            $vat_value = $newSubTotal * $vat;

            $cartTotal = ($newSubTotal * (1 + $vat)) + $shipping;


            return collect([
                'coupon_code'=>$coupon_code,
                'coupon_value_type'=>$coupon_value_type,
                'coupon_discount_amount'=>$coupon_amount,
                'vat'=>$vat,
                'vat_value'=>$vat_value,
                'shipping'=>$shipping,
                'cart_sub_total'=>$cartSubTotal,
                'new_sub_total'=>$newSubTotal,
                'cartTotal'=>$cartTotal,
            ]);

        }
        
    }


    if(!function_exists('couponDiscountAmount')){

        function couponDiscountAmount($coupon_code)
        {
            $coupon = App\Models\Coupon::where('coupon_code',$coupon_code)->first();

            $coupon_amount = $coupon->coupon_value;

            if($coupon->coupon_type === 'percent'){
                $coupon_amount = (getCartSubTotal() * 100) * ($coupon->coupon_value / 100);
            }
            
            return $coupon_amount;
        }

    }


    if(!function_exists('checkPurchase')){

        function checkPurchase($product_id){
            $order_item =\App\Models\User::where('id',auth()->user()->id)
                                        ->with('ordered_products', function($query) use ($product_id){
                                            $query->where('product_id', $product_id);
                                        })->first();
    
            if($order_item->ordered_products->count() > 0){
                return true;
            }
    
            return false;
        }

    }


    if(!function_exists('checkReview')){

        function checkReview($product_id){
            $review = \App\Models\ProductReview::where('product_id',$product_id)
                                                ->where('user_id',auth()->user()->id)
                                                ->exists();
    
            if($review){
                return true;
            }
            return false;
        }

    }


    if(!function_exists('getUser')){

        function getUser($user_id){
            return \App\Models\User::where('id',$user_id)->first();
        }

    }


    if(!function_exists('getReviewNumber')){

        function getReviewNumber($product_id){
            $product = \App\Models\Product::where('id',$product_id)->with('reviews')->first();
            return $product->reviews->count();
        }

    }


    if(!function_exists('getAvgRating')){

        function getAvgRating($product_id){
            $review_rating_count = \App\Models\ProductReview::where('product_id',$product_id)->sum('review_rating');

            $get_review_number = getReviewNumber($product_id);
            $avg_rating = 0;

            if($get_review_number != 0){
                $avg_rating = $review_rating_count / $get_review_number;
            }

            $floor_avg = floor($avg_rating);

            if($avg_rating != 0){

                if($avg_rating != $floor_avg){

                    $empty_star = (5 - $floor_avg) - 1;

                    for($i=1;$i<=5;$i++){

                        echo '<li style="margin:0px 1px;"><i class="fas fa-star"></i></li>';

                        if($floor_avg == $i){

                            break;

                        }

                    }

                    echo '<li style="margin:0px 1px;"><i class="fas fa-star-half-alt"></i></li>';

                    if($empty_star > 0){

                        for($i=1;$i<=$empty_star;$i++){

                            echo '<li style="margin:0px 1px;"><i class="far fa-star"></i></li>';

                        }

                    }

                }
                else{

                    $empty_star = 5 - $avg_rating;

                    for($i=1;$i<=5;$i++){

                        echo '<li style="margin:0px 1px;"><i class="fas fa-star"></i></li>';

                        if($avg_rating == $i){

                            break;

                        }
                    }

                    if($empty_star > 0){

                        for($i=1;$i<=$empty_star;$i++){

                            echo '<li style="margin:0px 1px;"><i class="far fa-star"></i></li>';

                        }

                    }
                }

            }
            else{

                for($i=1;$i<=5;$i++){

                    echo '<li style="margin:0px 1px;"><i class="far fa-star"></i></li>';

                }
                
            }

        }

    }


    if(!function_exists('top_rated_products')){

        function top_rated_products(){
            return  \App\Models\Product::where('status',1)
                                        ->whereHas('reviews')
                                        ->withCount('reviews')
                                        ->orderBy('reviews_count','desc');
        }

    }


    if(!function_exists('getStockStatus')){

        function getStockStatus($product_id){
            $product = \App\Models\Product::where('id',$product_id)->first();

            if ($product->in_stock > 20){
                $stockStatus = '<span class="text-success">In Stock</span>';                       
            }
            elseif ($product->in_stock > 0 && $product->in_stock <= 20){
                $stockStatus = '<span class="text-warning">Low Stock</span>'; 
            }
            else{
                $stockStatus = '<span class="text-danger">Out Of Stock</span>';
            }

            echo $stockStatus;
        }

    }


    if(!function_exists('total_orders_count')){

        function total_orders_count(){
            return \App\Models\Order::count();
        }

    }


    if(!function_exists('pending_orders_count')){

        function pending_orders_count(){
            return \App\Models\Order::where('order_status','pending')->count();
        }

    }


    if(!function_exists('processing_orders_count')){

        function processing_orders_count(){
            return \App\Models\Order::where('order_status','processing')->count();
        }

    }


    if(!function_exists('delivering_orders_count')){

        function delivering_orders_count(){
            return \App\Models\Order::where('order_status','delivering')->count();
        }

    }

    
    if(!function_exists('completed_orders_count')){

        function completed_orders_count(){
            return \App\Models\Order::where('order_status','completed')->count();
        }

    }


    if(!function_exists('total_unread_message')){

        function total_unread_message(){
            return \App\Models\Message::whereNull('message_id')->where('is_read',false)->count();
        }

    }


    if(!function_exists('contact_address')){

        function contact_address(){
            $address = \App\Models\ContactAddress::where('is_active',1)->first();

            return $address->contact_address ?? null;
        }

    }


    if(!function_exists('primary_contact_email')){

        function primary_contact_email(){
            $email = \App\Models\ContactEmail::where('is_primary',1)->where('is_active',1)->first();

            return $email->contact_email ?? null;
        }

    }


    if(!function_exists('primary_contact_phone')){

        function primary_contact_phone(){
            $phone = \App\Models\ContactPhone::where('is_primary',1)->where('is_active',1)->first();

            return $phone->contact_phone ?? null;
        }

    }



    if(!function_exists('get_revenue_growth_rate')){

        function get_revenue_growth_rate(int $final_value, int $initial_value){


            if($initial_value == 0){
                $growth = 100;
            }
            else{
                $growth = ((($final_value-$initial_value)/$initial_value)*100);
            }

            return number_format($growth,(is_float($growth) ? 2 : 0));
            
        }

    }




?>