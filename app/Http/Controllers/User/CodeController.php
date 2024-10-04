<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Imports\CodeImport;
use App\Models\Code;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CodeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $lots = Lot::where('user_id', $userId)->withCount('code')->get();
        return view('user.code.index', compact('lots'));
    }

    public function create()
    {
        $lots = Lot::all();
        return view('user.code.create', compact('lots'));
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'lot_id' => 'required|exists:lots,id',
                'file' => 'required|mimes:xlsx,xls,csv',
            ]);

            $userId = Auth::id();
            $lotId = $request->input('lot_id');

            Excel::import(new CodeImport($userId, $lotId), $request->file('file'));

            session()->flash('success', 'Berhasil menambahkan Data QRCode');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(Lot $lot)
    {
        $codes = Code::select('id', 'token', 'serial_number')->where('lot_id', $lot->id)->get();
        return view('user.code.show', compact('lot', 'codes'));
    }

    public function destroy($lot_id)
    {
        try {
            $lot = Lot::findOrFail($lot_id);

            Code::where('lot_id', $lot->id)->delete();

        session()->flash('success', "Berhasil menghapus data QRCode");
        } catch (\Exception $e) {
            session()->flash('error', "Terdapat kesalahan" . $e->getMessage());
        }

        return redirect()->back();
    }
}
