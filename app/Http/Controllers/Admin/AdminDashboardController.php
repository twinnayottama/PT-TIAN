<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCount = User::where('role', '=', 'user')->count();
        $adminCount = User::where('role', '=', 'admin')->count();

        $cards = [
            [
                'bg_color' => 'primary',
                'icon' => 'far fa-solid fa-user',
                'title' => 'Jumlah User',
                'value' => $userCount,
            ],
            [
                'bg_color' => 'warning',
                'icon' => 'far fa-solid fa-user',
                'title' => 'Jumlah Admin',
                'value' => $adminCount,
            ],
        ];

        return view('admin.dashboard.index', compact('cards'));
    }
}
