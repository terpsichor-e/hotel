<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
	const STATUS_EMPTY = 3;
	const STATUS_OCCUPIED = 4;

	const STATUSES = [
		self::STATUS_AVAILABLE => 'Доступен',
		self::STATUS_DISABLED  => 'Закрыт',
	];
	const STATUSES_EXTENDED = self::STATUSES + [
		self::STATUS_EMPTY    => 'Свободен',
		self::STATUS_OCCUPIED => 'Занят',
	];

	protected $fillable = [
		'title',
		'room_class_id',
		'status',
	];

	public function statusColumn() {
		return self::STATUSES_EXTENDED[ $this->statusExtended() ];
	}

	public function statusExtended( Carbon $arrival_at = null, Carbon $departure_at = null ) {
		if ( $this->status == self::STATUS_DISABLED ) {
			return self::STATUS_DISABLED;
		}
		if ( $arrival_at == null ) {
			$arrival_at = Carbon::now();
		}
		if ( $departure_at == null ) {
			$departure_at = Carbon::now();
		}
		if ( $this->isAvailable( $arrival_at, $departure_at ) ) {
			return self::STATUS_EMPTY;
		} else {
			return self::STATUS_OCCUPIED;
		}
	}

	public function isAvailable( Carbon $arrival_at, Carbon $departure_at ) {
		return ! $this->bookings()
		              ->where( 'status', '<>', Booking::STATUS_CANCELED )
		              ->where( function ( Builder $query ) use ( $arrival_at, $departure_at ) {
			              $query->whereBetween( 'arrival_at', [ $arrival_at, $departure_at ] )
			                    ->orWhereBetween( 'departure_at', [ $arrival_at, $departure_at ] )
			                    ->orWhere( function ( Builder $query ) use ( $arrival_at, $departure_at ) {
				                    $query->where( 'arrival_at', '<=', $arrival_at )
				                          ->where( 'departure_at', '>=', $departure_at );
			                    } );
		              } )
		              ->exists();
	}

	public function bookings() {
		return $this->hasMany( 'App\Booking' );
	}

	public function roomClass() {
		return $this->belongsTo( 'App\RoomClass' );
	}
}
