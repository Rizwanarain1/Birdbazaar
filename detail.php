<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- BirdBazaar | Species Detail -->
<!DOCTYPE html>
<html class="light scroll-smooth" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Avian Profile - BirdBazaar</title>
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
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "36px", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
                    }
                },
            },
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
        <div class="flex items-center gap-2.5">
            <img src="images/logo.png" alt="BirdBazaar Logo" class="w-12 h-12 object-contain rounded-full bg-white p-0.5 shadow-sm" />
            <span class="text-xl font-bold text-white tracking-tight">BirdBazaar</span>
        </div>
        <button onclick="closeMobNav()" class="text-white"><span class="material-symbols-outlined">close</span></button>
    </div>
    <div class="flex flex-col gap-1 px-4 py-6">
        <a href="index.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">home</span>Home</a>
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

<!-- TopNavBar -->
<header class="sticky top-0 z-50 flex justify-between items-center px-4 sm:px-6 md:px-margin-desktop py-4 w-full max-w-container-max mx-auto bg-surface/80 dark:bg-on-surface/80 backdrop-blur-md shadow-md border-b border-white/40">
    <div class="flex items-center gap-2.5 sm:gap-4 min-w-0">
        <div onclick="window.location.href='index.php'" class="flex items-center gap-2.5 cursor-pointer flex-shrink-0">
            <img src="images/logo.png" alt="BirdBazaar Logo" class="w-14 h-14 sm:w-16 sm:h-16 object-contain rounded-full border border-emerald-500/30 shadow-sm bg-white p-0.5" />
            <span class="font-display-lg text-lg sm:text-2xl font-bold text-primary dark:text-primary-fixed truncate max-w-[120px] sm:max-w-none tracking-tight">BirdBazaar</span>
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors font-body-md text-body-md" href="index.php">Home</a>
            <a class="text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-primary-fixed transition-colors font-body-md text-body-md" href="parrots.php">Categories</a>
        </nav>
    </div>
    <div class="flex items-center gap-2 md:gap-6">
        <button id="lang-toggle-btn" class="text-on-surface-variant dark:text-surface-variant font-label-md flex items-center gap-1 hover:text-primary transition-colors">
            <span class="material-symbols-outlined">language</span>
            <span class="hidden sm:inline">Urdu</span>
        </button>
        <div id="header-auth-container" class="flex items-center gap-2"></div>
        <!-- Hamburger Button (mobile only) -->
        <button onclick="openMobNav()" class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-primary/10 text-primary dark:text-emerald-300">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>

