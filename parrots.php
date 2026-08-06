<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- BirdBazaar | Categories Directory -->
<!DOCTYPE html>
<html class="light scroll-smooth" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Avian Categories Directory | BirdBazaar Premium Marketplace</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Custom CSS Styles -->
    <link href="styles.css" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-surface": "#121c2a",
                        "primary-fixed": "#c0edd4",
                        "primary": "#002d1d",
                        "background": "#f8f9ff",
                        "on-primary-container": "#85af99",
                        "outline": "#717973"
                    },
                    "spacing": {
                        "margin-desktop": "64px",
                        "container-max": "1280px"
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            display: inline-block;
            line-height: 1;
        }
    </style>
    <!-- Custom JavaScript App -->
    <script src="app.js" defer></script>
</head>
<body class="bg-background text-on-background dark:bg-on-background dark:text-inverse-on-surface font-body-md selection:bg-primary-fixed selection:text-on-primary-fixed custom-scrollbar">

<!-- Mobile Nav Drawer Backdrop -->
<div id="mob-nav-overlay" class="drawer-overlay" onclick="closeMobNav()"></div>
<!-- Mobile Nav Drawer -->
<nav id="mob-nav-drawer" class="mobile-nav-drawer flex flex-col">
    <div class="flex items-center justify-between px-6 py-5 border-b border-emerald-500/20">
        <img src="images/logo.png" alt="BirdBazaar Logo" class="h-16 w-auto object-contain cursor-pointer" onclick="window.location.href='index.php'" />
        <button onclick="closeMobNav()" class="text-white"><span class="material-symbols-outlined">close</span></button>
    </div>
    <div class="flex flex-col gap-1 px-4 py-6">
        <a href="index.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">home</span>Home</a>
        <a href="parrots.php" class="text-white font-semibold px-4 py-3 rounded-xl bg-emerald-700/30 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">menu_book</span>Categories</a>
        <a href="marketplace.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">storefront</span>Marketplace</a>
        <a href="feedback.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">forum</span>Community & Feedback</a>
        <a href="user-dashboard.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">dashboard</span>My Dashboard</a>
    </div>
</nav>
<script>
    function openMobNav() {
        document.getElementById('mob-nav-drawer').classList.add('open');
        document.getElementById('mob-nav-overlay').classList.add('active');
    }
    function closeMobNav() {
        document.getElementById('mob-nav-drawer').classList.remove('open');
        document.getElementById('mob-nav-overlay').classList.remove('active');
    }
</script>

<!-- Top Navigation Bar -->
<header class="sticky top-0 z-50 flex justify-between items-center px-4 sm:px-6 md:px-margin-desktop py-4 w-full max-w-container-max mx-auto bg-surface/80 dark:bg-on-surface/80 backdrop-blur-md shadow-md border-b border-white/40">
    <div class="flex items-center gap-3">
        <img src="images/logo.png" alt="BirdBazaar Logo" class="h-16 sm:h-20 w-auto object-contain cursor-pointer" onclick="window.location.href='index.php'" />
        <nav class="hidden md:flex items-center gap-8 font-label-md">
            <a class="text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors font-body-md text-body-md" href="index.php">Home</a>
            <a class="text-primary dark:text-primary-fixed font-bold border-b-2 border-primary dark:border-primary-fixed pb-1 font-body-md text-body-md" href="parrots.php">Categories</a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors font-body-md text-body-md" href="marketplace.php">Marketplace</a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors font-body-md text-body-md" href="feedback.php">Feedback</a>
        </nav>
    </div>
    <div class="flex items-center gap-2 md:gap-4">
        <div class="hidden lg:flex items-center bg-surface-container-low dark:bg-on-surface/40 px-4 py-2 rounded-full border border-outline-variant/30">
            <span class="material-symbols-outlined text-on-surface-variant mr-2">search</span>
            <input id="global-search-input" class="bg-transparent border-none focus:ring-0 text-label-md" placeholder="Search species..." type="text"/>
        </div>
        <button id="lang-toggle-btn" class="text-primary dark:text-emerald-300 font-label-md bg-primary/10 dark:bg-emerald-500/20 border border-primary/30 dark:border-emerald-500/30 px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1 hover:bg-primary/20 transition-colors">
            <span class="material-symbols-outlined text-sm">language</span>
            <span class="hidden sm:inline">Urdu</span>
        </button>
        <div id="header-auth-container" class="flex items-center gap-2"></div>
        <!-- Hamburger Button (mobile only) -->
        <button onclick="openMobNav()" class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-primary/10 text-primary dark:text-emerald-300">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>

