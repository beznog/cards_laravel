<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Words</title>
    </head>
    <body>
        <ul>
            @foreach ($words as $word)
                <li>
                    {{ $word->morpheme_id }}
                </li>
            @endforeach
        </ul>
    </body>
</html>
