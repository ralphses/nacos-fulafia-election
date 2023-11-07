<?php

use App\Utils\Utility;
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
        Schema::create('elections', function (Blueprint $table) {

            $table->id();

            $table->string('title');
            $table->string('date');
            $table->string('start_time');
            $table->string('stop_time');
            $table->string('status')->default(Utility::ELECTION_STATUS['start']);

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
        Schema::dropIfExists('elections');
    }
};
