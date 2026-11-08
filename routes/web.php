<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController; // <-- Corrigé : Importation indispensable !
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes Publiques (Accessibles par tout le monde)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
Route::get('/panier', [ProductController::class, 'showCart'])->name('cart.show');
Route::post('/panier/ajouter/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
// Afficher la page de paiement/caisse
Route::get('/panier/caisse', [ProductController::class, 'checkout'])->name('cart.checkout');

// Traiter l'action de paiement
Route::post('/panier/payer', [ProductController::class, 'processPayment'])->name('cart.process');

// Page de succès
Route::get('/commande-confirmee', [ProductController::class, 'success'])->name('cart.success');


/*
|--------------------------------------------------------------------------
| Routes Privées (Réservées aux utilisateurs connectés)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [ProductController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    // Routes du profil utilisateur générées par Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour la gestion des produits par l'agriculteur
    Route::get('/produits/creer', [ProductController::class, 'create'])->name('products.create');
    Route::post('/produits', [ProductController::class, 'store'])->name('products.store');

    // --- NOUVELLE ROUTE ---
    // Route pour supprimer une récolte de la base de données
    Route::delete('/produits/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    // Routes pour modifier une récolte
    Route::get('/produits/{id}/modifier', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/produits/{id}', [ProductController::class, 'update'])->name('products.update');
});

// Chargement des routes d'authentification de Breeze (Login, Register, etc.)
require __DIR__.'/auth.php';
