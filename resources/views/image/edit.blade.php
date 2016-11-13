@extends('layouts.app')
@section('title', '| Edit Image')
@section('content')
	<div class="row">
		{!! Form::model($image, ['route' => ['image.update', $image->id], 'method' => 'PUT']) !!}
		<div class="col-md-4 thumbnail">
			<img src="../../{{ $image->url }}" alt="">
		</div>
		<div class="col-md-4">
			{{ Form::label('name', 'Naziv:') }}
			{{ Form::text('name', null, ['class' => 'form-control input']) }}
			{{ Form::label('description', 'Opis:') }}
			{{ Form::text('description', null, ['class' => 'form-control']) }}
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
						<a href="{{ route('profile', Auth::user()->name) }}">
							<button class="btn btn-danger">
								Odustani
							</button>
						</a>
					</div>
					<div class="col-md-6">
						{{ Form::submit('Spremi', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
@endsection