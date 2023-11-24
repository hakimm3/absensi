<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('department')->latest();
            return DataTables::eloquent($users)
                ->addIndexColumn()
                ->addColumn('department', function ($row) {
                    return $row->department->name ?? '-';
                })
                ->addColumn('roles', function ($row) {
                    $roles = implode(', ', $row->roles->pluck('name')->toArray());
                    return $roles;
                })
                ->addColumn('photo', function ($row) {
                    return '<img src="' . asset('storage/user/' . $row->photo) . '" width="50px">';
                })
                ->addColumn('action', 'admin.user-management.user.action')
                ->rawColumns(['action', 'roles', 'photo'])
                ->make(true);
        }

        $departments = Department::all();
        $roles = Role::all();
        $compact = compact(
            'departments',
            'roles'
        );
        return view('admin.user-management.user.index', $compact);
    }

    public function store(UserRequest $request)
    {
        $request->photo ? $photoName = uploadPhoto($request->photo, 'user') : $photoName = null;
        $user = User::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'department_id' => $request->department_id,
                'photo' => $photoName,
                'password' => bcrypt("password"),
            ]
        );
        $user->syncRoles($request->roles);




        return response()->json([
            'success' => true,
            'message' => 'User saved successfully'
        ], 200);
    }

    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}
