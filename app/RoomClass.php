<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RoomClass
 *
 * @property int $id
 * @property int $title
 * @property string|null $description
 * @property float $price
 * @property int $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Feature[] $features
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Room[] $rooms
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoomClass extends Model {

	protected $fillable = [
		'title',
		'description',
		'price',
		'status',
	];

	public function rooms() {
		return $this->hasMany( 'App\Room' );
	}

	public function features() {
		return $this->belongsToMany( 'App\Feature' );
	}

	public function bookings() {
		return $this->hasMany( 'App\Booking' );
	}

}
