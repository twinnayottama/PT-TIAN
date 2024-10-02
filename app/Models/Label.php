<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $table = 'labels';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id', 'user_id', 'lot_id', 'certificate_number', 'seed_producers', 'address', 'seed_class', 'type_plant', 'varieties', 'registration_number', 'harvest_date', 'test_completion_date', 'end_distribution_date', 'serial_number', 'contents_packaging', 'water_content', 'pure_seeds', 'roomy_CVL', 'btl', 'seed_impurities', 'germination_power',
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
