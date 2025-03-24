<?php

namespace App\Helpers\User;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetHelper
{
    public static function sendResetLink($email)
    {
        try {
            $user = DB::table('users')->where('email', $email)->first();

            if (!$user) {
                return response()->failed(['Email tidak ditemukan'], 404);
            }

            $token = Str::random(64);

            DB::table('password_reset_tokens')->insert([
                'id' => Str::ulid()->toBase32(),
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]);

            Mail::to($email)->send(new ResetPasswordMail($email, $token));

            return [
                'status' => true,
                'message' => 'Reset password link telah dikirim ke email Anda.',
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    public static function resetPassword($token, $email, $password)
    {
        try {
            $record = DB::table('password_reset_tokens')->where('email', $email)->first();

            if (!$record || !Hash::check($token, $record->token)) {
                return [
                    'status' => false,
                    'error' => 'Token tidak valid',
                ];
            }

            DB::table('users')->where('email', $email)->update([
                'password' => Hash::make($password),
            ]);

            DB::table('password_reset_tokens')->where('email', $email)->delete();

            return [
                'status' => true,
                'message' => 'Password berhasil direset',
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }
}
