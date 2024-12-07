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

            $table->string('certificate_number')->nullable();
            $table->string('seed_producers')->nullable();
            $table->string('address')->nullable();
            $table->string('seed_class')->nullable();
            $table->string('type_plant')->nullable();
            $table->string('varieties')->nullable();
            $table->string('registration_number')->nullable();
            $table->date('harvest_date')->nullable();
            $table->date('test_completion_date')->nullable();
            $table->date('end_distribution_date')->nullable();
            $table->string('serial_number')->nullable();
            $table->integer('contents_packaging')->nullable();
            $table->decimal('water_content', 8, 2)->nullable();
            $table->decimal('pure_seeds', 8, 2)->nullable();
            $table->decimal('roomy_CVL', 8, 2)->nullable();
            $table->decimal('btl', 8, 2)->nullable();
            $table->decimal('seed_impurities', 8, 2)->nullable();
            $table->integer('germination_power')->nullable();

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
