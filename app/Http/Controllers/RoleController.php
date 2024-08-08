<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use DB;

class RoleController extends Controller {
    
    public function __construct()  {
        $this->middleware('auth');
        $this->middleware('permission:create-role|edit-role|delete-role', ['only' => ['index','show']]);
        $this->middleware('permission:create-role', ['only' => ['create','store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View {
        return view('admin.roles.index', [
            'roles' => Role::orderBy('id','DESC')->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View {
        return view('admin.roles.create', [
            'permissions' => Permission::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse  {
        
        $role = Role::create(['name' => $request->name]);
        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();
        $role->syncPermissions($permissions);
        return redirect()->route('admin.roles.index')->withSuccess('Новая роль добавлена.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): View {
        $role_permissions = Permission::join("role_has_permissions","permission_id","=","id")->where("role_id",$role->id)->select('name')->get();
        return view('admin.roles.show', [
            'rolePermissions' => $role_permissions,
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View  {
        if($role->name=='superAdmin') abort(403, 'Роль суперадмин не допускается к редактированию.');

        $role_permissions = DB::table("role_has_permissions")->where("role_id", $role->id)->pluck('permission_id')->all();

        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::get(),
            'rolePermissions' => $role_permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse {
        $role_name = $request->only('name');
        $role->update($role_name);
        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();
        $role->syncPermissions($permissions);    
        
        return redirect()->back()->withSuccess('Роль обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse {
        if($role->name=='superAdmin') abort(403, 'Роль суперадмин не допускается удалить.');
        if(auth()->user()->hasRole($role->name)) abort(403, 'Самоподписанную роль удалить невозможно.');
        $role->delete();
        return redirect()->route('admin.roles.index')->withSuccess('Роль удалена.');
    }
}
