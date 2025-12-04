<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'tb_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'id_pelanggan',
        'nama',
        'no_hp',
        'email',
        'alamat',
    ];

    public function orders(){
        return $this->hasMany(Order::class, 'id_pelanggan', 'id_pelanggan');
    }
}
