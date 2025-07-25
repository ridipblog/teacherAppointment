<?php

namespace App\Models\DbViews;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateMinData extends Model
{
    use HasFactory;
    protected $table='candidate_min_data';
    public $incrementing = false;
    protected $primaryKey = null;
    public $timestamps = false;
}
