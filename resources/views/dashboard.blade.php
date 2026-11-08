<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tableau de bord Agriculteur') }}
            </h2>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-white hover:bg-green-700 transition duration-150 ease-in-out text-sm shadow-sm">
                + Ajouter un produit
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Mes produits en ligne</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalProducts }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Volume total en stock</div>
                    <div class="mt-2 text-3xl font-bold text-green-700">{{ number_format($totalStock, 0, ',', ' ') }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Gestion de mes récoltes</h3>

                    @if($myProducts->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Vous n'avez pas encore mis de produit en vente.</p>
                            <a href="{{ route('products.create') }}" class="text-green-600 hover:text-green-700 font-semibold text-sm">Cliquez ici pour ajouter votre première récolte →</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 border-b border-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Produit</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Stock</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Prix unitaire</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Statut</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($myProducts as $product)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 flex items-center gap-4">
                                                <div class="h-10 w-10 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                                    @if($product->image)
                                                        <img src="{{ asset($product->image) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="flex items-center justify-center h-full text-gray-400 text-xs">No image</div>
                                                    @endif
                                                </div>
                                                <span class="font-semibold text-gray-900">{{ $product->name }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-gray-600 font-medium">
                                                {{ $product->quantity }} {{ $product->unit }}
                                            </td>
                                            <td class="px-6 py-4 text-gray-900 font-bold">
                                                {{ number_format($product->price_per_unit, 0, ',', ' ') }} FCFA
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 uppercase">
                                                    {{ $product->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right text-sm font-medium">
                                               <div class="flex items-center justify-end gap-3">
    <a href="{{ route('products.edit', $product->id) }}" class="text-green-600 hover:text-green-900 font-medium">Modifier</a>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Es-tu sûr de vouloir retirer ce produit de la vente ?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
            Supprimer
        </button>
    </form>
</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