<main class="max-w-container-max mx-auto px-3 sm:px-6 md:px-margin-desktop py-6 sm:py-8 animate-fade-in w-full overflow-hidden">
    
    <!-- Hero Glassmorphic Header -->
    <div class="mb-8 sm:mb-10 relative rounded-2xl sm:rounded-3xl p-4 sm:p-8 md:p-12 glass-card-dark text-white shadow-2xl overflow-hidden w-full max-w-full">
        <div class="relative z-10">
            <span class="inline-flex items-center gap-2 bg-emerald-500/20 text-emerald-300 font-bold text-xs px-3 py-1.5 rounded-full mb-3 sm:mb-4 border border-emerald-400/40 backdrop-blur-md max-w-full">
                <span class="pulse-dot flex-shrink-0"></span>
                <span class="material-symbols-outlined text-sm text-emerald-400 flex-shrink-0">menu_book</span>
                <span class="truncate">Verified Avian Species &amp; Care Encyclopedia</span>
            </span>
            <h2 id="category-page-title" class="font-display-lg text-xl sm:text-3xl md:text-5xl font-extrabold mb-3 sm:mb-4 text-white tracking-tight leading-tight">
                Avian Species Directory
            </h2>
            <p id="category-page-desc" class="font-body-lg text-xs sm:text-sm md:text-base text-emerald-100/90 leading-relaxed font-normal mb-5 sm:mb-6 break-words">
                Explore Pakistan's most comprehensive bird encyclopedia. Filter by species, intelligence rating, noise level, and learn about care &amp; diet requirements before connecting with verified breeders.
            </p>
            
            <!-- Category Quick Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 border-t border-white/10 pt-5">
                <div class="flex items-center gap-3 bg-white/5 sm:bg-transparent p-2.5 sm:p-0 rounded-2xl border border-white/10 sm:border-none">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 flex-shrink-0">
                        <span class="material-symbols-outlined text-lg sm:text-xl">pets</span>
                    </div>
                    <div>
                        <div id="hero-stat-varieties" class="font-bold text-sm sm:text-lg text-white leading-tight">12+ Species</div>
                        <div class="text-xs text-emerald-200/70 leading-tight">Knowledge Catalog</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 bg-white/5 sm:bg-transparent p-2.5 sm:p-0 rounded-2xl border border-white/10 sm:border-none">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 flex-shrink-0">
                        <span class="material-symbols-outlined text-lg sm:text-xl">menu_book</span>
                    </div>
                    <div>
                        <div class="font-bold text-sm sm:text-lg text-white leading-tight">100% Free</div>
                        <div class="text-xs text-emerald-200/70 leading-tight">Care &amp; Health Guides</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 bg-white/5 sm:bg-transparent p-2.5 sm:p-0 rounded-2xl border border-white/10 sm:border-none">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 flex-shrink-0">
                        <span class="material-symbols-outlined text-lg sm:text-xl">verified_user</span>
                    </div>
                    <div>
                        <div class="font-bold text-sm sm:text-lg text-white leading-tight">Certified</div>
                        <div class="text-xs text-emerald-200/70 leading-tight">Breeder &amp; Vet Guidance</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Tabs Navigation Bar -->
    <div class="mb-8 sm:mb-10 w-full max-w-full overflow-x-auto pb-2 scrollbar-none">
        <div class="flex items-center gap-2 sm:gap-3 min-w-max px-1" id="category-tabs-container">
            <button data-cat="all" class="cat-tab-btn active">
                <span class="material-symbols-outlined text-lg">apps</span> All Species
            </button>
            <button data-cat="parrots" class="cat-tab-btn">
                <span class="material-symbols-outlined text-lg">flutter_dash</span> Parrots
            </button>
            <button data-cat="macaws" class="cat-tab-btn">
                <span class="material-symbols-outlined text-lg">pets</span> Macaws
            </button>
            <button data-cat="cockatiels" class="cat-tab-btn">
                <span class="material-symbols-outlined text-lg">music_note</span> Cockatiels
            </button>
            <button data-cat="budgies" class="cat-tab-btn">
                <span class="material-symbols-outlined text-lg">group</span> Budgies
            </button>
            <button data-cat="lovebirds" class="cat-tab-btn">
                <span class="material-symbols-outlined text-lg">favorite</span> Lovebirds
            </button>
            <button data-cat="canaries" class="cat-tab-btn">
                <span class="material-symbols-outlined text-lg">record_voice_over</span> Canaries
            </button>
            <button data-cat="finches" class="cat-tab-btn">
                <span class="material-symbols-outlined text-lg">park</span> Finches
            </button>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filter -->
        <aside class="w-full md:w-64 lg:w-72 flex-shrink-0">
            <!-- Mobile Filter Toggle Button -->
            <button id="toggle-mobile-filters-btn" onclick="const body=document.getElementById('filter-body-container'); const arrow=document.getElementById('filter-arrow'); body.classList.toggle('hidden'); arrow.classList.toggle('rotate-180');" class="w-full lg:hidden mb-4 p-3.5 bg-emerald-800 text-white rounded-2xl font-bold text-xs flex items-center justify-between shadow-md cursor-pointer">
                <span class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">tune</span>
                    <span>Filter & Search Options</span>
                </span>
                <span class="material-symbols-outlined text-base transition-transform duration-300" id="filter-arrow">expand_more</span>
            </button>

            <div id="filter-body-container" class="hidden lg:block sticky top-28 bg-white dark:bg-slate-800/80 p-5 sm:p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-headline-md text-lg font-bold text-primary dark:text-primary-fixed flex items-center gap-2">
                        <span class="material-symbols-outlined">tune</span> Filters
                    </h3>
                    <button id="clear-filters-btn" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 transition-colors cursor-pointer">Clear All</button>
                </div>
                
                <!-- Filter Groups -->
                <div class="space-y-6">
                    <!-- Intelligence -->
                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider block mb-3 text-slate-700 dark:text-slate-300">Intelligence Level</label>
                        <div class="space-y-2" id="filter-intelligence">
                            <label class="flex items-center gap-3 cursor-pointer group text-xs">
                                <input class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" type="checkbox" value="Genius Level"/>
                                <span class="text-slate-600 dark:text-slate-300 group-hover:text-emerald-600 transition-colors">🧠 Genius Level</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group text-xs">
                                <input class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" type="checkbox" value="Highly Social"/>
                                <span class="text-slate-600 dark:text-slate-300 group-hover:text-emerald-600 transition-colors">🗣️ Highly Social</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group text-xs">
                                <input class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" type="checkbox" value="Active Learner"/>
                                <span class="text-slate-600 dark:text-slate-300 group-hover:text-emerald-600 transition-colors">🎵 Active Learner</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Noise Level -->
                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider block mb-3 text-slate-700 dark:text-slate-300">Noise Level</label>
                        <select id="filter-noise" class="w-full rounded-xl border-slate-200 bg-slate-50 dark:bg-slate-700 text-xs p-2.5 text-slate-800 dark:text-slate-200 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            <option value="Any">Any Volume</option>
                            <option value="Quiet">Quiet (Apartment Friendly)</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Loud">Loud (Natural Callers)</option>
                        </select>
                    </div>
                    
                    <!-- Beginner Friendly -->
                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider block mb-3 text-slate-700 dark:text-slate-300">Beginner Friendly</label>
                        <div class="flex gap-2" id="filter-beginner">
                            <button data-val="all" class="flex-1 py-2 px-2 rounded-lg border border-emerald-600 bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 text-xs font-bold transition-all cursor-pointer">All</button>
                            <button data-val="yes" class="flex-1 py-2 px-2 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 text-xs transition-all cursor-pointer">Yes</button>
                            <button data-val="no" class="flex-1 py-2 px-2 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 text-xs transition-all cursor-pointer">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        
        <!-- Bird Listing Grid -->
        <div class="flex-1 min-w-0">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3 bg-white dark:bg-slate-800/60 p-4 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <span class="text-xs md:text-sm font-medium text-slate-600 dark:text-slate-300">
                    Showing <span id="results-count" class="font-bold text-emerald-600 dark:text-emerald-400 text-base">0</span> Species Varieties
                </span>
                <div class="flex items-center gap-2 w-full sm:w-auto justify-between sm:justify-end border-t sm:border-t-0 pt-2 sm:pt-0 border-slate-100 dark:border-slate-700">
                    <span class="text-xs text-slate-500 font-medium">Sort by:</span>
                    <select id="sort-selector" class="border-none bg-slate-100 dark:bg-slate-700 sm:bg-transparent font-bold text-xs text-emerald-700 dark:text-emerald-300 focus:ring-0 px-3 py-1.5 sm:p-0 rounded-lg cursor-pointer">
                        <option value="popularity">Popularity</option>
                        <option value="name">Name (A-Z)</option>
                    </select>
                </div>
            </div>
            
            <div id="birds-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Dynamic Species Cards -->
            </div>
            
            <!-- Pagination -->
            <div id="pagination-container" class="mt-12 flex justify-center gap-2">
                <!-- Pagination buttons -->
            </div>
        </div>
    </div>
