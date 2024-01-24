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
        Schema::create('covid', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id')->unsigned()->default(20);
            $table->date('date');
            $table->integer('Confirmed')->unsigned()->default(0);
            $table->integer('Deaths')->unsigned()->default(0);
            $table->integer('Recovered')->unsigned()->default(0);
            $table->integer('Active')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covid');
    }
};
