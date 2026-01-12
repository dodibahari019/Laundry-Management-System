<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tb_pelanggan', function (Blueprint $table) {
            <?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'tb_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
    protected $keyType = 'string';

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

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pelanggan', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('auth_provider');
            $table->dropColumn('provider_id');
        });
    }
};
