<?php

namespace App\Http\Controllers\Admin;

use Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController as BaseController;
use Backpack\PageManager\app\Http\Requests\PageRequest as StoreRequest;
use Backpack\PageManager\app\Http\Requests\PageRequest as UpdateRequest;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Image;

class PageCrudController extends BaseController {

	public function store( StoreRequest $request ) {
		$this->addDefaultPageFields( \Request::input( 'template' ) );
		$this->useTemplate( \Request::input( 'template' ) );

		if ( $request->has( 'intro_bg' ) ) {
			$request->offsetSet( 'intro_bg', $this->uploadImage( $request->get( 'intro_bg' ) ) );
		}

		return parent::storeCrud( $request );
	}

	public function uploadImage( $value ) {
		$disk             = "uploads";
		$destination_path = "page";

		if ( $value == null ) {
			return null;
		}

		// if a base64 was sent, store it in the db
		if ( starts_with( $value, 'data:image' ) ) {
			// 0. Make the image
			$image = Image::make( $value );
			// 1. Generate a filename.
			$filename = md5( $value . time() ) . '.jpg';
			// 2. Store the image on disk.
			\Storage::disk( $disk )->put( $destination_path . '/' . $filename, $image->stream() );

			// 3. Save the path to the database
			return $destination_path . '/' . $filename;
		}

		return $value;
	}

	public function edit( $id, $template = false ) {
		if ( $template == false ) {
			$model               = $this->crud->model;
			$this->data['entry'] = $model::findOrFail( $id )->withFakes();
			if ( $this->data['entry']->intro_bg != null ) {
				try {
					$image                         = Image::make( \Storage::disk( 'uploads' )->get( $this->data['entry']->intro_bg ) );
					$this->data['entry']->intro_bg = $image->stream( 'data-url' )->getContents();
//					dd( $this->data['entry'] );
				} catch ( FileNotFoundException $e ) {
				}
			}
			$template = $this->data['entry']->template;
		}

		$this->addDefaultPageFields( $template );
		$this->useTemplate( $template );

		return parent::edit( $id );
	}

	public function update( UpdateRequest $request ) {
		$this->addDefaultPageFields( \Request::input( 'template' ) );
		$this->useTemplate( \Request::input( 'template' ) );

		if ( $request->has( 'intro_bg' ) ) {
			$request->offsetSet( 'intro_bg', $this->uploadImage( $request->get( 'intro_bg' ) ) );
		}

		return parent::updateCrud( $request );
	}

}
