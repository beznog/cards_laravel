<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Edit Word</title>
    </head>
    <body>
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

        {{ $word }}

        @include('elements.form_create_word')
    </body>
</html>
