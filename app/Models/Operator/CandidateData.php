<?php

namespace App\Models\Operator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateData extends Model
{
    use HasFactory;
    protected $table = 'candidate_data';

    protected $fillable = [
        'rollNumber',
        'post',
        'name',
        'fatherName',
        'subject',
        'address',
        'district',
        'pinCode',
        'medium',
        'category',
        'allocatedSchoolCode',
        'generatedBy',
        'generatedOn',
        'isAllocated'
    ];
}
