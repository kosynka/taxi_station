<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rent;

class DashboardController extends Controller
{
    private array $metaData = ['active' => 'dashboard'];

    public function dashboard()
    {
        $data = Rent::with(['car', 'driver', 'penalty'])->get();

        return view("admin.dashboard", compact('data') + $this->metaData);
    }
}