</main>

<!-- Custom Species Care & Info Modal -->
<div id="species-care-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 modal-backdrop animate-fade-in">
    <div class="bg-white dark:bg-slate-800 w-full max-w-xl rounded-3xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-700 transform transition-all">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-emerald-800 to-teal-900 p-6 text-white relative">
            <button id="close-modal-btn" onclick="closeModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors cursor-pointer" title="Close Modal">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>
            <span id="modal-tag" class="bg-emerald-500/20 text-emerald-300 text-xs px-3 py-1 rounded-full font-bold border border-emerald-400/30 inline-block mb-2">Species Profile</span>
            <h3 id="modal-title" class="font-display-lg text-2xl font-bold">African Grey</h3>
            <p id="modal-sci" class="text-xs text-emerald-200/80 italic">Psittacus erithacus</p>
        </div>
        
        <!-- Modal Content Body -->
        <div class="p-6 space-y-6">
            <!-- Voice Listener Audio Bar (English + Urdu TTS) -->
            <div data-no-translate="true" class="bg-emerald-950/90 border border-emerald-500/30 p-3.5 rounded-2xl flex flex-wrap items-center justify-between gap-2 shadow-inner">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-400 text-lg">volume_up</span>
                    <span class="text-xs font-bold text-white">Audio Guide:</span>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="playModalSpeech('en')" class="bg-emerald-800 hover:bg-emerald-700 text-white font-bold text-xs px-3.5 py-1.5 rounded-xl border border-emerald-400/40 flex items-center gap-1.5 cursor-pointer transition-all">
                        <span>🔊 English Audio</span>
                    </button>
                    <button type="button" onclick="playModalSpeech('ur')" class="bg-teal-800 hover:bg-teal-700 text-white font-bold text-xs px-3.5 py-1.5 rounded-xl border border-teal-400/40 flex items-center gap-1.5 cursor-pointer transition-all">
                        <span>🔊 اردو Audio</span>
                    </button>
                    <button type="button" onclick="stopModalSpeech()" class="bg-red-900/80 hover:bg-red-800 text-white font-bold text-xs px-3 py-1.5 rounded-xl border border-red-500/40 flex items-center gap-1 cursor-pointer transition-all">
                        <span>⏹️ Stop</span>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 bg-slate-50 dark:bg-slate-700/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700 text-xs">
                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Origin / Native Habitat</span>
                    <span id="modal-origin" class="font-semibold text-slate-800 dark:text-slate-200">Central Africa</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Lifespan Expectancy</span>
                    <span id="modal-life" class="font-semibold text-slate-800 dark:text-slate-200">40-60 Years</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Intelligence Rating</span>
                    <span id="modal-intel" class="font-semibold text-emerald-600 dark:text-emerald-400">Genius Level</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Noise Volume</span>
                    <span id="modal-noise" class="font-bold text-slate-700 dark:text-slate-300">Quiet (Apartment Friendly)</span>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-xs uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Care, Housing & Diet Guide</h4>
                <p id="modal-care-text" class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Requires spacious flight cage, daily mental stimulation, puzzle toys, and high-protein pellet diet supplemented with fresh fruits and seeds.
                </p>
            </div>

            <!-- Modal Action Footer -->
            <div class="flex items-center gap-3 pt-2">
                <button id="modal-find-sellers-btn" class="flex-1 btn-emerald-glow py-3 rounded-xl font-bold text-xs flex items-center justify-center gap-1.5 shadow-md cursor-pointer">
                    <span>Find Sellers on Marketplace</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
                <button id="modal-close-secondary-btn" onclick="closeModal()" class="px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 transition-colors cursor-pointer">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Ultra-Modern Footer -->
