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
        Schema::create('travel_setups', function (Blueprint $table) {
            $table->id();
            $table->integer('field_id');
            $table->string('footer_title')->nullable();
            $table->text('content')->nullable();
            $table->string('type')->nullable();
            $table->string('menu')->nullable();
            $table->string('contact_info')->nullable();
            $table->string('links')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_setups');
    }
};
