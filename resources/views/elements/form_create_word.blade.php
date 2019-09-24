{{ Form::open(['id' => 'add_word', 'class' => 'grid-x', 'autocomplete' => 'off', 'enctype' => 'text/plain', 'name' => 'add_word', 'target' => '_blank']) }}

<div class="cell small-12 parameter default" data-parameter-name="word">
{{ Form::text(
        'morpheme', 
        $value = (isset($word->morpheme)) ? $word->morpheme : '', 
        $attributes = array(
            'id'=>'morpheme_text', 
            'placeholder'=>'Word', 
            'autocomplete'=>'off'
        )
)}}    
</div>
<div class="cell small-12 parameter default" data-parameter-name="translate">
{{ Form::text(
        'translation', 
        $value = (isset($word->translation)) ? $word->translation : '', 
        $attributes = array(
            'id'=>'translation_text', 
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
                (isset($word->word_type) && $word->word_type === 'noun') ? true : false, 
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
                (isset($word->word_type) && $word->word_type === 'verb') ? true : false, 
                $attributes = array(
                    'id'=>'word_type_verb', 
                    'data-next-params'=>'article_type' 
                )
        )}}
        {{ Form::label('word_type_verb', 'Verb') }}
    </div>
    <div class="label-button">
        {{ Form::radio(
                'word_type', 
                'adjective',
                (isset($word->word_type) && $word->word_type === 'adjective') ? true : false, 
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
                (isset($word->word_type) && $word->word_type === 'other') ? true : false, 
                $attributes = array(
                    'id'=>'word_type_other', 
                    'data-next-params'=>'article_type' 
                )
        )}}
        {{ Form::label('word_type_other', 'Other') }}
    </div>
</fieldset>

<fieldset class="cell small-12 parameter hide" data-parameter-name="article_type">
    <div class="label-button">
        {{ Form::radio(
                'article_type', 
                'der',
                (isset($word->article_type) && $word->article_type === 'der') ? true : false,
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
                (isset($word->article_type) && $word->article_type === 'die') ? true : false, 
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
                (isset($word->article_type) && $word->article_type === 'das') ? true : false,
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
                (isset($word->article_type) && $word->article_type === 'die_plural') ? true : false, 
                $attributes = array(
                    'id'=>'article_type_die_plural', 
                    'data-next-params'=>'plural' 
                )
        )}}
        {{ Form::label('article_type_die_plural', 'die(Pl)') }}
    </div>   
</fieldset>

<div class="cell small-12 parameter hide" data-parameter-name="plural">
{{ Form::text(
        'plural', 
        $value = (isset($word->plural)) ? $word->plural : '', 
        $attributes = array(
            'id'=>'plural_text', 
            'placeholder'=>'Plural Form', 
            'autocomplete'=>'off'
        )
)}}
</div>

<div class="cell small-6 parameter hide" data-parameter-name="reflexive">
    <div class="label-button">
    {{ Form::checkbox(
            'reflexive', 
            '1',
            (isset($word->reflexive)) ? true : false, 
            $attributes = array(
                'id'=>'reflexive'
            )
    )}}
    {{ Form::label('reflexive', 'V + sich') }}
    </div>
</div>

<div class="cell small-6 parameter hide" data-parameter-name="preposition">
    <div class="label-button">
    {{ Form::checkbox(
            'preposition', 
            '1',
            (isset($word->preposition)) ? true : false, 
            $attributes = array(
                'id'=>'preposition',
                'data-next-params'=>'preposition_verb'
            )
    )}}
    {{ Form::label('preposition', 'V + preposition') }}
    </div>
</div>

<div class="cell small-12 parameter hide" data-parameter-name="preposition_verb">
    {{ Form::select(
            'preposition_verb', 
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
            (isset($word->preposition)) ? $word->preposition : null,
            (isset($word->preposition)) ? null : ['placeholder' => 'Preposition']
    )}}
</div>

<fieldset class="cell small-12 parameter hide" data-parameter-name="modal_verb">
    <div class="label-button">
    {{ Form::radio(
            'modal_verb', 
            'haben',
            (isset($word->modal_verb) && $word->modal_verb === 'haben') ? true : false, 
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
            (isset($word->modal_verb) && $word->modal_verb === 'sein') ? true : false, 
            $attributes = array(
                'id'=>'modal_verb_sein'
            )
    )}}
    {{ Form::label('modal_verb_sein', 'Sein') }}
    </div>
</fieldset>

<fieldset class="cell small-12 parameter hide" data-parameter-name="regularity">
    <div class="label-button">
    {{ Form::radio(
            'regularity', 
            'regular',
            (isset($word->regularity) && $word->regularity === true) ? true : false, 
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
            (isset($word->regularity) && $word->regularity === false) ? true : false, 
            $attributes = array(
                'id'=>'regularity_irregural',
                'data-next-params'=>'irregurality_forms'
            )
    )}}
    {{ Form::label('regularity_irregural', 'Irregural') }}
    </div>
</fieldset>

<fieldset class="cell small-12 parameter hide" data-parameter-name="irregurality_forms">
    <div class="cell small-12">
    {{ Form::text(
            'prasens', 
            $value = (isset($word->prasens)) ? $word->prasens : '', 
            $attributes = array(
                'placeholder'=>'Prasens'
            )
    )}}
    </div>
    <div class="cell small-12">
    {{ Form::text(
            'prateritum', 
            $value = (isset($word->prateritum)) ? $word->prateritum : '',
            $attributes = array(
                'placeholder'=>'Prateritum'
            )
    )}}
    </div>
    <div class="cell small-12">
    {{ Form::text(
            'partizip', 
            $value = (isset($word->partizip)) ? $word->partizip : '',
            $attributes = array(
                'placeholder'=>'Partizip II'
            )
    )}}
    </div>
</fieldset>

<div class="cell small-6 parameter hide" data-parameter-name="collections">
@isset($word->labels)
    @foreach ($word->labels as $label)
    	<div class="label-button">
    	{{ Form::checkbox(
        	    'collections[]', 
            	$label,
            	false, 
            	$attributes = array(
                	'id'=>'collections_'.$label
            	)
    	)}}
    	{{ Form::label('collections_moebel', $label) }}
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
    <li class="accordion-item" data-accordion-item>
        <a href="#" class="accordion-title">Show additional Params</a>
        <div class="accordion-content" data-tab-content>
            <div class="cell small-12 parameter default" data-parameter-name="illustrations">
			@if(isset($word->illustrations))
                <fieldset class="illustrations-result">
			    @foreach ($word->illustrations as $illustration)
                    <div class="label-button-image">
                    {{ Form::radio(
                            'picture', 
                            $illustration->url,
                            false, 
                            $attributes = array(
                                'id'=>'illustration-'.$loop->index,
                                'data-thumbnail'=>$illustration->thumbnail
                            )
                    )}}
                    <label for="illustration-{{ $loop->index }}">
                        <div class="thumbnail">
                            <img src="{{ $illustration->thumbnail }}">
                        </div>
                    </label>
                    </div>
			    @endforeach                	
                </fieldset>
			@else
                <div class="illustrations-noresult">
                    <h3>No images</h3>
                </div>
            @endif
            </div>
            <div class="cell small-12 parameter default" data-parameter-name="importance">
                <div class="input-group counter">
                    <span class="input-group-label">Importance</span>
                    <div class="input-group-button">
                        <button type="button" class="button" data-role="btn-number-decrement">-</button>
                    </div>
                    {{ Form::number(
                            'importance', 
                            (isset($word->importance)) ? $word->importance : '3', 
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
                            (isset($word->complexity)) ? $word->complexity : '3', 
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
                            (isset($word->knowledge)) ? $word->knowledge : '3',  
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
                            (isset($word->examples)) ? $word->examples : null, 
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