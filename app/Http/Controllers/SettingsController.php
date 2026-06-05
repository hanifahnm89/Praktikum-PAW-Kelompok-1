<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    // SETTINGS PAGE
    public function index()
{
    $user = User::find(session('user')['id']);

    $sessions = \DB::table('sessions')->get();

    return view('settings', compact('user', 'sessions'));
}
    // UPDATE PROFILE
    public function update(Request $request)
    {
        $user = User::find(session('user')['id']);

        $request->validate([

            'first_name' => 'required',

            'last_name' => 'required',

            'email' => 'required|email',

        ]);

        $user->update([

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'name' => $request->first_name . ' ' . $request->last_name,

            'email' => $request->email,

            'phone' => $request->phone,

            'role' => $request->role,

            'country' => $request->country,

        ]);

        // UPDATE SESSION
        session([
            'user' => $user
        ]);

        return back()->with(
            'success',
            'Profile updated successfully!'
        );
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = \App\Models\User::find(session('user')['id']);

    if (!$user) {

        return redirect('/login');

    }

    // cek password lama
    if (!Hash::check($request->current_password, $user->password)) {

        return back()->with('error', 'Current password is incorrect');

    }

    // update password
    $user->password = Hash::make($request->new_password);

    // waktu terakhir update password
    $user->password_updated_at = now();

    $user->save();

    return back()->with(
        'success',
        'Password updated successfully'
    );
}
}




