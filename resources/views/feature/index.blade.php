@extends('layout')

@section('title', __('feature.title'))
@section('body_class', 'features feature-archive')

@section('content')
    <div class="intro small" style="background-image: url({{ url('img/features_bg.jpg') }})">
        <div class="container">
            <div class="intro-content">
                <h1>@lang('feature.title')</h1>
            </div>
        </div>
    </div>
    <div class="features">
        <div class="container">
            @foreach($features as $feature)
                @include('feature.card')
            @endforeach
        </div>
    </div>
@endsection