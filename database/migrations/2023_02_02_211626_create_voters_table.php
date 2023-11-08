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
        Schema::create('voters', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('election_id');

            $table->string('matric');
            $table->string('name')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('voter_id')->nullable(true);

            $table->boolean('voted')->default(false);

            $table->foreign('election_id')->references('id')->on('elections')->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('voters');
    }
};
