<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Stock extends Model
{
    use FilterPaginateOrder;

    protected $fillable = [
        'name', 'email', 'phone', 'address'
    ];

    // whitelist of filter-able columns
    protected $filter = [
        'id', 'name', 'email', 'phone', 'address', 'created_at'
    ];

    public static function initialize()
    {
        return [
            'name' => '', 'email' => '',  'phone' => '', 'address' => ''
        ];
    }

    public function companies()
    {
        return $this->hasMany(Companie::class);
    }
}
