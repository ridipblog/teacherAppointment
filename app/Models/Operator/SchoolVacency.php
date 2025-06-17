<?php

namespace App\Models\Operator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolVacency extends Model
{
    use HasFactory;
    protected $table = 'school_vacency';

    protected $fillable = [
        'schoolCode',
        'schoolName',
        'district',
        'medium',
        'vacencyCategory',
        'actualVacency'
    ];

    public function current_vecancy(){
        return $this->hasOne(CurrentVacency::class,'schoolCode','id');
    }
}
