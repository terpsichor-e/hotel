<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomClassesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'room_classes', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->text( 'title' );
			$table->text( 'description' )
			      ->nullable();
			$table->decimal( 'price' )
			      ->unsigned();
			$table->smallInteger( 'status' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'room_classes' );
	}
}
