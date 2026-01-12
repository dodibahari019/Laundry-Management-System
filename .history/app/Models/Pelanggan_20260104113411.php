<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pelanggan',
        'nama',
        'no_hp',
        'email',
        'password',
        'auth_provider',
        'provider_id',
        'email_verified_at',
        'status',
        'alamat',
    ];

    public function orders(){
        return $this->hasMany(Order::class, 'id_pelanggan', 'id_pelanggan');
    }
}
