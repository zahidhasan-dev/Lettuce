<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactAddress;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ContactAddressFormRequest;

class ContactAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view-any', ContactAddress::class);

        $addresses = ContactAddress::orderBy('created_at','desc')->paginate(20);

        return view('admin.contact.address.index', compact('addresses'));
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
    public function store(ContactAddressFormRequest $request)
    {
        Gate::authorize('create', ContactAddress::class);

        ContactAddress::create($request->all());

        return response()->json(['status'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactAddress  $address
     * @return \Illuminate\Http\Response
     */
    public function show(ContactAddress $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactAddress  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactAddress $address)
    {
        Gate::authorize('update', $address);

        return response()->json(['status'=>'success','address'=>$address]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactAddress  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactAddress $address)
    {
        Gate::authorize('update', $address);

        $request->validate([
            'contact_address'=>['required','string','max:100','unique:contact_addresses,contact_address,'.$address->id.',id'],
        ]);

        $address->contact_address = $request->contact_address;
        $address->save();

        return response()->json(['status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactAddress  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactAddress $address)
    {
        Gate::authorize('delete', $address);

        $address->delete();

        return response()->json(['status'=>'success']);
    }



    public function updateAddressStatus($address_id)
    {
        $address = ContactAddress::findOrFail($address_id);
        
        Gate::authorize('update', $address);


        if($address->is_active == 0){
            $address->is_active = 1;

            ContactAddress::where('id','!=',$address->id)->update([
                'is_active' => 0,
            ]);
        }
        else{
            $address->is_active = 0;
        }

        $address->save();

        return response()->json(['success'=>'Status updated successfully!','address_status'=>$address->is_active]);
    }



}
