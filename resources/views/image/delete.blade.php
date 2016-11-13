@extends('layouts.app')
@section('title', '| DELETE IMAGE?')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="alert alert-danger">
                Sigurno želite obrisati ovu sliku?
            </div>
            <img style="height:360px" src="../../{{ $image->url }}" alt="">
            <a href="{{ url('/') }}">
                <button style="margin: 10px" class="btn btn-default pull-left">Odustani</button>
            </a>
            {{ Form::open(['route' => ['image.destroy', $image->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Obriši', ['style' => 'margin: 10px', 'class' => 'btn btn-danger pull-right']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection