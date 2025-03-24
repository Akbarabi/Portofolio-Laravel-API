<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\User\PasswordResetHelper;

class ForgotPasswordController extends Controller
{
    private $resetHelper;
    public function __construct()
    {
        $this->resetHelper = new PasswordResetHelper();
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $response = $this->resetHelper->sendResetLink($request->email);

        if (!$response['status']) {
            return response()->failed($response['error']);
        }

        return response()->success([], 'Link reset password telah dikirim ke email Anda');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $response = $this->resetHelper->resetPassword($request->token, $request->email, $request->password);

        if (!$response['status']) {
            return response()->failed($response['error']);
        }

        return response()->success([], 'Password berhasil direset');
    }
}
