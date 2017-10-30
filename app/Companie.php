<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Companie extends Model
{
    use FilterPaginateOrder;

    protected $fillable = [
        'name', 'email', 'address',
    ];

    protected $filter = [
        'id', 'stock_id', 'title', 'type', 'entered_date', 'entered_time', 'price', 'created_at',
        // filter relation also, eg: stock
        'stock.id', 'stock.company', 'stock.email', 'stock.name',
        'stock.address', 'stock.created_at'
    ];

    public static function initialize()
    {
        return [
            'name' => '',
            'email' => '',
            'address' => '',
            'items' => [
                Exchange::initialize()
            ]
        ];
    }

    public function items()
    {
        return $this->hasMany(Exchange::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
