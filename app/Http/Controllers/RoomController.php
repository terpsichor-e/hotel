<?php

namespace App\Http\Controllers;

use App\RoomClass;

class RoomController extends Controller {

	public function index() {
		$room_classes = RoomClass::active()->paginate();

		return view( 'room.index', compact( 'room_classes' ) );
	}

	public function view( RoomClass $room_class ) {
		$room_class->load( 'features' );

		return view( 'room.view', compact( 'room_class' ) );
	}
}
