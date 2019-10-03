<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Words</title>
    </head>
    <body>
        <ul>
            @foreach ($words as $word)
                <li>
                    {{-- $word --}}
                    @if ($word->wordTypes['word_type'] == "noun")
                        {{ $word->addParams['article_type'] }}
                    @endif
                    {{ $word->morphemes['morpheme'] }}

                    @if ($word->addParams['reflexive'])
                        sich
                    @endif
                    @isset($word->addParams['preposition'])
                        {{ $word->addParams['preposition'] }}
                    @endisset

                    @if ($word->wordTypes['word_type'] == "noun")
                        (pl. {{ $word->addParams['plural'] }})
                    @endif
                        - 
                    @foreach ($word->translates as $translate)
                        {{ $translate->translate }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                    
                    @isset($word->addParams['prasens'])
                        <br>
                        {{ $word->addParams['prasens'] }}
                    @endisset
                    @isset($word->addParams['prateritum'])
                        {{ $word->addParams['prateritum'] }}
                    @endisset
                    @isset($word->addParams['partizip'])
                        @isset($word->addParams['modal_verb'])
                            {{ $word->addParams['modal_verb'] }}
                        @endisset
                        {{ $word->addParams['partizip'] }}
                    @endisset
                    
                    @isset($word->addParams['examples'])
                        <br>
                        examples: {{ $word->addParams['examples'] }}
                    @endisset
                    
                    @isset($word->addParams['importance'])
                        <br>
                        importance: {{ $word->addParams['importance'] }},
                    @endisset
                    @isset($word->addParams['complexity'])
                        complexity: {{ $word->addParams['complexity'] }},
                    @endisset   
                    @isset($word->addParams['knowledge'])
                        knowledge: {{ $word->addParams['knowledge'] }}
                    @endisset
                    <br>
                    {{ link_to_action('WordsController@autocompleteEditForm', 'edit', $parameters = array($word->id), $attributes = array('target' => '_blank')) }}
                    <br>
                    <br>            
                </li>
            @endforeach
        </ul>
    </body>
</html>
