<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Edit Word</title>
    </head>
    <body>
        {{ $word }}
        @include('elements.form_create_word')
    </body>
</html>
