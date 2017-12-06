<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHashFieldToBookingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table( 'bookings', function ( Blueprint $table ) {
			$table->string( 'hash' )
			      ->unique()
			      ->after( 'id' )
			      ->index();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table( 'bookings', function ( Blueprint $table ) {
			$table->dropColumn( 'hash' );
		} );
	}
}
