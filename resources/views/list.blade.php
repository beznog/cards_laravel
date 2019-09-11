<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Words</title>
    </head>
    <body>
        <ul>
            @foreach ($words as $word)
                <li>
                    {{ $word->morphemes['morpheme'] }} - 
                    @foreach ($word->translates as $translate)
                        {{ $translate->translate }}
                    @endforeach
                </li>
            @endforeach
        </ul>
    </body>
</html>
