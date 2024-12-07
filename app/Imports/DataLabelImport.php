<?php

namespace App\Imports;

use App\Models\Label;
use App\Models\Lot;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataLabelImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $userId;
    protected $certificateNumber;
    protected $data;

    public function __construct($userId, $certificateNumber, $data)
    {
        $this->userId = $userId;
        $this->certificateNumber = $certificateNumber;
        $this->data = $data;
    }

    public function collection(Collection $rows)
    {
        // Konversi tanggal dari format Excel ke format MySQL
        $harvestDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->data['AP9']);
        $harvestDate = $harvestDate->format('Y-m-d');

        $testCompletionDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->data['AZ9']);
        $testCompletionDate = $testCompletionDate->format('Y-m-d');

        $endDistributionDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->data['BB9']);
        $endDistributionDate = $endDistributionDate->format('Y-m-d');

        $lot = Lot::where('lot_number', $this->data['AQ9'])->first();
        $lotId = $lot ? $lot->id : null;

        $total = $this->data['AV9'];
        $serialNumber = $this->data['BC9'];

        $labels = [];
        for ($i = 0; $i < $total; $i++) {
            $labels[] = new Label([
                'user_id' => $this->userId,
                'lot_id' => $lotId,
                'certificate_number' => $this->certificateNumber,
                'seed_producers' => $this->data['F9'],
                'address' => $this->data['G9'],
                'seed_class' => $this->data['AR9'],
                'type_plant' => $this->data['E9'],
                'varieties' => $this->data['AS9'],
                'registration_number' => $this->data['AW9'],
                'harvest_date' => $harvestDate,
                'test_completion_date' => $testCompletionDate,
                'end_distribution_date' => $endDistributionDate,
                'serial_number' => $serialNumber,
                'contents_packaging' => $this->data['AU9'],
                'water_content' => $this->data['BD9'],
                'pure_seeds' => $this->data['BE9'],
                'roomy_CVL' => $this->data['BF9'],
                'btl' => $this->data['BG9'],
                'seed_impurities' => $this->data['BH9'],
                'germination_power' => $this->data['BI9'],
                'code_area' => $this->data['BN9'],
                'no_area' => $this->data['BO9'],
            ]);
            $serialNumber++; // Increment serial number for the next label
        }

        foreach ($labels as $label) {
            $label->save();
        }
    }
}
