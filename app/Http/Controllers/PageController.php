<?php

namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller {

	public function home() {
		return $this->index('home');
	}

	public function index($slug)
	{
		$page = Page::findBySlug($slug);

		if (!$page)
		{
			abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
		}

		$data['title'] = $page->title;
		$data['page'] = $page->withFakes();

		return view('pages.'.$page->template, $data);
	}

}
