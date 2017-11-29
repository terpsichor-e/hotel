<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * The settings to add.
     */
    protected $settings = [
        [
            'key'         => 'contact_email',
            'name'        => 'Контактный Email',
            'description' => 'Отображается на страницах сайта',
            'value'       => 'admin@h.hotel',
            'field'       => '{"name":"value","label":"Email","type":"email"}',
            'active'      => 1,
        ],
        [
            'key'         => 'contact_phone',
            'name'        => 'Контактный телефон',
            'description' => 'Отображается на страницах сайта',
            'value'       => '+7 (978) 811-33-26',
            'field'       => '{"name":"value","label":"Телефон","type":"text"}',
            'active'      => 1,

        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = DB::table('settings')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted '.count($this->settings).' records.');
    }
}
