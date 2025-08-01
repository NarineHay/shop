<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {

        if ($request->user()->hasVerifiedEmail()) {

            return redirect()->intended(route('dashboard', ['locale' => app()->getLocale()], absolute: false));
        }

        // $request->user()->sendEmailVerificationNotification();
        $user = $request->user();
        Mail::to($user->email)->send(new VerifyEmail($user));

        return back()->with('status', 'verification-link-sent');
    }
}
