<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Edit Word</title>
    </head>
    <body>
        @include('elements.form_create_word')

        
        {{ $word }}
        {!! Form::open(['id' => 'add_word', 'class' => 'grid-x', 'autocomplete' => 'off', 'enctype' => 'text/plain', 'name' => 'add_word', 'target' => '_blank']) !!}
        <form id="add_word" class="grid-x" action="/add" autocomplete="off" enctype="text/plain" method="get" name="add_word" target="_blank">
        {{ Form::label('morpheme', 'Word') }}
        {{ Form::text(
                    'morpheme', 
                    $value = $word->morphemes['morpheme'], 
                    $attributes = array(
                        'id'=>'morpheme_text', 
                        'placeholder'=>'Word', 
                        'autocomplete'=>'off'
                    )
                ) }}

        {{ Form::submit('Save') }}
        {!! Form::close() !!}
    </body>
</html>
