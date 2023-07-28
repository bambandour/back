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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type_transfert',['depot','retrait','transfert_compte','transfert_code'])->nullable();
            $table->foreignId('source_compte_id')->constrained('comptes')->cascadeOnDelete()->nullable();
            $table->foreignId('destination_compte_id')->constrained('comptes')->cascadeOnDelete()->nullable();
            $table->float('montant');
            $table->dateTime('date');
            $table->integer('code')->unique()->nullable();
            $table->boolean('statut')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
