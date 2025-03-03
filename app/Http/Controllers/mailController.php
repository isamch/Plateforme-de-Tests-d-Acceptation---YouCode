<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\UserNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;


class mailController extends Controller
{

    public function sendMail(Request $request)
    {

        $user = Auth::user();
        $data = $request;

        $sendmail = new UserNotification($user, $data);

        Mail::to($data->receiver)->send($sendmail);

        // return view('emails.user_notification');
    }
}
