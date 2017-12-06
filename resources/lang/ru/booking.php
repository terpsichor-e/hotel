<?php

return [
	'number'    => 'Бронь #:id',
	'details' => '<p>Ваш номер :room категории :room_class ожидает вас с :arrival_at по :departure_at.</p><p><bold>Сумма к оплате $:price.</bold></p>',
	'not_available' => 'Нет доступных номеров на выбранные даты',
	'booked'        => 'Номер успешно забронирован. Ваш номер брони #:id',
	'action'        => 'Забронироать',
	'form'          => [
		'title'         => 'Бронирование',
		'room_class'    => 'Категория номера',
		'arrival_at'    => 'Время заезда',
		'departure_at'  => 'Время выезда',
		'client_name'   => 'Фамилия Имя Отчество',
		'client_phone'  => 'Телефон',
		'client_email'  => 'E-Mail',
		'client_wishes' => 'Пожелания',
		'submit'        => 'Забронировать',
	],
];