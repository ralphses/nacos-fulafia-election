<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'matric',
        'department',
        'position',
        'screened',
        'active',
        'total_votes',
        'level',
        'image_path'
    ];
}
