<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Imports\ImportMaterial;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function importView()
    {
        return view('test');
    }
    public function import(Request $request)
    {
        Excel::import(new ImportMaterial, $request->file('file')->store('files'));
        return redirect()->back();
    }
    public function index()
    {
        $models = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        // $models = User::where('id', '!=', 1)->get();
        return view('users.index', ['models' => $models, 'roles' => $roles, 'permissions' => $permissions]);
    }
    public function store(UserCreateRequest $request)
    {
        // dd($request->all());

        $data = $request->all();
        $roles = $request->roles;
        $permissions = $request->permissions;
        unset($data['roles']);
        unset($data['permissions']);

        $user = User::create($data);

        $user->assignRole($roles);
        $user->syncPermissions($permissions);
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(UserUpdateRequest $request, User $user)
    {
        // dd($request->all(), $user);
        $data = $request->all();
        $roles = $request->roles;
        $permissions = $request->permissions;

        unset($data['roles']);
        unset($data['permissions']);
        if (!empty($data['password']) and !empty($data['c_password'])) {
            $user->update($data);
        } else {
            $user->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
            ]);
        }

        $user->syncRoles($roles);
        $user->syncPermissions($permissions);
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(User $user)
    {
        // dd($user);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
    public function status(User $user)
    {
        if ($user->status == 1) {
            $user->update(['status' => 0]);
        } else {
            $user->update(['status' => 1]);
        }
        return redirect()->back();
    }
}
