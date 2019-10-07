@if(count($errors))
    <div class="form-group">
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif


{{ Form::open(['url' => (empty($word)) ? '/add' : '/edit/'.$word['id'], 'id' => (empty($word)) ? 'add_word' : 'edit_word', 'class' => 'grid-x', 'autocomplete' => 'off', 'name' => (empty($word)) ? 'add_word' : 'edit_word']) }}


@isset($word['id'])
    {{ Form::hidden(
            'word_id', 
            $value = $word['id'], 
            $attributes = array(
                'id'=>'word_id_hidden'
            )
    )}}
@endisset

<div class="cell small-12 parameter default" data-parameter-name="word">
{{ Form::text(
        'morpheme', 
        $value = (isset($word['morpheme'])) ? $word['morpheme'] : '', 
        $attributes = array(
            'id'=>'morpheme_text', 
            'placeholder'=>'Word', 
            'autocomplete'=>'off'
        )
)}}    
</div>
<div class="cell small-12 parameter default" data-parameter-name="translate">
{{ Form::text(
        'translate', 
        $value = (isset($word['translate'])) ? implode(', ', $word['translate']) : '', 
        $attributes = array(
            'id'=>'translate_text', 
            'placeholder'=>'Translation', 
            'autocomplete'=>'off'
        )
)}}     
</div>

<fieldset class="cell small-12 parameter default" data-parameter-name="word_type">
    <div class="label-button">
        {{ Form::radio(
                'word_type', 
                'noun',
                (isset($word['wordType']) && $word['wordType'] == 'noun') ? true : false, 
                $attributes = array(
                    'id'=>'word_type_noun', 
                    'data-next-params'=>'article_type'
                )
        )}}
        {{ Form::label('word_type_noun', 'Noun') }}
    </div>
    <div class="label-button">
        {{ Form::radio(
                'word_type', 
                'verb',
                (isset($word['wordType']) && $word['wordType'] == 'verb') ? true : false, 
                $attributes = array(
                    'id'=>'word_type_verb', 
                    'data-next-params'=>'reflexive preposition_verb preposition modal_verb regularity' 
                )
        )}}
        {{ Form::label('word_type_verb', 'Verb') }}
    </div>
    <div class="label-button">
        {{ Form::radio(
                'word_type', 
                'adjective',
                (isset($word['wordType']) && $word['wordType'] == 'adjective') ? true : false, 
                $attributes = array(
                    'id'=>'word_type_adjective', 
                    'data-next-params'=>'article_type' 
                )
        )}}
        {{ Form::label('word_type_adjective', 'Adjective') }}
    </div>
    <div class="label-button">
        {{ Form::radio(
                'word_type', 
                'other',
                (isset($word['wordType']) && $word['wordType'] == 'other') ? true : false, 
                $attributes = array(
                    'id'=>'word_type_other', 
                    'data-next-params'=>'article_type' 
                )
        )}}
        {{ Form::label('word_type_other', 'Other') }}
    </div>
</fieldset>

<fieldset class="cell small-12 parameter {{ (isset($word['wordType']) && $word['wordType'] == 'noun') ? '' : 'hide' }}" data-parameter-name="article_type">
    <div class="label-button">
        {{ Form::radio(
                'article_type', 
                'der',
                (isset($word['addParams']['article_type']) && $word['addParams']['article_type'] === 'der') ? true : false,
                $attributes = array(
                    'id'=>'article_type_der', 
                    'data-next-params'=>'plural' 
                )
        )}}
        {{ Form::label('article_type_der', 'der') }}
    </div>
    <div class="label-button">
        {{ Form::radio(
                'article_type', 
                'die',
                (isset($word['addParams']['article_type']) && $word['addParams']['article_type'] === 'die') ? true : false, 
                $attributes = array(
                    'id'=>'article_type_die', 
                    'data-next-params'=>'plural' 
                )
        )}}
        {{ Form::label('article_type_die', 'die') }}
    </div>    
    <div class="label-button">
        {{ Form::radio(
                'article_type', 
                'das',
                (isset($word['addParams']['article_type']) && $word['addParams']['article_type'] === 'das') ? true : false,
                $attributes = array(
                    'id'=>'article_type_das', 
                    'data-next-params'=>'plural' 
                )
        )}}
        {{ Form::label('article_type_das', 'das') }}
    </div>
    <div class="label-button">
        {{ Form::radio(
                'article_type', 
                'die_plural',
                (isset($word['addParams']['article_type']) && $word['addParams']['article_type'] === 'die_plural') ? true : false, 
                $attributes = array(
                    'id'=>'article_type_die_plural', 
                    'data-next-params'=>'plural' 
                )
        )}}
        {{ Form::label('article_type_die_plural', 'die(Pl)') }}
    </div>   
