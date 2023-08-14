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
        Schema::create('mobile_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('accountsl')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('account_type')->nullable();
            $table->string('signatory')->nullable();
            $table->string('nominee')->nullable();
            $table->string('holder_img')->nullable();
            $table->string('mobile')->nullable();
            $table->string('holder_address')->nullable();
            $table->integer('districtId')->nullable();
            $table->integer('divisionId')->nullable();
            $table->integer('countryId')->nullable();
            $table->decimal('pre_balance', 10, 2)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_accounts');
    }
};
