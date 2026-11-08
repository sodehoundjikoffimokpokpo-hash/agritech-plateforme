<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur AgriTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <span class="text-2xl font-extrabold text-green-700 tracking-tight">🌱 AgriTech</span>

            <div class="flex items-center gap-4 text-sm font-semibold">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-green-700 transition">Tableau de bord</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-700 transition">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-20 text-center">
        <div class="max-w-4xl mx-auto">
            <span class="text-green-600 font-bold uppercase tracking-wider text-sm">Le marché agricole du futur</span>
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 mt-3 mb-6 leading-tight">
                Connectez directement <span class="text-green-700">producteurs</span> et <span class="text-green-700">consommateurs</span>
            </h1>
            <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
                Une plateforme simple et moderne pour valoriser les récoltes locales et simplifier l'approvisionnement en produits frais.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">

                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 w-full max-w-sm hover:shadow-xl transition duration-300">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-700 text-2xl mb-4 mx-auto">🛒</div>
                    <h2 class="text-xl font-bold mb-2 text-gray-900">Je suis un acheteur</h2>
                    <p class="text-gray-500 text-sm mb-6">Je souhaite parcourir les produits frais disponibles et passer commande directement.</p>
                    <a href="{{ route('products.index') }}" class="inline-block w-full bg-green-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-green-700 transition duration-150">
                        Voir la boutique
                    </a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 w-full max-w-sm hover:shadow-xl transition duration-300">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 text-2xl mb-4 mx-auto">🚜</div>
                    <h2 class="text-xl font-bold mb-2 text-gray-900">Je suis un agriculteur</h2>
                    <p class="text-gray-500 text-sm mb-6">Je souhaite mettre en vente mes récoltes et gérer mes stocks en ligne.</p>

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-block w-full bg-gray-900 text-white font-semibold py-3 px-4 rounded-lg hover:bg-gray-800 transition duration-150">
                            Gérer mes produits
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-block w-full bg-gray-900 text-white font-semibold py-3 px-4 rounded-lg hover:bg-gray-800 transition duration-150">
                            Créer un compte
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </main>

    <footer class="text-center py-10 text-gray-500 text-sm border-t border-gray-100 bg-white mt-12">
        <p>&copy; 2026 AgriTech. Propulsé avec passion par les producteurs locaux.</p>
    </footer>

</body>
</html>
