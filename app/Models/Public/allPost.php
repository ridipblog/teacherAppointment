<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class allPost extends Model
{
    use HasFactory;

    protected $table='allpost';

    protected $fillable=[
        'name'
    ];
}
