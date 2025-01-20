<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
	use HasFactory;

	protected $table = 'unit';
	protected $primaryKey = 'id';
    protected $fillable = [
        'unit',
        'status',
    ];

    public function ruas(): HasMany {
        return $this->hasMany(Ruas::class, 'unit_id');
    }
}
