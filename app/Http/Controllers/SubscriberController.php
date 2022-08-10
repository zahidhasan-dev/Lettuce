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
                    $errors = $validator->errors()->add('subscriber_exists','You are already subscribed to our newsletter.');
                    return response()->json(['error'=>$errors]);
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
            
            return response()->json(['success'=>'You have successfully subscribed to our newslettter!']);
        }

        abort(500);
    }



    public function unsubscribe()
    {
        $s_email = request()->get('s_email');
        $s_id = request()->get('s_id');

        $subscriber = Subscriber::where('subscriber_id',$s_id)->where('subscriber_email',$s_email)->firstOrFail();

        $subscriber->subscribed = 0;
        $subscriber->save();

        return view('frontend.unsubscribe', compact('subscriber'));
    }





}
