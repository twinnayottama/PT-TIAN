<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Label;
use App\Models\Lot;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();
        $lotCount = Lot::where('user_id', $userId)->count();
        $labelCount = Label::where('user_id', $userId)->count();
        $qrcodeCount = Code::where('user_id', $userId)->count();

        // Data Card
        $cards = [
            [
                'bg_color' => 'primary',
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
                'bg_color' => 'warning',
                'icon' => 'far fa-solid fa-qrcode',
                'title' => 'Jumlah Qrcode',
                'value' => $qrcodeCount,
            ],
        ];
        return view('user.dashboard.index', compact('cards'));
    }
}
