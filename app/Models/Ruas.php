<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ruas extends Model
{
	use HasFactory;

	protected $table = 'ruas';
	protected $primaryKey = 'id';

    public function unit(): BelongsTo {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
