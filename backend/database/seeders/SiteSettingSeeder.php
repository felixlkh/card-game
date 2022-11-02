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
            'background_color' => 'linear-gradient(144deg, rgb(41, 47, 60) 0%, rgb(41, 72, 107) 46%, rgb(20, 19, 57) 100%)',
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
