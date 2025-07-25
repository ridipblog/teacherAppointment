<?php

namespace App\Models\DbViews;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportRemainingVacancyPg extends Model
{
    use HasFactory;
    protected $table = 'report_remaining_vacancy_pg';
    public $incrementing = false;
    protected $primaryKey = null;
    public $timestamps = false;
}
