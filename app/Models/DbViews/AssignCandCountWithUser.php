<?php

namespace App\Models\DbViews;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCandCountWithUser extends Model
{
    use HasFactory;
    protected $table = 'assignCandCountWithUser';
    public $incrementing = false;
    protected $primaryKey = null;
    public $timestamps = false;
}
