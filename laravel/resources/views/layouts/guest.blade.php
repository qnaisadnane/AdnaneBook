<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Adnane Books') }}</title>

        <!-- Polices Modernes -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:500,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts Tailwind -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            h1, h2, h3 { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <!-- L'image de fond qui représente une bibliothèque magnifique -->
    <body class="font-sans text-gray-900 antialiased bg-[url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=2070')] bg-cover bg-center bg-fixed">
        
        <!-- Le filtre sombre sur l'image (Backdrop blur) -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900/60 backdrop-blur-sm">
            
            <!-- Ta Marque (Logo) avec un petit effet d'animation au survol -->
            <div class="mb-8 transform transition-all hover:scale-105 duration-500">
                <a href="/">
                    <h1 class="text-5xl font-extrabold text-white tracking-widest drop-shadow-2xl">ADNANE <span class="text-blue-400">BOOKS</span></h1>
                </a>
            </div>

            <!-- La boite de connexion "Verre dépoli" -->
            <div class="w-full sm:max-w-md px-10 py-12 bg-white/95 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-3xl border border-white/50 transition-all hover:shadow-blue-500/30">
                {{ $slot }}
            </div>
            
        </div>
    </body>
</html>
