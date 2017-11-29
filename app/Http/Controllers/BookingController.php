<?php

namespace App\Http\Controllers;

use App\Booking;
use App\RoomClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller {

	public function book( Request $request, RoomClass $room_class ) {
		$this->validate( $request, [
			'client_name'   => 'required|string',
			'client_phone'  => 'required|string',
			'client_email'  => 'required|email',
			'client_wishes' => 'sometimes|required|text',
			'arrival_at'    => 'required|date_format:Y.m.d H:i',
			'departure_at'  => 'required|date_format:Y.m.d H:i|after:arrival_at',
		] );

		$arrival_at   = Carbon::createFromFormat( 'Y.m.d H:i', $request->get( 'arrival_at' ) );
		$departure_at = Carbon::createFromFormat( 'Y.m.d H:i', $request->get( 'departure_at' ) );

		$available = $room_class->available( $arrival_at, $departure_at );
		abort_if( $available->isEmpty(), 404, 'На эти даты нет доступных комнат' );

		$booking = Booking::create( [
			                            'room_class_id' => $room_class->id,
			                            'room_id'       => $available->first()->id,
			                            'price'         => $room_class->price,
			                            'type'          => Booking::TYPE_ONLINE,
			                            'status'        => Booking::STATUS_NEW,

			                            'arrival_at'   => $arrival_at,
			                            'departure_at' => $departure_at,
		                            ] + $request->only( 'client_name', 'client_phone', 'client_email', 'client_wishes' ) );
		if ( $request->ajax() ) {
			return [
				'code'    => '200',
				'message' => 'Номер успешно забронирован. Ваш номер брони #' . $booking->id,
				'action'  => 'fade',
			];
		} else {
			return redirect()
				->route( 'room.view', $room_class )
				->with( 'result', [ 'success', 'Номер успешно забронирован. Ваш номер брони #' . $booking->id ] );
		}
	}

}
