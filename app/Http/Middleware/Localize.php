<?php

namespace App\Http\Middleware;

use Closure;

class Localize {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		if ( $request->hasCookie( 'locale' ) ) {
			app()->setLocale( $request->cookie( 'locale' ) );
		}

		return $next( $request );
	}
}
