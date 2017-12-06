<?php

namespace App\Http\Controllers;

use App\Booking;
use App\RoomClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller {

	public function form() {
		$room_classes = RoomClass::active()
		                         ->get()
		                         ->mapWithKeys( function ( $item ) {
			                         return [ $item->id => $item->title ];
		                         } );

		return view( 'book.index', compact( 'room_classes' ) );
	}

	public function info( $booking_hash ) {
		$booking = Booking::whereHash( $booking_hash )
		                  ->with('room', 'roomClass' )
		                  ->firstOrFail();

		return view( 'book.info', compact( 'booking' ) );
	}

	public function available( Request $request ) {
		$this->validate( $request, [
			'room_class'   => 'required|exists:room_classes,id',
			'arrival_at'   => 'required|date_format:d.m.Y H:i',
			'departure_at' => 'required|date_format:d.m.Y H:i|after:arrival_at',
		] );

		$room_class   = RoomClass::find( $request->get( 'room_class' ) );
		$arrival_at   = Carbon::createFromFormat( 'd.m.Y H:i', $request->get( 'arrival_at' ) );
		$departure_at = Carbon::createFromFormat( 'd.m.Y H:i', $request->get( 'departure_at' ) );

		$available = $room_class->available( $arrival_at, $departure_at );
		$result    = [ 'available' => $available->isNotEmpty() ];
		if ( $result['available'] ) {
			$result['price'] = $this->calculate( $room_class->price, $arrival_at, $departure_at );
			$result['left']  = $available->count();
		} else {
			$result['message'] = __( 'booking.not_available' );
		}

		return $result;
	}

	private function calculate( $price, Carbon $arrival_at, Carbon $departure_at ) {
		$arrival_day   = $arrival_at->copy()->startOfDay()->hour( 12 );
		$departure_day = $departure_at->copy()->startOfDay()->hour( 11 );
		$extra         = ( $arrival_at->lt( $arrival_day ) ? 0.5 : 0 ) + ( $departure_at->gt( $departure_day ) ? 0.5 : 0 );

		return $price * ( $arrival_day->diffInDays( $departure_day->hour( 12 ) ) + $extra );
	}

	public function book( Request $request ) {
		$this->validate( $request, [
			'room_class'    => 'required|exists:room_classes,id',
			'client_name'   => 'required|string',
			'client_phone'  => 'required|string',
			'client_email'  => 'required|email',
			'client_wishes' => 'present|string|nullable',
			'arrival_at'    => 'required|date_format:d.m.Y H:i',
			'departure_at'  => 'required|date_format:d.m.Y H:i|after:arrival_at',
		] );

		$room_class   = RoomClass::find( $request->get( 'room_class' ) );
		$arrival_at   = Carbon::createFromFormat( 'd.m.Y H:i', $request->get( 'arrival_at' ) );
		$departure_at = Carbon::createFromFormat( 'd.m.Y H:i', $request->get( 'departure_at' ) );

		$available = $room_class->available( $arrival_at, $departure_at );
		if ( $available->isEmpty() ) {
			if ( $request->ajax() ) {
				return [
					'code'    => '401',
					'message' => __( 'booking.not_available' ),
					'action'  => 'fade',
				];
			} else {
				/** @noinspection MissedFieldInspection */
				return redirect()
					->back()
					->withInput( $request->all() )
					->withErrors( [ 'room_class' => __( 'booking.not_available' ) ] );
			}
		}

		$booking = Booking::create( [
			                            'room_class_id' => $room_class->id,
			                            'room_id'       => $available->first()->id,
			                            'price'         => $this->calculate( $room_class->price, $arrival_at, $departure_at ),
			                            'type'          => Booking::TYPE_ONLINE,
			                            'status'        => Booking::STATUS_NEW,

			                            'arrival_at'   => $arrival_at,
			                            'departure_at' => $departure_at,
		                            ] + $request->only( 'client_name', 'client_phone', 'client_email', 'client_wishes' ) );
		if ( $request->ajax() ) {
			return [
				'code'    => '200',
				'message' => __( 'booking.booked', [ 'id' => $booking->id ] ),
				'action'  => 'fade',
			];
		} else {
			return redirect()
				->route( 'book.info', $booking->hash )
				->with( 'notification', [
					'type'    => 'success',
					'message' => __( 'booking.booked', [ 'id' => $booking->id ] ),
				] );
		}
	}

}
