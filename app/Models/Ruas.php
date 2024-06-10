<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruas extends Model
{
	use HasFactory;

	protected $table = 'ruas';
	protected $primaryKey = 'id';

    public function unit(): BelongsTo {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function coordinates(): HasMany {
        return $this->hasMany(RuasCoordinates::class, 'ruas_id');
    }
}
