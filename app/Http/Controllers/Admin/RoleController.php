<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:role.show')->only('index');
        $this->middleware('can:role.add')->only(['create', 'store']);
        $this->middleware('can:role.edit')->only(['edit', 'update']);
    }

    public function index()
    {
        if (\request()->ajax()) {
            $roles = Role::where('guard_name', 'admin')->where('id', '!=', 2)->orderBy('id', 'desc')->get();
            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('action', function ($role) {
                        return view('admin.access_control.role.action_button', compact('role'));
                })
                ->rawColumns(['action'])
                ->tojson();
        }
        return view('admin.access_control.role.index');
    }

    public function create()
    {
        $permissions = Permission::where('guard_name', 'admin')->get()->groupBy('module_name');
        return view('admin.access_control.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:24',
                'min:2',
                Rule::unique('roles')->where('guard_name', 'admin')
            ],
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
           return back();
        }
    }

//    public function show($id)
//    {
//        //
//    }

    public function edit($id)
    {
        try {
            $role = Role::findById(decrypt($id));
            $permissions = Permission::where('guard_name', 'admin')->get()->groupBy('module_name');
            return view('admin.access_control.role.edit', compact('role', 'permissions'));
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
//        return $request->all();
        $decrypt = decrypt($id);
        try {
            $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:24',
                    'min:2',
                    Rule::unique('roles')->ignore($decrypt)->where('guard_name', 'admin')
                ],
                'permissions' => 'required|array',
            ]);

            $role = Role::findById($decrypt);
            $permissions = $request->input('permissions');
            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
                $role->name = $request->name;
                $role->update();
                Toastr::success('Update successfully!','Success');
                return back();
            }
        } catch (DecryptException $e) {
            abort(404);
        }
    }

//    public function destroy($id)
//    {
//        //
//    }
}
