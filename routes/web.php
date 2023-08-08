<?php

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArticleController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route ressource pour les commentaires = posts.
Route::resource('posts', PostController::class)
    ->middleware(['auth', 'verified']);

// Route::get('posts.index', function () {
//     return view('posts.index');
// });


//Route ressource pour les articles = articles.
Route::resource('articles', ArticleController::class)
    ->except('index')
    ->middleware(['auth', 'verified']);

// Route::get('articles.index', function () {
//     return view('articles.index');
// });

// Méthode pour afficher un article dans ArticleController
// public funtion show()
// {    //Pour afficher un article
//     return view('posts.show');
// }
// => créer views/articles/show.blade.php

require __DIR__ . '/auth.php';
