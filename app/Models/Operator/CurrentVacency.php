<?php

namespace App\Models\Operator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentVacency extends Model
{
    use HasFactory;
    protected $table = 'current_vecancy';

    protected $fillable = [
        'schoolCode',
        'remaingVacency'
    ];

    public function school_vacency()
    {
        return $this->belongsTo(SchoolVacency::class, 'schoolCode');
    }
}
