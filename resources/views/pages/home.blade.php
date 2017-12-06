@extends('layout')

@section('title', $page->title)

@section('content')
    <div class="intro" style="background-image: url({{ $page->image }})">
        <div class="container">
            <div class="intro-content">
                {!! $page->content !!}
            </div>
        </div>
    </div>
    <div class="rooms">
        <div class="container">
            @foreach(\App\RoomClass::active()->get() as $room)
                @include('room.card')
            @endforeach
        </div>
    </div>
@endsection