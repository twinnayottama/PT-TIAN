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
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lot_id');

            $table->string('certificate_number');
            $table->string('seed_producers');
            $table->string('address');
            $table->string('seed_class');
            $table->string('type_plant');
            $table->string('varieties');
            $table->string('registration_number');
            $table->date('harvest_date');
            $table->date('test_completion_date');
            $table->date('end_distribution_date');
            $table->string('serial_number');
            $table->integer('contents_packaging');
            $table->decimal('water_content');
            $table->decimal('pure_seeds');
            $table->decimal('roomy_CVL');
            $table->decimal('btl');
            $table->decimal('seed_impurities');
            $table->integer('germination_power');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lot_id')->references('id')->on('lots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labels');
    }
};
