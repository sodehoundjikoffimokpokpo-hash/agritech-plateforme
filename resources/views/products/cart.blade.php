<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - AgriTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="container mx-auto px-4 py-12">
        <div class="flex items-center justify-between mb-10 border-b border-gray-200 pb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">🛒 Mon Panier</h1>
            <a href="{{ route('products.index') }}" class="text-green-600 hover:text-green-800 font-semibold flex items-center">
                ← Retour à la boutique
            </a>
        </div>

        @if(session('cart'))
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix Unitaire</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantité</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $totalGeneral = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $totalGeneral += $details['price'] * $details['quantity']; @endphp
                            <tr>
                                <td class="px-6 py-5 flex items-center gap-4">
                                    <div class="h-16 w-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($details['image'])
                                            <img src="{{ asset($details['image']) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="flex items-center justify-center h-full text-gray-400 text-xs">No image</div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $details['name'] }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-gray-600 font-medium">
                                    {{ number_format($details['price'], 0, ',', ' ') }} FCFA / {{ $details['unit'] }}
                                </td>
                                <td class="px-6 py-5 text-gray-900 font-semibold">
                                    {{ $details['quantity'] }}
                                </td>
                                <td class="px-6 py-5 text-green-700 font-bold">
                                    {{ number_format($details['price'] * $details['quantity'], 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="bg-gray-50 px-6 py-6 flex justify-between items-center border-t border-gray-100">
                    <span class="text-xl font-bold text-gray-900">Total de votre commande :</span>
                    <span class="text-3xl font-extrabold text-green-700">{{ number_format($totalGeneral, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>

            <form action="{{ route('cart.checkout') }}" method="GET">
    @csrf
    <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition duration-150 shadow-sm">
        Confirmer la commande
    </button>
</form>
        @else
            <div class="rounded-r-lg border-l-4 border-yellow-400 bg-yellow-50 p-6 shadow-sm">
                <p class="text-sm font-medium text-yellow-700">Votre panier est encore vide !</p>
            </div>
        @endif
    </div>

</body>
</html>
