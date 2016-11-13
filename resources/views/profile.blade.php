@extends('layouts.app')
@section('title', '| ' . $user->name)
@section('content')
	<h1 class="text-center">{{ $user->name }}</h1>
	<div class="row">
		@foreach($images as $image)
			@if(Auth::guest())
				@if($image->user_id == $user->id && $image->privacy == 'public')
		            <div class="col-sm-3">
		                <a href="{{ route('image.show', $image->name) }}" class="thumbnail">
		                    <img src="../{{ $image->url }}" alt="{{ $image->name }}" title="{{ $image->name }}" />
		                </a>
		            </div>
		        @endif
	        @elseif(Auth::user())
	        	@if(Auth::user()->id == $user->id)
		            <div class="col-sm-3">
			            <div class="well">
			            	<a href="{{ route('image.edit', $image->id) }}">
				            	<button style="margin:10px" class="btn btn-primary">
				            		<span class="glyphicon glyphicon-pencil"></span>
				            	</button>
				            </a>
			            	<a href="{{ route('image.delete', $image->id) }}">
				            	<button style="margin:10px" class="btn btn-danger pull-right">
				            		<span class="glyphicon glyphicon-trash"></span>
				            	</button>
			            	</a>
			                <a href="{{ route('image.show', $image->name) }}" class="thumbnail">
			                    <img src="../{{ $image->url }}" alt="{{ $image->name }}" title="{{ $image->name }}" />
			                </a>
						</div>
		            </div>
	        	@endif    	
			@endif
		@endforeach
	</div>
@endsection