<?php

namespace App\Http\Controllers;

use App\Models\ContactPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ContactPhoneFormRequest;

class ContactPhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        Gate::authorize('view-any', ContactPhone::class);
        $phones = ContactPhone::orderBy('created_at','desc')->paginate(20);
        
        return view('admin.contact.phone.index', compact('phones'));
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
    public function store(ContactPhoneFormRequest $request)
    {   
        Gate::authorize('create', ContactPhone::class);

        ContactPhone::create($request->all());

        return response()->json(['status'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactPhone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(ContactPhone $phone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactPhone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactPhone $phone)
    {   
        Gate::authorize('update', $phone);

        return response()->json(['status'=>'success','phone'=>$phone]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactPhone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactPhone $phone)
    {   
        Gate::authorize('update', $phone);

        $request->validate([
            'contact_phone'=>['required','numeric','digits_between:4,16','unique:contact_phones,contact_phone,'.$phone->id.',id'],
        ]);

        $phone->contact_phone = $request->contact_phone;
        $phone->save();

        return response()->json(['status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactPhone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactPhone $phone)
    {   
        Gate::authorize('delete', $phone);
        
        $phone->delete();

        return response()->json(['status'=>'success']);
    }



    public function updatePhoneStatus($phone_id)
    {
        $phone = ContactPhone::findOrFail($phone_id);

        Gate::authorize('update', $phone);

        if($phone->is_active == 0){
            $phone->is_active = 1;
        }
        else{
            $phone->is_active = 0;
        }

        $phone->save();

        return response()->json(['success'=>'Status updated successfully!','phone_status'=>$phone->is_active]);
    }


    
    
    public function updatePrimaryPhoneStatus($phone_id)
    {
        $phone = ContactPhone::findOrFail($phone_id);

        Gate::authorize('update', $phone);

        if($phone->is_primary == 0){
            $phone->is_primary = 1;

            ContactPhone::where('id','!=',$phone->id)->update([
                'is_primary' => 0,
            ]);
        }
        else{
            $phone->is_primary = 0;
        }

        $phone->save();

        return response()->json(['success'=>'Status updated successfully!','phone_primary_status'=>$phone->is_primary]);
    }


}
