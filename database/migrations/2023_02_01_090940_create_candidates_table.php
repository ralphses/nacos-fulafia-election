<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {

            $table->id();

            $table->string('fullname');
            $table->string('matric');
            $table->string('position');
            $table->string('level');
            $table->string('image_path');

            $table->boolean('active')->default(true);

            $table->unsignedInteger('total_votes')->default(0);

            $table->boolean('screened')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
