@extends('layout')

@section('title', $room_class->title)
@section('body_class', 'room room-single')

@section('content')
    <div class="intro small" style="background-image: url({{ ('/storage/uploads/'.$room_class->photos[0]) }})">
        <div class="container">
            <div class="intro-content">
                <h1>{{ $room_class->title }}</h1>
                <a href="{{ route('book.form', ['room_class'=>$room_class]) }}"
                   class="btn btn-primary">@lang('booking.action')</a>
            </div>
        </div>
    </div>
    <div class="features">
        <div class="container">
            @foreach($room_class->features as $feature)
                @include('feature.card')
            @endforeach
        </div>
    </div>
    <div class="description">
        <div class="container">
            {!! $room_class->description !!}
        </div>
    </div>
    <div class="photos">
        <div class="container">
            @foreach($room_class->photos as $photo)
                <div class="col-md-4">
                    <a href="{{ ('/storage/uploads/'.$photo) }}"><img src="{{ ('/storage/uploads/'.$photo) }}"
                                                                      alt="{{ $room_class->title }}"></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection