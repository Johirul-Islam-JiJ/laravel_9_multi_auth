<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Traits\UploadAble;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    use UploadAble;
    //admin profile show
    public function edit()
    {
        $data = Auth::user();
        return view('admin.profile.edit', compact('data'));
    }

    public function update_general(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:4|max:32|regex:/^[a-zA-Z\s]+$/',
            'image' => 'image|mimes:jpg,png,jpeg|max:512',
            'phone' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
            'dob' => 'nullable|date|date_format:Y-m-d',
        ]);

        $admin = Admin::find($id);
        if ($request->hasFile('image')) {
            $filename = $this->uploadOne($request->image, 300, 300, config('imagepath.profile'));
            $this->deleteOne(config('imagepath.profile'), $admin->image);
            $admin->update(['image' => $filename]);    //update new filename
        }
//        $admin->dob = Carbon::parse($request->dob)->format('d-m-Y');
        $admin->update([
            'name' => strip_tags($request->name),
            'phone_number' => strip_tags($request->phone),
            'dob' => !empty($request->dob) ? $request->dob : null,
        ]);
        Toastr::success('Information changed Successfully!', 'Success');
        return redirect()->back();
    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ]);
        $admin = Admin::find($id);
        if (!\Hash::check($request->password, $admin->password)) {
            Toastr::error("Old password doesn't match !", 'Error');
            return back();
        } else {
            $admin = Admin::find($id);
            $admin->password = bcrypt($request->new_password);
            $admin->save();
            Toastr::success('Password changed Successfully!', 'Success');
            return redirect()->back();
        }
    }
}
