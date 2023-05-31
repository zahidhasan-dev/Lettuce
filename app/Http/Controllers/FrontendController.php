<?php

namespace App\Http\Controllers;

use App\Models\About;
use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\ContactEmail;
use App\Models\ContactPhone;
use App\Models\Discount;
use App\Models\Feature;
use App\Models\ProductView;

class FrontendController extends Controller
{
    

    public function index()
    {   
        $categories = Category::whereNull('parent_category')->with(['sub_category' => function ($query) {
                                    $query->where('status',1)->withCount(['products' => function($q){
                                        $q->where('status',1);
                                    }]);
                                }])->where('status',1)->withCount(['products' => function($q){
                                    $q->where('status',1);
                                }])->get();
        
        $parent_categories = Category::whereNull('parent_category')
                                ->where('status',1)
                                ->limit(5)
                                ->get();

        $top_categories = Category::where('status',1)->withCount(['products' => function($query){
                                        $query->where('status',1);
                                    }])->orderBy('products_count','desc')->limit(4)->get();


        $total_products = Product::where('status',1)->count();

        $banners = Banner::where('banner_type','campaign')->where('status',1)->inRandomOrder()->limit(3)->get();
        $hero_banners = Banner::where('banner_type','hero')->where('status',1)->get();

        // $discounted_products = Product::where('has_discount',1)->where('status',1)->with('product_discount.discount', function($query){
        //     $query->where('status',1)->where('discount_validity','>=',Carbon::now());
        // })->inRandomOrder()->limit(12)->get();

        $discounted_products = Product::whereHas('product_discount.discount', function($q){
                                        $q->where('status',1)->where('discount_validity','>=',Carbon::now());
                                    })
                                    ->with('product_discount.discount')
                                    ->where('status',1)
                                    ->inRandomOrder()
                                    ->limit(12)
                                    ->get();

        $featured_products = Product::where('is_featured',1)
                                ->where('status',1)
                                ->inRandomOrder()
                                ->limit(12)
                                ->get();

        $most_viewed_products = Product::where('status',1)
                                    ->wherehas('product_views')
                                    ->withCount('product_views')
                                    ->orderBy('product_views_count','desc')
                                    ->limit(12)
                                    ->get();

        $best_seller_products = Product::where('status',1)
                                    ->whereHas('product_orders')
                                    ->withCount('product_orders')
                                    ->orderBy('product_orders_count','desc')
                                    ->limit(12)
                                    ->get();

        return view('frontend.home', compact(
            'banners',
            'hero_banners',
            'categories',
            'parent_categories',
            'discounted_products',
            'top_categories',
            'total_products',
            'featured_products',
            'most_viewed_products',
            'best_seller_products'
        ));
    }




    public function shop(Category $category = null, Category $subCategory = null)
    {   
        $cat_ids = collect();

        if($subCategory != null){
            $cat_ids = collect($subCategory->id);

            $products = Product::whereHas('categories', function($query) use ($cat_ids){
                $query->whereIn('id',$cat_ids)->where('status',1);
            })->where('status',1);
        }
        elseif($category != null){
            $category->load('sub_category');
            $cat_ids = collect($category->id);

            if($category->sub_category->count() > 0){
                foreach($category->sub_category as $sub_category){
                    $cat_ids = $cat_ids->merge($sub_category->id);
                }
            }
            $products = Product::whereHas('categories', function($query) use ($cat_ids){
                $query->whereIn('id',$cat_ids)->where('status',1);
            })->where('status',1);
        }
        else{
            $products = Product::where('status',1);
        }     


        if(request()->sort_by == 'popular'){
            $products = $products->withCount('product_views')->orderBy('product_views_count','desc');
        }
        elseif(request()->sort_by == 'latest'){
            $products = $products->orderBy('created_at','desc');
        }
        elseif(request()->sort_by == 'low_to_high'){
            $products = $products->orderBy('price','asc');
        }
        elseif(request()->sort_by == 'high_to_low'){
            $products = $products->orderBy('price','desc');
        }
        else{
            $products = $products->inRandomOrder();
        }

        if(request()->search && request()->search != null){
            $products = $products->where('product_name','LIKE','%'.request()->search.'%')->orWhere('slug','LIKE','%'.request()->search.'%')
                                    ->whereHas('categories', function($query) use ($cat_ids){
                                        $query->whereIn('id',$cat_ids)->where('status',1);
                                    })->where('status',1);
        }


        $products = $products->paginate(18);

        $top_rated_products = top_rated_products()->limit(3)->get();

        $categories = Category::whereNull('parent_category')->with('sub_category', function($query){
                                    $query->where('status',1);
                                })->where('status',1)->get();
                                
        $banner = Banner::where('banner_type','campaign')->where('status',1)->inRandomOrder()->first();

        return view('frontend.shop', compact('products','top_rated_products','banner','categories'));

    }


