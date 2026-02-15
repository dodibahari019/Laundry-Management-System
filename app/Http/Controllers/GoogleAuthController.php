<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            /**
             * 1️⃣ Cek email
             */
            $user = Pelanggan::where('email', $googleUser->getEmail())->first();

            /**
             * 2️⃣ Generate ID pelanggan (PLG001)
             */
            if (!$user) {
                $last = Pelanggan::orderBy('id_pelanggan', 'desc')->first();
                $number = $last ? (int)substr($last->id_pelanggan, 3) + 1 : 1;
                $newId = 'PLG' . str_pad($number, 3, '0', STR_PAD_LEFT);

                /**
                 * Ambil first & last name dari Google
                 */
                $fullName = $googleUser->getName();
                $names = explode(' ', $fullName, 2);

                $user = Pelanggan::create([
                    'id_pelanggan'   => $newId,
                    'nama'           => $fullName,
                    'first_name'     => $names[0],
                    'last_name'      => $names[1] ?? null,
                    'email'          => $googleUser->getEmail(),
                    'password'       => bcrypt(Str::random(16)),
                    'no_hp'          => "",          // WAJIB karena NOT NULL
                    'alamat'         => "",          // WAJIB karena NOT NULL
                    'auth_provider'  => 'google',
                    'provider_id'    => $googleUser->getId(),
                    'email_verified_at' => now(),
                    'status'         => 'active',
                ]);
            } 
            /**
             * 3️⃣ User lama tapi belum link Google
             */
            else if (!$user->provider_id) {
                $user->update([
                    'auth_provider' => 'google',
                    'provider_id'   => $googleUser->getId(),
                    'email_verified_at' => now(),
                ]);
            }

            /**
             * 4️⃣ Login
             */
            // Auth::login($user);
            Auth::guard('pelanggan')->login($user);

            return redirect('/');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login Google gagal');
        }
    }
}
