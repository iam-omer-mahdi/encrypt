<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sex',
        'age',
        'phone',
        'national_number',
        'state_id',
        'district',
        'joining_date',
        'qualification_id',
        'form_number',
    ];
}
