<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'rooms', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->text( 'title' );
			$table->integer( 'room_class_id' )
			      ->references( 'id' )
			      ->on( 'room_classes' );
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
		Schema::dropIfExists( 'rooms' );
	}
}
