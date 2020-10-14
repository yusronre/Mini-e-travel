<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $role = Role::orderBy('name', 'ASC')->get();
        return view('users.create', compact('role'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name'
        ]);

        $user = User::firstOrCreate([
            'email' => $request->email
        ], [
            'name' => $request-name,
            'password' => bcrypt($request->password),
            'status' => true
        ]);

        $user->assignRole($request->role);
        return redirect(route('users.index'))->with(['success' => 'user: <strong>' . $user-name . '</strong> Ditambahkan']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'name' => $request->name,
            'password' => $password
        ]);
        return redirect(route('users.index'))->with(['success' => 'user: <strong>' . $user->name . '</strong> Ditambahkan']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return rediredct()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> Dihapus']);
    }

    public function rolePermission(Request $request)
    {
        $role = $request->get('role');

        //Default ,set dua buah vairable dengan nilai null
        $permission = null;
        $hasPermission = null;

        //Mengambil data role
        $roles = Role::all()->pluck('name');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
        //apabila parameter role terpenuhi
        if (!empty($role)){
            //select role berdasarkan namenya, ini sejenis dengan method find()
            $getRole = Role::findByName($role);

            //query untuk mengambil permission yang telah dimiliki oleh role terkait
            $hasPermission = DB::table('role_has_permission')
            ->select('permissions.name')
            ->join('permissions', 'role_has_permissions.permission.id'. '=', 'permissions.id')
            -where('role_id', $getRole->id)->get()->pluck('name')->all();

            //Mengambil data permission
            $permissions = Permission::all()->pluck('name');
        }
        return view('users.role.permission', compact('roles', 'permissions', 'hasPermission'));
    }

    public function addPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:permissions'
        ]);

        $permission = Permission::firstOrCreate([
            'name' => $request->name
        ]);
        return redirect()->back();
    }
}
