<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'tb_order_items';
    protected $primaryKey = 'id_order_item';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_order_item',
        'id_order',
        'id_layanan',
        'qty',
        'harga',
        'subtotal'
    ];

    public function order(){
        return $this->belongsTo(Orders::class, 'id_order', 'id_order');
    }

    public function layanan(){
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}
