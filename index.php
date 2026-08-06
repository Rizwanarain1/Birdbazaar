<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- BirdBazaar | Home -->
<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>BirdBazaar | Premium Avian Marketplace & Discovery</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Custom CSS Styles -->
    <link href="styles.css" rel="stylesheet" />

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
                        "on-tertiary-container": "#4e3e00",
                        "tertiary-container": "#cea700",
                        "surface-bright": "#f8f9ff",
                        "primary": "#002d1d",
                        "inverse-surface": "#27313f",
                        "secondary-fixed-dim": "#b7c9d5",
                        "surface-variant": "#d9e3f6",
                        "primary-container": "#1a4332",
                        "secondary-container": "#d3e5f1",
                        "surface-tint": "#3e6654",
                        "on-tertiary-fixed-variant": "#574500",
                        "background": "#f8f9ff",
                        "on-primary-container": "#85af99",
                        "outline": "#717973",
                        "surface-container": "#e6eeff",
                        "on-secondary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#50616b",
                        "on-primary-fixed": "#002114",
                        "on-secondary-container": "#566771",
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#d3e5f1",
                        "tertiary": "#735c00",
                        "surface-dim": "#d0dbed",
                        "tertiary-fixed-dim": "#eec200",
                        "primary-fixed-dim": "#a4d0b9",
                        "on-secondary-fixed": "#0c1e26",
                        "on-background": "#121c2a",
                        "on-primary-fixed-variant": "#264e3d",
                        "surface-container-low": "#eff4ff",
                        "surface-container-high": "#dee9fc",
                        "on-error": "#ffffff",
                        "on-secondary-fixed-variant": "#384953",
                        "inverse-primary": "#a4d0b9",
                        "tertiary-fixed": "#ffe083",
                        "inverse-on-surface": "#eaf1ff",
                        "on-surface-variant": "#414944",
                        "error": "#ba1a1a",
                        "outline-variant": "#c1c8c2",
                        "surface": "#f8f9ff",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "surface-container-highest": "#d9e3f6",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed": "#231b00"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-desktop": "64px",
                        "gutter": "24px",
                        "container-max": "1280px",
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "margin-mobile": "16px",
                        "unit": "8px",
                        "stack-sm": "8px",
                        "section-gap": "80px"
                    },
                    "fontFamily": {
                        "headline-md": ["Montserrat"],
                        "body-lg": ["Inter"],
                        "display-lg": ["Montserrat"],
                        "headline-lg": ["Montserrat"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-lg-mobile": ["Montserrat"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "headline-lg-mobile": ["28px", { "lineHeight": "36px", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            background-color: #f8f9ff;
        }
    </style>
    <!-- Custom JavaScript App -->
    <script src="app.js" defer></script>
</head>

<body class="font-body-md text-on-surface dark:bg-on-background dark:text-inverse-on-surface custom-scrollbar">
    <!-- Top Navigation Bar -->
    <!-- Mobile Nav Drawer Backdrop -->
    <div id="mob-nav-overlay" class="drawer-overlay" onclick="closeMobNav()"></div>
    <!-- Mobile Nav Drawer -->
    <nav id="mob-nav-drawer" class="mobile-nav-drawer flex flex-col">
        <div class="flex items-center justify-between px-6 py-5 border-b border-emerald-500/20">
            <div class="flex items-center gap-2.5">
                <img src="images/logo.png" alt="BirdBazaar Logo" class="w-16 h-16 object-contain" />
                <span class="text-xl font-bold text-white tracking-tight">BirdBazaar</span>
            </div>
            <button onclick="closeMobNav()" class="text-white"><span class="material-symbols-outlined">close</span></button>
        </div>
        <div class="flex flex-col gap-1 px-4 py-6">
            <a href="index.php" class="text-white font-semibold px-4 py-3 rounded-xl bg-emerald-700/30 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">home</span>Home</a>
            <a href="parrots.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">menu_book</span>Categories</a>
            <a href="marketplace.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">storefront</span>Marketplace</a>
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

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 flex justify-between items-center px-3 sm:px-6 md:px-margin-desktop py-3 sm:py-4 w-full max-w-container-max mx-auto bg-white/90 dark:bg-slate-900/90 backdrop-blur-md shadow-sm border-b border-slate-200 dark:border-slate-800">
        <div class="flex items-center gap-2.5 sm:gap-4 min-w-0">
            <!-- Logo -->
            <div onclick="window.location.href='index.php'" class="flex items-center gap-2.5 cursor-pointer flex-shrink-0">
                <img src="images/logo.png" alt="BirdBazaar Logo" class="w-16 h-16 sm:w-20 sm:h-20 object-contain" />
                <span class="font-display-lg text-lg sm:text-2xl font-bold text-primary dark:text-primary-fixed truncate max-w-[120px] sm:max-w-none tracking-tight">BirdBazaar</span>
            </div>
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="font-body-md text-body-md text-primary dark:text-primary-fixed font-bold border-b-2 border-primary dark:border-primary-fixed pb-1"
                href="index.php">Home</a>
            <a class="font-body-md text-body-md text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors"
                href="parrots.php">Categories</a>
            <a class="font-body-md text-body-md text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors"
                href="marketplace.php">Marketplace</a>
        </nav>
        <div class="flex items-center gap-2 md:gap-4">
            <button id="lang-toggle-btn"
                class="text-primary dark:text-emerald-300 font-label-md bg-primary/10 dark:bg-emerald-500/20 border border-primary/30 dark:border-emerald-500/30 px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1 hover:bg-primary/20 transition-colors">
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
    <main class="animate-fade-in">
        <!-- Hero Section (Pure Brand Showcase) -->
        <section class="relative w-full min-h-[500px] sm:min-h-[580px] md:min-h-[700px] py-10 sm:py-16 md:py-20 overflow-hidden flex items-center">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover" alt="Vibrant tropical parrots on branch"
                    src="images/hero_bg.png" />
                <div class="absolute inset-0 bg-gradient-to-r from-on-surface/90 via-on-surface/70 to-on-surface/40">
                </div>
            </div>
            <div class="relative z-10 px-4 sm:px-6 md:px-margin-desktop w-full max-w-container-max mx-auto">
                <div
                    class="glass-card-dark p-5 sm:p-8 md:p-12 rounded-3xl w-full max-w-2xl transform transition-all duration-500 hover:translate-y-[-2px] border border-white/10 shadow-2xl">
                    <span
                        class="inline-flex items-center gap-2 bg-emerald-500/20 text-emerald-300 font-bold text-xs px-3 py-1.5 rounded-full mb-4 border border-emerald-400/40 backdrop-blur-md max-w-full">
                        <span class="pulse-dot flex-shrink-0"></span>
                        <span class="material-symbols-outlined text-sm text-emerald-400 flex-shrink-0">verified</span>
                        <span class="truncate">Pakistan's #1 Avian Digital Sanctuary</span>
                    </span>

                    <h1
                        class="font-display-lg text-2xl sm:text-3xl md:text-5xl text-white mb-4 font-extrabold leading-tight tracking-tight">
                        Welcome to <span class="text-gradient-emerald">BirdBazaar</span>
                    </h1>

                    <p class="font-body-lg text-xs sm:text-sm md:text-base text-emerald-100/90 mb-6 font-normal leading-relaxed">
                        The ultimate digital home for bird lovers. Learn species health &amp; care guides, explore verified
                        aviaries, or buy &amp; sell birds safely with instant WhatsApp live video inspection.
                    </p>

                    <!-- Micro Trust Badges -->
                    <div
                        class="flex flex-wrap items-center gap-3 sm:gap-5 text-xs text-emerald-200/80 mb-6 border-t border-white/10 pt-4">
                        <span class="flex items-center gap-1.5 font-semibold"><span
                                class="text-emerald-400 text-sm">⚡</span> WhatsApp Live Chat</span>
                        <span class="flex items-center gap-1.5 font-semibold"><span
                                class="text-emerald-400 text-sm">🛡️</span> Verified Aviaries</span>
                        <span class="flex items-center gap-1.5 font-semibold"><span
                                class="text-emerald-400 text-sm">🔬</span> Avian Health Care</span>
                    </div>

                    <!-- Dual Action CTAs -->
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <button onclick="window.location.href='parrots.php'"
                            class="btn-emerald-glow font-label-md px-5 sm:px-7 py-3 sm:py-3.5 rounded-xl flex items-center justify-center gap-2 shadow-lg text-sm cursor-pointer w-full sm:w-auto">
                            <span class="material-symbols-outlined text-lg">menu_book</span>
                            <span>Explore Species Guide</span>
                        </button>
                        <button onclick="window.location.href='marketplace.php'"
                            class="bg-white/10 hover:bg-white/20 text-white font-label-md px-5 sm:px-7 py-3 sm:py-3.5 rounded-xl transition-all border border-white/20 hover:border-emerald-400/50 text-sm flex items-center justify-center gap-2 cursor-pointer w-full sm:w-auto">
                            <span class="material-symbols-outlined text-lg text-emerald-400">storefront</span>
                            <span>Visit Live Marketplace</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dual Hub Selection ("Explore By Intent") -->
        <section class="py-16 px-4 sm:px-6 md:px-margin-desktop max-w-container-max mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">What Are
                    You Looking For?</span>
                <h2 class="font-headline-lg text-3xl font-extrabold text-primary dark:text-primary-fixed mt-1">Explore
                    BirdBazaar Portals</h2>
                <p class="font-body-md text-sm text-on-surface-variant dark:text-surface-variant mt-2">Dedicated portals
                    designed for avian care knowledge and safe trading.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                <!-- Hub Card 1: Categories / Species Knowledge -->
                <div onclick="window.location.href='parrots.php'"
                    class="bg-gradient-to-br from-emerald-900 to-teal-950 text-white p-6 sm:p-8 md:p-10 rounded-3xl border border-emerald-500/30 shadow-xl hover:shadow-2xl transition-all cursor-pointer group hover:-translate-y-1 relative overflow-hidden flex flex-col justify-between">
                    <div
                        class="absolute -right-8 -bottom-8 opacity-10 text-emerald-300 pointer-events-none group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-[200px]">menu_book</span>
                    </div>
                    <div>
                        <div
                            class="w-14 h-14 rounded-2xl bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-3xl">menu_book</span>
                        </div>
                        <span
                            class="bg-emerald-500/20 text-emerald-300 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider border border-emerald-400/30">Knowledge
                            Directory</span>
                        <h3 class="font-display-lg text-2xl md:text-3xl font-bold text-white mt-3 mb-3">Avian Species
                            &amp; Care Guide
                        </h3>
                        <p class="text-xs md:text-sm text-white/90 leading-relaxed mb-6">
                            In-depth information on African Greys, Macaws, Cockatiels, Budgies, Lovebirds & Finches.
                            Species origin, diet plans, DNA testing, and health guidance.
                        </p>
                    </div>
                    <div
                        class="flex items-center text-xs md:text-sm font-bold text-emerald-300 group-hover:text-white transition-colors gap-2">
                        <span>Open Species Encyclopedia</span>
                        <span
                            class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>

                <!-- Hub Card 2: Live Marketplace -->
                <div onclick="window.location.href='marketplace.php'"
                    class="bg-gradient-to-br from-slate-900 to-emerald-950 text-white p-6 sm:p-8 md:p-10 rounded-3xl border border-teal-500/30 shadow-xl hover:shadow-2xl transition-all cursor-pointer group hover:-translate-y-1 relative overflow-hidden flex flex-col justify-between">
                    <div
                        class="absolute -right-8 -bottom-8 opacity-10 text-teal-300 pointer-events-none group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-[200px]">storefront</span>
                    </div>
                    <div>
                        <div
                            class="w-14 h-14 rounded-2xl bg-teal-500/20 border border-teal-400/40 text-teal-300 flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-3xl">storefront</span>
                        </div>
                        <span
                            class="bg-teal-500/20 text-teal-300 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider border border-teal-400/30">Trading
                            Portal</span>
                        <h3 class="font-display-lg text-2xl md:text-3xl font-bold text-white mt-3 mb-3">Live Buy & Sell
                            Marketplace
                        </h3>
                        <p class="text-xs md:text-sm text-white/90 leading-relaxed mb-6">
                            Connect with verified breeders across Pakistan. Post your birds for sale, chat on WhatsApp,
                            request live video clips, and enjoy buyer fraud protection.
                        </p>
                    </div>
                    <div
                        class="flex items-center text-xs md:text-sm font-bold text-teal-300 group-hover:text-white transition-colors gap-2">
                        <span>Enter Live Marketplace</span>
                        <span
                            class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Platform Ecosystem & Key Features -->
        <section
            class="py-16 px-4 sm:px-6 md:px-margin-desktop bg-slate-50 dark:bg-slate-900/50 border-y border-slate-200 dark:border-slate-800">
            <div class="max-w-container-max mx-auto">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span
                        class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Built
                        For Peace Of Mind</span>
                    <h2 class="font-headline-lg text-3xl font-extrabold text-primary dark:text-primary-fixed mt-1">Why
                        BirdBazaar Ecosystem?</h2>
                    <p class="font-body-md text-sm text-on-surface-variant dark:text-surface-variant mt-2">A complete
                        digital sanctuary designed to eliminate fraud and support avian health.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Feature 1 -->
                    <div
                        class="bg-white dark:bg-slate-800/80 p-6 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-md hover:shadow-xl transition-all hover:-translate-y-1">
                        <div
                            class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-2xl">chat</span>
                        </div>
                        <h4 class="font-bold text-lg text-slate-900 dark:text-white mb-2">WhatsApp Live Chat</h4>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            Direct instant messaging with breeders. Share 1-click video clips, voice notes, and high-res
                            photos before buying.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="bg-white dark:bg-slate-800/80 p-6 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-md hover:shadow-xl transition-all hover:-translate-y-1">
                        <div
                            class="w-12 h-12 rounded-xl bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-300 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-2xl">verified</span>
                        </div>
                        <h4 class="font-bold text-lg text-slate-900 dark:text-white mb-2">Verified Aviaries</h4>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            All aviaries undergo verification. Permanent fraud protection and blocked user enforcement
                            keep trading safe.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="bg-white dark:bg-slate-800/80 p-6 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-md hover:shadow-xl transition-all hover:-translate-y-1">
                        <div
                            class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-2xl">medical_services</span>
                        </div>
                        <h4 class="font-bold text-lg text-slate-900 dark:text-white mb-2">Avian Vet Care</h4>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            Access expert species nutrition plans, health check templates, and advice from certified
                            avian veterinarians.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div
                        class="bg-white dark:bg-slate-800/80 p-6 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-md hover:shadow-xl transition-all hover:-translate-y-1">
                        <div
                            class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-2xl">shield</span>
                        </div>
                        <h4 class="font-bold text-lg text-slate-900 dark:text-white mb-2">Buyer Escrow Protection</h4>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            Complete transaction safety. Verify bird health and condition before completing deal
                            confirmation.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- "Why BirdBazaar?" Platform Comparison Grid -->
        <section class="py-16 px-4 sm:px-6 md:px-margin-desktop max-w-container-max mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Compare
                    Security</span>
                <h2 class="font-headline-lg text-3xl font-extrabold text-primary dark:text-primary-fixed mt-1">
                    BirdBazaar vs Traditional Groups</h2>
                <p class="font-body-md text-sm text-on-surface-variant dark:text-surface-variant mt-2">See why bird
                    enthusiasts and breeders choose BirdBazaar over unverified social media groups.</p>
            </div>

            <div class="table-responsive-container shadow-xl max-w-4xl mx-auto border border-slate-200 dark:border-slate-700 rounded-3xl bg-white dark:bg-slate-800">
                <div class="min-w-[560px]">
                    <div class="grid grid-cols-3 bg-slate-900 text-white p-4 font-bold text-xs md:text-sm text-center">
                        <div class="text-left pl-2">Feature / Security</div>
                        <div class="text-slate-400">Unverified FB / OLX</div>
                        <div class="text-emerald-400">BirdBazaar Sanctuary</div>
                    </div>

                    <div class="divide-y divide-slate-100 dark:divide-slate-700/60 text-xs md:text-sm">
                        <div class="grid grid-cols-3 p-4 items-center text-center">
                            <div class="font-semibold text-slate-800 dark:text-white text-left pl-2">Breeder Verification
                            </div>
                            <div class="text-red-500 font-bold">❌ High Scam Risk</div>
                            <div
                                class="text-emerald-600 dark:text-emerald-400 font-bold flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">verified</span> 100% Verified Aviaries
                            </div>
                        </div>

                        <div class="grid grid-cols-3 p-4 items-center text-center bg-slate-50/50 dark:bg-slate-800/40">
                            <div class="font-semibold text-slate-800 dark:text-white text-left pl-2">Live Video Inspection
                            </div>
                            <div class="text-red-500 font-bold">❌ Static Photos Only</div>
                            <div
                                class="text-emerald-600 dark:text-emerald-400 font-bold flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">videocam</span> 1-Click WhatsApp Video
                            </div>
                        </div>

                        <div class="grid grid-cols-3 p-4 items-center text-center">
                            <div class="font-semibold text-slate-800 dark:text-white text-left pl-2">Health & Care Guides
                            </div>
                            <div class="text-red-500 font-bold">❌ None</div>
                            <div
                                class="text-emerald-600 dark:text-emerald-400 font-bold flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">menu_book</span> Full Species Encyclopedia
                            </div>
                        </div>

                        <div class="grid grid-cols-3 p-4 items-center text-center bg-slate-50/50 dark:bg-slate-800/40">
                            <div class="font-semibold text-slate-800 dark:text-white text-left pl-2">Blocked User Shield
                            </div>
                            <div class="text-red-500 font-bold">❌ No Protection</div>
                            <div
                                class="text-emerald-600 dark:text-emerald-400 font-bold flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">block</span> Instant Message Filtering
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Counter Section -->
        <section class="bg-primary dark:bg-on-surface/40 text-white py-12 px-4 sm:px-6 md:px-margin-desktop">
            <div class="max-w-container-max mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <h3 class="font-display-lg text-3xl md:text-4xl font-extrabold text-emerald-400 mb-1">50+</h3>
                    <p class="text-xs text-white font-medium">Cities Across Pakistan</p>
                </div>
                <div>
                    <h3 class="font-display-lg text-3xl md:text-4xl font-extrabold text-emerald-400 mb-1">100%</h3>
                    <p class="text-xs text-white font-medium">Verified Aviaries</p>
                </div>
                <div>
                    <h3 class="font-display-lg text-3xl md:text-4xl font-extrabold text-emerald-400 mb-1">10,000+</h3>
                    <p class="text-xs text-white font-medium">Avian Enthusiasts</p>
                </div>
                <div>
                    <h3 class="font-display-lg text-3xl md:text-4xl font-extrabold text-emerald-400 mb-1">24/7</h3>
                    <p class="text-xs text-white font-medium">Health &amp; Care Community</p>
                </div>
            </div>
        </section>

        <!-- Call to Action Banner -->
        <section
            class="bg-gradient-to-r from-emerald-900 to-teal-900 py-16 px-4 sm:px-6 md:px-margin-desktop text-white text-center relative overflow-hidden">
            <div class="max-w-3xl mx-auto relative z-10 space-y-6">
                <h2 class="text-3xl md:text-4xl font-extrabold leading-tight text-white">Ready to Explore or List Your
                    Aviary?</h2>
                <p class="text-sm md:text-base text-emerald-100 font-light max-w-xl mx-auto">
                    Join thousands of verified breeders and bird enthusiasts on Pakistan's #1 digital avian platform.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4 pt-2">
                    <button onclick="window.location.href='parrots.php'"
                        class="bg-white text-emerald-950 font-bold text-sm px-8 py-3.5 rounded-xl hover:bg-emerald-100 transition-colors shadow-lg cursor-pointer w-full sm:w-auto">
                        Explore Species Guide
                    </button>
                    <button onclick="window.location.href='marketplace.php'"
                        class="border border-white/40 bg-white/10 text-white font-bold text-sm px-8 py-3.5 rounded-xl hover:bg-white/20 transition-colors cursor-pointer w-full sm:w-auto">
                        Visit Marketplace
                    </button>
                </div>
            </div>
        </section>

    </main>

    <!-- Ultra-Modern Footer -->
    <footer
        class="w-full bg-gradient-to-b from-slate-950 via-slate-900 to-emerald-950 text-white py-16 px-4 sm:px-6 md:px-margin-desktop border-t border-emerald-500/20 shadow-2xl">
        <div class="max-w-container-max mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Column -->
            <div class="md:col-span-1">
        <div class="flex items-center gap-2 mb-4 cursor-pointer" onclick="window.location.href='index.php'">
            <img src="images/logo.png" alt="BirdBazaar Logo" class="h-24 w-auto object-contain" />
        </div>
                <p class="text-xs text-emerald-100/70 leading-relaxed mb-6 font-normal">
                    Pakistan's premier digital sanctuary for bird lovers, species knowledge, health guidance, and safe
                    aviary trading.
                </p>
                <div class="flex gap-3 text-xs text-emerald-300">
                    <span
                        class="bg-emerald-900/60 px-3 py-1 rounded-full border border-emerald-500/30 flex items-center gap-1 font-semibold">⚡
                        WhatsApp Support</span>
                    <span
                        class="bg-emerald-900/60 px-3 py-1 rounded-full border border-emerald-500/30 flex items-center gap-1 font-semibold">🛡️
                        Anti-Scam</span>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h5 class="text-emerald-400 font-bold text-sm mb-4 uppercase tracking-wider">Quick Links</h5>
                <ul class="space-y-3 text-xs">
                    <li><a class="text-slate-300 hover:text-emerald-400 transition-colors flex items-center gap-1"
                            href="index.php"><span
                                class="material-symbols-outlined text-sm text-emerald-500">home</span> Home
                            Sanctuary</a></li>
                    <li><a class="text-slate-300 hover:text-emerald-400 transition-colors flex items-center gap-1"
                            href="parrots.php"><span
                                class="material-symbols-outlined text-sm text-emerald-500">menu_book</span> Species
                            Guide</a></li>
                    <li><a class="text-slate-300 hover:text-emerald-400 transition-colors flex items-center gap-1"
                            href="marketplace.php"><span
                                class="material-symbols-outlined text-sm text-emerald-500">storefront</span> Live
                            Marketplace</a></li>
                    <li><a class="text-slate-300 hover:text-emerald-400 transition-colors flex items-center gap-1"
                            href="user-dashboard.php"><span
                                class="material-symbols-outlined text-sm text-emerald-500">dashboard</span> User
                            Dashboard</a></li>
                </ul>
            </div>

            <!-- Bird Categories -->
            <div>
                <h5 class="text-emerald-400 font-bold text-sm mb-4 uppercase tracking-wider">Bird Categories</h5>
                <ul class="space-y-3 text-xs">
                    <li><a class="text-slate-300 hover:text-emerald-400 transition-colors"
                            href="parrots.php?cat=parrots">Congo & Timneh Parrots</a></li>
                    <li><a class="text-slate-300 hover:text-emerald-400 transition-colors"
                            href="parrots.php?cat=macaws">Scarlet & Blue Macaws</a></li>
                    <li><a class="text-slate-300 hover:text-emerald-400 transition-colors"
                            href="parrots.php?cat=cockatiels">Whistle Cockatiels</a></li>
                    <li><a class="text-slate-300 hover:text-emerald-400 transition-colors"
                            href="parrots.php?cat=lovebirds">Opaline Lovebirds</a></li>
                </ul>
            </div>

            <!-- Interactive Newsletter -->
            <div>
                <h5 class="text-emerald-400 font-bold text-sm mb-4 uppercase tracking-wider">Join the Bazaar</h5>
                <p class="text-xs text-slate-300 mb-4 leading-relaxed">Subscribe for the latest bird care tips and
                    market updates.</p>
                <form
                    onsubmit="event.preventDefault(); if(window.showToast) window.showToast('🎉 Subscribed! You will receive bird care & market updates.'); this.reset();"
                    class="space-y-2">
                    <input
                        class="w-full bg-slate-900 border border-emerald-500/30 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-400 focus:outline-none focus:border-emerald-400 transition-colors"
                        placeholder="Your Email" type="email" required />
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-xs py-2.5 rounded-xl shadow-md transition-all cursor-pointer">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Copyright & Badges Bar -->
        <div
            class="max-w-container-max mx-auto mt-12 pt-6 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-400">
            <p>© 2026 BirdBazaar. Celebrating Avian Life.</p>
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-1.5"><span class="text-emerald-400">⚡</span> WhatsApp Verified</span>
                <span class="flex items-center gap-1.5"><span class="text-emerald-400">🛡️</span> Escrow Fraud
                    Protection</span>
                <span class="flex items-center gap-1.5"><span class="text-emerald-400">🇵🇰</span> Pakistan's #1 Avian
                    Network</span>
            </div>
        </div>
    </footer>

    <!-- FAB for Listing Action -->
    <button
        class="fixed bottom-5 right-5 sm:bottom-8 sm:right-8 bg-tertiary text-white w-14 h-14 sm:w-16 sm:h-16 rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50 animate-float"
        aria-label="Add listing">
        <span class="material-symbols-outlined text-3xl" data-icon="add">add</span>
    </button>

    <script>
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 20) {
                header.classList.add('shadow-lg', 'bg-surface/95', 'dark:bg-on-surface/95');
            } else {
                header.classList.remove('shadow-lg', 'bg-surface/80', 'dark:bg-on-surface/80');
            }
        });
    </script>
</body>

</html>
