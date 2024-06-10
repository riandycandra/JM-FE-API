<?php

use App\Models\Ruas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ruas_coordinates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ruas::class)->references('id')->on('ruas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ordering');
            $table->string('coordinates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruas_coordinates');
    }
};
