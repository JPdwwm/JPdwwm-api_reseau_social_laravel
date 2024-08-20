<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // On récupère tous les posts
            $comments = Comment::all();

            // On retourne les informations posts et des utilisateurs concernés JSON
            return response()->json($comments);
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
            'user_id' => 'required|int',
            'post_id' => 'required|int'
        ]);

        // On créé un nouveau commentaire
        $comment = Comment::create($request->all());

        // On retourne les informations du nouveau commentaire au format JSON
        return response()->json([
            'status' => 'Success',
            'data' => $comment,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
    return response ()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|max:500',
            'image' => 'nullable|max:191',
            'tags' => 'required|max:191'
        ]);

        // On met a jour le commentaire
        $comment->update($request->all());

        // On retourne le commentaire modifié
        return response()->json([
            'status' => 'Mise a jour du post effectuée avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
            // On supprime l'utilisateur
            $comment->delete();

            // On retourne la réponse au format JSON
            return response()->json([
                'status' => "Suppression effectuée avec succès !"
            ]);
    }
}
