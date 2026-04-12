<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Créer un compte - Adnane Books</title>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-container": "#c9cffd",
                        "on-surface-variant": "#454652",
                        "background": "#fbf8ff",
                        "on-primary-container": "#cbcfff",
                        "tertiary-fixed": "#ffdcc6",
                        "on-error": "#ffffff",
                        "on-tertiary-fixed": "#301400",
                        "on-primary-fixed-variant": "#303c9a",
                        "secondary": "#565c84",
                        "surface-tint": "#4955b3",
                        "on-primary": "#ffffff",
                        "surface-dim": "#dbd9e2",
                        "primary-fixed-dim": "#bcc2ff",
                        "surface-container": "#efedf6",
                        "primary-container": "#4551af",
                        "on-primary-fixed": "#000c62",
                        "on-secondary-fixed-variant": "#3e446b",
                        "on-tertiary-container": "#ffc7a2",
                        "tertiary-fixed-dim": "#ffb784",
                        "secondary-fixed": "#dee0ff",
                        "inverse-primary": "#bcc2ff",
                        "on-secondary": "#ffffff",
                        "inverse-on-surface": "#f2eff9",
                        "on-secondary-container": "#51577f",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "on-background": "#1a1b22",
                        "surface-variant": "#e3e1ea",
                        "surface": "#fbf8ff",
                        "error-container": "#ffdad6",
                        "on-tertiary-fixed-variant": "#713700",
                        "outline-variant": "#c5c5d4",
                        "surface-container-high": "#e9e7f0",
                        "surface-container-low": "#f4f2fc",
                        "secondary-fixed-dim": "#bec4f2",
                        "outline": "#757684",
                        "inverse-surface": "#2f3037",
                        "error": "#ba1a1a",
                        "on-error-container": "#93000a",
                        "on-surface": "#1a1b22",
                        "on-secondary-fixed": "#12183d",
                        "primary": "#2b3896",
                        "surface-container-highest": "#e3e1ea",
                        "tertiary-container": "#8f4700",
                        "primary-fixed": "#dfe0ff",
                        "surface-bright": "#fbf8ff",
                        "tertiary": "#6c3400"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-panel {
            background: rgba(251, 248, 255, 0.7);
            backdrop-filter: blur(20px);
        }
        .ghost-border {
            border: 1px solid rgba(197, 197, 212, 0.15);
        }
        .air-shadow {
            box-shadow: 0 8px 64px rgba(26, 27, 34, 0.06);
        }
        .auth-gradient {
            background: linear-gradient(135deg, #2b3896 0%, #4551af 100%);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">
    <main class="min-h-screen flex items-center justify-center p-6 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=2070');">
        <!-- Optional Background blur overlay -->
        <div class="absolute inset-0 bg-surface/80 backdrop-blur-sm"></div>
        <div class="w-full max-w-md mx-auto relative z-10">
            <div class="bg-surface-container-lowest p-8 md:p-12 rounded-xl air-shadow ghost-border">
                
                <div class="mb-10 text-center">
                    <h2 class="text-3xl font-bold font-headline tracking-tight text-on-surface mb-2">Création de Compte</h2>
                    <p class="text-sm text-on-surface-variant">Entrez vos détails pour rejoindre la librairie.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Full Name -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold tracking-wide uppercase text-on-surface-variant ml-1" for="name">Nom Complet</label>
                        <input class="w-full px-4 py-3.5 rounded-xl bg-surface-container-low border-transparent focus:border-primary focus:ring-4 focus:ring-primary-fixed transition-all outline-none text-on-surface text-sm ghost-border" id="name" name="name" :value="old('name')" required autofocus placeholder="Entrez votre nom complet" type="text"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-error text-xs ml-1" />
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold tracking-wide uppercase text-on-surface-variant ml-1" for="email">Adresse E-mail</label>
                        <input class="w-full px-4 py-3.5 rounded-xl bg-surface-container-low border-transparent focus:border-primary focus:ring-4 focus:ring-primary-fixed transition-all outline-none text-on-surface text-sm ghost-border" id="email" name="email" :value="old('email')" required placeholder="exemple@adnanebooks.com" type="email"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-error text-xs ml-1" />
                    </div>

                    <!-- Password Fields Group -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-xs font-semibold tracking-wide uppercase text-on-surface-variant ml-1" for="password">Mot de passe</label>
                            <input class="w-full px-4 py-3.5 rounded-xl bg-surface-container-low border-transparent focus:border-primary focus:ring-4 focus:ring-primary-fixed transition-all outline-none text-on-surface text-sm ghost-border" id="password" name="password" required autocomplete="new-password" placeholder="••••••••" type="password"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-error text-xs ml-1" />
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-semibold tracking-wide uppercase text-on-surface-variant ml-1" for="password_confirmation">Confirmer</label>
                            <input class="w-full px-4 py-3.5 rounded-xl bg-surface-container-low border-transparent focus:border-primary focus:ring-4 focus:ring-primary-fixed transition-all outline-none text-on-surface text-sm ghost-border" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" type="password"/>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3 py-2">
                        <div class="flex items-center h-5">
                            <input class="h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary-fixed" id="terms" name="terms" required type="checkbox"/>
                        </div>
                        <label class="text-xs text-on-surface-variant leading-relaxed" for="terms">
                            J'accepte les <a class="text-primary font-medium hover:underline" href="#">Conditions de service</a>.
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button class="w-full py-4 rounded-xl auth-gradient text-on-primary font-bold text-sm tracking-wide shadow-lg hover:shadow-primary/20 hover:scale-[1.01] active:scale-[0.98] transition-all duration-200" type="submit">
                        Créer le compte
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div aria-hidden="true" class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant opacity-20"></div>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="mt-10 text-center">
                    <p class="text-sm text-on-surface-variant">
                        Vous avez déjà un compte ? 
                        <a class="text-primary font-bold hover:underline decoration-primary/30 transition-all" href="{{ route('login') }}">Se connecter</a>
                    </p>
                </div>
                
            </div>
        </div>
    </main>
</body>
</html>
