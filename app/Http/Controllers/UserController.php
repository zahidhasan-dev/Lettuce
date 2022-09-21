<?php

namespace App\Http\Controllers;

use App\Http\Requests\addUserFormPost;
use App\Models\User;
use App\Models\UserDetails;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin','verified']);
    }


    
    public function addUser()
    {
        return view('admin.users.register_user');
    }
    

    public function createUser(addUserFormPost $request)
    {

        DB::beginTransaction();

        try {

            $user = User::insertGetId([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'is_admin'=>$request->user_role,
            ]);

            UserDetails::create([
                'user_id'=>$user,
                'created_at'=>Carbon::now(),
            ]);

            DB::commit();

            return redirect()->back()->with(['user_success'=>'User created successfully!']);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with(['user_error'=>'Something went wrong!'])->withInput();

        }
        
    }

    

    public function user_admin()
    {
        $admins = User::where('is_admin',true)->where('id','!=',auth()->user()->id)->orderBy('name','asc')->get();

        return view('admin.users.admin', compact('admins'));

    }


    public function user_customer()
    {
        $customers = User::where('is_admin', false)->orderBy('name','asc')->get();

        return view('admin.users.customer', compact('customers'));
        
    }




    public function viewUserDetails($user_id)
    {
        $user = User::with('userDetails.getcity.country')->where('id',$user_id)->first();

        if($user){
            $data_array = [
                'success'=>'success',
                'user'=>$user
            ];

            return response()->json($data_array);
        }

        return response()->json(['error'=>'Something wet wrong!']);
    }


    public function deleteUser($user_id)
    {
        $user = User::where('id',$user_id)->first();

        $user_delete = $user->delete();

        if($user_delete){
            return response()->json(['success'=>'User deleted successfully!']);
        }

        return response()->json(['error'=>'Something went wrong!']);

    }


}
