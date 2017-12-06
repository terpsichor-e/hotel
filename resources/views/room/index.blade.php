@extends('layout')

@section('title', __('room.classes.title'))

@section('content')
    <div class="intro small" style="background-image: url({{ url('img/rooms_bg.jpg') }})">
        <div class="container">
            <div class="intro-content">
                <h1>@lang('room.classes.title')</h1>
            </div>
        </div>
    </div>
    <div class="rooms">
        <div class="container">
            @foreach($room_classes as $room)
                @include('room.card')
            @endforeach
        </div>
    </div>
@endsection