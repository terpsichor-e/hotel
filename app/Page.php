<?php

namespace App;

use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Backpack\PageManager\app\Models\Page as BasePage;
use Traversable;

/**
 * App\Page
 *
 * @property int $id
 * @property string $template
 * @property string $name
 * @property array $title
 * @property string $slug
 * @property array $content
 * @property string|null $extras
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $image
 * @property-read mixed $slug_or_title
 * @method static \Illuminate\Database\Eloquent\Builder|\Backpack\PageManager\app\Models\Page findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereExtras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends BasePage {
	use HasTranslations;

	protected $translatable = [ 'content', 'title' ];
	protected $fillable = [ 'template', 'name', 'title', 'slug', 'content', 'image', 'extras' ];

	public static function boot() {
		parent::boot();
		static::deleting( function ( $obj ) {
			\Storage::disk( 'uploads' )->delete( $obj->image );
		} );
	}

	public function addFakes( $columns = [ 'extras' ] ) {
		foreach ( $columns as $key => $column ) {
			$column_contents = $this->{$column};

			if ( ! is_object( $this->{$column} ) ) {
				$column_contents = json_decode( $this->{$column}, true );
			}

			if ( ( is_array( $column_contents ) || $column_contents instanceof Traversable ) && count( $column_contents ) ) {
				foreach ( $column_contents as $fake_field_name => $fake_field_value ) {
					$this->setAttribute( $fake_field_name, $fake_field_value );
				}
			}
		}
	}

	public function setImageAttribute( $value ) {
		$attribute_name   = "image";
		$disk             = "uploads";
		$destination_path = "page";

		// if the image was erased
		if ( $value == null ) {
			// delete the image from disk
			\Storage::disk( $disk )->delete( $this->{$attribute_name} );

			// set null in the database column
			$this->attributes[ $attribute_name ] = null;
		}

		// if a base64 was sent, store it in the db
		if ( starts_with( $value, 'data:image' ) ) {
			// 0. Make the image
			$image = \Image::make( $value );
			// 1. Generate a filename.
			$filename = md5( $value . time() ) . '.jpg';
			// 2. Store the image on disk.
			\Storage::disk( $disk )->put( $destination_path . '/' . $filename, $image->stream() );
			// 3. Save the path to the database
			$this->attributes[ $attribute_name ] = $destination_path . '/' . $filename;
		}
	}

	public function getImageAttribute( $value ) {
		return \Storage::disk( 'uploads' )->url( $value );
	}

}
