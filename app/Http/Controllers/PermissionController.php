<?php

namespace App\Http\Controllers;

use App\Rules\UniqueRule;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view-any', Permission::class);

        $permissions = Permission::paginate(20);
        
        return view('admin.authorization.permission.index', compact('permissions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Permission::class);

        if($request->ajax()){

            $permission_name = Str::slug($request->permission_name,'-');

            $request['permission_name'] = $permission_name;

            $this->validatePermission($request);

            DB::beginTransaction();

            try {

                $permission = Permission::create([
                    'name' => $permission_name,
                    'created_at' => Carbon::now(),
                ]);

                if(!is_null($request->permission_role)){
                    $permission->assignRole($request->permission_role);
                }

                DB::commit();

                return response()->json(['status'=>'success']);

            } catch (\Throwable $th) {

                DB::rollBack();

                throw $th;

            }

        }

        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        Gate::authorize('update', $permission);

        $roles = Role::all();

        $role_elem = '';
        $is_checked = true;

        if($roles->count() > 0){
            foreach ($roles as $role) { 

                if(!$permission->roles->contains($role)){
                    $is_checked = false;
                }

                $role_elem .= '<label for="edit_permission_role_'.$role->id.'" style="margin-right:10px;cursor:pointer;">
                                <input type="checkbox" '.( $permission->roles->contains($role) ? "checked" : "" ).' class="form-check-input role_input edit_permission_role" id="edit_permission_role_'.$role->id.'" name="permission_role[]" value="'.$role->id.'">
                                <span>'.$role->name.'</span>
                            </label>';

            }
        }
        else{
            $is_checked = false;
            $role_elem = 'N/A';
        }

        $data = [
            'permission'=>$permission,
            'roles' => $role_elem,
            'is_checked' => $is_checked,
        ];
        
        return response()->json(['status'=>'success','data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        Gate::authorize('update', $permission);

        if($request->ajax()){

            $permission_name = Str::slug($request->permission_name,'-');

            $request['permission_name'] = $permission_name;

            $this->validatePermission($request, $permission->id);

            DB::beginTransaction();

            try {

                $permission->name = $permission_name;
                $permission->save();

                $permission->syncRoles($request->permission_role);

                DB::commit();
                return response()->json(['status'=>'success']);

            } catch (\Throwable $th) {

                DB::rollBack();

                throw $th;

            }

        }
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        Gate::authorize('delete', $permission);
        
        if(request()->ajax()){

            $permission->delete();

            return response()->json(['status'=>'success']);

        }

        return redirect()->back();
    }



    private function validatePermission(Request $request, int $except_id = null)
    {
        $rules = [
            'permission_name'=>['required','string',new UniqueRule('permissions','name',$except_id)],
            'permission_role'=>'exists:roles,id'
        ];

        $messages = [
            'permission_role.exists'=>'The selected role is invalid.',
        ];

        $request->validate($rules,$messages);
    }


}
