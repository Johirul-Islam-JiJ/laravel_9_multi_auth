<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller\Seller;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('seller.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'email' => 'required|email:rfc,dns|unique:sellers,email',
        ]);
        $code = date('Ym') . substr(hexdec(uniqid('')), -5);
        $seller = Seller::create([
            'name' => $request->name,
            'code' => $code,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
        ]);
        $seller->assignRole(1);
        event(new Registered($seller));
        Auth::guard('seller')->login($seller);
        Toastr::success("Registered Successfully", "Success");
        return redirect(RouteServiceProvider::SELLER_HOME);
    }
}
