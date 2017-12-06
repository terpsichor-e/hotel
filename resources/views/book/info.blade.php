@extends('layout')

@section('title', __('booking.number', ['id' => $booking->id]))
@section('body_class', 'booking booking-info')

@section('content')
    <div class="intro small" style="background-image: url({{ url('/img/booking_bg.jpg') }})">
        <div class="container">
            <div class="intro-content">
                <h1>@lang('booking.number', ['id' => $booking->id])</h1>
            </div>
        </div>
    </div>
    <div class="booking-info">
        <div class="container">
            <h1>@lang('booking.booked', ['id' => $booking->id])</h1>
            @lang('booking.details', ['arrival_at' => $booking->arrival_at->format('d.m.Y h:i'), 'departure_at' => $booking->departure_at->format('d.m.Y h:i'), 'room_class' => $booking->roomClass->title, 'room' => $booking->room->title, 'price' => $booking->price])
        </div>
    </div>
@endsection