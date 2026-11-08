<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit - AgriTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto px-4 py-8 max-w-lg">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-green-700">🚜 Ajouter une récolte</h1>
           <a href="{{ route('products.index') }}" class="text-green-600 hover:text-green-800 text-sm font-semibold">← Retour à la boutique</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nom du produit</label>
                    <input type="text" id="name" name="name" placeholder="Ex: Tomates, Maïs..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description (Optionnelle)</label>
                    <textarea id="description" name="description" rows="3" placeholder="Précisez la variété ou la qualité..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                </div>
                 <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Photo du produit (Optionnelle)</label>
    <input type="file" id="image" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
</div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">Quantité</label>
                        <input type="number" id="quantity" name="quantity" step="0.01" placeholder="Ex: 50" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="unit">Unité</label>
                        <select id="unit" name="unit" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="kg">Kilogrammes (kg)</option>
                            <option value="sacs">Sacs</option>
                            <option value="paniers">Paniers</option>
                            <option value="tonnes">Tonnes</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price_per_unit">Prix par unité (FCFA)</label>
                    <input type="number" id="price_per_unit" name="price_per_unit" step="0.01" placeholder="Ex: 500" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded-md hover:bg-green-700 transition duration-150">
                    Mettre en vente
                </button>
            </form>
        </div>
    </div>

</body>
</html>
