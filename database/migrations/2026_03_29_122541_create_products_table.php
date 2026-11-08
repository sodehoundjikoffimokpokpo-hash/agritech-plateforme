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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        // Clé étrangère pour lier le produit à un utilisateur (l'agriculteur)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('name'); // Nom du produit (ex: Tomates)
        $table->text('description')->nullable(); // Description
        $table->decimal('quantity', 10, 2); // Quantité disponible
        $table->string('unit'); // Unité (kg, sacs, etc.)
        $table->decimal('price_per_unit', 10, 2); // Prix par unité
        $table->string('status')->default('disponible'); // Statut
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
