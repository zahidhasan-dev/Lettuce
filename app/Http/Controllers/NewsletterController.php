<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Mail\NewsletterSend;
use Illuminate\Http\Request;
use App\Jobs\NewsletterSendJob;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\NewsletterFormRequest;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','admin','verified']);
    }


    public function index()
    {
        $newsletters = Newsletter::orderBy('created_at','desc')->paginate(20);

        return view('admin.newsletter.index', compact('newsletters'));
    }


    public function show(Newsletter $newsletter)
    {
        file_put_contents(resource_path()."/views/admin/newsletter/preview.blade.php", $newsletter->newsletter_code);

        return view('admin.newsletter.newsletter_details', compact('newsletter'))->render();
    }


    public function destroy(Newsletter $newsletter)
    {
        if(request()->ajax()){
            $newsletter->delete();
            return response()->json(['success'=>'Deleted Successfully!']);
        }

        return redirect()->back();
    }


    public function queryNewsletter(Request $request)
    {
        $newsletters = Newsletter::where('newsletter_subject','LIKE','%'.$request->newsletter_query.'%')->paginate(20);

        if($request->newsletter_query == ''){
            $newsletters = Newsletter::paginate(20);
        }

        return view('admin.newsletter.query_data', compact('newsletters'))->render();
    }


    public function createNewsletter()
    {
        return view('admin.newsletter.create_newsletter');
    }


    public function writePreviewNewsletter(Request $request)
    {
        if($request->ajax()){

            $newsletter = $request->newsletter_code;

            file_put_contents(resource_path()."/views/admin/newsletter/preview.blade.php", $newsletter);

            return response()->json(['status' => 'success',], 200);
        }

    }


    public function previewNewsletter()
    {   
        $subscriber_array = [
            'subscriber_email'=>'',
            'subscriber_id'=>'',
        ];

        $subscriber = (object)$subscriber_array;

        return view('admin.newsletter.preview', compact('subscriber'));
    }


    public function removeNewsletterPreview()
    {
        if (request()->ajax()) {

            file_put_contents(resource_path()."/views/admin/newsletter/preview.blade.php", "");

            // file_put_contents(resource_path()."/views/emails/newsletter/newsletter.blade.php", "");

            return response()->json(['status' => 'success',], 200);

        }
    }



    public function sendNewsletter(NewsletterFormRequest $request)
    {
        if($request->ajax()){

            if($request->validator->fails()){
                return response()->json(['status'=>'validation_error','errors'=>$request->validator->errors()]);
            }
            
            $subscribers = Subscriber::where('subscribed',1)->get();
            
            if($subscribers->count() > 0){

                $newsletter = Newsletter::create([
                    'newsletter_code'=>$request->newsletter_code,
                    'newsletter_subject'=>$request->newsletter_subject,
                    'created_at'=>Carbon::now(),
                ]);
                
                foreach($subscribers as $subscriber){

                    $delay = DB::table('jobs')->count()*10;
                    
                    dispatch(new NewsletterSendJob($subscriber,$newsletter))->delay($delay);

                }

                file_put_contents(resource_path()."/views/admin/newsletter/preview.blade.php", "");

                return response()->json(['status' => 'success',]);
            }
            
            return response()->json(['status'=>'no_subscriber']);

        }
    }




}
