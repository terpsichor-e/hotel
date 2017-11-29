<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Room
 *
 * @property int $id
 * @property string $title
 * @property int $room_class_id
 * @property int $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 * @property-read \App\RoomClass $roomClass
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Room whereRoomClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Room whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Room whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Room whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Room extends Model {
	use CrudTrait;

	const STATUS_AVAILABLE = 1;
	const STATUS_DISABLED = 2;

	protected $fillable = [
		'title',
		'room_class_id',
		'status',
	];

	public function roomClass() {
		return $this->belongsTo( 'App\RoomClass' );
	}

	public function bookings() {
		return $this->hasMany( 'App\Booking' );
	}
}
