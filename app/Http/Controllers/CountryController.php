<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryFormPost;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view-any', Country::class);

        $countries = Country::orderBy('country_name')->paginate(10);
        return view('admin.region.country.index', compact('countries'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryFormPost $request)
    {
        Gate::authorize('create', Country::class);

        $country = Country::create($request->all());

        if($country)
        {
            return redirect()->back()->with(['success'=>'Country added succesfully!']);
        }

        return redirect()->back()->with(['error'=>'Something went wrong!']);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        Gate::authorize('update', $country);

        return response()->json($country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        Gate::authorize('update', $country);

        $countryExists = Country::where('country_name',$request->country_name)->where('id','!=',$country->id)->exists();

        if($countryExists != true)
        {
            $country->country_name = $request->country_name;
            $country->save();

            return response()->json(['success'=>'Country updated successfully']);

        }

        return response()->json(['country_exists'=>'The country name has already been taken.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        Gate::authorize('delete', $country);

        $delete = $country->delete();

        if($delete)
        {
            return response()->json(['success'=>'Deleted successfully!']);
        }

        return response()->json(['error'=>'Something went wrong']);

    }
}
