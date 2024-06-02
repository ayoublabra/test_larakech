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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('cle', 32);
            $table->string('email', 200);
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('telephone_fixe');
            $table->string('service');
            $table->string('fonction');
            $table->unsignedBigInteger('organisation_id')->nullable();
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->integer('active'); 	
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
