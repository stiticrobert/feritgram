@extends('layouts.app')
@section('title', '| Home')
@section('content')
    <div class="row">
        @foreach ($images as $image)
            @if(Auth::guest() && ($image->privacy == 'public'))
                <div class="col-sm-3">
                    <a href="{{ route('image.show', $image->name) }}" class="thumbnail">
                        <img src="{{ $image->path }}" alt="{{ $image->name }}" title="{{ $image->name }}" />
                    </a>
                </div>
            @elseif(Auth::user())
                <div class="col-sm-3">
                    <a href="{{ route('image.show', $image->name) }}" class="thumbnail">
                        <img src="{{ $image->path }}" alt="{{ $image->name }}" title="{{ $image->name}}" />
                    </a>
                </div>
            @endif
        @endforeach
    </div>
    <div class="text-center">
        {!! $images->links(); !!}
    </div>
@endsection
