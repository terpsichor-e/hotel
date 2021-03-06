<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Feature
 *
 * @property int $id
 * @property array $title
 * @property array $description
 * @property string|null $icon
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RoomClass[] $roomClasses
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feature whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feature whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feature whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feature whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Feature extends Model {
	use CrudTrait;
	use HasTranslations;

	protected $fillable = [
		'title',
		'description',
		'icon',
	];
	protected $translatable = [
		'title',
		'description',
	];

	public function roomClassesCount() {
		return $this->roomClasses()->count();
	}

	public function roomClasses() {
		return $this->belongsToMany( 'App\RoomClass' );
	}

}
