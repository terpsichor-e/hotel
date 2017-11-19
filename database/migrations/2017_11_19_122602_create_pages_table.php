<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'pages', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'slug', 64 )
			      ->unique();
			$table->string( 'title', 255 );
			$table->text( 'content' )
			      ->nullable();
			$table->integer( 'parent_id' )
			      ->nullable()
			      ->references( 'id' )
			      ->on( 'pages' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'pages' );
	}
}
