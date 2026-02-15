<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    protected $table = 'tb_order_status_logs';
    protected $primaryKey = 'id_order_status_log';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_order_status_log',
        'id_order',
        'status',
        'id_user',
        'tanggal_ubah',
    ];

    public function users(){
        return $this->belongsTo(Users::class, 'id_user', 'id_user');
    }

    public function orders(){
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }
}
