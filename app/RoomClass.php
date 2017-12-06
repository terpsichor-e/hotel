<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\RoomClass
 *
 * @property int $id
 * @property array $title
 * @property array $description
 * @property float $price
 * @property int $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property array $photos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Feature[] $features
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Room[] $rooms
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoomClass whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoomClass extends Model {
	use CrudTrait;
	use HasTranslations;

	const STATUS_ACTIVE = 1;
	const STATUS_DISABLED = 2;
	const STATUSES = [
		self::STATUS_ACTIVE   => 'Включен',
		self::STATUS_DISABLED => 'Отключен',
	];

	protected $fillable = [
		'title',
		'description',
		'price',
		'status',
		'photos',
	];
	protected $translatable = [
		'title',
		'description',
	];
	protected $casts = [
		'photos' => 'array',
	];

	public function roomsCount() {
		$total     = $this->rooms()->count();
		$available = $this->available( Carbon::now(), Carbon::now(), true );

		return ( $available ) . '/' . ( $total - $available );
	}

	public function rooms() {
		return $this->hasMany( 'App\Room' );
	}

	/**
	 * @param Carbon $arrival_at
	 * @param Carbon $departure_at
	 * @param bool $count
	 *
	 * @return Room[]|\Illuminate\Database\Eloquent\Collection|int
	 */
	public function available( Carbon $arrival_at, Carbon $departure_at, $count = false ) {
		$query = $this->rooms()
		              ->where( 'status', Room::STATUS_AVAILABLE )
		              ->whereKeyNot( $this->bookings()
		                                  ->where( 'status', '<>', Booking::STATUS_CANCELED )
		                                  ->where( function ( Builder $query ) use ( $arrival_at, $departure_at ) {
			                                  $query->whereBetween( 'arrival_at', [ $arrival_at, $departure_at ] )
			                                        ->orWhereBetween( 'departure_at', [ $arrival_at, $departure_at ] )
			                                        ->orWhere( function ( Builder $query ) use ( $arrival_at, $departure_at ) {
				                                        $query->where( 'arrival_at', '<=', $arrival_at )
				                                              ->where( 'departure_at', '>=', $departure_at );
			                                        } );
		                                  } )
		                                  ->get( [ 'room_id' ] )
		                                  ->pluck( 'room_id' ) );

		return $count ? $query->count() : $query->get();
	}

	public function bookings() {
		return $this->hasMany( 'App\Booking' );
	}

	public function features() {
		return $this->belongsToMany( 'App\Feature' );
	}

	public function scopeActive( Builder $query ) {
		$query->where( 'status', self::STATUS_ACTIVE );
	}

	public function setPhotosAttribute( $value ) {
		$this->uploadMultipleFilesToDisk( $value, 'photos', 'uploads', 'class' );
	}
}
