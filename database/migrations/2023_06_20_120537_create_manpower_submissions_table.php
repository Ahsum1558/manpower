<?php

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
        Schema::create('manpower_submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('fieldId')->nullable();
            $table->integer('fieldarId')->nullable();
            $table->integer('fieldbnId')->nullable();
            $table->string('manpowerDate')->nullable();
            $table->integer('userId')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manpower_submissions');
    }
};
