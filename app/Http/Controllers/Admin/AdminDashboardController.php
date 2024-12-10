<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Label;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCount = User::where('role', '=', 'user')->count();
        $adminCount = User::where('role', '=', 'admin')->count();
        $lotCount = Lot::all()->count();
        $labelCount = Label::all()->count();
        $qrcodeCount = Code::all()->count();
        $lots = Lot::withCount('label')->with(['firstLabel', 'lastLabel'])->get();

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
            [
                'bg_color' => 'success',
                'icon' => 'far fa-solid fa-sheet-plastic',
                'title' => 'Jumlah Lot',
                'value' => $lotCount,
            ],
            [
                'bg_color' => 'danger',
                'icon' => 'far fa-solid fa-tag',
                'title' => 'Jumlah Label',
                'value' => $labelCount,
            ],
            [
                'bg_color' => 'info',
                'icon' => 'far fa-solid fa-qrcode',
                'title' => 'Jumlah Qrcode',
                'value' => $qrcodeCount,
            ],
        ];

        return view('admin.dashboard.index', compact('cards', 'lots'));
    }
}
