<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function viewProfile() {
        $user = auth()->user();
        $totalPrice = Transaction::where('user_id', $user->id)->sum('total_price');
        return view('pages.profile', compact('totalPrice', 'user'));
    }

    public function edit()
    {
        return view('pages.edit-profile', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:12',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Profile picture validation
        ]);

        $user = Auth::user();

        // Update name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Update profile picture if uploaded
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if exists
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }

            // Store new profile picture
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        // Save the changes
        $user->save();

        return redirect()->route('profile', $user->name)->with('success', 'Profile updated successfully!');
    }

}