</fieldset>

<div class="cell small-12 parameter {{ (isset($word['wordType']) && $word['wordType'] == 'noun') ? '' : 'hide' }}" data-parameter-name="plural">
{{ Form::text(
        'plural', 
        $value = (isset($word['addParams']['plural'])) ? $word['addParams']['plural'] : '', 
        $attributes = array(
            'id'=>'plural_text', 
            'placeholder'=>'Plural Form', 
            'autocomplete'=>'off'
        )
)}}
</div>

<div class="cell small-6 parameter {{ (isset($word['wordType']) && $word['wordType'] == 'verb') ? '' : 'hide' }}" data-parameter-name="reflexive">
    <div class="label-button">
    {{ Form::checkbox(
            'reflexive', 
            '1',
            (!empty($word['addParams']['reflexive'])) ? true : false, 
            $attributes = array(
                'id'=>'reflexive'
            )
    )}}
    {{ Form::label('reflexive', 'V + sich') }}
    </div>
</div>

<div class="cell small-6 parameter {{ (isset($word['wordType']) && $word['wordType'] == 'verb') ? '' : 'hide' }}" data-parameter-name="preposition_verb">
    <div class="label-button">
    {{ Form::checkbox(
            'preposition_verb', 
            '1',
            (isset($word['addParams']['preposition'])) ? true : false, 
            $attributes = array(
                'id'=>'preposition_verb',
                'data-next-params'=>'preposition'
            )
    )}}
    {{ Form::label('preposition_verb', 'V + preposition') }}
    </div>
</div>

<div class="cell small-12 parameter {{ (isset($word['wordType']) && $word['wordType'] == 'verb') ? '' : 'hide' }}" data-parameter-name="preposition">
    {{ Form::select(
            'preposition', 
            [
                'Von+Dativ' => 'Von + Dativ', 
                'Auf+Akkusativ' => 'Auf + Akkusativ',
                'Für+Akkusativ' => 'Für + Akkusativ',
                'Mit+Dativ' => 'Mit + Dativ',
                'An+Akkusativ' => 'An + Akkusativ',
                'An+Dativ' => 'An + Dativ',
                'Gegen+Akkusativ' => 'Gegen + Akkusativ',
                'Bei+Dativ' => 'Bei + Dativ',
                'Um+Akkusativ' => 'Um + Akkusativ',
                'Aus+Dativ' => 'Aus + Dativ',
                'Zu+Dativ' => 'Zu + Dativ',
                'Vor+Dativ' => 'Vor + Dativ',
                'Nach+Dativ' => 'Nach + Dativ',
                'In+Akkusativ' => 'In + Akkusativ',
                'In+Dativ' => 'In + Dativ',
                'Als+Nominativ' => 'Als + Nominativ'
            ], 
            (!empty($word['addParams']['preposition'])) ? $word['addParams']['preposition'] : null,
            (!empty($word['addParams']['preposition'])) ? [] : ['placeholder' => 'Preposition']
    )}}
</div>

