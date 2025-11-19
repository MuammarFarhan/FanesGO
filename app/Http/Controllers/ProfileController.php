<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // [cite: 1998]

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user(); // [cite: 2002]
        return view('profile', compact('user')); // [cite: 2003]
    }

    public function updateProfile(Request $request)
    {
        // [cite: 2007-2010]
        $request->validate([
            'name' => 'required|string|max:100',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user(); // [cite: 2012]
        $user->update(['name' => $request->name]); // [cite: 2013]

        if ($request->hasFile('profile')) { // [cite: 2014]
            // hapus file lama [cite: 2015]
            if ($user->file) {
                Storage::delete($user->file->path); // [cite: 2018]
                $user->file->delete(); // [cite: 2019]
            }

            $file = $request->file('profile'); // [cite: 2020]
            $extension = $file->getClientOriginalExtension(); // [cite: 2021]
            $filename = $user->id . '-' . time() . '.' . $extension; // [cite: 2022]
            $folder = 'profiles/' . $user->id; // [cite: 2023]
            $path = $file->storeAs($folder, $filename); // [cite: 2025]

            // [cite: 2026-2032]
            $user->file()->create([
                'alias' => 'foto-profil',
                'filename' => $filename,
                'path' => $path,
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return back()->with('success', 'Profile berhasil diperbarui'); // [cite: 2034]
    }
}
