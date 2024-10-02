<?php

namespace App\Imports;

use App\Models\Code;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CodeImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $userId;
    protected $lotId;

    public function __construct($userId, $lotId)
    {
        $this->userId = $userId;
        $this->lotId = $lotId;
    }

    public function collection(Collection $collection)
    {
        $index = 1;

        foreach ($collection as $row) {
            if ($index > 1) {
                $data['user_id'] = $this->userId;
                $data['lot_id'] = $this->lotId;
                $data['token'] = $row[1];
                $data['link'] = $row[2];
                $data['serial_number'] = $row[3];

                Code::create($data);
            }

            $index++;
        }
    }
}
