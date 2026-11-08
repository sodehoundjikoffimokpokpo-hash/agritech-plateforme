<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Affiche la liste des produits disponibles.
     */
    public function index()
    {
        // On récupère tous les produits de la base de données
        $products = Product::all();

        // On retourne une vue (qu'on va créer juste après !) en lui passant les produits
        return view('products.index', compact('products'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Enregistre le produit dans la base de données.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'price_per_unit' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);

        $validatedData['user_id'] = auth()->id();

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $validatedData['image'] = 'images/products/'.$imageName;
        }

        Product::create($validatedData);

        return redirect()->route('products.index');
    }

    /**
     * Ajoute un produit au panier en session.
     */
    public function addToCart(Request $request, $id)
    {
        // On cherche le produit
        $product = Product::findOrFail($id);

        // On récupère le panier actuel en session (ou un tableau vide s'il n'existe pas)
        $cart = session()->get('cart', []);

        // Si le produit est déjà dans le panier, on augmente la quantité
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Sinon on ajoute le produit au panier avec une quantité de 1
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price_per_unit,
                "image" => $product->image,
                "unit" => $product->unit
            ];
        }

        // On sauvegarde le panier mis à jour dans la session
        session()->put('cart', $cart);

        // On redirige vers la boutique avec un message de succès
        return redirect()->route('products.index')->with('success', 'Produit ajouté au panier !');
    }

    /**
     * Affiche le contenu du panier.
     */
    public function showCart()
    {
        return view('products.cart');
    }

    /**
     * Affiche le tableau de bord de l'agriculteur avec SES produits.
     */
    public function dashboard()
    {
        // On récupère uniquement les produits de l'utilisateur connecté
        $myProducts = Product::where('user_id', auth()->id())->get();

        // On calcule rapidement quelques statistiques
        $totalProducts = $myProducts->count();
        $totalStock = $myProducts->sum('quantity');

        return view('dashboard', compact('myProducts', 'totalProducts', 'totalStock'));
    }

    /**
     * Supprime un produit de la base de données.
     */
    public function destroy($id)
    {
        // 1. On cherche le produit avec son ID
        $product = Product::findOrFail($id);

        // 2. SÉCURITÉ : On vérifie que le produit appartient bien à l'utilisateur connecté
        if ($product->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée !');
        }

        // 3. On supprime l'image du serveur si elle existe pour ne pas encombrer le disque
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // 4. On supprime le produit de la base de données
        $product->delete();

        // 5. On redirige vers le dashboard avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Votre récolte a bien été retirée.');
    }

    /**
     * Affiche le formulaire de modification d'un produit.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // Sécurité : on vérifie que le produit appartient bien à l'utilisateur
        if ($product->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée !');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Enregistre les modifications dans la base de données.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Sécurité
        if ($product->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Action non autorisée !');
        }

        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_unit' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion de la nouvelle image si elle est téléchargée
        if ($request->hasFile('image')) {
            // On supprime l'ancienne image du serveur pour pas saturer
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/produits'), $imageName);
            $validatedData['image'] = 'images/produits/' . $imageName;
        }

        // Mise à jour magique !
        $product->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Votre récolte a bien été mise à jour !');
    }

    /**
     * Affiche la page de caisse pour le paiement.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Votre panier est vide.');
        }

        return view('products.checkout', compact('cart'));
    }

    /**
     * Simule le traitement du paiement.
     */
    public function processPayment(Request $request)
    {
        // On valide que le client a bien rempli ses infos de livraison/paiement
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string',
            'moyen_paiement' => 'required|string',
        ]);

        // --- ICI : Simulation de la transaction ---
        // Dans la vraie vie, on enverrait les données à l'API de Fedapay ou CinetPay ici.

        // Le paiement est "accepté", on vide le panier de la session
        session()->forget('cart');

        // On redirige vers la page de succès
        return redirect()->route('cart.success');
    }

    /**
     * Affiche la page de succès après commande et paiement.
     */
    public function success()
    {
        return view('products.success');
    }
}
