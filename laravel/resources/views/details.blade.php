<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2463eb",
                        "background-light": "#f6f6f8",
                        "background-dark": "#111621",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
<style>
    body { font-family: 'Inter', sans-serif; }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
<title>Book Details - ADNANE BOOKS</title>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">
<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 px-4 md:px-10 lg:px-40 py-3 bg-white dark:bg-slate-900">
<div class="flex items-center gap-8">
<a href="{{ url('/') }}" class="flex items-center gap-4 text-primary">
    <img alt="ADNANE BOOKS" class="h-10 w-auto" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCHaSfcSQzACpzRaM85jtiSCRc2YZlQQ9OyjG88BCQ5ZRkXGmMJ6p5sgW7qOfOSbNxOXlaN02z5vQUaNsva1DLs7kg8MgMhovhkKJQJcQRpKttceHtfdVsCU2spvQq58vpCHc4yf1rpvDePLbftu4871vWwSCUPgH38ziV8x27TpG0c3Cb_alPk9XYlJ0qI-qKLfmL-DyXCKCGXTDyr9snZhwNdFVPOIrXKkeppV89fFzJptxN652VAAHik8EXINBDVxoJIpWYlQ7_G"/>
    <span class="font-extrabold text-slate-900">ADNANE BOOKS</span>
</a>
<nav class="hidden md:flex items-center gap-9">
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="{{ url('/') }}">Home</a>
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('catalog') }}">Categories</a>
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="#">Deals</a>
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="#">My Library</a>
</nav>
</div>
<div class="flex flex-1 justify-end gap-4 md:gap-8">
<label class="hidden sm:flex flex-col min-w-40 !h-10 max-w-64">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full">
<div class="text-slate-400 flex border-none bg-slate-100 dark:bg-slate-800 items-center justify-center pl-4 rounded-l-lg">
<span class="material-symbols-outlined text-[20px]">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 border-none bg-slate-100 dark:bg-slate-800 focus:ring-0 text-slate-900 dark:text-slate-100 placeholder:text-slate-400 px-4 rounded-r-lg text-sm font-normal" placeholder="Search books..."/>
</div>
</label>
<div class="flex gap-2 items-center">
<button class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
<span class="material-symbols-outlined">shopping_cart</span>
</button>

@auth
    <a href="{{ url('/dashboard') }}" class="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
        Dashboard
    </a>
@else
    <a href="{{ route('login') }}" class="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
        Sign In
    </a>
@endauth
</div>
</div>
</header>

