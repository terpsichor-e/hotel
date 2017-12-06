{!! Form::open(['route' => 'book.store', 'class' => 'form booking', 'data-available' => route('book.available')]) !!}
<div class="col-sm-12 info-container" style="display: none;">
    <div class="well small">
        <h2>Стоимость $<span id="price"></span></h2>
        <h3>Осталось номеров <span id="left"></span></h3>
    </div>
</div>
<div class="form-group col-sm-12 {{ $errors->has('room_class') ? 'has-error' : '' }}">
    {!! Form::label('room_class', __('booking.form.room_class')) !!}
    {!! Form::select('room_class', $room_classes, null, ['class' => 'form-control']) !!}
    @if($errors->has('room_class'))
        <div class="form-control-error">{{ $errors->first('room_class') }}</div>
    @endif
</div>
<div class="form-group col-md-6 col-sm-12 {{ $errors->has('arrival_at') ? 'has-error' : '' }}">
    {!! Form::label('arrival_at', __('booking.form.arrival_at')) !!}
    {!! Form::datetime('arrival_at', null, ['class' => 'form-control datetimepicker', 'data-time' => '12:00']) !!}
    @if($errors->has('arrival_at'))
        <div class="form-control-error">{{ $errors->first('arrival_at') }}</div>
    @endif
</div>
<div class="form-group col-md-6 col-sm-12 {{ $errors->has('departure_at') ? 'has-error' : '' }}">
    {!! Form::label('departure_at', __('booking.form.departure_at')) !!}
    {!! Form::datetime('departure_at', null, ['class' => 'form-control datetimepicker', 'data-time' => '11:00', 'data-after' => '#arrival_at']) !!}
    @if($errors->has('departure_at'))
        <div class="form-control-error">{{ $errors->first('departure_at') }}</div>
    @endif
</div>
<div class="form-group col-sm-12 {{ $errors->has('client_name') ? 'has-error' : '' }}">
    {!! Form::label('client_name', __('booking.form.client_name')) !!}
    {!! Form::text('client_name', null, ['class' => 'form-control']) !!}
    @if($errors->has('client_name'))
        <div class="form-control-error">{{ $errors->first('client_name') }}</div>
    @endif
</div>
<div class="form-group col-md-6 col-sm-12 {{ $errors->has('client_phone') ? 'has-error' : '' }}">
    {!! Form::label('client_phone', __('booking.form.client_phone')) !!}
    {!! Form::tel('client_phone', null, ['class' => 'form-control']) !!}
    @if($errors->has('client_phone'))
        <div class="form-control-error">{{ $errors->first('client_phone') }}</div>
    @endif
</div>
<div class="form-group col-md-6 col-sm-12 {{ $errors->has('client_email') ? 'has-error' : '' }}">
    {!! Form::label('client_email', __('booking.form.client_email')) !!}
    {!! Form::email('client_email', null, ['class' => 'form-control']) !!}
    @if($errors->has('client_email'))
        <div class="form-control-error">{{ $errors->first('client_email') }}</div>
    @endif
</div>
<div class="form-group col-sm-12 {{ $errors->has('client_wishes') ? 'has-error' : '' }}">
    {!! Form::label('client_wishes', __('booking.form.client_wishes')) !!}
    {!! Form::textarea('client_wishes', null, ['class' => 'form-control', 'rows' => 4]) !!}
    @if($errors->has('client_wishes'))
        <div class="form-control-error">{{ $errors->first('client_wishes') }}</div>
    @endif
</div>
<div class="form-group col-sm-12 col-md-6 col-md-offset-3 text-center">
    {!! Form::submit(__('booking.form.submit'), ['class' => 'btn btn-primary btn-block']) !!}
</div>
{!! Form::close() !!}