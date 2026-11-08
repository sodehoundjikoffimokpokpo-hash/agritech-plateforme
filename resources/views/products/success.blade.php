<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande Confirmée - AgriTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="container mx-auto px-4 py-20 text-center">
        <div class="max-w-xl mx-auto bg-white p-10 rounded-2xl shadow-lg border border-gray-100">

            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-4xl mx-auto mb-6">
                ✓
            </div>

            <h1 class="text-3xl font-extrabold text-gray-900 mb-4">Commande validée !</h1>
            <p class="text-gray-600 mb-8">
                Merci pour votre achat sur AgriTech. Votre commande a bien été transmise aux producteurs concernés. Vous recevrez un récapitulatif sous peu.
            </p>

            <div class="flex flex-col gap-4">
                <a href="{{ route('products.index') }}" class="inline-block w-full bg-green-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-green-700 transition duration-150">
                    Continuer mes achats
                </a>
                <a href="/" class="text-sm text-gray-500 hover:text-gray-700 font-medium">
                    Retourner à l'accueil
                </a>
            </div>
        </div>
    </div>

</body>
</html>
