<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLocations extends Model
{
    protected $table = 'tb_order_locations';
    protected $primaryKey = 'id_order_locations';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_order_locations',
        'id_order',
        'latitude',
        'longitude',
        'place_id',
        'formatted_address',
    ];

    public function order(){
        return $this->belongsTo(Orders::class, 'id_order', 'id_order');
    }
}
