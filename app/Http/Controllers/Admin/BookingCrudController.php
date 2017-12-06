<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;

class BookingCrudController extends CrudController {
	public function setup() {

		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		$this->crud->setModel( 'App\Booking' );
		$this->crud->setRoute( config( 'backpack.base.route_prefix' ) . '/booking' );
		$this->crud->setEntityNameStrings( 'Бронь', 'Брони' );
		$this->crud->enableDetailsRow();
		$this->crud->allowAccess( 'details_row' );
		$this->crud->orderColumns( [ 'id', 'room_id', 'room_class_id' ] );

		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

		$this->crud->addColumn( [
			'name'  => 'id',
			'label' => '#',
		] );
		$this->crud->addColumn( [
			'name'      => 'room_id',
			'label'     => 'Номер',
			'type'      => 'select',
			'entity'    => 'room',
			'attribute' => 'title',
			'model'     => "\App\Room",
		] );
		$this->crud->addColumn( [
			'name'      => 'room_class_id',
			'label'     => 'Категория',
			'type'      => 'select',
			'entity'    => 'roomClass',
			'attribute' => 'title',
			'model'     => "\App\RoomClass",
		] );
		$this->crud->addColumn( [
			'name'  => 'price',
			'label' => 'Стоимость',
		] );
		$this->crud->addColumn( [
			'name'    => 'type',
			'label'   => 'Тип',
			'type'    => 'radio',
			'options' => Booking::TYPES,
		] );
		$this->crud->addColumn( [
			'name'    => 'status',
			'label'   => 'Статус',
			'type'    => 'radio',
			'options' => Booking::STATUSES,
		] );
		$this->crud->addColumn( [
			'name'  => 'arrival_at',
			'label' => 'Заезд',
		] );
		$this->crud->addColumn( [
			'name'  => 'departure_at',
			'label' => 'Отъезд',
		] );

		$this->crud->addField( [
			'name'      => 'room_id',
			'label'     => 'Номер',
			'type'      => 'select2',
			'entity'    => 'room',
			'attribute' => 'title',
			'model'     => 'App\Room',
		] );
		$this->crud->addField( [
			'name'      => 'room_class_id',
			'label'     => 'Категория',
			'type'      => 'select2',
			'entity'    => 'roomClass',
			'attribute' => 'title',
			'model'     => 'App\RoomClass',
		] );
		$this->crud->addField( [
			'name'  => 'price',
			'label' => 'Стоимость',
			'type'  => 'number',
		] );
		$this->crud->addField( [
			'name'    => 'type',
			'label'   => 'Тип',
			'type'    => 'select_from_array',
			'options' => Booking::TYPES,
		] );
		$this->crud->addField( [
			'name'    => 'status',
			'label'   => 'Статус',
			'type'    => 'select_from_array',
			'options' => Booking::STATUSES,
		] );
		$this->crud->addField( [
			'name'  => 'client_name',
			'label' => 'ФИО',
		] );
		$this->crud->addField( [
			'name'  => 'client_phone',
			'label' => 'Телефон',
		] );
		$this->crud->addField( [
			'name'  => 'client_email',
			'label' => 'E-Mail',
			'type'  => 'email',
		] );
		$this->crud->addField( [
			'name'  => 'client_wishes',
			'label' => 'Пожелания',
			'type'  => 'textarea',
		] );
		$this->crud->addField( [
			'name'  => 'arrival_at',
			'label' => 'Заезд',
			'type'  => 'datetime',
		] );
		$this->crud->addField( [
			'name'  => 'departure_at',
			'label' => 'Объезд',
			'type'  => 'datetime',
		] );

		// ------ CRUD FIELDS
		// $this->crud->addField($options, 'update/create/both');
		// $this->crud->addFields($array_of_arrays, 'update/create/both');
		// $this->crud->removeField('name', 'update/create/both');
		// $this->crud->removeFields($array_of_names, 'update/create/both');

		// ------ CRUD COLUMNS
		// $this->crud->addColumn(); // add a single column, at the end of the stack
		// $this->crud->addColumns(); // add multiple columns, at the end of the stack
		// $this->crud->removeColumn('column_name'); // remove a column from the stack
		// $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
		// $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
		// $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

		// ------ CRUD BUTTONS
		// possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
		// $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
		// $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
		// $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
		// $this->crud->removeButton($name);
		// $this->crud->removeButtonFromStack($name, $stack);
		// $this->crud->removeAllButtons();
		// $this->crud->removeAllButtonsFromStack('line');

		// ------ CRUD ACCESS
		// $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
		// $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

		// ------ CRUD REORDER
		// $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
		// NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

		// ------ CRUD DETAILS ROW
		// $this->crud->enableDetailsRow();
		// NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
		// NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

		// ------ REVISIONS
		// You also need to use \Venturecraft\Revisionable\RevisionableTrait;
		// Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
		// $this->crud->allowAccess('revisions');

		// ------ AJAX TABLE VIEW
		// Please note the drawbacks of this though:
		// - 1-n and n-n columns are not searchable
		// - date and datetime columns won't be sortable anymore
		// $this->crud->enableAjaxTable();

		// ------ DATATABLE EXPORT BUTTONS
		// Show export to PDF, CSV, XLS and Print buttons on the table view.
		// Does not work well with AJAX datatables.
		// $this->crud->enableExportButtons();

		// ------ ADVANCED QUERIES
		// $this->crud->addClause('active');
		// $this->crud->addClause('type', 'car');
		// $this->crud->addClause('where', 'name', '==', 'car');
		// $this->crud->addClause('whereName', 'car');
		// $this->crud->addClause('whereHas', 'posts', function($query) {
		//     $query->activePosts();
		// });
		// $this->crud->addClause('withoutGlobalScopes');
		// $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
		// $this->crud->with(); // eager load relationships
		// $this->crud->orderBy();
		// $this->crud->groupBy();
		// $this->crud->limit();
	}

	public function store( StoreRequest $request ) {
		return parent::storeCrud( $request );
	}

	public function update( UpdateRequest $request ) {
		return parent::updateCrud( $request );
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 * @throws \Throwable
	 */
	public function showDetailsRow( $id ) {
		$booking = Booking::query()->find( $id );

		return view( 'vendor.backpack.my.details_row.booking', compact( 'booking' ) )->render();
	}
}
