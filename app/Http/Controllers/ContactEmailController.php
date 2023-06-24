<?php

namespace App\Http\Controllers;

use App\Models\ContactEmail;
use Illuminate\Http\Request;
use App\Rules\ContactEmailRule;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ContactEmailFormRequest;

class ContactEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        Gate::authorize('view-any', ContactEmail::class);

        $emails = ContactEmail::orderBy('created_at','desc')->paginate(20);
        
        return view('admin.contact.email.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactEmailFormRequest $request)
    {   
        Gate::authorize('create', ContactEmail::class);

        ContactEmail::create($request->all());

        return response()->json(['status'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactEmail  $email
     * @return \Illuminate\Http\Response
     */
    public function show(ContactEmail $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactEmail  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactEmail $email)
    {
        Gate::authorize('update', $email);

        return response()->json(['status'=>'success','email'=>$email]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactEmail  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactEmail $email)
    {   
        Gate::authorize('update', $email);

        $request->validate([
            'contact_email'=>['required','string','email','max:100',new ContactEmailRule('contact_emails','contact_email',$email->id)],
        ]);

        $email->contact_email = $request->contact_email;
        $email->save();

        return response()->json(['status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactEmail  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactEmail $email)
    {
        Gate::authorize('delete', $email);

        $email->delete();

        return response()->json(['status'=>'success']);
    }


    public function updateEmailStatus($email_id)
    {
        $email = ContactEmail::findOrFail($email_id);

        Gate::authorize('update', $email);

        if($email->is_active == 0){
            $email->is_active = 1;
        }
        else{
            $email->is_active = 0;
        }

        $email->save();

        return response()->json(['success'=>'Status updated successfully!','email_status'=>$email->is_active]);
    }


    public function updatePrimaryEmailStatus($email_id)
    {
        $email = ContactEmail::findOrFail($email_id);

        Gate::authorize('update', $email);

        if($email->is_primary == 0){
            $email->is_primary = 1;

            ContactEmail::where('id','!=',$email->id)->update([
                'is_primary' => 0,
            ]);
        }
        else{
            $email->is_primary = 0;
        }

        $email->save();

        return response()->json(['success'=>'Status updated successfully!','email_primary_status'=>$email->is_primary]);
    }



}
