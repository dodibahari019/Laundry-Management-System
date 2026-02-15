<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'tb_pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = false;
    protected $keytype = 'string';

    protected $fillable = [
        'id_pembayaran',
        'id_order',
        'metode',
        'jumlah',
        'kembalian',
        'bukti_transfer',
        'tanggal_bayar',
        'gateway',
        'gateway_transaction_id',
        'status',
        'payment_channel',
        'payment_reference',
        'expired_at',
        'amount_paid',
        'paid_at',
        'raw_response',
        'payment_method_details'
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
        'tanggal_bayar' => 'datetime',
        'payment_method_details' => 'array',
    ];

    public function orders(){
        return $this->belongsTo(Orders::class, 'id_order', 'id_order');
    }
}
