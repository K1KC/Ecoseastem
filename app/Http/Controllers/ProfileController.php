<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function viewProfile($current_username) {
        $user = auth()->user();
        $totalPrice = Transaction::where('user_id', $user->id)->sum('total_price');
        return view('pages.profile', compact('totalPrice', 'user', 'current_username'));
    }

    public function updateProfilePicture(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle the file upload
    if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
        $file = $request->file('profile_picture');

        $userId = auth()->user()->id;
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = 'profile_pic-' . $userId . '.' . $fileExtension;

        $filePath = $file->storeAs('profile_pictures', $fileName, 'public');  // Store in 'storage/app/public/profile_pictures'

        $user = auth()->user();
        $user->profile_picture = $filePath;
        $user->save();

        return back()->with('success', 'Profile picture updated successfully!');
    }

    return back()->with('error', 'Failed to upload profile picture.');
}

}
