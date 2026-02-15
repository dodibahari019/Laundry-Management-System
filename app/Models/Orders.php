<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'tb_orders';
    protected $primaryKey = 'id_order';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_order',
        'kode_order',
        'id_pelanggan',
        'total',
        'status_order',
        'pickup_date',
        'pickup_time',
        'pickup_type',
        'alamat_pickup',
        'kategori_alamat',
        'instruksi_alamat',
        'instruksi_driver',
        'catatan',
        'tanggal_masuk',
        'tanggal_selesai'
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'pickup_time' => 'datetime',
        'tanggal_masuk' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function orderStatusLog()
    {
        return $this->hasMany(OrderStatusLog::class, 'id_order', 'id_order');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_order', 'id_order');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'id_order', 'id_order');
    }

    // Tambahkan alias 'items' untuk kompatibilitas
    public function items()
    {
        return $this->hasMany(OrderItems::class, 'id_order', 'id_order');
    }

    public function orderLocations()
    {
        return $this->hasOne(OrderLocations::class, 'id_order', 'id_order');
    }
    
    // Alias untuk location
    public function location()
    {
        return $this->hasOne(OrderLocations::class, 'id_order', 'id_order');
    }
}