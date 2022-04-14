<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Montecarlo extends Model
{
    protected $table = "table_montecarlo";

    protected $fillable = [
        'bulan', 'nilai'
    ];
}
