<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //On récupère tous les articles
        $articles = Article::latest()->get();

        // On transmet les articles à la vue
        return view("articles.index", compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // On retourne la vue "/resources/views/articles/edit.blade.php"
        return view("articles.edit");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. La validation
        $this->validate($request, [
            "title" => 'bail|required|string|max:255',
            "picture" => 'bail|required |image|max:1024',
            "content" => 'bail|required',
        ]);

        // 2. On upload l'image dans "/storage/app/public/articles"
        $chemin_image = $request->picture->store("articles");

        // 3. On enregistre les informations du article
        Article::create([
            "title" => $request->title,
            "picture" => $chemin_image,
            "content" => $request->content,
        ]);

        // 4. On retourne vers tous les articles : route("articles.index")
        return redirect(route("articles.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view("articles.show", compact("article"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view("articles.edit", compact("article"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        // 1. La validation

        // Les règles de validation pour "title" et "content"
        $rules = [
            'title' => 'bail|required|string|max:255',
            "content" => 'bail|required',
        ];

        // Si une nouvelle image est envoyée
        if ($request->has("picture")) {
            // On ajoute la règle de validation pour "picture"
            $rules["picture"] = 'bail|required|image|max:1024';
        }

        $this->validate($request, $rules);

        // 2. On upload l'image dans "/storage/app/public/articles"
        if ($request->has("picture")) {

            //On supprime l'ancienne image
            Storage::delete($article->picture);

            $chemin_image = $request->picture->store("articles");
        }

        // 3. On met à jour les informations du article
        $article->update([
            "title" => $request->title,
            "picture" => isset($chemin_image) ? $chemin_image : $article->picture,
            "content" => $request->content
        ]);

        // 4. On affiche le article modifié : route("articles.show")
        return redirect(route("articles.show", $article));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // On supprime l'image existant
        Storage::delete($article->picture);

        // On les informations du $article de la table "articles"
        $article->delete();

        // Redirection route "articles.index"
        return redirect(route('articles.index'));
    }
}
