<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'background_color',
        'btn_color',
        'live',
        'card_face',
        'text_title',
        'text_play',
        'text_replay',
        'text_higher',
        'text_lower',
    ];
}
