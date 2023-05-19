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
        Schema::create('fieldbns', function (Blueprint $table) {
            $table->id();
            $table->string('title_bn');
            $table->string('license_bn');
            $table->text('description_bn')->nullable();
            $table->text('address_bn')->nullable();
            $table->string('proprietor_bn');
            $table->string('proprietortitle_bn')->nullable();
            $table->string('telephone_bn')->nullable();
            $table->string('cellphone_bn')->nullable();
            $table->string('helpline_bn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fieldbns');
    }
};
