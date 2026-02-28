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
        Schema::create('dettes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('depense_id')->constrained('depenses')->onDelete('cascade');
            $table->foreignId('colocation_user_id')->constrained('colocation_user')->onDelete('cascade');
            $table->float('montant');
            $table->dateTime('date_paiement')->nullable();
            $table->boolean('statut')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dettes');
    }
};
