<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/books', function (Request $request) {
    if ($request->has('author'))
        $books = App\Book::whereAuthor($request->author)->get();
    elseif ($request->has('without_author'))
        $books = App\Book::doesntHave('authors')->get();
    else
        $books = App\Book::all();

    if ($request->has('total_price'))
        return $books->sum('price');
    else
        return $books;
});

Route::get('/authors', function (Request $request) {
    if ($request->has('book'))
        return App\Author::whereBook($request->book)->get();
    else
        return App\Author::all();
});
