<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Message;
use App\Mail\ReplyToMessage;
use Illuminate\Http\Request;
use App\Jobs\ReplyToMessageJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\MessageFormRequest;
use App\Http\Requests\ReplyMessageFormRequest;


class MessageController extends Controller
{
    
    public function index()
    {
       $messages = Message::whereNull('message_id')->orderBy('created_at','desc')->paginate(20);

       return view('admin.message.index', compact('messages'));
    }



    public function message_trash()
    {
        $messages = Message::whereNull('message_id')->onlyTrashed()->orderBy('created_at','desc')->paginate(20);

        return view('admin.message.trash', compact('messages'));
    }


    public function show(Message $message)
    {
        if(!$message->is_read){
            $message->is_read = 1;
            $message->save();
        }

        $message->load('replies');

        return view('admin.message.show', compact('message'));
    }



    public function store(MessageFormRequest $request)
    {   
        Message::create([
            'name'=>$request->contact_name,
            'email'=>$request->contact_email,
            'message'=>$request->contact_message,
            'created_at'=>Carbon::now(),
        ]);

        return redirect()->back()->with('message_success','Sent Successfully!');
    }

    

    public function destroy(Message $message)
    {
        $message->delete();

        return response()->json(['status'=>'success']);
    }



    public function massDestroy(Request $request)
    {   
        Message::whereIn('id',$request->ids)->delete();

        return response()->json(['status'=>'success']);
    }



    public function forceDelete($message_id)
    {
        $message = Message::where('id',$message_id)->withTrashed()->firstOrFail();
        $message->forceDelete();

        return response()->json(['status'=>'success']);
    }


    public function massForceDelete(Request $request)
    {
        Message::whereIn('id',$request->ids)->withTrashed()->forceDelete();

        return response()->json(['status'=>'success']);
    }



    public function restore($message_id)
    {
        $message = Message::where('id',$message_id)->withTrashed()->firstOrFail();
        $message->restore();

        return response()->json(['status'=>'success']);
    }


    public function massRestore(Request $request)
    {
        Message::whereIn('id',$request->ids)->withTrashed()->restore();

        return response()->json(['status'=>'success']);
    }



    public function queryMessage(Request $request)
    {

        $query = Message::where('name','LIKE','%'.$request->message_query.'%')
                        ->whereNull('message_id')
                        ->orWhere('email','LIKE','%'.$request->message_query.'%')
                        ->whereNull('message_id');                            

        if($request->message_query == ''){
            $query = Message::whereNull('message_id');                                
        }
        
        if($request->message_sort_by != ''){
            $query = Message::where('name','LIKE','%'.$request->message_query.'%')
                            ->where('is_read',$request->message_sort_by)
                            ->whereNull('message_id')
                            ->orWhere('email','LIKE','%'.$request->message_query.'%')
                            ->where('is_read',$request->message_sort_by)
                            ->whereNull('message_id');                                
        }


        if($request->message_status == 'trash'){

            if($request->message_sort_by != ''){
                $query = Message::where('name','LIKE','%'.$request->message_query.'%')
                            ->where('is_read',$request->message_sort_by)
                            ->whereNull('message_id')
                            ->onlyTrashed()
                            ->orWhere('email','LIKE','%'.$request->message_query.'%')
                            ->where('is_read',$request->message_sort_by)
                            ->whereNull('message_id')
                            ->onlyTrashed();
            }
            else{
                $query = Message::where('name','LIKE','%'.$request->message_query.'%')
                                ->whereNull('message_id')
                                ->onlyTrashed()
                                ->orWhere('email','LIKE','%'.$request->message_query.'%')
                                ->whereNull('message_id')
                                ->onlyTrashed();
            }

        }

        $messages = $query->orderBy('created_at','desc')->paginate(20);

        return view('admin.message.query_data', compact('messages'))->render();

    }



    public function replyMessage(ReplyMessageFormRequest $request)
    {
        $message = Message::findOrFail($request->message_id);
        
        $delay = DB::table('jobs')->count()*10;
        
        dispatch(new ReplyToMessageJob($message->email,$request->reply_message))->delay($delay);

        Message::create([
            'message_id'=>$message->id,
            'name'=>'Lettuce Support',
            'email'=>'support@lettuce.com',
            'message'=>$request->reply_message,
            'is_read'=>1,
            'created_at'=>Carbon::now(),
        ]);


        return response()->json(['status'=>'success']);
    }



}
