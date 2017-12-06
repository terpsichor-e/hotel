<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\MenuItem
 *
 * @property int $id
 * @property array $name
 * @property string|null $type
 * @property string|null $link
 * @property int|null $page_id
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rgt
 * @property int|null $depth
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MenuItem[] $children
 * @property-read \App\Page|null $page
 * @property-read \App\MenuItem|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MenuItem extends Model {
	use CrudTrait;
	use HasTranslations;

	protected $table = 'menu_items';
	protected $fillable = [ 'name', 'type', 'link', 'page_id', 'parent_id' ];
	protected $translatable = [ 'name' ];

	/**
	 * Get all menu items, in a hierarchical collection.
	 * Only supports 2 levels of indentation.
	 */
	public static function getTree() {
		$menu = self::orderBy( 'lft' )->get();

		if ( $menu->count() ) {
			foreach ( $menu as $k => $menu_item ) {
				$menu_item->children = collect( [] );

				foreach ( $menu as $i => $menu_subitem ) {
					if ( $menu_subitem->parent_id == $menu_item->id ) {
						$menu_item->children->push( $menu_subitem );

						// remove the subitem for the first level
						$menu = $menu->reject( function ( $item ) use ( $menu_subitem ) {
							return $item->id == $menu_subitem->id;
						} );
					}
				}
			}
		}

		return $menu;
	}

	public function parent() {
		return $this->belongsTo( 'App\MenuItem', 'parent_id' );
	}

	public function children() {
		return $this->hasMany( 'App\MenuItem', 'parent_id' );
	}

	public function page() {
		return $this->belongsTo( 'App\Page', 'page_id' );
	}

	public function url() {
		switch ( $this->type ) {
			case 'external_link':
				return $this->link;
				break;

			case 'internal_link':
				return is_null( $this->link ) ? '#' : url( $this->link );
				break;

			default: //page_link
				if ( $this->page ) {
					return url( $this->page->slug );
				}
				break;
		}
	}
}
