<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;

class Profile extends Model
{
    use FilterPaginateOrder;

    protected $fillable = [
        'stock_id', 'title', 'type', 'entered_date', 'entered_time', 'price'
    ];

    protected $filter = [
        'id', 'stock_id', 'title', 'type', 'entered_date', 'entered_time', 'price', 'created_at',
        // filter relation also, eg: stock
        'stock.id', 'stock.company', 'stock.email', 'stock.name',
        'stock.phone', 'stock.address', 'stock.created_at'
    ];

    public static function initialize()
    {
        return [
            'stock_id' => 'Select',
            'title' => ' ',
            'entered_date' => date('Y-m-d'),
            'entered_time' => date('00:00:00'),
            'price' => 0,
        ];
    }
/*
    public function items()
    {
        return $this->hasMany(CompanieItem::class);
    }
*/
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
