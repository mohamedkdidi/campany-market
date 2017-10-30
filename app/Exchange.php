<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $fillable = [
        'stock', 'type', 'entered_date', 'entered_time', 'price'
    ];

    public static function initialize()
    {
        return [
            'stock' => 'Select',
            'type' => '',
            'entered_date' => date('Y-m-d'),
            'entered_time' => time('00:00'),
            'price' => 0,
        ];
    }
}
