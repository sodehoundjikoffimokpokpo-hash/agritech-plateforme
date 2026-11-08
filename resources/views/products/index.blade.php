<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Produits - AgriTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Petite astuce CSS pour que toutes les cartes d'une ligne aient la même hauteur */
        .grid-stretch {
            display: grid;
        }
        .grid-stretch > div {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10 border-b border-gray-200 pb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                🌱 <span class="text-green-700">Produits disponibles</span> pour la vente
            </h1>
            <div class="flex items-center gap-4">
    <a href="{{ route('cart.show') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-900 border border-transparent rounded-lg font-semibold text-white hover:bg-gray-800 transition duration-150 ease-in-out shadow-sm text-sm relative">
        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        Mon Panier

        @if(session('cart') && count(session('cart')) > 0)
            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                {{ count(session('cart')) }}
            </span>
        @endif
    </a>
</div>
        </div>

        @if($products->isEmpty())
            <div class="rounded-r-lg border-l-4 border-yellow-400 bg-yellow-50 p-6 shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-yellow-700">Aucun produit n'est disponible pour le moment.</p>
                    </div>
                </div>
            </div>
        @else

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 grid-stretch">

                @foreach($products as $product)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100">

                        <div class="h-56 w-full bg-gray-100 flex items-center justify-center overflow-hidden group">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="flex flex-col items-center text-gray-400">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm font-medium">Pas d'image</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex-grow flex flex-col">
                            <h2 class="text-2xl font-bold text-gray-950 mb-1.5 truncate">{{ $product->name }}</h2>
                            <p class="text-gray-600 mb-5 text-sm line-clamp-2 flex-grow">{{ $product->description ?? 'Pas de description fournie.' }}</p>

                            <div class="border-t border-gray-100 pt-5 mt-auto">
                                <div class="flex items-end justify-between gap-4 mb-5">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-medium uppercase tracking-wider">Quantité</span>
                                        <strong class="text-xl font-semibold text-gray-900">{{ number_format($product->quantity, 0, ',', ' ') }} <span class="text-base font-normal text-gray-600">{{ $product->unit }}</span></strong>
                                    </div>
                                    <div class="text-right flex flex-col">
                                        <span class="text-xs text-gray-500 font-medium uppercase tracking-wider">Prix</span>
                                        <strong class="text-2xl font-extrabold text-green-700">{{ number_format($product->price_per_unit, 0, ',', ' ') }} FCFA <span class="text-base font-normal text-gray-600">/ {{ $product->unit }}</span></strong>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between gap-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 uppercase tracking-wider">
                                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                        {{ $product->status }}
                                    </span>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <button type="submit" class="flex-shrink-0 inline-flex items-center px-6 py-2.5 bg-gray-900 border border-transparent rounded-lg font-semibold text-white hover:bg-gray-800 transition duration-150 ease-in-out shadow-sm text-sm">
        Commander
    </button>
</form>
                                </div>
                            </div>
                        </div>

                    </div> @endforeach

            </div>

        @endif
    </div>

</body>
</html>
