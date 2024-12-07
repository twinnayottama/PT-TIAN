<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class certificateLabel extends Controller
{

    public function certificate(Request $request)
    {
        // Ambil parameter serial_number dari request
        $serial_number = $request->input('serial_number');

        // Cek jika serial_number ada dan ada data yang cocok
        $labels = Label::where('serial_number', $serial_number)->get();

        // Kirim data ke view
        return view('certificate', compact('labels'));
    }
}


