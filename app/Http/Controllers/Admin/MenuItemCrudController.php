<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;

class MenuItemCrudController extends CrudController {
	public function __construct() {
		parent::__construct();

		$this->crud->setModel( "App\MenuItem" );
		$this->crud->setRoute( config( 'backpack.base.route_prefix' ) . '/menu-item' );
		$this->crud->setEntityNameStrings( 'Пункт Меню', 'Пункты Меню' );

		$this->crud->allowAccess( 'reorder' );
		$this->crud->enableReorder( 'name', 2 );

		$this->crud->addColumn( [
			'name'  => 'name',
			'label' => 'Надпись',
		] );

		$this->crud->addField( [
			'name'  => 'name',
			'label' => 'Надпись',
		] );
		$this->crud->addField( [
			'name'       => 'type',
			'label'      => 'Тип',
			'type'       => 'page_or_link',
			'page_model' => '\App\Page',
		] );
	}

	public function store( StoreRequest $request ) {
		return parent::storeCrud( $request );
	}

	public function update( UpdateRequest $request ) {
		return parent::updateCrud( $request );
	}
}