<main class="px-4 md:px-10 lg:px-40 py-8">
<nav class="flex flex-wrap gap-2 mb-8">
<a class="text-slate-500 dark:text-slate-400 text-sm font-medium hover:text-primary" href="{{ url('/') }}">Home</a>
<span class="text-slate-400 text-sm font-medium">/</span>
<a class="text-slate-500 dark:text-slate-400 text-sm font-medium hover:text-primary" href="{{ route('catalog') }}">Books</a>
<span class="text-slate-400 text-sm font-medium">/</span>
<span class="text-slate-900 dark:text-slate-100 text-sm font-semibold">Fiction Classics</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
<div class="lg:col-span-5 flex flex-col gap-4">
<div class="w-full aspect-[3/4] bg-slate-200 dark:bg-slate-800 rounded-xl overflow-hidden shadow-xl">
<img alt="The Great Gatsby Book Cover" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuATMn1hYDOwtmt59J8hTV_sSDhffyY2qJGV0myN3jvL-rE6DkmDYtiYdvudLfPwoHZm1o6xVEL69_4VboHvSZ42PNCiTWTHe0leIeU2UFxaQRmhZhm33kXKyxTzdPOAvQLJgbeUyUCV5_hEyXlevDpFT0Ap86sx1E0Ug7vFupg-wwpMGc3mMFhL0wyHop4cdGlDjuU2Tepc_0Pi2kyTIxV7Gubrcb10oeTyb9qO5KugzrWQSUZOrOkqeXTrp3_e5DbdATeI9w8E7JPd"/>
</div>
<div class="grid grid-cols-4 gap-4">
<div class="aspect-square bg-slate-200 dark:bg-slate-800 rounded-lg border-2 border-primary overflow-hidden">
<img alt="Thumbnail 1" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQIP0a8ltL8GeZxiH-AnH0SLFY-xHlhwMuqFxI-tb3Y4yBEeXpys_y9lwPpmcltpP6EULrc_QE7Y7VnmnojzGEh9n88ZJNn6LeZHG8HNsUybbaTs5POW5iGzI1Z-fkccD2Mc3dZmGcrjtVOapxbBp0-Y7r7w5keIac_MTVwNfWZlAYj15hU3C_m1sLGM5FKeXuvky3OsFQ_OyYC5EI2uM5gr06UbBTunjIuAAc3tpKiP9GWWqhA4kuBfI9fnkOJ80kvUqk3U-uIsM_"/>
</div>
<div class="aspect-square bg-slate-200 dark:bg-slate-800 rounded-lg overflow-hidden">
<img alt="Thumbnail 2" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9lHMwgJ179XKZNiqSbhUs_UK5eSaFrR937BVy5zrL9RYOmHse-5GJnd6iy7epKYnln_-jg0V1bl5D9JpfqTUar24J57IZltSBCybSY2jLdRzTBKcM82RgPEaYUlQBorQXdTtJBF-223wMY9rZOdfg5HLCBQl40Lb2xiufJ2fPP2fbrxSGZCIZfVXd0zroX99GnuO5BD6qAnOTJ1AwkOhMMS2E9vB89oR-Fb3vHdhejuL6O5rd049jR5k3gFtWoHxThFuk5dDNJcrB"/>
</div>
<div class="aspect-square bg-slate-200 dark:bg-slate-800 rounded-lg overflow-hidden">
<img alt="Thumbnail 3" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjGtZdUUbmi1EKEq-NcJL7y1-gPjbof-RVGuTYfBW9JeCeIHs5pIPJj3X5n1Bg4qMDVcr1LR7-8XVx3iho32erA9_1cSLENWUcqSTB_2Qwq9rowUazr3xQ7WGuXepBE8UYD5HNXvcyZjprOOpge46PO-pg4O1yDLnzGqn870hu9v6Mt_SoM6tHsKb7nVtXvWwQBueAy2GShVBDq4vQYuR9MAcYpCaaPlx9W6GIIUqFzdXXWwGrUi_TlgFOphRo0cEX31iUgH3gXpsl"/>
</div>
<div class="aspect-square bg-slate-200 dark:bg-slate-800 rounded-lg overflow-hidden flex items-center justify-center">
<span class="material-symbols-outlined text-slate-400">videocam</span>
</div>
</div>
</div>

<div class="lg:col-span-7 flex flex-col gap-6">
<div>
<div class="flex items-center gap-2 mb-2">
<span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider">In Stock</span>
<div class="flex items-center text-amber-400">
<span class="material-symbols-outlined !text-lg">star</span>
<span class="material-symbols-outlined !text-lg">star</span>
<span class="material-symbols-outlined !text-lg">star</span>
<span class="material-symbols-outlined !text-lg">star</span>
<span class="material-symbols-outlined !text-lg">star_half</span>
<span class="ml-1 text-slate-500 text-sm font-medium">4.8 (1.2k reviews)</span>
</div>
</div>
<h1 class="text-4xl font-bold text-slate-900 dark:text-slate-100 mb-2">The Great Gatsby</h1>
<p class="text-xl text-primary font-medium mb-6">by F. Scott Fitzgerald</p>
<div class="text-3xl font-bold text-slate-900 dark:text-slate-100 mb-6">$15.99</div>
<div class="space-y-4 mb-8">
<h3 class="font-bold text-slate-900 dark:text-slate-100">About this book</h3>
<p class="text-slate-600 dark:text-slate-400 leading-relaxed">
    A portrait of the Jazz Age in all of its decadence and excess, Gatsby captured the spirit of the author's generation and earned itself a permanent place in American mythology. The story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan is an exquisite craft of fiction and a touchstone of 20th-century literature.
