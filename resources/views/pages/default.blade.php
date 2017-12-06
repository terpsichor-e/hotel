@extends('layout')

@section('title', $page->title)

@section('content')
    <div class="intro small" style="background-image: url({{ $page->image }})">
        <div class="container">
            <div class="intro-content">
                {!! $page->intro_text !!}
            </div>
        </div>
    </div>
    <div class="text-block">
        <div class="container">
            {!! $page->content !!}
        </div>
    </div>
@endsection