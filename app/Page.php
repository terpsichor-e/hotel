<?php

namespace App;

use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Backpack\PageManager\app\Models\Page as BasePage;

/**
 * App\Page
 *
 * @property int $id
 * @property string $template
 * @property string $name
 * @property string $title
 * @property string $slug
 * @property string|null $content
 * @property string|null $extras
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereContent( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereDeletedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereExtras( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereSlug( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereTemplate( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereTitle( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page whereUpdatedAt( $value )
 * @mixin \Eloquent
 */
class Page extends BasePage {
	use HasTranslations;

	protected $translatable = ['content', 'title'];
}
