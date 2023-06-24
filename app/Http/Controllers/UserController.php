<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\UserDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\addUserFormPost;

use function PHPUnit\Framework\isNull;
use App\Http\Requests\editUserDetailsFormRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin','verified']);
    }

    
    public function addUser()
    {
        Gate::authorize('create', User::class);

        $roles = Role::where('name','!=','super-admin')->get();
        $permissions = Permission::all();

        return view('admin.users.register_user', compact('roles','permissions'));
    }
    

    public function createUser(addUserFormPost $request)
    {
        Gate::authorize('create', User::class);

        DB::beginTransaction();

        try {

            $user_id = User::insertGetId([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'is_admin'=>$request->user_type,
                'created_at'=>Carbon::now(),
            ]);

            UserDetails::create([
                'user_id'=>$user_id,
                'created_at'=>Carbon::now(),
            ]);

            $user = User::find($user_id);
              
            if($request->user_type == 1 && $request->user_role != null){
                $user->assignRole($request->user_role);            
            }
                
            if($request->user_type == 1 && $request->user_permission != null){
                $user->givePermissionTo($request->user_permission);
            }

            DB::commit();

            return redirect()->back()->with(['user_success'=>'User created successfully!']);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with(['user_error'=>'Something went wrong!'])->withInput();

        }
    }

    

    public function user_admin()
    {
        Gate::authorize('view-any', User::class);

        $admins = User::where('is_admin',true)->where('id','!=',auth()->user()->id)->orderBy('name','asc')->get();

        $admins->load('roles','userDetails');

        return view('admin.users.admin', compact('admins'));
    }



    public function user_customer()
    { 
        Gate::authorize('view-any', User::class);

        $customers = User::where('is_admin', false)->orderBy('name','asc')->get();

        $customers->load('userDetails');

        return view('admin.users.customer', compact('customers'));
    }



    public function viewUserDetails($user_id)
    {
        $user = User::with('userDetails.getcity.country')->where('id',$user_id)->first();
        
        Gate::authorize('view', $user);

        if($user->is_admin){
           $user->load('roles','permissions');
        }

        if($user){
            $data_array = [
                'success'=>'success',
                'user'=>$user
            ];

            return response()->json($data_array);
        }

        return response()->json(['error'=>'Something went wrong!']);
    }
    


    public function editUserDetails($user_id)
    {
        $user = User::where('id',$user_id)->where('is_admin',1)->firstOrFail();
        
        Gate::authorize('update', $user);   

        $roles = Role::whereNot('name','super-admin')->get();

        $permissions  = Permission::all();

        $is_checked = true;
        $role_elems = '<option value="" selected disabled>--Select Role--</option>';
        $permission_elems = '';

        if($roles->count() > 0){
            foreach($roles as $role){
                $role_elems .='<option value="'.$role->id.'"'.( $user->roles->contains($role) ? "selected" : "" ).'>'.$role->name.'</option>'; 
            }
        }

        if($permissions->count() > 0){
            foreach ($permissions as $permission) {
                if(!$user->permissions->contains($permission)){
                    $is_checked = false;
                }

                $permission_elems .= '<label for="edit_user_permission_'.$permission->id.'" style="margin-right:10px;cursor:pointer;">
                                        <input type="checkbox" '.( $user->permissions->contains($permission) ? "checked" : "" ).' class="form-check-input edit_user_permission edit_user_input" id="edit_user_permission_'.$permission->id.'" name="user_permission[]" value="'.$permission->id.'">
                                        <span>'.$permission->name.'</span>
                                    </label>';
            }
        }
        else{
            $is_checked = false;
            $permission_elems = 'N/A';
        }

        $data = [
            'user_id'=>$user->id,
            'role_elems'=>$role_elems,
            'permission_elems'=>$permission_elems,
            'is_checked'=>$is_checked,
        ];
            
        return response()->json(['status'=>'success','data'=>$data]);
    }



    public function updateUserDetails(editUserDetailsFormRequest $request, $user_id)
    {
        
        DB::beginTransaction();
        
        try {
            
            $user = User::where('id',$user_id)->where('is_admin',1)->firstOrFail();
            
            Gate::authorize('update', $user);

            if(!is_null($request->password)){
                $user->password = Hash::make($request->password);
                $user->save();
            }

            $user->syncRoles($request->user_role);
            $user->syncPermissions($request->user_permission);

            $data = [
                'user_id' => $user->id,
            ];

            DB::commit();

            return response()->json(['status'=>'success','data'=>$data]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }




    public function deleteUser($user_id)
    {
        $user = User::where('id',$user_id)->first();

        Gate::authorize('delete', $user);

        $user_delete = $user->delete();

        if($user_delete){
            return response()->json(['success'=>'User deleted successfully!']);
        }

        return response()->json(['error'=>'Something went wrong!']);
    }


}
