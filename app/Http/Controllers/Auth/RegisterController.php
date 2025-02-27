<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

use App\Models\User;
use App\Models\Candidat;


class RegisterController extends Controller
{


    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {

        // image :
        // profile :

        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image')->store('profiles_images', 'public');
        } else {
            $profileImage = 'default/profile.png';
        }

        dd($profileImage);
        // dd($request->profile_image);





    }
}