</p>
</div>
<div class="grid grid-cols-2 gap-4 mb-8">
<div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
<p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase mb-1">Format</p>
<p class="text-slate-900 dark:text-slate-100 font-semibold">Hardcover</p>
</div>
<div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
<p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase mb-1">Language</p>
<p class="text-slate-900 dark:text-slate-100 font-semibold">English</p>
</div>
<div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
<p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase mb-1">Publisher</p>
<p class="text-slate-900 dark:text-slate-100 font-semibold">Scribner</p>
</div>
<div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
<p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase mb-1">Pages</p>
<p class="text-slate-900 dark:text-slate-100 font-semibold">180 Pages</p>
</div>
</div>
<div class="flex flex-col sm:flex-row gap-4">
<button class="flex-1 bg-primary text-white font-bold py-4 px-8 rounded-lg shadow-lg hover:bg-primary/90 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined">bolt</span>
Buy Now
</button>
<button class="flex-1 bg-white dark:bg-slate-800 border-2 border-primary text-primary font-bold py-4 px-8 rounded-lg hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined">shopping_bag</span>
Add to Cart
</button>
</div>
<div class="mt-6 flex items-center gap-6 text-slate-500 dark:text-slate-400 text-sm">
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-base">local_shipping</span>
Free delivery
</div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-base">verified_user</span>
1-year warranty
</div>
</div>
</div>
</div>
</div>

<div class="mt-20">
<div class="flex items-center justify-between mb-8">
<h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Related Books</h2>
<a class="text-primary font-semibold hover:underline flex items-center gap-1" href="{{ route('catalog') }}">
View All <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
<div class="group cursor-pointer">
<div class="aspect-[3/4] bg-slate-200 dark:bg-slate-800 rounded-lg mb-3 overflow-hidden shadow-sm group-hover:shadow-md transition-all">
<img alt="To Kill a Mockingbird" class="w-full h-full object-cover group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDuWEL1F9qy8dGPiQNw4RwE0Tus-R2iobKCMo5JGWlINuZiw4mLmX05v_sU6FVxP8Milod8xgHMBliLbAtTUYGsYKzy-IpnZFsD9mXkZJ0S0-m5tNC3aZsfjH8gB6bNO-cFbOu5iXgs8aoZ5HZaTejzEfrTznymbUFk9PhhnlEcQT8l87OSarvhUfkVuv7W8hvOcgDXdNzXetyPGgL1q9moDPWDACSpi1Xpzx3WgI5ikbYFdWuqXDbLcCgLM7BPeiW5IFp9nrZgKiOv"/>
</div>
<h3 class="font-bold text-slate-900 dark:text-slate-100 line-clamp-1 group-hover:text-primary transition-colors">To Kill a Mockingbird</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm">Harper Lee</p>
<p class="text-slate-900 dark:text-slate-100 font-bold mt-1">$12.50</p>
</div>
<div class="group cursor-pointer">
<div class="aspect-[3/4] bg-slate-200 dark:bg-slate-800 rounded-lg mb-3 overflow-hidden shadow-sm group-hover:shadow-md transition-all">
<img alt="1984" class="w-full h-full object-cover group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjkQPnz1mOMPNUEcyH7jsYzIdSqmswcp2mchmmdlbG8aezM3VItcsNL2b8sEzohO_n9cFCR3HK8j8BwQ4OB3tnTpcoj1dU4ZrCoGQ91DsoPyY3YaI4VqjAsh-QktQ1qHc3Gl8jyYBneuLhN9r77al6qwyXebl2Le_IEY2Lmi3vqBWM0W4mY5uL1Koj61PF1SvT4C9UHRzRmBm-eHtVY0t9vzzJFWw4AlYm1ULLFEiJjJNtdVqJWsPzurSp4e7vq20N3cHBG4q6psRb"/>
</div>
<h3 class="font-bold text-slate-900 dark:text-slate-100 line-clamp-1 group-hover:text-primary transition-colors">1984</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm">George Orwell</p>
<p class="text-slate-900 dark:text-slate-100 font-bold mt-1">$14.20</p>
</div>
<div class="group cursor-pointer">
<div class="aspect-[3/4] bg-slate-200 dark:bg-slate-800 rounded-lg mb-3 overflow-hidden shadow-sm group-hover:shadow-md transition-all">
<img alt="Pride and Prejudice" class="w-full h-full object-cover group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbTNfas6vxFAq_sDvKt2slj4LbtPgaB3xKnNIqBxWW4SX3juDOoO1TEe4GumAorDqBateMoBnvYjAJL9A4jKpRSxx4LzN2tjbc0Ji_k7D6tBR7WUmhI_cs_pX7ZKy9oOhYZB_f8iAeIEG_SpJYtmM6Voq0p-VRRN7O-ptpmXiH-3ilwEwvI3TrPEtFk-ozWmRshGZQ4LPlbSD3wycDf1gRB869rE0COJnt9GGi-VRo3OlvOQaLQBgh3luYSodJx68AZXn6FWpQ1oA3"/>
</div>
<h3 class="font-bold text-slate-900 dark:text-slate-100 line-clamp-1 group-hover:text-primary transition-colors">Pride and Prejudice</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm">Jane Austen</p>
<p class="text-slate-900 dark:text-slate-100 font-bold mt-1">$10.99</p>
</div>
</div>
</div>
</main>

