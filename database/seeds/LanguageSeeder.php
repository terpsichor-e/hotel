<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder {
	public function run() {
		DB::table('languages')->insert([
			'name'        => 'Russian',
			'flag'        => '',
			'abbr'        => 'ru',
			'script'    => 'Cyrl',
			'native'    => 'Русский',
			'active'    => '1',
			'default'    => '1',
		]);

		DB::table('languages')->insert([
			'name'        => 'English',
			'flag'        => '',
			'abbr'        => 'en',
			'script'    => 'Latn',
			'native'    => 'English',
			'active'    => '1',
			'default'    => '0',
		]);

		$this->command->info('Language seeding successful.');
	}
}
