<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement sécurisé - AgriTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-5xl mx-auto">

            <h1 class="text-3xl font-extrabold mb-8">Finaliser ma commande</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <form action="{{ route('cart.process') }}" method="POST">
                        @csrf

                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-6">
                            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                                <span class="text-green-600">1.</span> Vos informations
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet *</label>
                                    <input type="text" name="nom" class="w-full border-gray-200 rounded-lg focus:ring-green-500 focus:border-green-500" placeholder="Ex: Koffi Mokpokpo" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Numéro de téléphone *</label>
                                    <input type="tel" name="telephone" class="w-full border-gray-200 rounded-lg focus:ring-green-500 focus:border-green-500" placeholder="Ex: +228 90 00 00 00" required>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                                <span class="text-green-600">2.</span> Moyen de paiement
                            </h2>

                            <div class="space-y-3">
                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 border-gray-200">
                                    <input type="radio" name="moyen_paiement" value="mobile_money" class="text-green-600 focus:ring-green-500" checked>
                                    <div class="ml-4 flex-grow">
                                        <p class="font-bold text-gray-900">Mobile Money (T-Money / Flooz)</p>
                                        <p class="text-xs text-gray-500">Paiement instantané par téléphone</p>
                                    </div>
                                    <div class="text-2xl">📱</div>
                                </label>

                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 border-gray-200">
                                    <input type="radio" name="moyen_paiement" value="carte" class="text-green-600 focus:ring-green-500">
                                    <div class="ml-4 flex-grow">
                                        <p class="font-bold text-gray-900">Carte Bancaire</p>
                                        <p class="text-xs text-gray-500">Visa, Mastercard</p>
                                    </div>
                                    <div class="text-2xl">💳</div>
                                </label>
                            </div>

                            <button type="submit" class="mt-8 w-full bg-green-600 text-white font-bold py-4 px-4 rounded-xl hover:bg-green-700 transition duration-150 text-lg shadow-sm">
                                Payer et Confirmer
                            </button>
                            <p class="text-xs text-gray-400 text-center mt-3">🔒 Vos transactions sont sécurisées.</p>
                        </div>

                    </form>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-6">
                        <h2 class="text-xl font-bold mb-4">Résumé de la commande</h2>

                        <div class="divide-y divide-gray-100">
                            @php $totalGeneral = 0; @endphp
                            @foreach($cart as $id => $details)
                                @php $totalGeneral += $details['price'] * $details['quantity']; @endphp
                                <div class="py-3 flex justify-between items-center text-sm">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $details['name'] }}</p>
                                        <p class="text-gray-500">Qté: {{ $details['quantity'] }}</p>
                                    </div>
                                    <span class="font-bold text-gray-900">{{ number_format($details['price'] * $details['quantity'], 0, ',', ' ') }} FCFA</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-100 mt-4 pt-4 flex justify-between items-center">
                            <span class="text-base font-bold text-gray-900">Total à payer</span>
                            <span class="text-2xl font-extrabold text-green-700">{{ number_format($totalGeneral, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
