<?php

return [
	'number'    => 'Reservation #:id',
	'details' => '<p>Your number :room category :room_class expects you from :arrival_at by :departure_at. </p><p><bold>Сумма к оплате $:price.</bold></p>',
	'not_available' => 'No available numbers for the selected dates',
	'booked'        => '\'Number has been successfully booked. Your reservation number is #:id',
	'action'        => 'Book',
	'form'          => [
		'title'         => 'Reservation',
		'room_class'    => 'Category of the room',
		'arrival_at'    => 'Check-in time',
		'departure_at'  => 'Check out time',
		'client_name'   => 'Full name',
		'client_phone'  => 'Phone',
		'client_email'  => 'E-Mail',
		'client_wishes' => 'Wishes',
		'submit'        => 'Reserve',
	],
];