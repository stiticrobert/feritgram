@extends('layouts.app')
@section('title', '| Upload')
@section('content')
	<div class="col-md-6 col-md-offset-3">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            Uploadaj sliku
	        </div>
        	<div class="panel-body">
		        @if(Auth::user())
	                {{ Form::open(array('url' => 'upload', 'files' => true)) }}
	                	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                        {{ Form::label('name', 'Ime slike:') }}
	                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                        	@if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
	                	<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	                        {{ Form::label('description', 'Opis:') }}
	                        {{ Form::text('description', null, ['class' => 'form-control'])}}
	                        @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
	                        {{ Form::label('image', 'Slika:') }}
	                        {{ Form::file('image', null, ['class' => 'form-control'])}}
	                        @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>	                       
	                    <hr>
	                    <div class="form-group{{ $errors->has('privacy') ? ' has-error' : '' }}">
	                        {{ Form::label('privacy', 'Privatnost:') }}
	                        {{ Form::select('privacy', array('public' => 'Javno', 'private' => 'Privatno')) }}
	                    	@if ($errors->has('privacy'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('privacy') }}</strong>
                                </span>
                            @endif
                        </div>
						<hr>
						{{ Form::label('tags', 'Tagovi:') }}
						<select class="form-control select2-multi" name="tags[]" multiple="multiple">
							@foreach($tags as $tag)
								<option value='{{ $tag->id }}'>{{ $tag->name }}</option>
							@endforeach
						</select>
                        {{ Form::submit('Upload', ['class' => 'btn btn-primary btn-block btn-lg']) }}
	                {{ Form::close() }}
                @else
	                <div class="col-md-6">
	                	<a href="{{ url('/login') }}">
	                		<button class="btn btn-primary btn-lg">Samo prijavljeni korisnici mogu uploadat</button>
	                	</a>
	                </div>
                @endif
        	</div>
		</div>
	</div>
@endsection