<footer class="mt-20 py-12 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 md:px-10 lg:px-40">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
<div class="col-span-1 md:col-span-1">
<div class="flex items-center gap-4 text-primary mb-6">
<span class="font-extrabold text-slate-900">ADNANE BOOKS</span></div>
<p class="text-slate-500 dark:text-slate-400 text-sm">Premium bookstore providing classics and modern literature worldwide.</p>
</div>
<div>
<h4 class="font-bold text-slate-900 dark:text-slate-100 mb-6">Shop</h4>
<ul class="space-y-4 text-sm text-slate-500 dark:text-slate-400">
<li><a class="hover:text-primary" href="#">Best Sellers</a></li>
<li><a class="hover:text-primary" href="#">New Arrivals</a></li>
<li><a class="hover:text-primary" href="#">Special Offers</a></li>
</ul>
</div>
<div>
<h4 class="font-bold text-slate-900 dark:text-slate-100 mb-6">Support</h4>
<ul class="space-y-4 text-sm text-slate-500 dark:text-slate-400">
<li><a class="hover:text-primary" href="#">Shipping Policy</a></li>
<li><a class="hover:text-primary" href="#">Returns &amp; Refunds</a></li>
<li><a class="hover:text-primary" href="#">Contact Us</a></li>
</ul>
</div>
<div>
<h4 class="font-bold text-slate-900 dark:text-slate-100 mb-6">Newsletter</h4>
<div class="flex gap-2">
<input class="bg-slate-100 dark:bg-slate-800 border-none rounded-lg flex-1 px-4 py-2 text-sm focus:ring-primary" placeholder="Email address" type="email"/>
<button class="bg-primary text-white p-2 rounded-lg">
<span class="material-symbols-outlined">send</span>
</button>
</div>
</div>
</div>
<div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 text-center text-xs text-slate-500 dark:text-slate-400">
    © 2026 ADNANE BOOKS. All rights reserved.
</div>
</footer>
</div>
</div>
</body></html>
