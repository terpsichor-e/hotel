<?php

namespace App\Http\Middleware;

use App\MenuItem;
use Backpack\LangFileManager\app\Models\Language;
use Closure;

class ShareVariables {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		\View::share( 'menu', MenuItem::getTree() );
		\View::share( 'languages', Language::getActiveLanguagesArray() );

		return $next( $request );
	}
}
