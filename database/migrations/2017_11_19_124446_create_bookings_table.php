<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'bookings', function ( Blueprint $table ) {
			$table->increments( 'id' );

			$table->integer( 'room_class_id' )
			      ->references( 'id' )
			      ->on( 'room_classes' );
			$table->integer( 'room_id' )
			      ->references( 'id' )
			      ->on( 'rooms' )
			      ->nullable();
			$table->decimal( 'price' )
			      ->unsigned();
			$table->smallInteger( 'type' );
			$table->smallInteger( 'status' );

			$table->string( 'client_name' );
			$table->string( 'client_phone' )
			      ->nullable();
			$table->string( 'client_email' )
			      ->nullable();
			$table->text( 'client_wishes' )
			      ->nullable();

			$table->timestamp( 'arrival_at' )
			      ->nullable();
			$table->timestamp( 'departure_at' )
			      ->nullable();

			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'bookings' );
	}
}
