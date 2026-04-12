<x-guest-layout>
    <!-- Gère les messages de succès ou d'erreur automatique de Laravel -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Bon retour !</h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">Connectez-vous pour lire et gérer vos livres.</p>
        </div>

        <!-- Champ Email -->
        <div>
            <label for="email" class="block text-sm font-bold text-gray-700">Adresse E-mail</label>
            <div class="mt-2 relative">
                <input id="email" class="block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 bg-gray-50 focus:bg-white shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="exemple@adnanebooks.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-bold" />
        </div>

        <!-- Champ Mot de passe -->
        <div class="mt-5">
            <label for="password" class="block text-sm font-bold text-gray-700">Mot de Passe</label>
            <div class="mt-2 relative">
                <input id="password" class="block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 bg-gray-50 focus:bg-white shadow-sm" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-bold" />
        </div>

        <!-- Checkbox et lien "Mot de passe oublié" -->
        <div class="flex items-center justify-between mt-5">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-0 transition duration-200" name="remember">
                <span class="ms-3 text-sm text-gray-700 font-medium group-hover:text-blue-600 transition-colors">Se souvenir de moi</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <!-- Bouton Valider -->
        <div class="mt-8">
            <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-sm font-extrabold tracking-wide text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all hover:-translate-y-1">
                SE CONNECTER
            </button>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-sm font-medium text-gray-600 shadow-sm">Nouveau membre ? <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors border-b-2 border-transparent hover:border-blue-800 pb-1">Créer un compte</a></p>
        </div>
    </form>
</x-guest-layout>
