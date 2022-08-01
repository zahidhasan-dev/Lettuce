<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewFormRequest;
use App\Models\ProductReview;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }



    public function storeReview(ReviewFormRequest $request)
    {
        if(!checkPurchase($request->product_id))
        {
            return redirect()->back()->with(['error'=>'You did not purchase this product!'])->withInput();
        }

        if(checkReview($request->product_id))
        {
            return redirect()->back()->with(['error'=>'You already have a review for this product!'])->withInput();
        }

        ProductReview::create([
            'user_id'=>auth()->user()->id,
            'product_id'=>$request->product_id,
            'user_name'=>$request->user_name,
            'user_email'=>$request->user_email,
            'review_rating'=>$request->review_rating,
            'review_feedback'=>$request->review_feedback,
            'created_at'=>Carbon::now(),
        ]);

        return redirect()->back()->with(['success'=>true]);

    }


}
