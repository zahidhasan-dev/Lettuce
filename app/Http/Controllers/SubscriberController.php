<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Mail\NewsletterSubscribed;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    

    public function subscribe(Request $request)
    {   

        if($request->ajax()){

            $validator = Validator::make($request->all(),
                [
                    'subscriber_email'=>'required|email',
                ],
                [
                    'subscriber_email.required'=>'Email is required.',
                    'subscriber_email.email'=>'Enter a valid email.',
                ]
            );
    
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()]);
            }
    
            $subscriber = Subscriber::where('subscriber_email',$request->subscriber_email)->first();
    
            if($subscriber != null){
                
                if($subscriber->subscribed){
                    return response()->json(['subscriber_exists'=>'You are already subscribed to our newsletter.']);
                }
    
                $subscriber->subscribed = 1;
                $subscriber->save();

            }
            else{

                $subscriber = Subscriber::create([
                    'subscriber_id'=>Hash::make($request->subscriber_email),
                    'subscriber_email'=>$request->subscriber_email,
                    'subscribed'=>1,
                ]);
            }


            Mail::to($subscriber->subscriber_email)->send(new NewsletterSubscribed($subscriber));
            
            return response()->json(['success'=>'Thank you for subscribing to our newslettter!']);
        }

        abort(500);
    }



    public function unsubscribe()
    {
        $s_email = request()->get('s_email');

        $subscriber = Subscriber::where('subscriber_email',$s_email)->firstOrFail();

        $subscriber->subscribed = 0;
        $subscriber->save();

        return redirect()->route('unsubscribe.view')->with(['subscriber'=>$subscriber]);
        // return redirect()->to(url('/unsubscribe'))->with(['subscriber'=>$subscriber]);
    }

    public function unsubscribeView()
    {
        $subscriber = session()->get('subscriber');

        return view('frontend.unsubscribe', compact('subscriber'));
    }



}
