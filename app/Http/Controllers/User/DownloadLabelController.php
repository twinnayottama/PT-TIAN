<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use App\Services\QrCodeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use ZipArchive;

class DownloadLabelController extends Controller
{
    protected $qrCodeService;
    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    public function download(string $id)
    {
        $lot = Lot::findOrFail($id);
        return view('user.lot.pdf.download', compact('lot'));
    }

    public function downloadPdf(Request $request, string $id)
    {
        // Increase memory limit and execution time for handling large data
        ini_set('memory_limit', '1024M'); // Increase if necessary
        ini_set('max_execution_time', '10000'); // 10 minutes

        $startSerialNumber = $request->input('start_serial_number');
        $endSerialNumber = $request->input('end_serial_number');

        $lot = Lot::findOrFail($id);
        $groupedData = $lot->getMergedDataDownload($startSerialNumber, $endSerialNumber);

        // Check if data is empty
        if ($groupedData->isEmpty()) {
            return response()->json(['warning' => "Data yang akan download tidak ada"], 404);
        }

        // Convert the collection to an array
        $groupedDataArray = $groupedData->toArray();

        // Split groupedData into chunks of 500 items each
        $chunks = array_chunk($groupedDataArray, 500, true);

        $pdfFiles = [];
        foreach ($chunks as $index => $chunk) {
            // Generate QR codes for each item in the chunk
            foreach ($chunk as $serial_number => $data) {
                foreach ($data as $item) {
                    $link = $item->link;
                    $item->barcode_data_uri = $this->qrCodeService->generateQrcode($link);
                }
            }

            // Generate the PDF for the current chunk
            $pdf = Pdf::loadView('user.lot.pdf.index', [
                'lot' => $lot,
                'groupedData' => $chunk
            ])->setPaper('A3', 'landscape');

            // Save the PDF to a temporary file
            $fileName =  $startSerialNumber . " - " . $endSerialNumber . '.pdf';
            $pdf->save(storage_path('app/public/' . $fileName));
            $pdfFiles[] = storage_path('app/public/' . $fileName);
        }

        // Return the first PDF file for download
        return response()->download($pdfFiles[0])->deleteFileAfterSend(true);
    }
}
