<?php

use App\Models\Unit;
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
        Schema::create('ruas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Unit::class)->references('id')->on('unit')->onDelete('cascade')->onUpdate('cascade');
            $table->string('ruas_name');
            $table->integer('long');
            $table->string('km_awal');
            $table->string('km_akhir');
            $table->string('photo_url')->nullable();
            $table->string('doc_url')->nullable();
            $table->enum('status', ['0', '1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruas');
    }
};
