@extends('layouts.app')
@section('title', '| Edit Image')
@section('content')
	<div class="row">
		{{ Form::model($image, ['route' => ['image.update', $image->id], 'method' => 'PUT']) }}
		<div class="col-md-4 thumbnail">
			<img src="../../{{ $image->path }}" alt="">
		</div>
		<div class="col-md-4">	                	
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    			{{ Form::label('name', 'Naziv:') }}
    			{{ Form::text('name', null, ['class' => 'form-control input']) }}
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">                        
    			{{ Form::label('description', 'Opis:') }}
    			{{ Form::text('description', null, ['class' => 'form-control']) }}
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <hr>
            <div class="form-group{{ $errors->has('privacy') ? ' has-error' : '' }}">                          
                {{ Form::label('privacy', 'Privatnost:') }}
                {{ Form::select('privacy', array('public' => 'Javno', 'private' => 'Privatno')) }}
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <hr>                        
            {{ Form::label('filter', 'Filter:') }}
            {{ Form::select('filter', array(
                    'Antique'    => 'Antique', 
                    'Blur'       => 'Blur',
                    'Chrome'     => 'Chrome',
                    'Monopin'    => 'Monopin',
                    'Retro'      => 'Retro',
                    'Velvet'     => 'Velvet',
                    'BlackWhite' => 'BlackWhite',
                    'Boost'      => 'Boost',
                    'Dreamy'     => 'Dreamy',
                    'Sepia'      => 'Sepia',
                    'SynCity'    => 'SynCity')) }}
            <hr>
            {{ Form::label('tags', 'Tagovi:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
		</div>
		<div class="col-md-4">
			<br>
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Postavljeno:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($image->created_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Zadnji put ažurirano:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($image->updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
                    <div class="col-md-6">
                        {{ Form::submit('Spremi', ['class' => 'btn btn-success btn-block']) }}
                        {{ Form::close() }}
                    </div>       
					<div class="col-md-6">
						<a href="{{ url('/') }}">
							<button class="btn btn-danger pull-right">
								Odustani
							</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
