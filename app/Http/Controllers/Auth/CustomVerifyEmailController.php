<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use App\Services\Auth\VerifyEmailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Auth\Events\Verified;

class CustomVerifyEmailController extends Controller
{

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request, $locale, $id, $hash): RedirectResponse
    {

        $user = User::findOrFail($id);

        // Проверка что hash совпадает с email
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid or expired verification link.');
        }

        // Если уже верифицирован
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', ['locale' => app()->getLocale()], absolute: false) . '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(route('dashboard', ['locale' => app()->getLocale()], absolute: false) . '?verified=1');
        // return redirect()->intended(route('login', ['locale' => app()->getLocale()], absolute: false));

    }
}
