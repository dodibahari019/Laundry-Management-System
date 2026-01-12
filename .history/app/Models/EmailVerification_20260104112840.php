<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
     use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    /**
     * Generate token verifikasi baru
     */
    public static function generateToken($email)
    {
        // Hapus token lama jika ada
        self::where('email', $email)->delete();

        // Buat token baru
        $token = bin2hex(random_bytes(32));

        // Simpan token (expired 24 jam)
        self::create([
            'email' => $email,
            'token' => $token,
            'expired_at' => now()->addHours(24),
        ]);

        return $token;
    }

    /**
     * Validasi token
     */
    public static function verifyToken($token)
    {
        $verification = self::where('token', $token)
            ->where('expired_at', '>', now())
            ->first();

        return $verification;
    }

    /**
     * Hapus token setelah digunakan
     */
    public static function deleteToken($email)
    {
        self::where('email', $email)->delete();
    }
}
