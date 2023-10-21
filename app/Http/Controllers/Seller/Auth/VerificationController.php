<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerificationController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Email Verification Controller
   |--------------------------------------------------------------------------
   |
   | This controller is responsible for handling email verification for any
   | user that recently registered with the application. Emails may also
   | be re-sent if the user didn't receive the original email message.
   |
   */
    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::SELLER_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:seller');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:3,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {

        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('seller.auth.verify-email');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();
        Toastr::success('Recent successfully!','Success');
        return $request->wantsJson()
            ? new JsonResponse([], 202)
            : back()->with('resent', true);
    }

    /**
     * @throws \JsonException
     */
    protected function verified(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($this->isCommissionActive()) {
                $this->giveCommission(request()->user(),'seller');
            }
            DB::commit();
        }catch (\Exception $error){
            DB::rollBack();
        }

    }


}
