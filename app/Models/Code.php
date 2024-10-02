<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    protected $table = 'codes';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id', 'user_id', 'lot_id', 'token', 'link', 'serial_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }
}
