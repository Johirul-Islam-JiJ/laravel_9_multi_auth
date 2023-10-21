<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller\Seller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user.show')->only('allUser');
        $this->middleware('can:user.add')->only(['userCreate', 'storeSellerUser']);
        $this->middleware('can:user.edit')->only(['editSellerUser', 'updateSellerUser']);
        $this->middleware('can:user.restore')->only(['sellerUserRestore']);
        $this->middleware('can:user.delete-permanently')->only(['sellerUserDelete']);
        $this->middleware('can:user.delete')->only(['trashSellerUser', 'sellerUserDeleted']);
    }

    public function allUser()
    {

        if (\request()->ajax()) {
            $sellers = Seller::where('code',auth('seller')->user()->code)->get();
            return DataTables::of($sellers)
                ->addIndexColumn()
                ->addColumn('roles', function ($seller) {
                    $button = '';
                    foreach ($seller->getRoleNames() as $role) {
                        $button .= '<span class="badge badge-info mr-1">' . $role . '</span>';
                    }
                    return $button;
                })
                ->addColumn('action', function ($seller) {
                    if ($seller->hasRole('Super Admin') or auth('seller')->user()->id == $seller->id) {
                        return "N/A";
                    } else {
                        return view('seller.access_control.user.action-column', compact('seller'));
                    }
                })
                ->rawColumns(['action','roles'])
                ->tojson();
        }
        return view('seller.access_control.user.index');
    }
    public function userCreate(){
        $roles = Role::where(['guard_name' => 'seller', 'code' => auth('seller')->user()->code])->get();
        return view('seller.access_control.user.create',compact('roles'));
    }
    public function storeSellerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64',
            'phone_number' => 'required|bail|numeric|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/|unique:sellers,phone_number',
            'email' => 'required|string|max:32|unique:sellers,email',
            'password' => 'required|confirmed|string|min:8|max:32',
        ]);
        $seller = Seller::create([
            'code' => auth('seller')->user()->code,
            'email_verified_at' =>  Carbon::now(),
            'name' => trim($request->input('name')),
            'phone_number' => trim($request->input('phone_number')),
            'email' => trim(strtolower($request->input('email'))),
            'password' => Hash::make($request->input('password')),
        ]);
        if ($request->roles) {
            $seller->assignRole($request->roles);
        }
        Toastr::success('User Create successfully!','Success');
        return redirect()->route('seller.user');
    }

    public function editSellerUser(Request $request, $id)
    {
        try {
            $seller = Seller::findOrFail(decrypt($id));
            $roles = Role::where('guard_name', 'seller')->where('id', '!=', 1)->get();
            return view('seller.access_control.user.edit', compact('seller', 'roles'));
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function updateSellerUser(Request $request, $id)
    {
        $decrypt = decrypt($id);
        try {
            $request->validate([
                'roles' => 'required',
                'name' => 'required|string|max:64',
                'phone_number' => "required|bail|numeric|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/|unique:sellers,phone_number,$decrypt",
                'email' =>  "required|string|max:32|unique:sellers,email,$decrypt",
                'password' => 'confirmed',
            ]);

            $seller = Seller::findOrFail($decrypt);

            $seller->update([
                'code' => auth('seller')->user()->code,
                'name' => trim($request->input('name')),
                'phone_number' => trim($request->input('phone_number')),
                'email' => trim(strtolower($request->input('email'))),
                'password' => Hash::make($request->input('password')),
            ]);
            if ($request->roles) {
                $seller->syncRoles($request->roles);
            }
            Toastr::success('User info updated successfully!','Success');
            return back();
//            return redirect()->route('admin.user');
//            return $data = $this->message('User info updated', 'Success', 'user.index');
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function trashSellerUser($id)
    {
        try {
            $seller = Seller::findOrFail(decrypt($id));
            $name = $seller->name;
            $seller->delete();
            Toastr::success($name . 'info deleted successfully!','Success');
            return back();
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function sellerUserDeleted()
    {
        if (\request()->ajax()) {
            $sellers = Seller::onlyTrashed()->get();
            return DataTables::of($sellers)
                ->addIndexColumn()
                ->addColumn('roles', function ($seller) {
                    $button = '';
                    foreach ($seller->getRoleNames() as $role) {
                        $button .= '<span class="badge badge-info mr-1">' . $role . '</span>';
                    }
                    return $button;
                })
                ->addColumn('action', function ($seller) {
                    return view('seller.access_control.user.trash_action', compact('seller'));
                })
                ->rawColumns(['action','roles'])
                ->tojson();
        }
        return view('seller.access_control.user.trash');
    }

    public function sellerUserRestore($id)
    {
        try {
            $seller= Seller::withTrashed()->findOrFail(decrypt($id));
            $name = $seller->name;
            $seller->restore();
            Toastr::success('<strong>' . $name . '</strong> info restored successfully!','Success');
            return back();
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function sellerUserDelete($id)
    {
        try {
            $seller = Seller::withTrashed()->findOrFail(decrypt($id));
            $name = $seller->name;
            $seller->forceDelete();
            Toastr::success('<strong>' . $name . '</strong> info deleted successfully!','Success');
            return back();
        } catch (DecryptException $e) {
            abort(404);
        }
    }

}
