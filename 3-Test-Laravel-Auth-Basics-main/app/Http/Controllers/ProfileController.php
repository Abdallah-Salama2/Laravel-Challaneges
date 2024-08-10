<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        $user=auth()->user();
        $user->name=$request->name;
        $user->email=$request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
//        $user->update([
//            'name'=>$request->name,
//            'email'=>$request->email,
//            'password'=>$request->password,
//        ]);
//        dd($request,auth()->user());
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
