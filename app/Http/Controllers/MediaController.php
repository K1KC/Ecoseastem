<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\MediaFile;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'media' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,mp4|max:10240',  // Adjust based on your needs
        ]);

        // Handle the uploaded file
        if ($request->hasFile('media') && $request->file('media')->isValid()) {
            $file = $request->file('media');

            // Generate a unique name for the file
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');  // Store in 'storage/app/public/uploads'

            // Create a new media entry in the database
            MediaFile::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_type' => $file->getMimeType(),
            ]);

            return back()->with('success', 'File uploaded successfully!');
        }

        return back()->with('error', 'Failed to upload file.');
    }
}

}