<main class="max-w-container-max mx-auto px-3 sm:px-6 md:px-margin-desktop py-6 sm:py-8 md:py-12 animate-fade-in w-full overflow-hidden">
    <!-- Breadcrumb -->
    <nav class="flex flex-wrap items-center gap-1.5 sm:gap-2 mb-6 sm:mb-8 text-label-md text-on-surface-variant dark:text-surface-variant text-xs sm:text-sm">
        <a href="index.php" class="hover:text-primary dark:hover:text-primary-fixed">Home</a>
        <span class="material-symbols-outlined text-[14px] sm:text-[16px]">chevron_right</span>
        <a href="parrots.php" class="hover:text-primary dark:hover:text-primary-fixed">Directory</a>
        <span class="material-symbols-outlined text-[14px] sm:text-[16px]">chevron_right</span>
        <span id="breadcrumb-species" class="font-bold text-primary dark:text-primary-fixed truncate max-w-[150px] sm:max-w-none">African Grey</span>
    </nav>

    <!-- Main Avian Dashboard -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-12 mb-16">
        <!-- Photo Gallery Component -->
        <div>
            <div class="rounded-2xl overflow-hidden shadow-lg border border-outline-variant/30 h-[220px] sm:h-[350px] md:h-[500px] bg-surface-variant mb-3 sm:mb-4 relative">
                <img id="main-profile-img" class="w-full h-full object-cover" src="" alt="Avian Profile" />
                <span id="detail-tag" class="absolute top-3 left-3 sm:top-6 sm:left-6 bg-tertiary text-white font-label-md text-xs sm:text-sm px-3 sm:px-4 py-1 sm:py-1.5 rounded-full shadow-lg">Rare Genus</span>
            </div>
            <!-- Thumbnails -->
            <div class="grid grid-cols-3 gap-2 sm:gap-4" id="gallery-thumbnails">
                <!-- Swappers generated in JS -->
            </div>
        </div>

        <!-- Quick Profile & Core Facts -->
        <div class="flex flex-col justify-between">
            <div>
                <span id="profile-category" class="font-label-md uppercase tracking-wider text-tertiary dark:text-tertiary-fixed-dim">Category: Parrots</span>
                
                <!-- Title & Voice Listener Widgets -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mt-2 mb-1">
                    <h2 id="profile-title" class="font-display-lg text-2xl sm:text-4xl font-extrabold text-primary dark:text-primary-fixed leading-tight">African Grey</h2>
                    
                    <!-- Voice Listener Button -->
                    <button id="tts-toggle-btn" class="w-full sm:w-auto justify-center flex-shrink-0 flex items-center gap-1.5 bg-primary-container text-on-primary-container hover:bg-primary-fixed hover:text-on-primary-fixed px-3.5 py-2 rounded-full font-label-md transition-all active:scale-95 shadow-sm text-xs sm:text-sm">
                        <span class="material-symbols-outlined text-[18px] sm:text-[20px]" id="tts-icon">volume_up</span>
                        <span id="tts-text">Listen Profile</span>
                    </button>
                </div>
                
                <p id="profile-sci" class="font-headline-md text-body-lg italic text-outline mb-6">Psittacus erithacus</p>
                
                <p id="profile-desc" class="text-body-lg text-on-surface-variant dark:text-surface-variant leading-relaxed mb-8">
                    Highly revered for their exceptional intelligence, emotional sensitivity, and remarkable speech mimicking ability. Owners often describe them as "toddlers in feathers" because they require dedicated mental engagement and care.
                </p>

                <!-- Attribute Badges -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-6 p-4 sm:p-6 rounded-2xl bg-surface-container-low dark:bg-on-surface/30 border border-outline-variant/20 mb-6 sm:mb-8">
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="material-symbols-outlined text-primary dark:text-primary-fixed-dim text-2xl sm:text-3xl flex-shrink-0">public</span>
                        <div class="min-w-0">
                            <span class="text-[9px] sm:text-[10px] uppercase tracking-wider text-outline block font-bold">Origin</span>
                            <span id="fact-origin" class="font-bold text-xs sm:text-sm text-on-surface dark:text-white truncate block">Central Africa</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="material-symbols-outlined text-primary dark:text-primary-fixed-dim text-2xl sm:text-3xl flex-shrink-0">hourglass_empty</span>
                        <div class="min-w-0">
                            <span class="text-[9px] sm:text-[10px] uppercase tracking-wider text-outline block font-bold">Lifespan</span>
                            <span id="fact-life" class="font-bold text-xs sm:text-sm text-on-surface dark:text-white truncate block">40-60 Years</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="material-symbols-outlined text-primary dark:text-primary-fixed-dim text-2xl sm:text-3xl flex-shrink-0">psychology</span>
                        <div class="min-w-0">
                            <span class="text-[9px] sm:text-[10px] uppercase tracking-wider text-outline block font-bold">Intelligence</span>
                            <span id="fact-intel" class="font-bold text-xs sm:text-sm text-on-surface dark:text-white truncate block">Genius Level</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="material-symbols-outlined text-primary dark:text-primary-fixed-dim text-2xl sm:text-3xl flex-shrink-0">volume_up</span>
                        <div class="min-w-0">
                            <span class="text-[9px] sm:text-[10px] uppercase tracking-wider text-outline block font-bold">Noise Level</span>
                            <span id="fact-noise" class="font-bold text-xs sm:text-sm text-on-surface dark:text-white truncate block">Quiet</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Marketplace Call to Action -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-4 sm:p-6 bg-primary-container text-on-primary-container rounded-2xl">
                <div>
                    <span class="text-label-sm uppercase text-on-primary-container/70">Estimated Price Range</span>
                    <h3 id="detail-price-range" class="font-display-lg text-xl sm:text-2xl md:text-3xl font-bold text-white">$1,200 - $2,500</h3>
                </div>
                <button onclick="window.location.href='marketplace.php'" class="bg-tertiary text-white hover:bg-tertiary-container font-label-md px-6 py-3 rounded-lg shadow-md transition-all active:scale-95 flex items-center gap-2 w-full sm:w-auto justify-center">
                    Browse Marketplace <span class="material-symbols-outlined">shopping_bag</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Interactive Care Calculator & Species Details tabs -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12 mb-16">
        <!-- Care details (Diet, training, grooming) -->
        <div class="lg:col-span-2 space-y-6 sm:space-y-8">
            <h3 class="font-headline-lg text-xl sm:text-2xl md:text-3xl font-bold text-primary dark:text-primary-fixed border-b border-outline-variant/30 pb-3">Expert Care Guidelines</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 md:gap-8">
                <!-- Diet -->
                <div class="p-4 sm:p-6 rounded-2xl bg-white dark:bg-on-surface/30 shadow-sm border border-outline-variant/20">
                    <div class="flex items-center gap-3 mb-3 sm:mb-4">
                        <span class="material-symbols-outlined text-tertiary text-2xl sm:text-3xl">nutrition</span>
                        <h4 class="font-headline-md text-lg sm:text-xl font-bold text-primary dark:text-primary-fixed">Nutrition & Diet</h4>
                    </div>
                    <p class="text-xs sm:text-sm text-on-surface-variant dark:text-surface-variant leading-relaxed">
                        A balanced pellet-based diet should make up 70% of intake. Supplement daily with fresh dark leafy greens (kale, spinach), chopped carrots, apples, and seeds. Avoid chocolate and avocados.
                    </p>
                </div>

                <!-- Training & Social -->
                <div class="p-4 sm:p-6 rounded-2xl bg-white dark:bg-on-surface/30 shadow-sm border border-outline-variant/20">
                    <div class="flex items-center gap-3 mb-3 sm:mb-4">
                        <span class="material-symbols-outlined text-tertiary text-2xl sm:text-3xl">sports_esports</span>
                        <h4 class="font-headline-md text-lg sm:text-xl font-bold text-primary dark:text-primary-fixed">Socializing & Play</h4>
                    </div>
                    <p class="text-xs sm:text-sm text-on-surface-variant dark:text-surface-variant leading-relaxed">
                        Requires regular out-of-cage time daily. Engage their high intellect with puzzle toys, foraging blocks, and active companion chats.
                    </p>
                </div>

                <!-- Health & Hygiene -->
                <div class="p-4 sm:p-6 rounded-2xl bg-white dark:bg-on-surface/30 shadow-sm border border-outline-variant/20">
                    <div class="flex items-center gap-3 mb-3 sm:mb-4">
                        <span class="material-symbols-outlined text-tertiary text-2xl sm:text-3xl">medical_services</span>
                        <h4 class="font-headline-md text-lg sm:text-xl font-bold text-primary dark:text-primary-fixed">Health Indicators</h4>
                    </div>
                    <p class="text-xs sm:text-sm text-on-surface-variant dark:text-surface-variant leading-relaxed">
                        Watch for active curiosity. Schedule annual vet checks. Clean the cage bottom daily and wash water bowls to prevent bacterial issues.
                    </p>
                </div>

                <!-- Habitat -->
                <div class="p-4 sm:p-6 rounded-2xl bg-white dark:bg-on-surface/30 shadow-sm border border-outline-variant/20">
                    <div class="flex items-center gap-3 mb-3 sm:mb-4">
                        <span class="material-symbols-outlined text-tertiary text-2xl sm:text-3xl">home</span>
                        <h4 class="font-headline-md text-lg sm:text-xl font-bold text-primary dark:text-primary-fixed">Habitat Setup</h4>
                    </div>
                    <p class="text-xs sm:text-sm text-on-surface-variant dark:text-surface-variant leading-relaxed">
                        Provide a sturdy metal cage. Include multiple branches of varied thickness to help exercise their claws and feet.
                    </p>
                </div>
            </div>
        </div>

        <!-- Dynamic Cost Calculator Widget -->
        <div class="bg-surface-container-low dark:bg-on-surface/40 p-4 sm:p-6 md:p-8 rounded-2xl border border-outline-variant/30 shadow-md">
            <h4 class="font-headline-md text-lg sm:text-xl font-bold text-primary dark:text-primary-fixed mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary dark:text-primary-fixed">calculate</span>
                Care Cost Calculator
            </h4>
            <p class="text-label-md text-on-surface-variant dark:text-surface-variant mb-6">Estimate the monthly financial and time commitment required.</p>
            
            <div class="space-y-6">
                <!-- Cage Size Selection -->
                <div>
                    <label class="font-label-md block mb-2 text-on-surface dark:text-white">Habitat Setup</label>
                    <select id="calc-cage" class="w-full rounded-lg border-outline-variant bg-surface-container-lowest dark:bg-on-surface/40 text-body-md p-2.5">
                        <option value="standard">Standard Cage (Minimal)</option>
                        <option value="large" selected>Large Aviary Cage (Recommended)</option>
                        <option value="luxury">Luxury Custom Flight Room</option>
                    </select>
                </div>

                <!-- Age Slider -->
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="font-label-md text-on-surface dark:text-white">Bird Age</label>
                        <span id="calc-age-val" class="font-bold text-primary dark:text-primary-fixed">2 Years</span>
                    </div>
                    <input id="calc-age-slider" class="w-full accent-primary h-1.5 bg-surface-variant rounded-full appearance-none cursor-pointer" type="range" min="1" max="50" value="2"/>
                </div>

                <!-- Daily Attention slider -->
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="font-label-md text-on-surface dark:text-white">Daily Out-of-Cage Time</label>
                        <span id="calc-time-val" class="font-bold text-primary dark:text-primary-fixed">3 Hours</span>
                    </div>
                    <input id="calc-time-slider" class="w-full accent-primary h-1.5 bg-surface-variant rounded-full appearance-none cursor-pointer" type="range" min="1" max="8" value="3"/>
                </div>

                <div class="border-t border-outline-variant/30 pt-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-label-md text-on-surface-variant dark:text-surface-variant">Estimated Monthly Cost:</span>
                        <span id="calc-cost-out" class="font-display-lg text-headline-md font-bold text-primary dark:text-primary-fixed">$120 / mo</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-label-md text-on-surface-variant dark:text-surface-variant">Daily Commitment:</span>
                        <span id="calc-commit-out" class="font-bold text-label-md">High Attention</span>
                    </div>
                    <p class="text-[11px] text-outline italic">Includes estimates for premium pellets, fresh produce, replacement foraging toys, and vet fund savings.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Local Breeders Listings -->
    <div class="mb-16">
        <h3 class="font-headline-lg text-headline-lg text-primary dark:text-primary-fixed mb-2">Verified Birds for Sale</h3>
        <p class="text-body-lg text-on-surface-variant dark:text-surface-variant mb-8">Purchase safely through our certified breeders. Secure escrow payments supported.</p>
        
        <div id="breeders-listings-grid" class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
            <!-- Populated via JS -->
        </div>
    </div>

    <!-- Breeder Inquiry Modal -->
    <div id="inquiry-modal" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-on-surface/60 dark:bg-black/70 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="glass-card w-full max-w-md p-4 sm:p-6 md:p-8 rounded-xl shadow-2xl scale-95 transition-transform duration-300 relative text-on-surface dark:text-surface-bright max-h-[90vh] overflow-y-auto">
            <button class="absolute top-4 right-4 text-on-surface-variant hover:text-primary dark:text-surface-variant dark:hover:text-primary-fixed" id="close-inquiry-btn">
                <span class="material-symbols-outlined text-2xl">close</span>
            </button>
            <h3 class="font-display-lg text-headline-md text-primary dark:text-primary-fixed mb-2">Inquire About <span id="modal-bird-name">African Grey</span></h3>
            <p class="text-label-sm text-on-surface-variant dark:text-surface-variant mb-6">Contact <span id="modal-breeder-name" class="font-bold">Luxe Avian Farms</span> directly. Your inquiry will be forwarded securely.</p>
            
            <form id="inquiry-form" class="space-y-4">
                <div>
                    <label class="font-label-md block mb-1">Your Name</label>
                    <input type="text" required class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-2.5 dark:bg-on-surface/40 dark:border-white/10" />
                </div>
                <div>
                    <label class="font-label-md block mb-1">Your Email</label>
                    <input type="email" required class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-2.5 dark:bg-on-surface/40 dark:border-white/10" />
                </div>
                <div>
                    <label class="font-label-md block mb-1">Your Message</label>
                    <textarea required rows="4" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-2.5 dark:bg-on-surface/40 dark:border-white/10" placeholder="Ask about the bird's weaning history, DNA certificates, or health guarantees..."></textarea>
                </div>
                <button type="submit" class="w-full bg-primary text-white dark:bg-primary-fixed dark:text-on-primary-fixed font-label-md py-3 rounded-lg hover:scale-101 active:scale-99 transition-transform">
                    Send Inquiry
                </button>
            </form>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="w-full mt-section-gap bg-primary dark:bg-on-primary-fixed py-10 sm:py-16 px-4 sm:px-6 md:px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-8 max-w-container-max mx-auto rounded-t-3xl">
    <div class="md:col-span-1">
        <div class="flex items-center gap-2 mb-6">
            <span class="text-3xl">🦜</span>
            <span class="font-display-lg text-headline-lg text-on-primary font-bold">BirdBazaar</span>
        </div>
        <p class="text-primary-fixed-dim/80 font-body-md mb-6 font-light">The world's premier digital sanctuary for bird lovers, providing knowledge and a secure marketplace for avian life.</p>
        <div class="flex gap-4">
            <a class="text-on-primary hover:text-tertiary-fixed transition-colors" href="#"><span class="material-symbols-outlined" data-icon="public">public</span></a>
            <a class="text-on-primary hover:text-tertiary-fixed transition-colors" href="#"><span class="material-symbols-outlined" data-icon="alternate_email">alternate_email</span></a>
            <a class="text-on-primary hover:text-tertiary-fixed transition-colors" href="#"><span class="material-symbols-outlined" data-icon="share">share</span></a>
        </div>
    </div>
    <div>
        <h5 class="text-white font-headline-md mb-6">Quick Links</h5>
        <ul class="space-y-4">
            <li><a class="text-primary-fixed-dim/80 hover:text-tertiary-fixed transition-colors" href="index.php">Home Sanctuary</a></li>
            <li><a class="text-primary-fixed-dim/80 hover:text-tertiary-fixed transition-colors" href="parrots.php">Species Guide</a></li>
            <li><a class="text-primary-fixed-dim/80 hover:text-tertiary-fixed transition-colors" href="marketplace.php">Live Marketplace</a></li>
            <li><a class="text-primary-fixed-dim/80 hover:text-tertiary-fixed transition-colors" href="user-dashboard.php">User Dashboard</a></li>
        </ul>
    </div>
    <div>
        <h5 class="text-white font-headline-md mb-6">Categories</h5>
        <ul class="space-y-4">
            <li><a class="text-primary-fixed-dim/80 hover:text-tertiary-fixed transition-colors" href="parrots.php?cat=parrots">Parrots</a></li>
            <li><a class="text-primary-fixed-dim/80 hover:text-tertiary-fixed transition-colors" href="parrots.php?cat=budgies">Budgies</a></li>
            <li><a class="text-primary-fixed-dim/80 hover:text-tertiary-fixed transition-colors" href="parrots.php?cat=cockatiels">Cockatiels</a></li>
            <li><a class="text-primary-fixed-dim/80 hover:text-tertiary-fixed transition-colors" href="parrots.php?cat=macaws">Macaws</a></li>
        </ul>
    </div>
    <div>
        <h5 class="text-white font-headline-md mb-6">Join the Nest</h5>
        <p class="text-primary-fixed-dim/80 font-body-md mb-4 font-light">Subscribe for the latest bird care tips and market updates.</p>
        <div class="flex flex-col gap-2">
            <input class="bg-primary-container border border-white/20 rounded-lg px-4 py-2 text-white placeholder:text-white/40 focus:outline-none focus:border-tertiary-fixed transition-colors dark:bg-on-surface/50" placeholder="Your Email" type="email"/>
            <button class="bg-tertiary text-on-tertiary font-label-md py-2 rounded-lg hover:bg-tertiary-container transition-colors">Subscribe</button>
        </div>
    </div>
    <div class="md:col-span-4 mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
        <p class="text-primary-fixed-dim/60 font-label-md">© 2026 BirdBazaar. Celebrating Avian Life.</p>
        <div class="flex flex-wrap justify-center gap-4 sm:gap-8">
            <span class="text-primary-fixed-dim/60 font-label-md">Secure Payments via Stripe</span>
            <span class="text-primary-fixed-dim/60 font-label-md">Verified Breeders Only</span>
        </div>
    </div>
