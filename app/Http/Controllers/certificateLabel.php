<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Lot;
use App\Models\code;
use Illuminate\Http\Request;

class certificateLabel extends Controller
{

    public function certificate(Request $request)
    {
        // Ambil parameter token dan serial_number dari query string
        $token = $request->input('token');
        $serial_number = $request->input('serial_number');

        // Validasi jika token dan serial_number ada
        if (!$token || !$serial_number) {
            return redirect()->back()->with('error', 'Token atau Serial number tidak ditemukan.');
        }

        // Cari data token dan serial_number di tabel 'codes'
        $code = Code::where('serial_number', $serial_number)
                    ->where('token', $token)
                    ->first();

        // Cek jika data ditemukan
        if (!$code) {
            return redirect()->back()->with('error', 'Token dan serial number tersebut tidak ditemukan.');
        }

        // Ambil label yang cocok dengan serial_number yang diberikan
        $labels = Label::where('serial_number', $serial_number)->get();

        // Cek jika label ditemukan
        if ($labels->isEmpty()) {
            return redirect()->back()->with('error', 'Label dengan serial number tersebut tidak ditemukan.');
        }

        // Misalnya, ambil lot berdasarkan kriteria lain (contohnya berdasarkan ID atau criteria lain)
        $lot = Lot::findOrFail(1); // Misal mengambil Lot dengan ID 1
        // Atau bisa juga dengan kriteria lain
        // $lot = Lot::where('lot_code', 'ABC123')->first();

        if (!$lot) {
            return redirect()->back()->with('error', 'Lot dengan kriteria tersebut tidak ditemukan.');
        }

        // Kirim data ke view bersama dengan token
        return view('certificate', compact('labels', 'lot', 'token'));
    }


}

