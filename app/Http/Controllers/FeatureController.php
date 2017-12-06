<?php

namespace App\Http\Controllers;

use App\Feature;

class FeatureController extends Controller {

	public function index() {
		$features = Feature::all();

		return view( 'feature.index', compact( 'features' ) );
	}

}
