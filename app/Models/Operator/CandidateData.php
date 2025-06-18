<?php

namespace App\Models\Operator;

use App\Models\Public\allPost;
use App\Models\Public\Posts;
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
        'isAllocated',
        'letterCode',
        'active'
    ];

    public function allpost()
    {
        return $this->belongsTo(allPost::class, 'post');
    }

    public function vacency_details(){
        return $this->belongsTo(VacencyDetails::class,'allocatedSchoolCode');
    }
}
