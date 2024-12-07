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

    public function getLabelsData()
    {
        return DB::table('labels')
            ->where('lot_id', $this->id)
            ->orderBy('serial_number')
            ->select('serial_number', 'certificate_number', 'varieties')
            ->get();
    }

    public function getLabelsDataDownload($startSerialNumber, $endSerialNumber)
    {
        return DB::table('labels')
            ->where('lot_id', $this->id)
            ->whereBetween('serial_number', [$startSerialNumber, $endSerialNumber])
            ->orderBy('serial_number')
            ->get()
            ->groupBy('serial_number');
    }
}
