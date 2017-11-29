<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Booking
 *
 * @property int $id
 * @property int $room_class_id
 * @property int|null $room_id
 * @property float $price
 * @property int $type
 * @property int $status
 * @property string $client_name
 * @property string|null $client_phone
 * @property string|null $client_email
 * @property string|null $client_wishes
 * @property string|null $arrival_at
 * @property string|null $departure_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Room|null $room
 * @property-read \App\RoomClass $roomClass
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereArrivalAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereClientEmail( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereClientName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereClientPhone( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereClientWishes( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereDepartureAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking wherePrice( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereRoomClassId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereRoomId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereStatus( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereType( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereUpdatedAt( $value )
 * @mixin \Eloquent
 */
class Booking extends Model {
	use CrudTrait;

	const TYPE_ONLINE = 1;
	const TYPE_PHONE = 2;
	const TYPE_EMAIL = 3;
	const TYPE_PERSONAL = 4;

	const STATUS_NEW = 1;
	const STATUS_APPROVAL = 2;
	const STATUS_CONFIRMED = 3;
	const STATUS_CANCELED = 4;

	protected $fillable = [
		'room_class_id',
		'room_id',
		'price',
		'type',
		'status',
		'client_name',
		'client_phone',
		'client_email',
		'client_wishes',
		'arrival_at',
		'departure_at',
	];

	public function roomClass() {
		return $this->belongsTo( 'App\RoomClass' );
	}

	public function room() {
		return $this->belongsTo( 'App\Room' );
	}

}
