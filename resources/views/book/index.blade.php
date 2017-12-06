@extends('layout')

@section('title', __('booking.form.title'))
@section('body_class', 'booking')

@section('content')
    <div class="intro small" style="background-image: url({{ url('/img/booking_bg.jpg') }})">
        <div class="container">
            <div class="intro-content">
                <h1>@lang('booking.form.title')</h1>
            </div>
        </div>
    </div>
    <div class="booking-form">
        <div class="container">
            @include('book.form')
        </div>
    </div>
@endsection