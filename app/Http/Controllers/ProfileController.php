<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('admin.pengaturan.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'alamat_toko' => 'nullable|string',
            'deskripsi_toko' => 'nullable|string',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        
        $user->update([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'alamat_toko' => $request->alamat_toko,
            'deskripsi_toko' => $request->deskripsi_toko,
        ]);

        if ($request->hasFile('profile')) {
            if ($user->file) {
                Storage::delete($user->file->path);
                $user->file->delete();
            }

            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $filename = $user->id . '-' . time() . '.' . $extension;
            $folder = 'profiles/' . $user->id;
            $path = $file->storeAs($folder, $filename, 'public'); 

            $user->file()->create([
                'alias' => 'foto-profil',
                'filename' => $filename,
                'path' => $path,
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return back()->with('success', 'Pengaturan toko berhasil diperbarui');
    }
}