<fieldset class="cell small-12 parameter {{ (isset($word['wordType']) && $word['wordType'] == 'verb') ? '' : 'hide' }}" data-parameter-name="modal_verb">
    <div class="label-button">
    {{ Form::radio(
            'modal_verb', 
            'haben',
            (isset($word['addParams']['modal_verb']) && $word['addParams']['modal_verb'] === 'haben') ? true : false, 
            $attributes = array(
                'id'=>'modal_verb_haben'
            )
    )}}
    {{ Form::label('modal_verb_haben', 'Haben') }}
    </div>
    <div class="label-button">
    {{ Form::radio(
            'modal_verb', 
            'sein',
            (isset($word['addParams']['modal_verb']) && $word['addParams']['modal_verb'] === 'sein') ? true : false, 
            $attributes = array(
                'id'=>'modal_verb_sein'
            )
    )}}
    {{ Form::label('modal_verb_sein', 'Sein') }}
    </div>
</fieldset>

<fieldset class="cell small-12 parameter {{ (isset($word['wordType']) && $word['wordType'] == 'verb') ? '' : 'hide' }}" data-parameter-name="regularity">
    <div class="label-button">
    {{ Form::radio(
            'regularity', 
            'regular',
            (isset($word['addParams']['regularity']) && $word['addParams']['regularity'] == 'regular') ? true : false, 
            $attributes = array(
                'id'=>'regularity_regular'
            )
    )}}
    {{ Form::label('regularity_regular', 'Regural') }}
    </div>
    <div class="label-button">
    {{ Form::radio(
            'regularity', 
            'irregular',
            (isset($word['addParams']['regularity']) && $word['addParams']['regularity'] == 'irregular') ? true : false, 
            $attributes = array(
                'id'=>'regularity_irregural',
                'data-next-params'=>'irregurality_forms'
            )
    )}}
    {{ Form::label('regularity_irregural', 'Irregural') }}
    </div>
</fieldset>

<fieldset class="cell small-12 parameter {{ (isset($word['wordType']) && $word['wordType'] == 'verb') ? '' : 'hide' }}" data-parameter-name="irregurality_forms">
    <div class="cell small-12">
    {{ Form::text(
            'prasens', 
            $value = (isset($word['addParams']['prasens'])) ? $word['addParams']['prasens'] : '', 
            $attributes = array(
                'placeholder'=>'Prasens'
            )
    )}}
    </div>
    <div class="cell small-12">
    {{ Form::text(
            'prateritum', 
            $value = (isset($word['addParams']['prateritum'])) ? $word['addParams']['prateritum'] : '',
            $attributes = array(
                'placeholder'=>'Prateritum'
            )
    )}}
    </div>
    <div class="cell small-12">
    {{ Form::text(
            'partizip', 
            $value = (isset($word['addParams']['partizip'])) ? $word['addParams']['partizip'] : '',
            $attributes = array(
                'placeholder'=>'Partizip II'
            )
    )}}
    </div>
</fieldset>

<div class="cell small-6 parameter" data-parameter-name="collections">
@isset($word['collections'])
    @foreach ($word['collections'] as $collection)
    	<div class="label-button">
    	{{ Form::checkbox(
        	    'collections[]', 
            	$collection,
            	true, 
            	$attributes = array(
                	'id'=>'collections_'.$collection
            	)
    	)}}
    	{{ Form::label('collections_'.$collection, $collection) }}
    </div>
    @endforeach
@endisset
</div>

<div class="cell small-12 parameter default" data-parameter-name="add_tag">
    <fieldset class="ajax-form" id="add_tag" data-action="/add_label.php" data-method="get" data-enctype="text/plain">
        <div class="input-group">
            <input id="add_tag_text" class="input-group-field" type="text" name="add_tag" placeholder="Enter Tag">
            <div class="input-group-button">
                <input id="add_tag_submit" data-form="add_tag" class="ajax-form-submit button" value="Add">
            </div>
        </div>
    </fieldset>
    <span class="added-tags"></span>
</div>

