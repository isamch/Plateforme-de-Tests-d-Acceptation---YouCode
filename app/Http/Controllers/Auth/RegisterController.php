<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


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
            $profileImage = $request->file('profile_image')->store('profiles_images/candidat', 'public');
        } else {
            $profileImage = 'profiles_images/default/profile.jpeg';
        }

        // card :
         if ($request->hasFile('national_card_image')) {
            $cardImage = $request->file('national_card_image')->store('card_images/candidat', 'public');
        } else {
            $cardImage = 'card_images/default/card1.png';
        }


        // insert for user :
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'address' => $request->address,
            'photo' => $profileImage,
        ]);

        $user->assignRole('candidat');

        $candidat = Candidat::create([
            'user_id' => $user->id,
            'card_path' => $cardImage,
        ]);


        return redirect()->to('/login')->with('success_register', 'account created successfully');

    }
}
