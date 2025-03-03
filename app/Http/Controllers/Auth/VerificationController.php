<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationMail;
use App\Models\User;


class VerificationController extends Controller
{

    public function index()
    {
        return view('emails.verify');
    }

    public function verify($id, $token)
    {

        $user = User::where('verification_token', $token)->where('id', $id)->first();


        if (!$user) {
            return view('emails.verification_error')->with('message', 'Invalid verification code.');
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        return redirect()->to('home')->with('success', 'Your email has been verified successfully.');
    }


    public function send()
    {
        $user = Auth::user();

        if ($user->email_verified_at) {
            return redirect()->to('home')->with('message', 'Your Account was activated');
        }

        $user->update([
            'verification_token' => Str::random(60)
        ]);

        Mail::to($user->email)->send(new VerificationMail($user));

        return redirect()->route('verification.notice')->with('success', 'Verification email has been sent successfully!');
    }
}
