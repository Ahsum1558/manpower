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
        Schema::create('fieldars', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('license_ar');
            $table->text('description_ar')->nullable();
            $table->text('address_ar')->nullable();
            $table->string('proprietor_ar');
            $table->string('proprietortitle_ar')->nullable();
            $table->string('telephone_ar')->nullable();
            $table->string('cellphone_ar')->nullable();
            $table->string('helpline_ar')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fieldars');
    }
};
