<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function __construct()  {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View  {
        return view('admin.users.index', [
            'users' => User::where('id', '<>', '1')->latest('id')->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View {
        return view('admin.users.create', [
            'roles' => Role::pluck('name')->all()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse {
        $user_data = $request->all();
        $user_data['password'] = Hash::make($request->password);

        $user = User::create($user_data);
        $user->assignRole($request->roles);

        return redirect()->route('admin.users.index')->withSuccess('Новый пользователь создан.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View  {
        if ($user->hasRole('superAdmin')){
            if($user->id != auth()->user()->id){
                abort(403, 'Пользователь не имеет права обновлять это разрешение.');
            }
        }

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse  {
        $user_data = $request->all();

        if(!empty($request->password)) $user_data['password'] = Hash::make($request->password);
        else $user_data = $request->except('password');
        
        $user->update($user_data);
        $user->syncRoles($request->roles);
        return redirect()->back()->withSuccess('Пользователь обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse {
        if ($user->hasRole('superAdmin') || $user->id == auth()->user()->id) abort(403, 'У пользователя нет необходимых разрешений.');

        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('admin.users.index')->withSuccess('Пользователь удален.');
    }


    public function resetPassword(): View {
        return view('admin.users.reset_password');
    }

    public function resetPasswordPost(Request $request): RedirectResponse {
        $request->validate([
            'password' => 'required|string|min:3|confirmed',
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->password = Hash::make($request['password']);
        $user->save();

        return redirect("/admin/dashboard")->withSuccess('Пароль был изменен.');
    }
}