</footer>

<!-- FAB for Listing Action -->
<button onclick="window.location.href='marketplace.php'" class="fixed bottom-5 right-5 sm:bottom-8 sm:right-8 bg-tertiary text-white w-14 h-14 sm:w-16 sm:h-16 rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50 animate-float" aria-label="Add listing">
    <span class="material-symbols-outlined text-2xl sm:text-3xl" data-icon="add">add</span>
</button>

<script>
    // Detailed dataset of bird categories including Parrots, Macaws, Cockatiels, Budgies, Lovebirds, Finches, and Canaries
    const detailsDataset = {
        'African Grey': {
            name: 'African Grey',
            sci: 'Psittacus erithacus',
            category: 'Parrots',
            origin: 'Central Africa',
            life: '40-60 Years',
            intel: 'Genius Level',
            noise: 'Quiet',
            priceRange: '$1,500 - $2,800',
            basePrice: 1500,
            desc: 'Highly revered for their exceptional intelligence, emotional sensitivity, and remarkable speech mimicking ability. African Greys bond deeply with their owners but require substantial mental stimulation to prevent boredom and anxiety.',
            tag: 'Rare Genus',
            images: [
                'images/african_grey.png',
                'images/eclectus_parrot.png'
            ],
            breeders: [
                { id: 1, name: 'Feathered Friend Avia', title: 'Hand-reared Weaned Baby African Grey', age: '6 Months', location: 'Seattle, WA', price: 1800, rating: '4.9★', verified: true },
                { id: 2, name: 'Apex Avian Farms', title: 'DNA Sexed Male Young African Grey', age: '1 Year', location: 'Austin, TX', price: 1600, rating: '4.8★', verified: true }
            ]
        },
        'Scarlet Macaw': {
            name: 'Scarlet Macaw',
            sci: 'Ara macao',
            category: 'Parrots',
            origin: 'South America',
            life: '50-75 Years',
            intel: 'Highly Social',
            noise: 'Loud',
            priceRange: '$3,000 - $4,500',
            basePrice: 3200,
            desc: 'A spectacular bird possessing brilliant red, yellow, and blue plumage. Macaws are grand, energetic, and highly social creatures. They need a committed owner who can accommodate their loud calls and large enclosure requirements.',
            tag: 'Featured',
            images: [
                'images/scarlet_macaw.png',
                'images/hyacinth_macaw.png'
            ],
            breeders: [
                { id: 3, name: 'Luxe Avian Farms', title: 'Brilliant Scarlet Macaw (Trained)', age: '1.5 Years', location: 'Miami, FL', price: 3400, rating: '5.0★', verified: true },
                { id: 4, name: 'Jungle Aviaries', title: 'Weaned Scarlet Macaw Hand-Fed', age: '8 Months', location: 'San Diego, CA', price: 3200, rating: '4.7★', verified: false }
            ]
        },
        'Sun Conure': {
            name: 'Sun Conure',
            sci: 'Aratinga solstitialis',
            category: 'Parrots',
            origin: 'South America',
            life: '25-30 Years',
            intel: 'Active Learner',
            noise: 'Moderate',
            priceRange: '$550 - $900',
            basePrice: 650,
            desc: 'Famous for their glowing yellow, orange, and green feathers. Sun Conures are small but pack a huge, affectionate personality. They love being handled and can learn several vocal mimicries and performance tricks.',
            tag: 'Aesthetic Select',
            images: [
                'images/sun_conure.png',
                'images/hero_bg.png'
            ],
            breeders: [
                { id: 5, name: 'Sunny Wings Breeding', title: 'Bright Sun Conure (Very Playful)', age: '5 Months', location: 'Portland, OR', price: 700, rating: '4.9★', verified: true },
                { id: 6, name: 'Pet Bird Emporium', title: 'Sun Conure Companion Pair', age: '1 Year', location: 'Denver, CO', price: 1200, rating: '4.6★', verified: false }
            ]
        },
        'Peach-faced Lovebird': {
            name: 'Peach-faced Lovebird',
            sci: 'Agapornis roseicollis',
            category: 'Lovebirds',
            origin: 'Southwest Africa',
            life: '12-15 Years',
            intel: 'Highly Social',
            noise: 'Moderate',
            priceRange: '$150 - $250',
            basePrice: 180,
            desc: 'Peach-faced Lovebirds are small, incredibly active, and affectionate pets. Known for their tight pair bonds, they show great devotion to their human family if kept alone, or to their mate if kept in pairs.',
            tag: 'Sweet Companion',
            images: [
                'images/lovebird.png'
            ],
            breeders: [
                { id: 7, name: 'Lovebird Loft', title: 'Weaned Peach-faced Lovebirds (Tame)', age: '3 Months', location: 'Atlanta, GA', price: 180, rating: '4.8★', verified: true }
            ]
        },
        'Zebra Finch': {
            name: 'Zebra Finch',
            sci: 'Taeniopygia guttata',
            category: 'Finches',
            origin: 'Australia',
            life: '5-8 Years',
            intel: 'Active Learner',
            noise: 'Quiet',
            priceRange: '$30 - $60',
            basePrice: 40,
            desc: 'Zebra Finches are active, cheerful small birds. They are exceptionally low-maintenance and communicate using charming beep sounds, making them the perfect pet bird for busy households or apartment layouts.',
            tag: 'Best Seller',
            images: [
                'images/finch.png'
            ],
            breeders: [
                { id: 8, name: 'Tiny Wings Aviary', title: 'Zebra Finch Flocking Pairs', age: '4 Months', location: 'Phoenix, AZ', price: 80, rating: '4.9★', verified: true }
            ]
        },
        'Red Factor Canary': {
            name: 'Red Factor Canary',
            sci: 'Serinus canaria',
            category: 'Canaries',
            origin: 'Canary Islands',
            life: '10-12 Years',
            intel: 'Active Learner',
            noise: 'Quiet',
            priceRange: '$130 - $200',
            basePrice: 150,
            desc: 'The Red Factor Canary is prized for its gorgeous orange-red coloration and delightful, sweet singing voice. Canaries prefer keeping to themselves, singing melodies to brighten your home.',
            tag: 'Featured',
            images: [
                'images/canary.png'
            ],
            breeders: [
                { id: 9, name: 'Canary Song Studios', title: 'Singing Male Red Factor Canary', age: '6 Months', location: 'Salt Lake City, UT', price: 160, rating: '4.7★', verified: true }
            ]
        }
    };

    let activeSpecies = 'African Grey';
    const urlParams = new URLSearchParams(window.location.search);
    const speciesParam = urlParams.get('species');
    if (speciesParam && detailsDataset[speciesParam]) {
        activeSpecies = speciesParam;
    }

    const currentData = detailsDataset[activeSpecies];

    document.addEventListener('DOMContentLoaded', () => {
        populatePageData();
        setupCalculators();
        setupInquiryModal();
        setupVoiceListener();
    });

    function populatePageData() {
        document.getElementById('breadcrumb-species').textContent = currentData.name;
        
        document.getElementById('main-profile-img').src = currentData.images[0];
        document.getElementById('main-profile-img').alt = currentData.name;
        
        const tagBox = document.getElementById('detail-tag');
        if (currentData.tag) {
            tagBox.textContent = currentData.tag;
            tagBox.style.display = 'block';
        } else {
            tagBox.style.display = 'none';
        }

        const thumbRow = document.getElementById('gallery-thumbnails');
        thumbRow.innerHTML = '';
        currentData.images.forEach((imgUrl, idx) => {
            const thumbDiv = document.createElement('div');
            thumbDiv.className = `h-24 rounded-lg overflow-hidden border-2 cursor-pointer transition-all hover:opacity-90 ${idx === 0 ? 'border-primary' : 'border-transparent'}`;
            thumbDiv.innerHTML = `<img class="w-full h-full object-cover" src="${imgUrl}" alt="${currentData.name} thumbnail" />`;
            thumbDiv.addEventListener('click', () => {
                document.getElementById('main-profile-img').src = imgUrl;
                Array.from(thumbRow.children).forEach(c => c.classList.replace('border-primary', 'border-transparent'));
                thumbDiv.classList.replace('border-transparent', 'border-primary');
            });
            thumbRow.appendChild(thumbDiv);
        });

        document.getElementById('profile-category').textContent = `Category: ${currentData.category}`;
        document.getElementById('profile-title').textContent = currentData.name;
        document.getElementById('profile-sci').textContent = currentData.sci;
        document.getElementById('profile-desc').textContent = currentData.desc;
        document.getElementById('fact-origin').textContent = currentData.origin;
        document.getElementById('fact-life').textContent = currentData.life;
        document.getElementById('fact-intel').textContent = currentData.intel;
        document.getElementById('fact-noise').textContent = currentData.noise;
        document.getElementById('detail-price-range').textContent = currentData.priceRange;

        const breedersGrid = document.getElementById('breeders-listings-grid');
        breedersGrid.innerHTML = '';
        currentData.breeders.forEach(breed => {
            const badgeHtml = breed.verified ? `
                <span class="bg-primary-container text-on-primary-container text-[10px] px-2 py-0.5 rounded font-bold">Verified Breeder</span>
            ` : '';
            
            const card = document.createElement('div');
            card.className = 'p-4 sm:p-6 rounded-2xl bg-white dark:bg-on-surface/40 shadow-sm border border-outline-variant/20 hover:border-primary/40 transition-all flex flex-col justify-between';
            card.innerHTML = `
                <div>
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-2 mb-3">
                        <div class="min-w-0">
                            <h4 class="font-headline-md text-base sm:text-lg font-bold text-primary dark:text-primary-fixed truncate">${breed.title}</h4>
                            <div class="flex items-center gap-2 flex-wrap mt-0.5">
                                <span class="text-xs text-outline font-medium">${breed.name}</span>
                                ${badgeHtml}
                            </div>
                        </div>
                        <span class="text-lg sm:text-xl font-bold text-primary dark:text-primary-fixed flex-shrink-0">$${breed.price.toLocaleString()}</span>
                    </div>
                    <ul class="text-xs sm:text-sm text-on-surface-variant dark:text-surface-variant space-y-1 mb-6">
                        <li><strong>Age:</strong> ${breed.age}</li>
                        <li><strong>Location:</strong> ${breed.location}</li>
                        <li><strong>Breeder Rating:</strong> ${breed.rating}</li>
                    </ul>
                </div>
                <button onclick="triggerInquiry('${breed.name}', '${breed.title}')" class="w-full py-2.5 rounded-lg border border-primary text-primary dark:border-primary-fixed dark:text-primary-fixed font-label-md text-xs sm:text-sm hover:bg-primary hover:text-white dark:hover:bg-primary-fixed dark:hover:text-on-primary-fixed transition-colors">Inquire Breeder</button>
            `;
            breedersGrid.appendChild(card);
        });
    }

    function setupCalculators() {
        const cageSelect = document.getElementById('calc-cage');
        const ageSlider = document.getElementById('calc-age-slider');
        const timeSlider = document.getElementById('calc-time-slider');

        const ageVal = document.getElementById('calc-age-val');
        const timeVal = document.getElementById('calc-time-val');
        const costOut = document.getElementById('calc-cost-out');
        const commitOut = document.getElementById('calc-commit-out');

        const recompute = () => {
            const age = ageSlider.value;
            ageVal.textContent = age === '1' ? '1 Year' : `${age} Years`;

            const time = timeSlider.value;
            timeVal.textContent = time === '1' ? '1 Hour' : `${time} Hours`;

            let cageMultiplier = 1.0;
            if (cageSelect.value === 'standard') cageMultiplier = 0.8;
            if (cageSelect.value === 'luxury') cageMultiplier = 1.6;

            let baseVal = currentData.basePrice * 0.08;
            let monthlyBase = baseVal / 12;

            let ageFactor = 1.0;
            if (age > 25) ageFactor = 1.25;

            let timeFactor = 1.0;
            if (time > 5) timeFactor = 1.3;

            let monthlyCost = Math.round(monthlyBase * cageMultiplier * ageFactor * timeFactor);
            costOut.textContent = `$${monthlyCost} / mo`;

            if (time < 3) {
                commitOut.textContent = 'Moderate Attention';
                commitOut.className = 'font-bold text-label-md text-on-surface-variant dark:text-surface-variant';
            } else if (time >= 3 && time < 6) {
                commitOut.textContent = 'High Attention';
                commitOut.className = 'font-bold text-label-md text-tertiary-container dark:text-tertiary-fixed';
            } else {
                commitOut.textContent = 'Full Devotion';
                commitOut.className = 'font-bold text-label-md text-error';
            }
        };

        cageSelect.addEventListener('change', recompute);
        ageSlider.addEventListener('input', recompute);
        timeSlider.addEventListener('input', recompute);

        recompute();
    }

    function setupInquiryModal() {
        const modal = document.getElementById('inquiry-modal');
        const closeBtn = document.getElementById('close-inquiry-btn');
        const form = document.getElementById('inquiry-form');

        const closeModal = () => {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
        };

        closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const buyerName = form.querySelector('input[type="text"]').value;
            const buyerEmail = form.querySelector('input[type="email"]').value;
            const message = form.querySelector('textarea').value;

            fetch('api/inquiry.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    buyer_name: buyerName,
                    buyer_email: buyerEmail,
                    message: message
                })
            })
            .then(res => res.json())
            .then(data => {
                const msg = data.message || "✉️ Inquiry sent successfully! Breeder will email you within 24 hours.";
                if (window.showToast) window.showToast(msg);
                form.reset();
                closeModal();
            })
            .catch(() => {
                if (window.showToast) window.showToast("✉️ Inquiry sent successfully! Breeder will email you within 24 hours.");
                form.reset();
                closeModal();
            });
        });
    }

    window.triggerInquiry = function(breederName, birdTitle) {
        const modal = document.getElementById('inquiry-modal');
        document.getElementById('modal-bird-name').textContent = birdTitle;
        document.getElementById('modal-breeder-name').textContent = breederName;
        
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
        modal.firstElementChild.classList.remove('scale-95');
        modal.firstElementChild.classList.add('scale-100');
    };

    /* ==========================================
       5. Voice Listener (Text-to-Speech) System
       ========================================== */
    let synth = window.speechSynthesis;
    let utterance = null;

    function setupVoiceListener() {
        const btn = document.getElementById('tts-toggle-btn');
        if (!btn) return;

        btn.addEventListener('click', () => {
            if (synth.speaking) {
                synth.cancel();
                resetTtsButton();
                return;
            }

            const title = document.getElementById('profile-title').innerText;
            const sci = document.getElementById('profile-sci').innerText;
            const desc = document.getElementById('profile-desc').innerText;
            const originText = document.getElementById('fact-origin').innerText;
            
            const currentLang = localStorage.getItem('language') || 'en';
            let readText = "";

            if (currentLang === 'ur') {
                readText = `${title}۔ سائینسی نام ${sci}۔ اصل وطن ${originText}۔ ${desc}`;
            } else {
                readText = `${title}. Scientific name ${sci}. Native to ${originText}. ${desc}`;
            }

            utterance = new SpeechSynthesisUtterance(readText);
            
            // Set voice language
            if (currentLang === 'ur') {
                utterance.lang = 'ur-PK';
                // Find suitable Urdu or Hindi voice
                const voices = synth.getVoices();
                const urduVoice = voices.find(v => v.lang.startsWith('ur') || v.lang.startsWith('hi'));
                if (urduVoice) utterance.voice = urduVoice;
            } else {
                utterance.lang = 'en-US';
                const voices = synth.getVoices();
                const engVoice = voices.find(v => v.lang.startsWith('en'));
                if (engVoice) utterance.voice = engVoice;
            }

            utterance.onend = () => {
                resetTtsButton();
            };

            utterance.onerror = () => {
                resetTtsButton();
            };

            // Set button speaking state
            btn.querySelector('#tts-icon').textContent = 'volume_off';
            btn.querySelector('#tts-text').textContent = currentLang === 'ur' ? 'آواز روکیں' : 'Stop Voice';
            btn.classList.replace('bg-primary-container', 'bg-error-container');
            btn.classList.replace('text-on-primary-container', 'text-error');

            synth.speak(utterance);
        });

        // Ensure voices load (needed in Chrome)
        if (speechSynthesis.onvoiceschanged !== undefined) {
            speechSynthesis.onvoiceschanged = () => {};
        }
    }

    function resetTtsButton() {
        const btn = document.getElementById('tts-toggle-btn');
        if (!btn) return;
        const currentLang = localStorage.getItem('language') || 'en';

        btn.querySelector('#tts-icon').textContent = 'volume_up';
        btn.querySelector('#tts-text').textContent = currentLang === 'ur' ? 'پروفائل سنیں' : 'Listen Profile';
        btn.classList.replace('bg-error-container', 'bg-primary-container');
        btn.classList.replace('text-error', 'text-on-primary-container');
    }
</script>
</body>
</html>
