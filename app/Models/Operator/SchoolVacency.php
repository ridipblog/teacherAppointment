<?php

namespace App\Models\Operator;

use App\Models\Public\allPost;
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
        'actualVacency',
        'postID',
      'isEnabled'
    ];

    public function current_vecancy()
    {
        return $this->hasOne(CurrentVacency::class, 'schoolCode', 'id');
    }

    public function vacency_details()
    {
        return $this->hasMany(VacencyDetails::class, 'schoolCode', 'id');
    }

    public function allpost()
    {
        return $this->belongsTo(allPost::class, 'postID');
    }
}
