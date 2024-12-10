<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lot extends Model
{
    use HasFactory;

    protected $table = 'lots';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'user_id', 'lot_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function label()
    {
        return $this->hasMany(Label::class);
    }

    public function firstLabel()
    {
        return $this->hasOne(Label::class)->orderBy('serial_number', 'asc');
    }

    public function lastLabel()
    {
        return $this->hasOne(Label::class)->orderBy('serial_number', 'desc');
    }

    public function code()
    {
        return $this->hasMany(Code::class);
    }

    public function firstCode()
    {
        return $this->hasOne(Code::class)->orderBy('serial_number', 'asc');
    }

    public function lastCode()
    {
        return $this->hasOne(Code::class)->orderBy('serial_number', 'desc');
    }


    public function getMergedData()
    {
        return DB::table('labels')
            ->join('codes', 'labels.serial_number', '=', 'codes.serial_number')
            ->where('labels.lot_id', $this->id)
            ->orderBy('labels.serial_number')
            ->select('labels.serial_number', 'labels.certificate_number', 'labels.varieties', 'codes.token')
            ->get();
    }

    public function getMergedDataDownload($startSerialNumber, $endSerialNumber)
    {
        return DB::table('labels')
            ->join('codes', 'labels.serial_number', '=', 'codes.serial_number')
            ->where('labels.lot_id', $this->id)
            ->orderBy('labels.serial_number')
            ->whereBetween('labels.serial_number', [$startSerialNumber, $endSerialNumber])
            ->get()
            ->groupBy('serial_number');
    }
}
