<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Lot;
use Illuminate\Http\Request;

class certificateLabel extends Controller
{

    public function certificate(Request $request)
    {
        // Ambil parameter serial_number dari request
        $serial_number = $request->input('serial_number');

        // Validasi jika serial_number ada
        if (!$serial_number) {
            return redirect()->back()->with('error', 'Serial number tidak ditemukan.');
        }

        // Cek apakah ada label yang cocok dengan serial_number yang diberikan
        $labels = Label::where('serial_number', $serial_number)->get();

        // Cek jika label ditemukan, jika tidak, tampilkan pesan error
        if ($labels->isEmpty()) {
            return redirect()->back()->with('error', 'Label dengan serial number tersebut tidak ditemukan.');
        }

        // Misalnya, ambil lot berdasarkan kriteria lain (contohnya berdasarkan ID atau criteria lain)
        // Jika Anda ingin mengambil berdasarkan ID atau kriteria lainnya
        $lot = Lot::findOrFail(1); // Misal mengambil Lot dengan ID 1
        // Atau bisa juga dengan kriteria lain
        // $lot = Lot::where('lot_code', 'ABC123')->first();

        if (!$lot) {
            return redirect()->back()->with('error', 'Lot dengan kriteria tersebut tidak ditemukan.');
        }

        // Kirim data ke view
        return view('certificate', compact('labels', 'lot'));
    }
}

