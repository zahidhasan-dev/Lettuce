<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassFormPost;
use App\Http\Requests\UserDetailsFormPost;
use App\Models\City;
use App\Models\User;
use App\Models\UserDetails;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth','verified','admin']);
    }

   
    public function admin_profile()
    {
        return view('admin.profile.index');
    }


    public function updatePassword(ChangePassFormPost $request)
    {
        $update_password = User::find(auth()->user()->id)->update([
            'password'=>Hash::make($request->password),
        ]);

        if($update_password){
            return redirect()->back()->with(['passupdated'=>'Password updated successfully!']);
        }

        return redirect()->back()->with(['passerror'=>'Something went wrong!']);

    }



    public function editUserDetails()
    {

        return view('admin.profile.edit');

    }



    public function updateUserDetails(UserDetailsFormPost $request)
    {
        $user  = User::with('userDetails')->where('id',auth()->user()->id)->first();
        $userDetails = $user->userDetails;
   
        $user->name = $request->user_name;
        $userDetails->phone = $request->phone;
        $userDetails->country = $request->country;
        $userDetails->city = $request->city;

        $user->save();
        $userDetails->save();

        return redirect()->route('admin.profile')->with(['updatesuccess'=>'Updated successfully!']);

    }


    public function updateUserAvatar(Request $request)
    {

        $allowed_extension = ['jpg','jpeg','png','webp'];

       if($request->hasFile('avatar'))
       {    

            $uploaded_img = $request->file('avatar');
            $img_extension = $uploaded_img->getClientOriginalExtension();

            if(in_array($img_extension,$allowed_extension)){

                if(auth()->user()->userDetails->avatar != null)
                {
                    $delete_avatar = base_path('public/uploads/users/'.auth()->user()->userDetails->avatar);
                    unlink($delete_avatar);
                }


                $new_img_name = "avatar".auth()->user()->id.Carbon::now()->timestamp.'.'.$img_extension;
                $img_new_location = base_path('public/uploads/users/'.$new_img_name);
                Image::make($uploaded_img)->resize(200,200)->save($img_new_location);

                auth()->user()->userDetails->avatar = $new_img_name;
                auth()->user()->userDetails->save();

                return response()->json(['success'=>'Avatar updated successfully!']);

            }
            
            return response()->json(['extnsn_err'=>'Invalid file type!']);

       }

       return response()->json(["error"=>"Somethfing went wrong!"]);

    }


    public function removeUserAvatar()
    {   

        if(auth()->user()->userDetails->avatar != null)
        {
            $remove_avatar = base_path('public/uploads/users/'.auth()->user()->userDetails->avatar);
            unlink($remove_avatar);

            auth()->user()->userDetails->avatar = null;
            auth()->user()->userDetails->save();


            return response()->json(['success'=>'Avatar removed successfully!']);

        }

        return response()->json(["error"=>"Somethfing went wrong!"]);

    }




    public function getCityList($country_id)
    {
        $cities = City::where('country_id',$country_id)->orderBy('city_name')->get();

        $city_result = "";

        foreach($cities as $city)
        {
            $city_result .="<option value='$city->id' ".((auth()->user()->userDetails->city == $city->id)?'selected':'').">".$city->city_name."</option>";
        }

        $data_array = [
            'success'=>1,
            'city_list'=>$city_result,
        ];

        return response()->json($data_array);

    }


}

