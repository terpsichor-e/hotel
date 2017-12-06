<?php

namespace App;

trait PageTemplates {
	private function default() {
		$this->crud->addField( [
			'name'   => 'image',
			'label'  => 'Интро / Фон',
			'type'   => 'image',
			'upload' => true,
			'crop'   => true,
		] );
		$this->crud->addField( [
			'name'  => 'intro_text',
			'label' => 'Интро / Текст',
			'fake'  => true,
		] );
		$this->crud->addField( [
			'name'  => 'content',
			'label' => 'Содержимое',
			'type'  => 'wysiwyg',
		] );
	}

	private function home() {
		$this->crud->addField( [
			'name'   => 'image',
			'label'  => 'Интро / Фон',
			'type'   => 'image',
			'upload' => true,
			'crop'   => true,
		] );
		$this->crud->addField( [
			'name'  => 'content',
			'label' => 'Интро / Текст',
			'type'  => 'wysiwyg',
		] );
	}
}
