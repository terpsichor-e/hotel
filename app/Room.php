<?php

namespace App;

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
