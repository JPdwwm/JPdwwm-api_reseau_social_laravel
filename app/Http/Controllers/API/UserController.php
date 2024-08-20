<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On récupère tous les utilisateurs
        $users = User::all();

        // On retourne les informations des utilisateurs en format JSON
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pseudo' => 'required|max:191',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'email' => 'required|max:191',
            'password' => 'required|max:191',
        ]);

        $imageName = null; // Initialiser la variable

        // Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
            } else {
                return response()->json(['error' => 'Erreur lors du téléchargement de l\'image.'], 400);
            }
        }

        // On créé un nouvel utilisateur
        $user = User::create(array_merge(
            $request->only(['pseudo', 'email', 'password']),
            ['image' => $imageName] // Ajoutez le nom de l'image uniquement si elle est définie
        ));

        // On retourne les informations du nouvel utilisateur en format JSON
        return response()->json([
            'status' => 'Success',
            'data' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // On retourne les informations de l'utilisateur en format JSON
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'pseudo' => 'required|max:191',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'email' => 'required|max:191',
        ]);

        // Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
                $request->merge(['image' => $imageName]); // Mettre à jour la demande avec le nouveau nom d'image
            } else {
                return response()->json(['error' => 'Erreur lors du téléchargement de l\'image.'], 400);
            }
        }

        // On met à jour l'utilisateur
        $user->update($request->only(['pseudo', 'email', 'image']));

        // On retourne les informations du nouvel utilisateur en format JSON
        return response()->json([
            'status' => 'Mise à jour effectuée avec succès !'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // On supprime l'utilisateur
        $user->delete();

        // On retourne la réponse au format JSON
        return response()->json([
            'status' => 'Suppression effectuée avec succès !'
        ]);
    }
}