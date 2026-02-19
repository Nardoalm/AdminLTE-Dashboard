<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return view('photo.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        return view('photo.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'photos.*' => 'required|image|max:2048'
        ]);

        foreach ($request->file('photos') as $file) {

            $path = $file->store('photos', 'public');

            $user->photos()->create([
                'path' => $path,
                'is_default' => false
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        return view('photo.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Photo $photo)
    {
        $photo = $user->photos()->findOrFail($photo->id);
        $photo->delete();
        return view('photo.index', compact('user'));
    }

    public function setDefault(User $user, Photo $photo)
    {
        $default = $user->photos()->where('is_default', true)->first();

        if($default != null){
            $default->update(['is_default' => false]);
        }

        $photo = $user->photos()->findOrFail($photo->id);

        $photo->update(['is_default' => true]);

        return back();
    }

    public function removeDefault(User $user, Photo $photo)
    {
        $photo = $user->photos()->findOrFail($photo->id);
        $photo->update(['is_default' => false]);
        return back();
    }

    public static function getDefaultPhoto(User $user){
        $photo = $user->photos()->where('is_default', true)->first();

        if ($photo) {
            return $photo->path;
        }

        return null;
    }
}
