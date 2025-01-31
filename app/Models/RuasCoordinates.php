<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuasCoordinates extends Model
{
    use HasFactory;

    protected $table = 'ruas_coordinates';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ordering',
        'coordinates'
    ];
}
