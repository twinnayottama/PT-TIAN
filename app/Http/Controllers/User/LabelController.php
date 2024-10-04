<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Imports\DataLabelImport;
use App\Models\Label;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LabelController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $lots = Lot::where('user_id', $userId)->withCount('label')->with(['firstLabel', 'lastLabel'])->get();
        return view('user.label.index', compact('lots'));
    }

    public function create()
    {
        return view('user.label.create');
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'certificate_number' => 'required|string',
                'file' => 'required|mimes:xlsx,xls,csv',
            ]);

            $userId = Auth::id();
            $certificateNumber = $request->input('certificate_number');

            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();

            $data = [
                'AP9' => $worksheet->getCell('AP9')->getValue(),
                'AZ9' => $worksheet->getCell('AZ9')->getValue(),
                'BB9' => $worksheet->getCell('BB9')->getValue(),
                'AQ9' => $worksheet->getCell('AQ9')->getValue(),
                'AV9' => $worksheet->getCell('AV9')->getValue(),
                'BC9' => $worksheet->getCell('BC9')->getValue(),
                'F9'  => $worksheet->getCell('F9')->getValue(),
                'G9'  => $worksheet->getCell('G9')->getValue(),
                'AR9' => $worksheet->getCell('AR9')->getValue(),
                'E9'  => $worksheet->getCell('E9')->getValue(),
                'AS9' => $worksheet->getCell('AS9')->getValue(),
                'AW9' => $worksheet->getCell('AW9')->getValue(),
                'AU9' => $worksheet->getCell('AU9')->getValue(),
                'BD9' => $worksheet->getCell('BD9')->getValue(),
                'BE9' => $worksheet->getCell('BE9')->getValue(),
                'BF9' => $worksheet->getCell('BF9')->getValue(),
                'BG9' => $worksheet->getCell('BG9')->getValue(),
                'BH9' => $worksheet->getCell('BH9')->getValue(),
                'BI9' => $worksheet->getCell('BI9')->getValue(),
            ];

            Excel::import(new DataLabelImport($userId, $certificateNumber, $data), $file);

            session()->flash('success', "Berhasil menambahkan data label");
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(Lot $lot)
    {
        $labels = Label::select('id', 'serial_number', 'seed_producers', 'seed_class', 'varieties')->where('lot_id', $lot->id)->get();
        return view('user.label.show', compact('lot', 'labels'));
    }

    public function destroy($lot_id)
    {
        try {
            $lot = Lot::findOrFail($lot_id);

            Label::where('lot_id', $lot->id)->delete();
            session()->flash('success', "Berhasil menghapus data");
        } catch (\Exception $e) {
            session()->flash('error', "Terdapat kesalahan" . $e->getMessage());
        }
        return redirect()->back();
    }
}