    public function shopSale($sale = null)
    {   

        $banner_query = Banner::where('banner_type','campaign');

        if($sale != null){
            $sale_banner = Banner::where('banner_slug',$sale)
                            ->whereNotNull('discount_id')
                            ->where('status',1)
                            ->firstOrFail();
    
            $query = Product::whereHas('product_discount.discount', function($q) use($sale_banner){
                                $q->where('id',$sale_banner->discount_id)->where('status',0)->where('discount_validity','>=',Carbon::now());
                            })
                            ->with('product_discount.discount')
                            ->inRandomOrder();                                
    
            if($sale_banner->category_id != null){

                $category_ids = collect($sale_banner->category_id);

                $category = Category::where('id',$sale_banner->category_id)->where('status',1)->first();
                $category->load('sub_category');

                if($category->sub_category->count()> 0){
                    foreach($category->sub_category as $sub_category){
                        $category_ids = $category_ids->merge($sub_category->id);
                    }
                } 
    
                $query = Product::whereHas('categories',function($q) use($category_ids){
                                    $q->whereIn('id',$category_ids)->where('status',1);
                                })
                                ->whereHas('product_discount.discount', function($q) use($sale_banner){
                                    $q->where('id',$sale_banner->discount_id)->where('status',1)->where('discount_validity','>=',Carbon::now());
                                })
                                ->with('product_discount.discount')
                                ->inRandomOrder();    
                                
                $banner_query = $banner_query->where('id','!=',$sale_banner->id);
    
            }
        }
        else{
            $query = Product::whereHas('product_discount.discount', function($q){
                                $q->where('status',1)->where('discount_validity','>=',Carbon::now());
                            })
                            ->with('product_discount.discount')
                            ->inRandomOrder();                                
        }

        if(request()->sort_by == 'popular'){
            $query = $query->withCount('product_views')->orderBy('product_views_count','desc');
        }
        elseif(request()->sort_by == 'latest'){
            $query = $query->orderBy('created_at','desc');
        }
        elseif(request()->sort_by == 'low_to_high'){
            $query = $query->orderBy('price','asc');
        }
        elseif(request()->sort_by == 'high_to_low'){
            $query = $query->orderBy('price','desc');
        }
        else{
            $query = $query->inRandomOrder();
        }

        if(request()->search && request()->search != null){
            $query = $query->where(function($q){
                $q->where('product_name','LIKE','%'.request()->search.'%')
                    ->orWhere('slug','LIKE','%'.request()->search.'%');
            });
        }

        $products = $query->where('status',1)->paginate(18);

        $top_rated_products = top_rated_products()->limit(3)->get();

        $banner = $banner_query->where('status',1)->inRandomOrder()->first();

        return view('frontend.sale',compact('products','banner','top_rated_products'));
    }



    public function productDetails($slug)
    {   
        $product = Product::where('slug',$slug)->where('status',1)->with(['categories','size','multiple_photos','reviews'])->firstOrFail();

        $this->insertProductView($product->id);
        
        $top_rated_products = top_rated_products()->where('id','!=',$product->id)->limit(3)->get();

        $banner = Banner::where('banner_type','campaign')->where('status',1)->inRandomOrder()->first();

        return view('frontend.product_details',compact('product','top_rated_products','banner'));
    }




    public function quickViewProduct(Product $product)
    {   
        if($product->status != 1){
            return response()->json(['error'=>'Product Not Found!']);
        }

        $product->load(['categories','size','multiple_photos']);

        $this->insertProductView($product->id);

        return view('frontend.quick_view_product', compact('product'))->render();
    }

    

    public function about()
    {
        $faqs = Faq::where('is_active',1)->get();
        $features = Feature::where('is_active',1)->limit(3)->get();
        $about = About::where('is_active',1)->first();

        return view('frontend.about', compact('faqs','about','features'));
    }



    public function contact()
    {

        $contact_emails = ContactEmail::where('is_active',1)->get();
        $contact_phones = ContactPhone::where('is_active',1)->get();

        return view('frontend.contact', compact('contact_emails','contact_phones'));

    }



    public function faq()
    {
        $faqs = Faq::where('is_active',1)->get();
        $banner = Banner::where('banner_type','campaign')->where('status',1)->inRandomOrder()->first();
        
        return view('frontend.faq', compact('faqs','banner'));

    }



    public function wishlist()
    {   
    
        return view('frontend.wishlist');

    }



    public function cart()
    {   
        
        return view('frontend.cart');

    }



    public function checkout()
    {
        
        if(count(getCart()) == 0){
            return redirect('shop');
        }

        return view('frontend.checkout');
    }



    public function thankyou()
    {
        if(!session()->has('order_success')){
            return redirect('/');
        }
        
        return view('frontend.thankyou');
    }



    private function insertProductView(int $product_id)
    {
        $user_id = null;

        if(auth()->check()){
            $user_id = auth()->user()->id;
        }

        if(auth()->check()){
            $is_unique_view = ProductView::where('product_id',$product_id)->where('user_id',$user_id)->exists();
        }
        else{
            $is_unique_view = ProductView::where('product_id',$product_id)->where('user_ip',request()->ip())->exists();
        }

        if(!$is_unique_view){
            ProductView::create([
                'user_ip'=>request()->ip(),
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'created_at'=>Carbon::now(),
            ]);
        }
    }




    public function getCityByCountry($country_id){

        $cities =  cityByCountry($country_id);
        $city_options = "";
        $city_lists = "";

        foreach($cities as $city){
            $city_options .="<option value='$city->id'>".$city->city_name."</option>";
            $city_lists .="<li data-value='$city->id' class='option'>".$city->city_name."</li>";
        }

        $city_results = [
            'city_options'=>$city_options,
            'city_lists'=>$city_lists,
        ];

        return $city_results;
    }

 

    
}
