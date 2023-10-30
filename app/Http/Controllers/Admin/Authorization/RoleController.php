<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(Role::latest())
                ->addIndexColumn()
                ->addColumn('action', 'admin.authorization.role.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.authorization.role.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $name = strtolower($request->name);
        Role::updateOrCreate(['id' => $request->id], [
            'name' => $name,
            'guard_name' => 'web',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully'
        ], 200);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return response()->json([
            'success' => true,
            'data' => $role
        ], 200);
    }

    public function show($id)
    {
        $role = Role::find(Crypt::decrypt($id));
        $permission = Permission::all();

        $permission = $permission->each(function($item, $key){
            $name = explode(' ', $item['name']);
            $item['action'] = $name[0];
            $item['module'] = $name[1];
        });

        $permission = $permission->groupBy('module')->sortKeys();

        return view('admin.authorization.role.permission', compact('role', 'permission'));
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully'
        ], 200);
    }
}
