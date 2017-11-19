<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'features', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'title' );
			$table->text( 'description' )
			      ->nullable();
			$table->string( 'icon' )
			      ->nullable();
			$table->timestamps();
		} );
		Schema::create( 'feature_room_class', function ( Blueprint $table ) {
			$table->integer( 'feature_id' )
			      ->references( 'id' )
			      ->on( 'features' );
			$table->integer( 'room_class_id' )
			      ->references( 'id' )
			      ->on( 'room_classes' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'feature_room_class' );
		Schema::dropIfExists( 'features' );
	}
}
