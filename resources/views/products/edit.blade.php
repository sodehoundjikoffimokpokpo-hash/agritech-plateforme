<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier ma récolte : {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nom du produit</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="w-full border-gray-200 rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea name="description" class="w-full border-gray-200 rounded-lg">{{ $product->description }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Quantité</label>
                            <input type="number" name="quantity" value="{{ $product->quantity }}" class="w-full border-gray-200 rounded-lg" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Unité (ex: kg, sacs...)</label>
                            <input type="text" name="unit" value="{{ $product->unit }}" class="w-full border-gray-200 rounded-lg" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Prix unitaire (FCFA)</label>
                        <input type="number" name="price_per_unit" value="{{ $product->price_per_unit }}" class="w-full border-gray-200 rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                        <select name="status" class="w-full border-gray-200 rounded-lg">
                            <option value="DISPONIBLE" {{ $product->status == 'DISPONIBLE' ? 'selected' : '' }}>DISPONIBLE</option>
                            <option value="ÉPUISÉ" {{ $product->status == 'ÉPUISÉ' ? 'selected' : '' }}>ÉPUISÉ</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Modifier l'image (optionnel)</label>
                        <input type="file" name="image" class="w-full text-gray-500">
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">Annuler</a>
                        <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-150">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
