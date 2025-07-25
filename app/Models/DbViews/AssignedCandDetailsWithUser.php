<?php

namespace App\Models\DbViews;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedCandDetailsWithUser extends Model
{
    use HasFactory;
    protected $table = 'AssignedCandDetailsWithUser';
    public $incrementing = false;
    protected $primaryKey = null;
    public $timestamps = false;
}
