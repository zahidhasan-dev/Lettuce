<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Permission;
use App\Rules\UniqueRule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view-any', Role::class);

        return view('admin.authorization.role.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Role::class);
        
        if($request->ajax()){

            $role_name = Str::slug($request->role_name,'-');

            $request['role_name'] = $role_name;

            $this->validateRole($request);

            DB::beginTransaction();

            try {

                $role = Role::create([
                    'name' => $role_name,
                    'created_at' => Carbon::now(),
                ]);
                
                if(!is_null($request->role_permission)){
                    $role->givePermissionTo($request->role_permission);
                }

                DB::commit();

                return response()->json(['status'=>'success']);
                
            } catch (\Throwable $th) {
                
                DB::rollback();
                
                throw $th;
                
            }
    
        }

        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        Gate::authorize('update', $role);

        $permissions  = Permission::all();

        $is_checked = true;
        $permission_elem = '';

        if($permissions->count() > 0){
            foreach ($permissions as $permission) {

                if(!$role->permissions->contains($permission)){
                    $is_checked = false;
                }
    
                $permission_elem .= '<label for="edit_role_permission_'.$permission->id.'" style="margin-right:10px;cursor:pointer;">
                                        <input type="checkbox" '.( $role->permissions->contains($permission) ? "checked" : "" ).' class="form-check-input role_input edit_role_permission" id="edit_role_permission_'.$permission->id.'" name="role_permission[]" value="'.$permission->id.'">
                                        <span>'.$permission->name.'</span>
                                    </label>';
    
            }
        }
        else{
            $is_checked = false;
            $permission_elem = 'N/A';
        }

        $data = [
            'role' => $role,
            'permissions' => $permission_elem,
            'is_checked' => $is_checked,
        ];

        return response()->json(['status'=>'success','data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        Gate::authorize('update', $role);

        if($request->ajax()){

            $role_name = Str::slug($request->role_name,'-');

            $request['role_name'] = $role_name;

            $this->validateRole($request, $role->id);

            DB::beginTransaction();

            try {

                $role->name = $role_name;
                $role->save();
                
                $role->syncPermissions($request->role_permission);

                DB::commit();

                return response()->json(['status'=>'success']);

            } catch (\Throwable $th) {

                DB::rollback();
                
                throw $th;
                
            }
    
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('delete', $role);

        if(request()->ajax()){
            $role->delete();
            
            return response()->json(['status'=>'success']);
        }

        return redirect()->back();
    }


    private function validateRole(Request $request, int $except_id = null)
    {   
        $rules = [
            'role_name'=>['required','string',new UniqueRule('roles','name',$except_id)],
            'role_permission'=>'exists:permissions,id',
        ];

        $messages = [
            'role_permission.exists'=>'The selected permission is invalid.',
        ];

        $request->validate($rules,$messages);
    }
}
