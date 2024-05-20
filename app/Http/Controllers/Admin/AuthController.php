<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function check()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return redirect('login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