<ul class="accordion cell small-12" data-accordion data-allow-all-closed="true" data-multi-expand="true">
    <li class="accordion-item" data-accordion-item>
        <a href="#" class="accordion-title">Show all tags</a>
        <div class="accordion-content" data-tab-content>
            <div class="cell small-12 parameter default" data-parameter-name="all_tags">
            </div>
        </div>
    </li>
    <li class="accordion-item {{ (!empty($word['images']) || !empty($word['addParams']['importance']) || !empty($word['addParams']['complexity']) || !empty($word['addParams']['knowledge']) || !empty($word['addParams']['examples'])) ? 'is-active' : '' }}" data-accordion-item>
        <a href="#" class="accordion-title">Show additional Params</a>
        <div class="accordion-content" data-tab-content>
            <div class="cell small-12 parameter default" data-parameter-name="illustrations">
                <fieldset class="illustrations-result">
                @if(!empty($word['images']))
			    @foreach ($word['images'] as $illustration)
                    <div class="label-button-image">
                    {{ Form::radio(
                            'picture', 
                            '{"url":"'.$illustration['url'].'", "thumbnail_url":"'.$illustration['thumbnail_url'].'"}',
                            (!empty($illustration['selected'])) ? true : false, 
                            $attributes = array(
                                'id'=>'illustration-'.$loop->index
                            )
                    )}}
                    <label for="illustration-{{ $loop->index }}">
                        <div class="thumbnail">
                            <img src="{{ $illustration['thumbnail_url'] }}">
                        </div>
                    </label>
                    </div>
			    @endforeach
                @endif                	
                </fieldset>
                <div class="illustrations-noresult">
                    <h3>No images</h3>
                </div>
            </div>
            <div class="cell small-12 parameter default" data-parameter-name="importance">
                <div class="input-group counter">
                    <span class="input-group-label">Importance</span>
                    <div class="input-group-button">
                        <button type="button" class="button" data-role="btn-number-decrement">-</button>
                    </div>
                    {{ Form::number(
                            'importance', 
                            (isset($word['addParams']['importance'])) ? $word['addParams']['importance'] : '3', 
                            [
                                'class'=>'input-group-field number-field',
                                'min'=>'1', 
                                'max'=>'5', 
                                'step'=>'1'
                            ]
                    )}}
                    <div class="input-group-button">
                        <button type="button" class="button" data-role="btn-number-increment">+</button>
                    </div>
                </div>
            </div>
            <div class="cell small-12 parameter default" data-parameter-name="complexity">
                <div class="input-group counter">
                    <span class="input-group-label">Complexity</span>
                    <div class="input-group-button">
                        <button type="button" class="button number-decrement">-</button>
                    </div>
                    {{ Form::number(
                            'complexity', 
                            (isset($word['addParams']['complexity'])) ? $word['addParams']['complexity'] : '3', 
                            [
                                'class'=>'input-group-field number-field',
                                'min'=>'1', 
                                'max'=>'5', 
                                'step'=>'1'
                            ]
                    )}}
                    <div class="input-group-button">
                        <button type="button" class="button number-increment">+</button>
                    </div>
                </div>
            </div>
            <div class="cell small-12 parameter default" data-parameter-name="knowledge">
                <div class="input-group counter">
                    <span class="input-group-label">Knowledge</span>
                    <div class="input-group-button">
                        <button type="button" class="button number-decrement">-</button>
                    </div>
                    {{ Form::number(
                            'knowledge', 
                            (isset($word['addParams']['knowledge'])) ? $word['addParams']['knowledge'] : '3',  
                            [
                                'class'=>'input-group-field number-field',
                                'min'=>'1', 
                                'max'=>'5', 
                                'step'=>'1'
                            ]
                    )}}
                    <div class="input-group-button">
                        <button type="button" class="button number-increment">+</button>
                    </div>
                </div>
            </div>
            <div class="cell small-12 parameter default" data-parameter-name="examples">
                {{ Form::textarea(
                            'examples', 
                            (isset($word['addParams']['examples'])) ? $word['addParams']['examples'] : null, 
                            [
                                'placeholder'=>'Using examples'
                            ]
                )}}
            </div>
        </div>
    </li>
</ul>

<div class="cell small-12">
    {{ Form::submit('Submit', ['class'=>'button cell small-12']) }}
</div>


{!! Form::close() !!}