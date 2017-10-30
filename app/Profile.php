<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Profile extends Model
{


    protected $fillable = [
        'name', 'email', 'address'
    ];

    protected $filter = [
        'id', 'name', 'email', 'address', 'created_at',
    ];

    public static function initialize()
    {
        return [
            'name' => '', 'email' => '', 'address' => ''
        ];
    }

}