<footer class="w-full bg-gradient-to-b from-slate-950 via-slate-900 to-emerald-950 text-white py-16 px-4 sm:px-6 md:px-margin-desktop border-t border-emerald-500/20 shadow-2xl mt-16">
    <div class="max-w-container-max mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Brand Column -->
        <div class="md:col-span-1">
            <div class="flex items-center gap-2 mb-6">
                <img src="images/logo.png" alt="BirdBazaar Logo" class="h-20 sm:h-24 w-auto object-contain cursor-pointer" onclick="window.location.href='index.php'" />
            </div>
            <p class="text-xs text-emerald-100/70 leading-relaxed mb-6 font-normal">
                Pakistan's premier digital sanctuary for bird lovers, species knowledge, health guidance, and safe aviary trading.
            </p>
            <div class="flex gap-3 text-xs text-emerald-300">
                <span class="bg-emerald-900/60 px-3 py-1 rounded-full border border-emerald-500/30 flex items-center gap-1 font-semibold">⚡ WhatsApp Support</span>
                <span class="bg-emerald-900/60 px-3 py-1 rounded-full border border-emerald-500/30 flex items-center gap-1 font-semibold">🛡️ Anti-Scam</span>
            </div>
        </div>

        <!-- Quick Links -->
        <div>
            <h5 class="text-emerald-400 font-bold text-sm mb-4 uppercase tracking-wider">Quick Links</h5>
            <ul class="space-y-3 text-xs">
                <li><a class="text-slate-300 hover:text-emerald-400 transition-colors flex items-center gap-1" href="index.php"><span class="material-symbols-outlined text-sm text-emerald-500">home</span> Home Sanctuary</a></li>
                <li><a class="text-slate-300 hover:text-emerald-400 transition-colors flex items-center gap-1" href="parrots.php"><span class="material-symbols-outlined text-sm text-emerald-500">menu_book</span> Species Guide</a></li>
                <li><a class="text-slate-300 hover:text-emerald-400 transition-colors flex items-center gap-1" href="marketplace.php"><span class="material-symbols-outlined text-sm text-emerald-500">storefront</span> Live Marketplace</a></li>
                <li><a class="text-slate-300 hover:text-emerald-400 transition-colors flex items-center gap-1" href="user-dashboard.php"><span class="material-symbols-outlined text-sm text-emerald-500">dashboard</span> User Dashboard</a></li>
            </ul>
        </div>

        <!-- Bird Categories -->
        <div>
            <h5 class="text-emerald-400 font-bold text-sm mb-4 uppercase tracking-wider">Bird Categories</h5>
            <ul class="space-y-3 text-xs">
                <li><a class="text-slate-300 hover:text-emerald-400 transition-colors" href="parrots.php?cat=parrots">Congo & Timneh Parrots</a></li>
                <li><a class="text-slate-300 hover:text-emerald-400 transition-colors" href="parrots.php?cat=macaws">Scarlet & Blue Macaws</a></li>
                <li><a class="text-slate-300 hover:text-emerald-400 transition-colors" href="parrots.php?cat=cockatiels">Whistle Cockatiels</a></li>
                <li><a class="text-slate-300 hover:text-emerald-400 transition-colors" href="parrots.php?cat=lovebirds">Opaline Lovebirds</a></li>
            </ul>
        </div>

        <!-- Interactive Newsletter -->
        <div>
            <h5 class="text-emerald-400 font-bold text-sm mb-4 uppercase tracking-wider">Join the Bazaar</h5>
            <p class="text-xs text-slate-300 mb-4 leading-relaxed">Subscribe for the latest bird care tips and market updates.</p>
            <form onsubmit="event.preventDefault(); if(window.showToast) window.showToast('🎉 Subscribed! You will receive bird care & market updates.'); this.reset();" class="space-y-2">
                <input class="w-full bg-slate-900 border border-emerald-500/30 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-400 focus:outline-none focus:border-emerald-400 transition-colors" placeholder="Your Email" type="email" required/>
                <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-xs py-2.5 rounded-xl shadow-md transition-all cursor-pointer">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    <!-- Copyright & Badges Bar -->
    <div class="max-w-container-max mx-auto mt-12 pt-6 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-400">
        <p>© 2026 BirdBazaar. Celebrating Avian Life.</p>
        <div class="flex items-center gap-6">
            <span class="flex items-center gap-1.5"><span class="text-emerald-400">⚡</span> WhatsApp Verified</span>
            <span class="flex items-center gap-1.5"><span class="text-emerald-400">🛡️</span> Escrow Fraud Protection</span>
            <span class="flex items-center gap-1.5"><span class="text-emerald-400">🇵🇰</span> Pakistan's #1 Avian Network</span>
        </div>
    </div>
</footer>

