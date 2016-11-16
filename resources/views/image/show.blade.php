@extends('layouts.app')
@section('title', '| '. $image->name)
@section('content')
	<img src="../{{ $image->path }}" alt="">
	<div class="col-md-5" style="float:right">
		<div class="row">
			<div class="col-md-6">
				<p class="lead">Naziv: {{ $image->name }}</p>
				<p class="lead">Korisnik: 
					<a href="{{ route('profile', $user->name) }}"> {{ $user->name }}</a>
				</p>
			</div>
			<div class="col-md-6">
				<i class="fa fa-2x fa-share-alt">&nbsp&nbsp</i>
				<div style="position: absolute; display:inline; float:right" class="addthis_inline_share_toolbox"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@if($image->description)
					<hr>
					<p style="word-break: break-all" class="lead">Opis: 
						{{ $image->description }}
					</p>
					<hr>
				@endif
				@if($image->tags)
					<p class="lead">Tagovi: 
						@foreach($image->tags as $tag)
							{{ $tag->name }},
						@endforeach
					</p>
				@endif
			</div>
		</div>
		<div class="row">
			<h3 class="comments-title">
				<span class="glyphicon glyphicon-comment"></span>  
				@if($image->comments->count() == 1)
					1 Komentar
				@else
					{{ $image->comments->count() }} Komentara
				@endif
			</h3>
			@if($image->comments->count() > 2)
				<a data-toggle="modal" href="#sviKomentari" style=" margin-top: -25px; float:right">
					Pogledaj sve komentare
				</a>
			@endif
			<?php $br = 0; ?>
			@foreach($image->comments as $comment)
				<div class="comment col-md-6">
					<div class="author-info">
						<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=monsterid" }}" class="author-image">
						<div class="author-name">
							<h4>{{ $comment->name }}</h4>
							<p class="author-time">{{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
						</div>
					</div>
					<div class="comment-content">
						<div class="well">{{ $comment->comment }}</div>
					</div>
				</div>
				<?php 
					$br++;
					if($br == 2) {
						break;
					}
				 ?>
			@endforeach
		</div>
		<div class="row">
			<div id="comment-form">
				{{ Form::open(['route' => ['comments.store', $image->id], 'method' => 'POST']) }}
					<div class="col-md-6">
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							{{ Form::label('name', "Ime") }}
							{{ Form::text('name', null, ['class' => 'form-control']) }}
							@if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>						
					</div>
					<div class="col-md-6">
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							{{ Form::label('email', 'Email') }}
							{{ Form::text('email', null, ['class' => 'form-control']) }}
							@if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>							
					</div>
					<div class="col-md-12">
						<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
							{{ Form::label('comment', "Komentar") }}
							{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
							{{ Form::submit('Komentiraj', ['class' => 'btn btn-primary pull-right', 'style' => 'margin-top: 10px']) }}
							@if ($errors->has('comment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
			                @endif
						</div>						
					</div>
				{{ Form::close() }}
	      	</div>
		</div>
	</div>
	<div class="modal" id="sviKomentari" tabindex="-1" role="dialog" aria-labelledby="komentari">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Zatvori"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="komentari">Komentari</h4>
	      </div>
	      <div class="modal-body">
			@foreach($image->comments as $comment)
				<div class="comment col-md-12">
					<div class="author-info">
						<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=monsterid" }}" class="author-image">
						<div class="author-name">
							<h4>{{ $comment->name }}</h4>
							<p class="author-time">{{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
						</div>
					</div>
					<div class="comment-content">
						<div class="well">{{ $comment->comment }}</div>
					</div>
				</div>
			@endforeach
			<div id="comment-form">
				{{ Form::open(['route' => ['comments.store', $image->id], 'method' => 'POST']) }}
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						{{ Form::label('name', "Ime") }}
						{{ Form::text('name', null, ['class' => 'form-control']) }}
						@if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						{{ Form::label('email', 'Email') }}
						{{ Form::text('email', null, ['class' => 'form-control']) }}
						@if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>				
					<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
						{{ Form::label('comment', "Komentar") }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
						@if ($errors->has('comment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
		                @endif
					</div>
				{{ Form::close() }}
			</div>
	      </div>
	      <div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
			{{ Form::submit('Komentiraj', ['class' => 'btn btn-primary']) }}
			{{ Form::close() }}
	      </div>
	  </div>
	</div>
@endsection

