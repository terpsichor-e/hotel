<?php

namespace App\Http\Controllers;

use App\RoomClass;

class RoomController extends Controller {

	public function index() {
		$rooms = RoomClass::paginate();

		return view( 'room.index', compact( 'rooms' ) );
	}

	public function view( RoomClass $room_class ) {
		$room_class->load( 'features' );

		return view( 'room.view', compact( 'room_class' ) );
	}
}
