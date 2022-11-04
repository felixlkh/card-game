<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_settings')->insert([
            'background_color' => 'linear-gradient(to left, #4155b3 50%, #c34875 50%)',
            'btn_color' => 'ff84b7',
            'live' => 3,
            'card_face' => '',
            'text_title' => 'Card Game',
            'text_play' => 'Play',
            'text_replay' => 'Replay',
            'text_higher' => 'Higher',
            'text_lower' => 'Lower',
        ]);
    }
}
