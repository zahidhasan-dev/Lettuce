<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WishlistController extends Controller
{


    public function store(Request $request)
    {

       if(request()->ajax()){

            $product = Product::where('id',$request->product_id)->where('status',1)->firstOrFail();

            $product_data = [
                'product_name'=>$product->product_name,
                'thumbnail'=>$product->thumbnail,
            ];
            
            if(auth()->check()){

                if(auth()->user()->is_admin){
                    return response()->json(['status'=>'unauthorized']);
                }

                $wishlist_exists = Wishlist::where('user_id',auth()->user()->id)->where('product_id',$product->id)->exists();

                if($wishlist_exists){
                    return response()->json(['status'=>'exists','product'=>$product_data]);
                }

                Wishlist::create([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$product->id,
                    'craeted_at'=>Carbon::now(),
                ]);

                return response()->json(['status'=>'success','product'=>$product_data]);

            }

            $wishlist = session()->get('wishlist',[]);

            if(isset($wishlist[$product->id])){
                return response()->json(['status'=>'exists','product'=>$product_data]);
            }

            $wishlist[$product->id] = [
                    'id'=>$product->id,
                    'product_name'=>$product->product_name,
                    'thumbnail'=>$product->thumbnail,
                    'price'=>$product->price,
                    'in_stock'=>$product->in_stock,
                    'slug'=>$product->slug,
            ];

            //store only product id
            // if(in_array($product->id,$wishlist)){
            //     return 'already added';
            // }

            // $wishlist[] = $product->id;       

            session()->put('wishlist',$wishlist);

            return response()->json(['status'=>'success','product'=>$product_data]);

       }

       return response(null, Response::HTTP_NO_CONTENT);

    }


    public function destroy($id)
    {
       if(request()->ajax()){
            if(auth()->check()){
                $wishlist = Wishlist::where('product_id',$id)->where('user_id',auth()->user()->id)->firstOrFail();
                $wishlist->delete();
            }
            else{
                if(session()->has('wishlist')){
                    $wishlists = session('wishlist');
                    if(isset($wishlists[$id])){
                        unset($wishlists[$id]);
                        session()->put('wishlist',$wishlists);
                    }
                }
            }
       }

        return response(null, Response::HTTP_NO_CONTENT);
    }



}
