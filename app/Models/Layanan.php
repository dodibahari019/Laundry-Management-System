<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'tb_layanan';
    protected $primaryKey = 'id_layanan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_layanan',
        'nama_layanan',
        'jenis',
        'harga',
        'durasi',
        'status',
        'foto',
    ];

    public function orders(){
        return $this->hasMany(Orders::class, 'id_layanan', 'id_layanan');
    }

    public function orderItems(){
        return $this->hasMany(OrderItems::class, 'id_layanan', 'id_layanan');
    }
}
