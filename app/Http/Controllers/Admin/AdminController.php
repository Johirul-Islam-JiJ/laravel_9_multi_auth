<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:user.show')->only('allUser');
        $this->middleware('can:user.add')->only(['userCreate', 'storeAdminUser']);
        $this->middleware('can:user.edit')->only(['editAdminUser', 'updateAdminUser']);
        $this->middleware('can:user.restore')->only(['adminUserRestore']);
        $this->middleware('can:user.delete-permanently')->only(['adminUserDelete']);
        $this->middleware('can:user.delete')->only(['trashAdminUser', 'adminUserDeleted']);
    }

    public function allUser()
    {
        if (\request()->ajax()) {
            $admins = Admin::get();
            return DataTables::of($admins)
                ->addIndexColumn()
                ->addColumn('roles', function ($admin) {
                    $button = '';
                    foreach ($admin->getRoleNames() as $role) {
                        $button .= '<span class="badge badge-info mr-1">' . $role . '</span>';
                    }
                    return $button;
                })
                ->addColumn('action', function ($admin) {
                    if ($admin->hasRole('Super Admin') or auth('admin')->user()->id == $admin->id) {
                         return "N/A";
                    } else {
                        return view('admin.access_control.user.action-column', compact('admin'));
                    }
                })
                ->rawColumns(['action','roles'])
                ->tojson();
        }
        return view('admin.access_control.user.index');
    }
    public function userCreate(){
        $roles = Role::where(['guard_name' => 'admin'])->where('id', '!=', 2)->get();
        return view('admin.access_control.user.create',compact('roles'));
    }
    public function storeAdminUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'phone_number' => 'required|bail|numeric|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/|unique:admins,phone_number',
            'email' => 'required|string|max:32|unique:admins,email',
            'password' => 'required|confirmed|string|min:8|max:32',
        ]);
        $admin = Admin::create([
            'name' => trim($request->input('name')),
            'phone_number' => trim($request->input('phone_number')),
            'email' => trim(strtolower($request->input('email'))),
            'password' => Hash::make($request->input('password')),
        ]);
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }
        Toastr::success('Update successfully!','Success');
        return redirect()->route('admin.user');
    }

    public function editAdminUser(Request $request, $id)
    {
        try {
            $admin = Admin::findOrFail(decrypt($id));
            $roles = Role::where('guard_name', 'admin')->where('id', '!=', 2)->get();
            return view('admin.access_control.user.edit', compact('admin', 'roles'));
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function updateAdminUser(Request $request, $id)
    {
        $decrypt = decrypt($id);
        try {
            $request->validate([
                'roles' => 'required',
                'name' => 'required|string|max:64',
                'phone_number' => "required|bail|numeric|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/|unique:admins,phone_number,$decrypt",
                'email' =>  "required|string|max:32|unique:admins,email,$decrypt",
                'password' => 'confirmed',
            ]);

            $admin = Admin::findOrFail($decrypt);

            $admin->update([
                'name' => trim($request->input('name')),
                'phone_number' => trim($request->input('phone_number')),
                'email' => trim(strtolower($request->input('email'))),
                'password' => Hash::make($request->input('password')),
            ]);
            if ($request->roles) {
                $admin->syncRoles($request->roles);
            }
            Toastr::success('User info updated successfully!','Success');
            return back();
//            return redirect()->route('admin.user');
//            return $data = $this->message('User info updated', 'Success', 'user.index');
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function trashAdminUser($id)
    {
        try {
            $admin = Admin::findOrFail(decrypt($id));
            $name = $admin->name;
            $admin->delete();
            Toastr::success($name . 'info deleted successfully!','Success');
            return back();
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function adminUserDeleted()
    {
        if (\request()->ajax()) {
            $admins = Admin::onlyTrashed()->get();
            return DataTables::of($admins)
                ->addIndexColumn()
                ->addColumn('roles', function ($admin) {
                    $button = '';
                    foreach ($admin->getRoleNames() as $role) {
                        $button .= '<span class="badge badge-info mr-1">' . $role . '</span>';
                    }
                    return $button;
                })
                ->addColumn('action', function ($admin) {
                        return view('admin.access_control.user.trash_action', compact('admin'));
                })
                ->rawColumns(['action','roles'])
                ->tojson();
        }
        return view('admin.access_control.user.trash');
    }

    public function adminUserRestore($id)
    {
        try {
            $admin = Admin::withTrashed()->findOrFail(decrypt($id));
            $name = $admin->name;
            $admin->restore();
            Toastr::success('<strong>'.$name . '</strong> info restored successfully!','Success');
            return back();
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function adminUserDelete($id)
    {
        try {
            $admin = Admin::withTrashed()->findOrFail(decrypt($id));
            $name = $admin->name;
            $admin->forceDelete();
            Toastr::success('<strong>'.$name . '</strong> info deleted successfully!','Success');
            return back();
        } catch (DecryptException $e) {
            abort(404);
        }
    }


}
