<?php

namespace App\Models\DbViews;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSelectedCandidateUg extends Model
{
    use HasFactory;
    protected $table='report_selected_candidate_ug';
    public $incrementing = false;
    protected $primaryKey = null;
    public $timestamps = false;
}
