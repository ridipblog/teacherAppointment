<?php

namespace App\Models\Operator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacencyDetails extends Model
{
    use HasFactory;

    protected $table = 'vacency_details';

    protected $fillable = [
        'schoolCode',
        'post',
        'vacencyCode',
        'replcedPersion',
        'isAssined'
    ];

    public function school_vacency(){
        return $this->belongsTo(SchoolVacency::class,'schoolCode');
    }
}