<script>
    // USD to PKR conversion rate constant
    const PKR_RATE = 280;

    const birdDataset = [
        { name: 'African Grey', sci: 'Psittacus erithacus', origin: 'Central Africa', life: '40-60 Years', price: 1500, volume: 'Quiet', friendly: true, intel: 'Genius Level', category: 'parrots', tag: 'Rare Genus', image: 'images/african_grey.png', care: 'Requires spacious flight cage, daily mental stimulation, puzzle toys, and high-protein pellet diet.' },
        { name: 'Scarlet Macaw', sci: 'Ara macao', origin: 'South America', life: '50-75 Years', price: 3200, volume: 'Loud', friendly: false, intel: 'Highly Social', category: 'macaws', tag: 'Featured', image: 'images/scarlet_macaw.png', care: 'Needs large aviary, sturdy chew toys, nuts, and extensive social interaction.' },
        { name: 'Sun Conure', sci: 'Aratinga solstitialis', origin: 'South America', life: '25-30 Years', price: 650, volume: 'Moderate', friendly: true, intel: 'Active Learner', category: 'parrots', tag: 'Aesthetic', image: 'images/sun_conure.png', care: 'Loves affection, climbing ropes, fresh fruits, and warm housing environments.' },
        { name: 'Eclectus Parrot', sci: 'Eclectus roratus', origin: 'Solomon Islands', life: '30-40 Years', price: 1800, volume: 'Quiet', friendly: true, intel: 'Highly Social', category: 'parrots', tag: 'Rare Genus', image: 'images/eclectus_parrot.png', care: 'High-fiber diet rich in fresh fruits, vegetables, and soft cooked grains.' },
        { name: 'Hyacinth Macaw', sci: 'Anodorhynchus hyacinthinus', origin: 'Brazil', life: '60 Years', price: 4800, volume: 'Loud', friendly: false, intel: 'Genius Level', category: 'macaws', tag: 'Featured', image: 'images/hyacinth_macaw.png', care: 'Requires custom extra-heavy steel aviary, macadamia nuts, and expert handling.' },
        { name: 'Cockatiel (Lutino)', sci: 'Nymphicus hollandicus', origin: 'Australia', life: '15-20 Years', price: 200, volume: 'Quiet', friendly: true, intel: 'Active Learner', category: 'cockatiels', tag: 'Best Seller', image: 'images/cockatiel.png', care: 'Gentle family companion, whistle-trained easily, enjoys seeds, leafy greens, and cuttlebone.' },
        { name: 'Budgerigar (Classic)', sci: 'Melopsittacus undulatus', origin: 'Australia', life: '5-10 Years', price: 80, volume: 'Quiet', friendly: true, intel: 'Active Learner', category: 'budgies', tag: 'Beginner Choice', image: 'images/budgie.png', care: 'Great apartment bird, loves mirrors, small swings, and seed mixtures.' },
        { name: 'Peach-faced Lovebird', sci: 'Agapornis roseicollis', origin: 'Southwest Africa', life: '12-15 Years', price: 180, volume: 'Moderate', friendly: true, intel: 'Highly Social', category: 'lovebirds', tag: 'Sweet Companion', image: 'images/lovebird.png', care: 'Very energetic, keeps close pair bond, enjoys paper shredding and foraging toys.' },
        { name: 'Fischer\'s Lovebird', sci: 'Agapornis fischeri', origin: 'East Africa', life: '12-15 Years', price: 220, volume: 'Moderate', friendly: true, intel: 'Active Learner', category: 'lovebirds', tag: 'Energetic', image: 'images/lovebird.png', care: 'Playful active bird, requires pair caging and mineral blocks for beak health.' },
        { name: 'Zebra Finch', sci: 'Taeniopygia guttata', origin: 'Australia', life: '5-8 Years', price: 40, volume: 'Quiet', friendly: true, intel: 'Active Learner', category: 'finches', tag: 'Best Seller', image: 'images/finch.png', care: 'Peaceful flocking bird, needs flight room, small seed blend, and water bath dish.' },
        { name: 'Gouldian Finch', sci: 'Erythrura gouldiae', origin: 'Australia', life: '6-8 Years', price: 150, volume: 'Quiet', friendly: true, intel: 'Active Learner', category: 'finches', tag: 'Rainbow Finch', image: 'images/finch.png', care: 'Vibrant rainbow feathers, warmth sensitive, requires clean flight cage and millets.' },
        { name: 'Red Factor Canary', sci: 'Serinus canaria', origin: 'Canary Islands', life: '10-12 Years', price: 160, volume: 'Quiet', friendly: true, intel: 'Active Learner', category: 'canaries', tag: 'Beautiful Voice', image: 'images/canary.png', care: 'Famed singing bird, requires carotenoid-rich diet for feather color preservation.' }
    ];

    let activeCategory = 'all';
    let currentFilters = {
        intel: [],
        noise: 'Any',
        beginner: 'all',
        maxPrice: 5000,
        searchQuery: ''
    };
    let currentPage = 1;
    const itemsPerPage = 6;
    let selectedBirdForModal = null;

    const categoryMap = {
        'all': { title: 'Avian Species Directory', desc: 'Browse all verified bird varieties available across Pakistan. Filter by species, price, or care level.' },
        'parrots': { title: 'Parrots Directory', desc: 'Explore Psittaciformes species. From intelligent African Greys to colorful Conures.' },
        'cockatiels': { title: 'Cockatiels Collection', desc: 'Affectionate, musical whistling companions ideal for families and apartments.' },
        'budgies': { title: 'Budgerigar Collection', desc: 'Playful, communicative small birds that are easy to care for and beginner friendly.' },
        'macaws': { title: 'Macaws Directory', desc: 'Spectacular long-tailed large parrots with giant sizes and stunning feather gradients.' },
        'lovebirds': { title: 'Lovebirds Sanctuary', desc: 'Energetic, affectionate, loyal birds known for their strong pair bonds.' },
        'finches': { title: 'Finches Directory', desc: 'Quiet, active flocking birds with soft beeps and rainbow feather patterns.' },
        'canaries': { title: 'Canaries Directory', desc: 'Famed sweet singing songbirds with vibrant yellow and orange colors.' }
    };

    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const catParam = urlParams.get('cat');
        if (catParam && categoryMap[catParam]) {
            activeCategory = catParam;
        }

        updateCategoryHeaderUI();
        setupTabsUI();
        setupEventListeners();
        renderGrid();
    });

    function updateCategoryHeaderUI() {
        const info = categoryMap[activeCategory] || categoryMap['all'];
        document.getElementById('category-page-title').textContent = info.title;
        document.getElementById('category-page-desc').textContent = info.desc;
    }

    function setupTabsUI() {
        const tabBtns = document.querySelectorAll('#category-tabs-container button');
        tabBtns.forEach(btn => {
            const cat = btn.getAttribute('data-cat');
            if (cat === activeCategory) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }

            btn.addEventListener('click', () => {
                tabBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeCategory = cat;
                updateCategoryHeaderUI();
                currentPage = 1;
                renderGrid();
            });
        });
    }

    function setupEventListeners() {
        const intelCheckboxes = document.querySelectorAll('#filter-intelligence input');
        intelCheckboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                currentFilters.intel = Array.from(intelCheckboxes).filter(c => c.checked).map(c => c.value);
                currentPage = 1;
                renderGrid();
            });
        });

        const noiseFilter = document.getElementById('filter-noise');
        if (noiseFilter) {
            noiseFilter.addEventListener('change', (e) => {
                currentFilters.noise = e.target.value;
                currentPage = 1;
                renderGrid();
            });
        }

        const beginnerBtns = document.querySelectorAll('#filter-beginner button');
        beginnerBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                beginnerBtns.forEach(b => {
                    b.className = 'flex-1 py-2 px-2 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 text-xs transition-all cursor-pointer';
                });
                btn.className = 'flex-1 py-2 px-2 rounded-lg border border-emerald-600 bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 text-xs font-bold transition-all cursor-pointer';
                currentFilters.beginner = btn.getAttribute('data-val');
                currentPage = 1;
                renderGrid();
            });
        });

        const searchInput = document.getElementById('global-search-input');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                currentFilters.searchQuery = e.target.value.toLowerCase().trim();
                currentPage = 1;
                renderGrid();
            });
        }

        const sortSelect = document.getElementById('sort-selector');
        if (sortSelect) {
            sortSelect.addEventListener('change', () => {
                renderGrid();
            });
        }

        const clearBtn = document.getElementById('clear-filters-btn');
        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                intelCheckboxes.forEach(cb => cb.checked = false);
                currentFilters.intel = [];
                if (noiseFilter) noiseFilter.value = 'Any';
                currentFilters.noise = 'Any';
                
                beginnerBtns.forEach(b => {
                    b.className = 'flex-1 py-2 px-2 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 text-xs transition-all cursor-pointer';
                });
                if (beginnerBtns[0]) beginnerBtns[0].className = 'flex-1 py-2 px-2 rounded-lg border border-emerald-600 bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 text-xs font-bold transition-all cursor-pointer';
                currentFilters.beginner = 'all';
                
                if (searchInput) searchInput.value = '';
                currentFilters.searchQuery = '';
                
                currentPage = 1;
                renderGrid();
            });
        }

        // Modal Action listeners
        const findSellersBtn = document.getElementById('modal-find-sellers-btn');
        if (findSellersBtn) {
            findSellersBtn.addEventListener('click', () => {
                if (selectedBirdForModal) {
                    window.location.href = `marketplace.php?q=${encodeURIComponent(selectedBirdForModal.name)}`;
                }
            });
        }

        // Backdrop click to close modal
        const modalBackdrop = document.getElementById('species-care-modal');
        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', (e) => {
                if (e.target === modalBackdrop) {
                    closeModal();
                }
            });
        }

        // Escape key to close modal
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    }

    window.openModal = function(bird) {
        selectedBirdForModal = bird;
        stopModalSpeech();
        
        document.getElementById('modal-title').textContent = bird.name;
        document.getElementById('modal-sci').textContent = bird.sci;
        document.getElementById('modal-origin').textContent = bird.origin;
        document.getElementById('modal-life').textContent = bird.life;
        document.getElementById('modal-intel').textContent = bird.intel;
        document.getElementById('modal-noise').textContent = bird.volume;
        document.getElementById('modal-tag').textContent = bird.tag || 'Species Overview';
        document.getElementById('modal-care-text').textContent = bird.care || 'Requires standard clean housing, daily fresh water, balanced seeds/pellets, and warm temperature control.';
        
        document.getElementById('species-care-modal').classList.remove('hidden');
    };

    window.closeModal = function() {
        stopModalSpeech();
        const modal = document.getElementById('species-care-modal');
        if (modal) modal.classList.add('hidden');
    };

    // Warm up speech synthesis voices on page load for Chrome/Windows
    if ('speechSynthesis' in window) {
        window.speechSynthesis.getVoices();
        if (window.speechSynthesis.onvoiceschanged !== undefined) {
            window.speechSynthesis.onvoiceschanged = () => {
                window.speechSynthesis.getVoices();
            };
        }
    }

    window.playModalSpeech = function(lang) {
        if (!selectedBirdForModal) return;
        if (!('speechSynthesis' in window)) {
            if (window.showToast) window.showToast('⚠️ Web Speech Audio not supported in this browser.', true);
            return;
        }

        window.speechSynthesis.cancel();
        if (window.speechSynthesis.paused) {
            window.speechSynthesis.resume();
        }

        const bird = selectedBirdForModal;
        
        const urduScriptNames = {
            'African Grey': 'افریقی گرے طوطا',
            'Scarlet Macaw': 'اسکارلیٹ مکاؤ',
            'Sun Conure': 'سن کونیور',
            'Eclectus Parrot': 'ایکلیٹس طوطا',
            'Hyacinth Macaw': 'ہائیسنتھ مکاؤ',
            'Cockatiel (Lutino)': 'کاکاٹیل',
            'Budgerigar (Classic)': 'بجی طوطا',
            'Peach-faced Lovebird': 'لو برڈ',
            'Fischer\'s Lovebird': 'فشر لو برڈ',
            'Zebra Finch': 'زیبرا فنچ',
            'Gouldian Finch': 'گولڈین فنچ',
            'Red Factor Canary': 'ریڈ فیکٹر کینیری'
        };

        const romanUrduCare = {
            'African Grey': 'Afriqi Grey toata. Asli watan: Central Africa. Umar: 40 se 60 saal. Dekh bhal: Bada pinjra, rozana zehni mashq, taza phal aur beej zaroori hain.',
            'Scarlet Macaw': 'Scarlet Macaw. Asli watan: South America. Umar: 50 se 75 saal. Dekh bhal: Bada aviary, mazboot khilone aur meva zaad khurak zaroori hai.',
            'Sun Conure': 'Sun Conure toata. Asli watan: South America. Umar: 25 se 30 saal. Dekh bhal: Pyar, rassi par charhna aur garam mahool pasand karta hai.',
            'Eclectus Parrot': 'Eclectus toata. Asli watan: Solomon Islands. Umar: 30 se 40 saal. Dekh bhal: Taza sabziyan, phal aur narm khana pasand karta hai.',
            'Hyacinth Macaw': 'Hyacinth Macaw. Asli watan: Brazil. Umar: 60 saal. Dekh bhal: Khas mazboot steel aviary aur bada meva pasand karta hai.',
            'Cockatiel (Lutino)': 'Lutino Cockatiel. Asli watan: Australia. Umar: 15 se 20 saal. Dekh bhal: Seeti bajana pasand karta hai, sabziyan aur beej khata hai.',
            'Budgerigar (Classic)': 'Budgie toata. Asli watan: Australia. Umar: 5 se 10 saal. Dekh bhal: Chhota pinjra, jhoola aur beej pasand karta hai.',
            'Peach-faced Lovebird': 'Peach-faced Lovebird. Asli watan: Southwest Africa. Umar: 12 se 15 saal. Dekh bhal: Bohat chust aur jodi mein rehna pasand karta hai.',
            'Fischer\'s Lovebird': 'Fischers Lovebird. Asli watan: East Africa. Umar: 12 se 15 saal. Dekh bhal: Khelna pasand karta hai aur mineral block zaroori hai.',
            'Zebra Finch': 'Zebra Finch perinda. Asli watan: Australia. Umar: 5 se 8 saal. Dekh bhal: Udne ki jagah, pani ka bartan aur chhota beej zaroori hai.',
            'Gouldian Finch': 'Gouldian Finch perinda. Asli watan: Australia. Umar: 6 se 8 saal. Dekh bhal: Rang-biranga perinda, garam mahool aur safai zaroori hai.',
            'Red Factor Canary': 'Red Factor Canary songbird. Asli watan: Canary Islands. Umar: 10 se 12 saal. Dekh bhal: Surila gana gata hai aur khas rang-daar khurak zaroori hai.'
        };

        const voices = window.speechSynthesis.getVoices();
        const urVoice = voices.find(v => 
            v.lang.startsWith('ur') || 
            v.lang.startsWith('hi') || 
            v.name.includes('Urdu') || 
            v.name.includes('Hindi') || 
            v.lang.includes('hi-IN') || 
            v.lang.includes('ur-PK')
        );
        const engVoice = voices.find(v => v.lang.startsWith('en')) || voices[0];

        let text = "";
        if (lang === 'ur') {
            if (urVoice) {
                const nameUr = urduScriptNames[bird.name] || bird.name;
                text = `${nameUr}۔ اصل وطن ${bird.origin}۔ عمر ${bird.life}۔ دیکھ بھال: ${bird.care}`;
            } else {
                // Guaranteed Phonetic Roman Urdu reading for Windows PCs without Urdu TTS packs
                text = romanUrduCare[bird.name] || `${bird.name} toata. Asli watan: ${bird.origin}. Umar: ${bird.life}. Care guide: ${bird.care}`;
            }
        } else {
            text = `${bird.name}. Native origin: ${bird.origin}. Average lifespan: ${bird.life}. Care guide: ${bird.care}`;
        }

        const utterance = new SpeechSynthesisUtterance(text);

        if (lang === 'ur') {
            if (urVoice) {
                utterance.voice = urVoice;
                utterance.lang = urVoice.lang;
            } else {
                if (engVoice) utterance.voice = engVoice;
                utterance.lang = 'en-US'; // Bulletproof fallback for all Windows PCs
            }
        } else {
            if (engVoice) utterance.voice = engVoice;
            utterance.lang = 'en-US';
        }

        utterance.rate = 0.9; // Slightly slower for crisp clear speech
        utterance.pitch = 1.0;
        utterance.volume = 1.0;

        window.speechSynthesis.speak(utterance);
    };

    window.stopModalSpeech = function() {
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();
        }
    };

    function renderGrid() {
        let filtered = [...birdDataset];

        if (activeCategory !== 'all') {
            filtered = filtered.filter(b => b.category === activeCategory);
        }

        if (currentFilters.intel.length > 0) {
            filtered = filtered.filter(bird => currentFilters.intel.includes(bird.intel));
        }
        if (currentFilters.noise !== 'Any') {
            filtered = filtered.filter(bird => bird.volume === currentFilters.noise);
        }
        if (currentFilters.beginner !== 'all') {
            const expectFriendly = currentFilters.beginner === 'yes';
            filtered = filtered.filter(bird => bird.friendly === expectFriendly);
        }

        if (currentFilters.searchQuery) {
            filtered = filtered.filter(bird => 
                bird.name.toLowerCase().includes(currentFilters.searchQuery) ||
                bird.sci.toLowerCase().includes(currentFilters.searchQuery) ||
                bird.origin.toLowerCase().includes(currentFilters.searchQuery)
            );
        }

        processAndDisplayGrid(filtered);
    }

    function processAndDisplayGrid(filtered) {
        const grid = document.getElementById('birds-grid');
        grid.innerHTML = '';

        const sortVal = document.getElementById('sort-selector').value;
        if (sortVal === 'name') {
            filtered.sort((a, b) => a.name.localeCompare(b.name));
        }

        document.getElementById('results-count').textContent = filtered.length;
        document.getElementById('hero-stat-varieties').textContent = `${filtered.length} Varieties`;

        const totalItems = filtered.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;
        if (currentPage > totalPages) currentPage = totalPages;
        
        const startIdx = (currentPage - 1) * itemsPerPage;
        const paginatedData = filtered.slice(startIdx, startIdx + itemsPerPage);

        if (paginatedData.length === 0) {
            grid.innerHTML = `
                <div class="col-span-full py-16 text-center bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700">
                    <span class="material-symbols-outlined text-slate-400 text-6xl mb-3">search_off</span>
                    <h4 class="font-headline-md text-lg font-bold text-slate-800 dark:text-slate-200 mb-1">No Species Found</h4>
                    <p class="text-slate-500 text-xs max-w-sm mx-auto">Try clearing your filters or selecting another category tab above.</p>
                </div>
            `;
            renderPagination(totalPages);
            return;
        }

        paginatedData.forEach(bird => {
            const card = document.createElement('div');
            card.className = 'group bg-white dark:bg-slate-800/90 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between';
            
            card.innerHTML = `
                <div>
                    <div class="h-56 overflow-hidden relative bg-slate-100 dark:bg-slate-700">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-108" src="${bird.image}" alt="${bird.name}" />
                        
                        <div class="absolute top-3 left-3">
                            <span class="bg-slate-900/80 text-white backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold shadow-md border border-white/20">
                                ${bird.tag || 'Popular'}
                            </span>
                        </div>

                        <div class="absolute bottom-3 right-3 bg-emerald-900/90 text-emerald-200 backdrop-blur-md font-bold text-xs px-3 py-1 rounded-xl shadow-lg border border-emerald-400/30">
                            ${bird.friendly ? '⭐ Easy Care' : '⚠️ Expert Only'}
                        </div>
                    </div>

                    <div class="p-4 sm:p-5">
                        <h4 class="font-bold text-base sm:text-lg text-slate-900 dark:text-white mb-0.5 leading-snug truncate">${bird.name}</h4>
                        <p class="text-xs italic text-slate-400 mb-3 sm:mb-4 font-mono truncate">${bird.sci}</p>
                        
                        <div class="grid grid-cols-2 gap-2 mb-3 sm:mb-4 bg-slate-50 dark:bg-slate-700/40 p-2 sm:p-2.5 rounded-xl border border-slate-100 dark:border-slate-700 text-xs">
                            <div class="flex items-center gap-1.5 min-w-0">
                                <span class="material-symbols-outlined text-emerald-600 text-sm flex-shrink-0">public</span>
                                <div class="min-w-0 overflow-hidden">
                                    <span class="text-[9px] block uppercase text-slate-400 font-bold leading-tight">Origin</span>
                                    <span class="font-semibold text-slate-700 dark:text-slate-200 text-[10px] sm:text-[11px] truncate block leading-tight">${bird.origin}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 min-w-0">
                                <span class="material-symbols-outlined text-emerald-600 text-sm flex-shrink-0">timelapse</span>
                                <div class="min-w-0 overflow-hidden">
                                    <span class="text-[9px] block uppercase text-slate-400 font-bold leading-tight">Lifespan</span>
                                    <span class="font-semibold text-slate-700 dark:text-slate-200 text-[10px] sm:text-[11px] truncate block leading-tight">${bird.life}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-[11px] sm:text-xs text-slate-500 mb-2">
                            <span class="truncate">Intel: <strong class="text-emerald-600 dark:text-emerald-400 font-semibold">${bird.intel}</strong></span>
                            <span class="truncate">Noise: <strong class="text-slate-700 dark:text-slate-300">${bird.volume}</strong></span>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-5 pt-0 grid grid-cols-2 gap-2 w-full">
                    <button class="quick-care-btn py-2 sm:py-2.5 px-2 sm:px-3 rounded-xl border border-emerald-600 text-emerald-700 dark:border-emerald-400 dark:text-emerald-300 font-bold text-[11px] sm:text-xs hover:bg-emerald-50 dark:hover:bg-emerald-950 transition-colors flex items-center justify-center gap-1 cursor-pointer w-full whitespace-nowrap">
                        <span class="material-symbols-outlined text-sm sm:text-base flex-shrink-0">menu_book</span>
                        <span class="whitespace-nowrap">Care Guide</span>
                    </button>
                    <button onclick="window.location.href='marketplace.php?q=${encodeURIComponent(bird.name)}'" class="py-2 sm:py-2.5 px-2 sm:px-3 rounded-xl btn-emerald-glow text-white font-bold text-[11px] sm:text-xs flex items-center justify-center gap-1 cursor-pointer w-full whitespace-nowrap">
                        <span class="whitespace-nowrap">Find Sellers</span>
                        <span class="material-symbols-outlined text-sm sm:text-base flex-shrink-0">storefront</span>
                    </button>
                </div>
            `;

            // Attach modal listener to quick care button
            const careBtn = card.querySelector('.quick-care-btn');
            careBtn.addEventListener('click', () => openModal(bird));

            grid.appendChild(card);
        });

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        const pagContainer = document.getElementById('pagination-container');
        pagContainer.innerHTML = '';
        if (totalPages <= 1) return;

        const prevBtn = document.createElement('button');
        prevBtn.className = `w-9 h-9 rounded-xl flex items-center justify-center border border-slate-200 text-slate-600 hover:bg-emerald-600 hover:text-white transition-all ${currentPage === 1 ? 'opacity-50 cursor-not-allowed pointer-events-none' : ''}`;
        prevBtn.innerHTML = '<span class="material-symbols-outlined text-sm">chevron_left</span>';
        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderGrid();
                window.scrollTo({top: 250, behavior: 'smooth'});
            }
        });
        pagContainer.appendChild(prevBtn);

        for (let i = 1; i <= totalPages; i++) {
            const pageBtn = document.createElement('button');
            const isActive = i === currentPage;
            pageBtn.className = `w-9 h-9 rounded-xl flex items-center justify-center font-bold text-xs transition-all ${isActive ? 'bg-emerald-600 text-white shadow-md' : 'border border-slate-200 text-slate-600 hover:bg-slate-100'}`;
            pageBtn.textContent = i;
            pageBtn.addEventListener('click', () => {
                currentPage = i;
                renderGrid();
                window.scrollTo({top: 250, behavior: 'smooth'});
            });
            pagContainer.appendChild(pageBtn);
        }

        const nextBtn = document.createElement('button');
        nextBtn.className = `w-9 h-9 rounded-xl flex items-center justify-center border border-slate-200 text-slate-600 hover:bg-emerald-600 hover:text-white transition-all ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed pointer-events-none' : ''}`;
        nextBtn.innerHTML = '<span class="material-symbols-outlined text-sm">chevron_right</span>';
        nextBtn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderGrid();
                window.scrollTo({top: 250, behavior: 'smooth'});
            }
        });
        pagContainer.appendChild(nextBtn);
    }
</script>
</body>
</html>
