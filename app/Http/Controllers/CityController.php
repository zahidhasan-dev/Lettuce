<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\CityFormPost;
use Illuminate\Support\Facades\Gate;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view-any', City::class);

        $cities = City::orderBy('city_name')->paginate(10);

        $countries = Country::orderBy('country_name')->get();

        return view('admin.region.city.index', compact('cities','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityFormPost $request)
    {
        Gate::authorize('create', City::class);

        $cityExists = City::where('country_id',$request->country_id)->where('city_name',$request->city_name)->exists();


        if($cityExists != true){

            $add_city = City::create($request->all());

            if($add_city)
            {
                return redirect()->back()->with(['success'=>'City added succesfully!']);
            }

            return redirect()->back()->with(['error'=>'Something went wrong!']);
        }

        return redirect()->back()->withErrors(['city_name'=>'The city name has already been taken.']);

        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        Gate::authorize('update', $city);

        $countries = Country::orderBy('country_name')->get();

        $country_result = '';
        foreach($countries as $country)
        {
            $country_result .="<option value='$country->id' ".(($city->country->id === $country->id)?'selected':'').">".$country->country_name."</option>";
        }

        $data_array = [
            'city'=>$city,
            'country_result'=>$country_result,
        ];

        return response()->json($data_array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        Gate::authorize('update', $city);

       $city_exists = City::where('id','!=',$city->id)->where('country_id',$request->country_id)->where('city_name',$request->city_name)->exists();

       if($city_exists != true){

           $city->country_id = $request->country_id;
           $city->city_name = $request->city_name;
           $update_city = $city->save();

           if($update_city){

               return response()->json(['success'=>'Updated successfully!']);

           }

           return response()->json(['error'=>'Something went wrong']);

       }

       return  response()->json(['city_exists'=>'The city name has already been taken.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        Gate::authorize('delete', $city);

        $delete = $city->delete();

        if($delete)
        {
            return response()->json(['success'=>'Deleted successfully!']);
        }

        return response()->json(['error'=>'Something went wrong']);

    }
}
