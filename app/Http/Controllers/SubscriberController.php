<?php

namespace App\Http\Controllers;


use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Mail\NewsletterSubscribed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{

    
    public function subscribers()
    {
        $subscribers = Subscriber::paginate(20);
        
        return view('admin.newsletter.subscriber.index', compact('subscribers'))->render();
    }


    public function show($subscriber_id)
    {
        if(request()->ajax()){
            
            $subscriber = Subscriber::where('subscriber_id', $subscriber_id)->firstOrFail();
    
            return view('admin.newsletter.subscriber.subscriber_details', compact('subscriber'))->render();

        }

        return redirect()->back();
    }
    
    
    public function destroy($subscriber_id)
    {
        if(request()->ajax()){

            $subscriber = Subscriber::where('subscriber_id',$subscriber_id)->firstOrFail(); 
            $subscriber->delete();

            return response()->json(['success'=>'Deleted Successfully!']);

        }

        return redirect()->back();
    }


    public function querySubscriber(Request $request)
    {
        $subscribers = Subscriber::where('subscriber_email','LIKE','%'.$request->subscriber_query.'%')->paginate(20);

        if($request->subscriber_query == ''){
            $subscribers = Subscriber::paginate(20);
        }

        return view('admin.newsletter.subscriber.query_data', compact('subscribers'))->render();
    }


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
                    'subscriber_id'=>hash('sha256',$request->subscriber_email),
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
