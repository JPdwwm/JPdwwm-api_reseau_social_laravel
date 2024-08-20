<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On récupère tous les posts
        $posts = Post::all();

        // On retourne les informations posts et des utilisateurs concernés JSON
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:500',
            'image' => 'nullable|max:191',
            'tags' => 'required|max:191',
            'user_id' => 'required|int'
        ]);

        // On créé un nouveau psot
        $post = Post::create($request->all());

        // On retourne les informations du nouveau post au format JSON
        return response()->json([
            'status' => 'Success',
            'data' => $post,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // On retourne les informations du post au format json
        return response ()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:500',
            'image' => 'nullable|max:191',
            'tags' => 'required|max:191'
        ]);

        // On met a jour le post
        $post->update($request->all());

        // On retourne le post modifié
        return response()->json([
            'status' => 'Mise a jour du post effectuée avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // On supprime l'utilisateur
        $post->delete();

        // On retourne la réponse au format JSON
        return response()->json([
            'status' => "Suppression effectuée avec succès !"
        ]);
    }
}
