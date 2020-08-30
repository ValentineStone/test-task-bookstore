<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Bookstore</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Spectre is a minimal frontend css-only framework -->
        <link rel="stylesheet" href="{{ url('css/spectre.min.css') }}">
        <!-- Hydrate app with immedite data -->
        <script>
            window.books = @json(App\Book::all()->makeHidden('price'));
            window.authors = @json(App\Author::all());
            window.booksWithoutAuthor = @json(App\Book::doesntHave('authors')->get());
        </script>
        <!-- Load application styles and scripts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script defer src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <!-- Preact instance lives in #app -->
        <div id="app"></div>
    </body>
</html>
