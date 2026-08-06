<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- BirdBazaar | Facebook-Style Avian Marketplace -->
<!DOCTYPE html>
<html class="light scroll-smooth" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Avian Marketplace - Buy & Sell Birds | BirdBazaar</title>
    
    <!-- Google Fonts & Material Symbols -->
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
                        "primary-container": "#1a4332",
                        "surface-bright": "#f8f9ff",
                        "surface-variant": "#d9e3f6",
                        "background": "#f8f9ff",
                        "outline": "#717973",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#50616b",
                        "tertiary": "#735c00",
                        "tertiary-container": "#cea700",
                        "error": "#ba1a1a",
                        "outline-variant": "#c1c8c2",
                        "surface": "#f8f9ff"
                    },
                    "spacing": {
                        "margin-desktop": "64px",
                        "gutter": "24px",
                        "container-max": "1280px",
                        "section-gap": "60px"
                    },
                    "fontFamily": {
                        "headline-md": ["Montserrat"],
                        "body-lg": ["Inter"],
                        "display-lg": ["Montserrat"],
                        "label-md": ["Inter"],
                        "body-md": ["Inter"]
                    }
                }
            }
        };
    </script>
    <script src="app.js" defer></script>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 font-body-md selection:bg-emerald-500 selection:text-white custom-scrollbar min-h-screen">

<!-- Mobile Nav Drawer Backdrop -->
<div id="mob-nav-overlay" class="drawer-overlay" onclick="closeMobNav()"></div>
<!-- Mobile Nav Drawer -->
<nav id="mob-nav-drawer" class="mobile-nav-drawer flex flex-col">
    <div class="flex items-center justify-between px-6 py-5 border-b border-emerald-500/20">
        <span class="text-xl font-bold text-white">🦜 BirdBazaar</span>
        <button onclick="closeMobNav()" class="text-white"><span class="material-symbols-outlined">close</span></button>
    </div>
    <div class="flex flex-col gap-1 px-4 py-6">
        <a href="index.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">home</span>Home</a>
        <a href="parrots.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">menu_book</span>Categories</a>
        <a href="marketplace.php" class="text-white font-semibold px-4 py-3 rounded-xl bg-emerald-700/30 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">storefront</span>Marketplace</a>
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
<header class="sticky top-0 z-40 flex justify-between items-center px-4 sm:px-6 md:px-margin-desktop py-4 w-full max-w-container-max mx-auto bg-white/90 dark:bg-slate-900/90 backdrop-blur-md shadow-sm border-b border-slate-200 dark:border-slate-800">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-emerald-700 dark:text-emerald-400 text-3xl cursor-pointer" onclick="window.location.href='index.php'">storefront</span>
        <h1 onclick="window.location.href='index.php'" class="font-display-lg text-lg sm:text-2xl font-bold text-emerald-950 dark:text-emerald-400 cursor-pointer tracking-tight">BirdBazaar <span class="text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300 px-2 py-0.5 rounded-full font-bold uppercase ml-1 hidden sm:inline">Marketplace</span></h1>
    </div>
    <nav class="hidden md:flex items-center gap-8 font-semibold text-sm">
        <a class="text-slate-600 dark:text-slate-300 hover:text-emerald-700 dark:hover:text-emerald-400 transition-colors" href="index.php">Home</a>
        <a class="text-slate-600 dark:text-slate-300 hover:text-emerald-700 dark:hover:text-emerald-400 transition-colors" href="parrots.php">Categories</a>
        <a class="text-emerald-800 dark:text-emerald-400 font-bold border-b-2 border-emerald-700 pb-1" href="marketplace.php">Marketplace</a>
    </nav>
    <div class="flex items-center gap-2">
        <div id="header-auth-container" class="flex items-center gap-2"></div>
        <!-- Hamburger Button (mobile only) -->
        <button onclick="openMobNav()" class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>

<main class="max-w-container-max mx-auto px-3 sm:px-6 md:px-margin-desktop py-6 sm:py-8 animate-fade-in w-full overflow-hidden">

    <!-- Top Banner & Actions -->
    <div class="bg-gradient-to-r from-emerald-900 to-teal-950 text-white rounded-2xl sm:rounded-3xl p-4 sm:p-8 mb-6 sm:mb-8 shadow-xl relative overflow-hidden flex flex-col md:flex-row justify-between items-start md:items-center gap-6 w-full">
        <div class="relative z-10 max-w-xl">
            <span class="bg-emerald-500/30 text-emerald-300 text-[10px] sm:text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider mb-2 sm:mb-3 inline-block">Facebook Style Marketplace</span>
            <h2 class="font-display-lg text-xl sm:text-3xl font-extrabold text-white mb-2 leading-tight">Buy &amp; Sell Hand-Raised Birds</h2>
            <p class="text-emerald-100/90 text-xs sm:text-sm font-light leading-relaxed">Connect directly with verified bird owners, chat in real-time to negotiate prices, and post your own listings easily.</p>
        </div>
        <div class="relative z-10 flex flex-wrap gap-3 w-full sm:w-auto">
            <button onclick="window.triggerListingModal ? window.triggerListingModal() : (window.openAuthModal ? window.openAuthModal() : null)" class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold px-5 sm:px-6 py-3.5 rounded-2xl shadow-lg hover:scale-102 active:scale-98 transition-all flex items-center justify-center gap-2 text-xs sm:text-sm cursor-pointer w-full sm:w-auto">
                <span class="material-symbols-outlined text-lg">add_circle</span> Post Bird for Sale
            </button>
        </div>
    </div>

    <!-- Filter Pills & Search Bar -->
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-4 mb-6 sm:mb-8 w-full">
        <!-- Mobile Filter Toggle Button -->
        <button id="toggle-mobile-market-filters" onclick="const p=document.getElementById('category-pills-wrapper'); p.classList.toggle('hidden');" class="w-full md:hidden p-3 bg-emerald-800 text-white rounded-2xl font-bold text-xs flex items-center justify-between shadow-sm cursor-pointer">
            <span class="flex items-center gap-2">
                <span class="material-symbols-outlined text-base">tune</span>
                <span>Filter Categories</span>
            </span>
            <span class="material-symbols-outlined text-base">expand_more</span>
        </button>

        <!-- Category Pills Wrapper -->
        <div id="category-pills-wrapper" class="hidden md:block w-full md:w-auto">
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none w-full" id="category-pills">
                <button data-cat="all" class="px-4 sm:px-5 py-2.5 rounded-xl font-bold text-xs bg-emerald-800 text-white shadow-md transition-all whitespace-nowrap cursor-pointer">All Categories</button>
                <button data-cat="parrots" class="px-4 sm:px-5 py-2.5 rounded-xl font-bold text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-all whitespace-nowrap cursor-pointer">Parrots</button>
                <button data-cat="cockatiels" class="px-4 sm:px-5 py-2.5 rounded-xl font-bold text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-all whitespace-nowrap cursor-pointer">Cockatiels</button>
                <button data-cat="budgies" class="px-4 sm:px-5 py-2.5 rounded-xl font-bold text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-all whitespace-nowrap cursor-pointer">Budgies</button>
                <button data-cat="macaws" class="px-4 sm:px-5 py-2.5 rounded-xl font-bold text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-all whitespace-nowrap cursor-pointer">Macaws</button>
                <button data-cat="lovebirds" class="px-4 sm:px-5 py-2.5 rounded-xl font-bold text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-all whitespace-nowrap cursor-pointer">Lovebirds</button>
                <button data-cat="finches" class="px-4 sm:px-5 py-2.5 rounded-xl font-bold text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-all whitespace-nowrap cursor-pointer">Finches</button>
                <button data-cat="canaries" class="px-4 sm:px-5 py-2.5 rounded-xl font-bold text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-all whitespace-nowrap cursor-pointer">Canaries</button>
            </div>
        </div>

        <!-- Search Input Full Width on Mobile -->
        <div class="relative w-full md:min-w-[280px] md:w-auto">
            <span class="material-symbols-outlined absolute left-3.5 top-3 text-slate-400 text-lg">search</span>
            <input id="market-search" type="text" placeholder="Search title or location..." class="w-full pl-10 pr-4 py-2.5 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm" />
        </div>
    </div>

    <!-- Marketplace Feed Grid -->
    <div id="marketplace-feed" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
        <!-- Rendered dynamically -->
    </div>

</main>

<!-- Footer -->
<footer class="w-full mt-16 bg-primary dark:bg-slate-900 py-10 sm:py-16 px-4 sm:px-6 md:px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-8 max-w-container-max mx-auto rounded-t-3xl border-t border-white/10 text-white">
    <div class="md:col-span-1">
        <div class="flex items-center gap-2 mb-6">
            <span class="text-3xl">🦜</span>
            <span class="font-display-lg text-xl font-bold text-white">BirdBazaar</span>
        </div>
        <p class="text-emerald-100/70 font-body-md mb-6 text-xs sm:text-sm font-light">The world's premier digital sanctuary for bird lovers, providing knowledge and a secure marketplace for avian life.</p>
        <div class="flex gap-4">
            <a class="text-white hover:text-emerald-400 transition-colors" href="#"><span class="material-symbols-outlined">public</span></a>
            <a class="text-white hover:text-emerald-400 transition-colors" href="#"><span class="material-symbols-outlined">alternate_email</span></a>
            <a class="text-white hover:text-emerald-400 transition-colors" href="#"><span class="material-symbols-outlined">share</span></a>
        </div>
    </div>
    <div>
        <h5 class="text-white font-bold mb-4 text-sm sm:text-base">Quick Links</h5>
        <ul class="space-y-3 text-xs sm:text-sm">
            <li><a class="text-emerald-100/70 hover:text-emerald-300 transition-colors" href="index.php">Home Sanctuary</a></li>
            <li><a class="text-emerald-100/70 hover:text-emerald-300 transition-colors" href="parrots.php">Species Guide</a></li>
            <li><a class="text-emerald-100/70 hover:text-emerald-300 transition-colors" href="marketplace.php">Live Marketplace</a></li>
            <li><a class="text-emerald-100/70 hover:text-emerald-300 transition-colors" href="user-dashboard.php">User Dashboard</a></li>
        </ul>
    </div>
    <div>
        <h5 class="text-white font-bold mb-4 text-sm sm:text-base">Categories</h5>
        <ul class="space-y-3 text-xs sm:text-sm">
            <li><a class="text-emerald-100/70 hover:text-emerald-300 transition-colors" href="parrots.php?cat=parrots">Parrots</a></li>
            <li><a class="text-emerald-100/70 hover:text-emerald-300 transition-colors" href="parrots.php?cat=budgies">Budgies</a></li>
            <li><a class="text-emerald-100/70 hover:text-emerald-300 transition-colors" href="parrots.php?cat=cockatiels">Cockatiels</a></li>
            <li><a class="text-emerald-100/70 hover:text-emerald-300 transition-colors" href="parrots.php?cat=macaws">Macaws</a></li>
        </ul>
    </div>
    <div>
        <h5 class="text-white font-bold mb-4 text-sm sm:text-base">Join the Nest</h5>
        <p class="text-emerald-100/70 font-body-md mb-4 text-xs sm:text-sm font-light">Subscribe for the latest bird care tips and market updates.</p>
        <div class="flex flex-col gap-2">
            <input class="bg-emerald-950/60 border border-white/20 rounded-xl px-4 py-2 text-white placeholder:text-white/40 text-xs focus:outline-none focus:border-emerald-400 transition-colors" placeholder="Your Email" type="email"/>
            <button class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 rounded-xl text-xs transition-colors cursor-pointer">Subscribe</button>
        </div>
    </div>
    <div class="md:col-span-4 mt-8 sm:mt-12 pt-6 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left text-xs text-emerald-100/60">
        <p>© 2026 BirdBazaar. Celebrating Avian Life.</p>
        <div class="flex flex-wrap justify-center gap-4 sm:gap-8">
            <span>Secure Payments via Stripe</span>
            <span>Verified Breeders Only</span>
        </div>
    </div>
</footer>

<!-- Live Chat Drawer Component -->
<div id="chat-drawer" class="fixed bottom-0 sm:bottom-4 right-0 sm:right-4 z-50 w-full sm:max-w-md bg-white dark:bg-slate-900 rounded-t-3xl sm:rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 flex flex-col hidden animate-fade-in overflow-hidden h-[85vh] sm:h-[500px]">
    <!-- Header -->
    <div class="bg-gradient-to-r from-emerald-800 to-teal-900 text-white p-4 flex items-center justify-between shadow-md">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-500 text-slate-950 font-bold flex items-center justify-center text-base shadow-sm" id="chat-seller-avatar">S</div>
            <div>
                <h4 class="font-bold text-sm leading-tight" id="chat-seller-name">Seller Chat</h4>
                <p class="text-[11px] text-emerald-200 flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span id="chat-bird-title">Bird Listing</span>
                </p>
            </div>
        </div>
        <button id="close-chat-btn" class="text-emerald-200 hover:text-white transition-colors cursor-pointer">
            <span class="material-symbols-outlined text-2xl">close</span>
        </button>
    </div>

    <!-- Chat Messages Box -->
    <div id="chat-messages-container" class="flex-1 p-4 overflow-y-auto space-y-3 bg-slate-50 dark:bg-slate-950/60 custom-scrollbar text-xs">
        <div class="text-center text-[11px] text-slate-400 py-2">
            🔒 WhatsApp End-to-End Encrypted Conversation
        </div>
    </div>

    <!-- Attachment Preview Card -->
    <div id="chat-attachment-preview" class="hidden px-3 py-2 bg-emerald-100 dark:bg-emerald-950 border-t border-emerald-300 dark:border-emerald-800 flex items-center justify-between animate-fade-in">
        <div class="flex items-center gap-3 overflow-hidden">
            <div id="chat-preview-thumb" class="w-12 h-12 rounded-xl overflow-hidden bg-black flex items-center justify-center flex-shrink-0 text-white text-xs border border-white/20"></div>
            <div>
                <p id="chat-preview-label" class="font-bold text-xs text-emerald-900 dark:text-emerald-200 truncate">Attachment selected</p>
                <p class="text-[10px] text-emerald-700 dark:text-emerald-400">⚡ Instant 1-Click Send | Media attached</p>
            </div>
        </div>
        <button type="button" onclick="cancelChatAttachment()" class="text-slate-500 hover:text-red-600 p-1 cursor-pointer">
            <span class="material-symbols-outlined text-lg">close</span>
        </button>
    </div>

    <!-- Emojis & Quick Suggestions -->
    <div class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800/80 border-t border-slate-200 dark:border-slate-800 flex gap-1.5 overflow-x-auto text-[11px] items-center scrollbar-none">
        <button type="button" onclick="insertChatEmoji('😀')" class="hover:scale-125 transition-transform">😀</button>
        <button type="button" onclick="insertChatEmoji('😊')" class="hover:scale-125 transition-transform">😊</button>
        <button type="button" onclick="insertChatEmoji('👍')" class="hover:scale-125 transition-transform">👍</button>
        <button type="button" onclick="insertChatEmoji('❤️')" class="hover:scale-125 transition-transform">❤️</button>
        <button type="button" onclick="insertChatEmoji('🦜')" class="hover:scale-125 transition-transform">🦜</button>
        <button type="button" onclick="insertChatEmoji('💰')" class="hover:scale-125 transition-transform">💰</button>
        <button type="button" onclick="insertChatEmoji('✅')" class="hover:scale-125 transition-transform">✅</button>
        <button type="button" onclick="insertChatEmoji('🙏')" class="hover:scale-125 transition-transform">🙏</button>
        <span class="text-slate-300 dark:text-slate-700">|</span>
        <button type="button" onclick="sendQuickMessage('Is this bird available?')" class="px-2 py-0.5 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 whitespace-nowrap cursor-pointer">Available?</button>
        <button type="button" onclick="sendQuickMessage('What is your final price?')" class="px-2 py-0.5 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 whitespace-nowrap cursor-pointer">Final Price?</button>
    </div>

    <!-- Input Box with WhatsApp Attachments -->
    <form id="chat-input-form" class="p-2 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 flex gap-1.5 items-center">
        <input type="file" id="chat-file-image" accept="image/*" class="hidden" onchange="handleChatImageUpload(this)" />
        <input type="file" id="chat-file-video" accept="video/*" class="hidden" onchange="handleChatVideoUpload(this)" />
        <input type="file" id="chat-file-audio" accept="audio/*" class="hidden" onchange="handleChatAudioUpload(this)" />

        <button type="button" onclick="document.getElementById('chat-file-image').click()" class="text-slate-400 hover:text-emerald-600 transition-colors p-1 cursor-pointer" title="Attach Photo">
            <span class="material-symbols-outlined text-xl">image</span>
        </button>
        <button type="button" onclick="document.getElementById('chat-file-video').click()" class="text-slate-400 hover:text-emerald-600 transition-colors p-1 cursor-pointer" title="Attach Video Clip">
            <span class="material-symbols-outlined text-xl">videocam</span>
        </button>
        <button type="button" id="market-mic-btn" onclick="toggleMarketVoiceRecording()" class="text-slate-400 hover:text-emerald-600 transition-colors p-1 cursor-pointer" title="Record Voice Note / Attach Audio">
            <span class="material-symbols-outlined text-xl">mic</span>
        </button>

        <input type="text" id="chat-input-text" placeholder="Write message..." class="flex-1 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-800 p-2 text-xs focus:outline-none focus:ring-1 focus:ring-emerald-500" />
        
        <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white p-2 rounded-xl shadow-md transition-all flex items-center justify-center cursor-pointer">
            <span class="material-symbols-outlined text-lg">send</span>
        </button>
    </form>
</div>

<script>
    let activeCategory = 'all';
    let searchQuery = '';
    let currentActiveBirdId = null;

    document.addEventListener('DOMContentLoaded', () => {
        setupFilters();
        renderFeed();

        window.addEventListener('avinest-listings-updated', () => {
            renderFeed();
        });

        document.getElementById('close-chat-btn').addEventListener('click', () => {
            document.getElementById('chat-drawer').classList.add('hidden');
        });

        document.getElementById('chat-input-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const textInput = document.getElementById('chat-input-text');
            const msg = textInput.value.trim();
            if (msg || pendingMarketAttachment) {
                sendChatMessage(msg);
                textInput.value = '';
            }
        });
    });

    function setupFilters() {
        const pills = document.querySelectorAll('#category-pills button');
        pills.forEach(pill => {
            pill.addEventListener('click', () => {
                pills.forEach(p => {
                    p.className = 'px-5 py-2.5 rounded-xl font-bold text-xs bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-all whitespace-nowrap cursor-pointer';
                });
                pill.className = 'px-5 py-2.5 rounded-xl font-bold text-xs bg-emerald-800 text-white shadow-md transition-all whitespace-nowrap cursor-pointer';
                activeCategory = pill.getAttribute('data-cat');
                renderFeed();
            });
        });

        document.getElementById('market-search').addEventListener('input', (e) => {
            searchQuery = e.target.value.toLowerCase().trim();
            renderFeed();
        });
    }

    function renderFeed() {
        let sessionListings = [];
        try {
            const stored = sessionStorage.getItem('avinest_listings');
            if (stored) {
                const parsed = JSON.parse(stored);
                const uniqueSession = [];
                parsed.forEach(item => {
                    if (!uniqueSession.some(u => u.name.toLowerCase().trim() === item.name.toLowerCase().trim() && (u.breeder || '').toLowerCase().trim() === (item.breeder || '').toLowerCase().trim() && Math.abs(Number(u.price) - Number(item.price)) < 1)) {
                        uniqueSession.push(item);
                    }
                });
                sessionListings = uniqueSession;
                sessionStorage.setItem('avinest_listings', JSON.stringify(uniqueSession));
            }
        } catch(e) {}

        fetch('api/birds.php?user_only=1')
            .then(res => res.json())
            .then(data => {
                let dbData = [];
                if (data.success && Array.isArray(data.data)) {
                    dbData = data.data;
                }
                if (dbData.length > 0) {
                    sessionStorage.removeItem('avinest_listings');
                    combineFeed(dbData, []);
                } else {
                    combineFeed([], sessionListings);
                }
            })
            .catch(() => {
                combineFeed([], sessionListings);
            });
    }

    function combineFeed(dbData, sessionListings) {
        const uniqueFeed = [];
        const seenIds = new Set();
        const seenKeys = new Set();

        [...dbData, ...sessionListings].forEach(item => {
            const idStr = String(item.id);
            const key = (item.name || '').toLowerCase().trim() + '_' + (item.breeder || '').toLowerCase().trim() + '_' + Math.round(Number(item.price));
            if (!seenIds.has(idStr) && !seenKeys.has(key)) {
                seenIds.add(idStr);
                seenKeys.add(key);
                uniqueFeed.push(item);
            }
        });

        let combined = uniqueFeed.filter(item => 
            item.breeder !== 'Local Avian Owner' && 
            item.breeder !== 'Luxe Avian Farms' && 
            !['101','102','103','104','105','106','107','108'].includes(String(item.id))
        );

        if (activeCategory !== 'all') {
            combined = combined.filter(item => item.category === activeCategory);
        }

        if (searchQuery) {
            combined = combined.filter(item => 
                item.name.toLowerCase().includes(searchQuery) ||
                (item.origin && item.origin.toLowerCase().includes(searchQuery)) ||
                (item.breeder && item.breeder.toLowerCase().includes(searchQuery))
            );
        }

        displayFeedCards(combined);
    }

    function displayFeedCards(listings) {
        const feed = document.getElementById('marketplace-feed');
        feed.innerHTML = '';

        if (listings.length === 0) {
            feed.innerHTML = `
                <div class="col-span-full py-16 text-center bg-white dark:bg-slate-900 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm">
                    <span class="material-symbols-outlined text-emerald-600 text-6xl mb-3">storefront</span>
                    <h4 class="font-display-lg text-xl font-bold text-slate-900 dark:text-white mb-2">No Marketplace Listings Found</h4>
                    <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">Be the first registered user to post a bird for sale on the BirdBazaar Marketplace!</p>
                    <button onclick="window.triggerListingModal ? window.triggerListingModal() : (window.openAuthModal ? window.openAuthModal() : null)" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-6 py-3 rounded-2xl shadow-md transition-transform inline-flex items-center gap-2 text-sm cursor-pointer">
                        <span class="material-symbols-outlined">add_circle</span> Post First Listing
                    </button>
                </div>
            `;
            return;
        }

        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || '{}');

        listings.forEach((item, index) => {
            const isSold = item.status === 'sold' || item.sold === true;
            const isOwner = currentUser.email && (currentUser.name === item.breeder || currentUser.role === 'admin');

            const soldOverlay = isSold ? `
                <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-[2px] z-20 flex items-center justify-center">
                    <span class="bg-red-600 text-white text-2xl font-black px-6 py-2 rounded-2xl shadow-2xl transform -rotate-12 border-2 border-white tracking-widest uppercase">
                        🔴 SOLD
                    </span>
                </div>
            ` : '';

            // Multi-Image Gallery Thumbnails
            let multiImagesHtml = '';
            if (Array.isArray(item.images) && item.images.length > 1) {
                multiImagesHtml = `
                    <div class="flex gap-2 mt-2 p-2 bg-slate-100 dark:bg-slate-800/80 rounded-xl overflow-x-auto">
                        ${item.images.map((img, i) => `
                            <img src="${img}" onclick="document.getElementById('card-img-${index}').src='${img}'" class="w-12 h-12 object-cover rounded-lg cursor-pointer border-2 border-transparent hover:border-emerald-500 transition-all flex-shrink-0" alt="Bird Photo ${i+1}" />
                        `).join('')}
                    </div>
                `;
            }

            // HTML5 Video Player Button & Modal Launcher
            const videoPlayer = item.video ? `
                <button onclick="openCardVideoModal('${item.video.replace(/'/g, "&apos;")}', '${item.name.replace(/'/g, "&apos;")}')" class="w-full mt-2 py-2 px-3 rounded-xl bg-slate-900 text-white font-bold text-xs flex items-center justify-center gap-1.5 hover:bg-emerald-800 transition-all shadow-sm border border-emerald-500/30 cursor-pointer">
                    <span class="material-symbols-outlined text-emerald-400 text-sm animate-pulse">play_circle</span> Watch Bird Video Clip
                </button>
            ` : '';

            const card = document.createElement('div');
            card.id = 'market-card-' + item.id;
            card.className = `bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200 dark:border-slate-800 transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1 ${isSold ? 'opacity-90' : ''}`;
            card.innerHTML = `
                <div>
                    <!-- Post Header -->
                    <div class="p-3.5 px-4 flex items-center justify-between border-b border-slate-100 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-800/30 gap-2">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 rounded-full bg-emerald-700 text-white font-bold flex items-center justify-center text-xs shadow-sm flex-shrink-0">
                                ${(item.breeder || 'U').charAt(0).toUpperCase()}
                            </div>
                            <div class="leading-tight min-w-0">
                                <h4 class="font-bold text-xs text-slate-900 dark:text-white truncate max-w-[120px] sm:max-w-[140px]">${item.breeder || 'Seller'}</h4>
                                <p class="text-[10px] text-slate-400 flex items-center gap-0.5 truncate">
                                    <span class="material-symbols-outlined text-[11px] text-emerald-600 flex-shrink-0">location_on</span> <span class="truncate">${item.origin || 'Pakistan'}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <span class="bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-[10px] px-2 py-0.5 rounded-full font-extrabold truncate">
                                ${item.category || 'Parrots'}
                            </span>
                            ${isSold ? '<span class="bg-red-100 text-red-700 text-[10px] px-2 py-0.5 rounded-full font-bold">SOLD</span>' : ''}
                        </div>
                    </div>

                    <!-- Photo Container (Compact Height) -->
                    <div class="h-44 overflow-hidden relative bg-slate-900">
                        ${soldOverlay}
                        <img id="card-img-${index}" src="${item.image || 'images/african_grey.png'}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="${item.name}" />
                        <div class="absolute top-3 right-3 bg-gradient-to-r from-emerald-900/90 to-teal-900/90 text-white font-black text-xs px-3 py-1 rounded-full shadow-lg border border-white/20 backdrop-blur-md">
                            PKR ${Number(item.price).toLocaleString()}
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-4 space-y-2">
                        <h3 class="font-bold text-base text-slate-900 dark:text-white truncate leading-tight">${item.name}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed">${item.description || 'Health checked, hand-reared bird listing.'}</p>
                        ${multiImagesHtml}
                        ${videoPlayer}
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="p-4 pt-0">
                    <div class="flex gap-2 pt-2 border-t border-slate-100 dark:border-slate-800/80">
                        <button onclick="${isSold ? 'null' : `openChatDrawer('${item.id}', '${item.breeder || 'Seller'}', '${item.name}')`}" class="flex-1 ${isSold ? 'bg-slate-200 text-slate-400 cursor-not-allowed' : 'bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white shadow-md cursor-pointer'} font-bold py-2.5 rounded-xl text-xs flex items-center justify-center gap-1.5 transition-all">
                            <span class="material-symbols-outlined text-sm">chat</span>
                            ${isSold ? 'Listing Sold' : 'Chat to Buy'}
                        </button>
                        
                        ${isOwner && !isSold ? `
                            <button onclick="markPostAsSold('${item.id}')" class="bg-emerald-800 hover:bg-emerald-900 text-white font-bold py-2.5 px-2.5 rounded-xl text-xs shadow-sm transition-all cursor-pointer flex items-center gap-1" title="Mark Sold">
                                <span class="material-symbols-outlined text-sm">check_circle</span>
                            </button>
                        ` : ''}

                        ${isOwner ? `
                            <button onclick="deleteMyListing('${item.id}')" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-2.5 rounded-xl text-xs shadow-sm transition-all cursor-pointer flex items-center gap-1" title="Delete Listing">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        ` : ''}
                    </div>
                </div>
            `;
            feed.appendChild(card);
        });
    }

    function deleteMyListing(birdId) {
        const executeDelete = () => {
            const cardElem = document.getElementById('market-card-' + birdId);
            if (cardElem) cardElem.remove();

            try {
                const stored = sessionStorage.getItem('avinest_listings');
                if (stored) {
                    let listings = JSON.parse(stored);
                    listings = listings.filter(l => String(l.id) !== String(birdId));
                    sessionStorage.setItem('avinest_listings', JSON.stringify(listings));
                }
            } catch(e) {}

            fetch(`api/birds.php?id=${birdId}`, { method: 'DELETE' })
                .then(res => res.json())
                .then(() => {
                    if (window.showToast) window.showToast("🗑️ Your listing has been deleted!");
                });
        };

        if (window.showConfirmModal) {
            window.showConfirmModal({
                title: "Delete Your Bird Listing",
                message: "Are you sure you want to delete your bird listing? It will be removed from the Marketplace feed.",
                icon: "delete",
                confirmText: "Yes, Delete Listing",
                cancelText: "Cancel",
                onConfirm: () => {
                    executeDelete();
                }
            });
        } else if (confirm("Delete this listing?")) {
            executeDelete();
        }
    }

    function openChatDrawer(birdId, sellerName, birdTitle) {
        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
        if (!currentUser) {
            if (window.showCustomModal) {
                window.showCustomModal({
                    title: "🔒 Login Required",
                    message: "Please log in to chat with the seller and buy this bird.",
                    icon: "lock",
                    type: "warning",
                    buttonText: "Login Now",
                    onAction: () => { if (window.openAuthModal) window.openAuthModal(); }
                });
            } else if (window.openAuthModal) {
                window.openAuthModal();
            }
            return;
        }

        const buyerEmail = (currentUser.email || 'user').toLowerCase();
        const threadKey = birdId + '_' + encodeURIComponent(buyerEmail);

        currentActiveBirdId = threadKey;
        document.getElementById('chat-seller-name').textContent = sellerName;
        document.getElementById('chat-seller-avatar').textContent = sellerName.charAt(0).toUpperCase();
        document.getElementById('chat-bird-title').textContent = birdTitle;

        const drawer = document.getElementById('chat-drawer');
        drawer.classList.remove('hidden');

        updateBlockUI(sellerName);
        fetchChatMessages(threadKey);
    }

    function getStoredChat(birdId) {
        const key = 'avinest_chat_history_' + (birdId || 'default');
        try {
            const stored = sessionStorage.getItem(key);
            if (stored) return JSON.parse(stored);
        } catch(e) {}
        return [];
    }

    function saveStoredChat(birdId, messages) {
        const key = 'avinest_chat_history_' + (birdId || 'default');
        try {
            sessionStorage.setItem(key, JSON.stringify(messages));
        } catch(e) {
            console.warn("sessionStorage quota exceeded:", e);
        }
    }

    function fetchChatMessages(birdId) {
        const storedMsgs = getStoredChat(birdId);

        fetch(`api/chat.php?bird_id=${encodeURIComponent(birdId)}`)
            .then(res => res.json())
            .then(data => {
                if (data.success && Array.isArray(data.data) && data.data.length > 0) {
                    const combined = [...storedMsgs];
                    data.data.forEach(d => {
                        if (!combined.some(c => c.id === d.id || (c.message === d.message && c.sender_name === d.sender_name))) {
                            combined.push(d);
                        }
                    });
                    saveStoredChat(birdId, combined);
                    renderChatMessages(combined);
                } else {
                    renderChatMessages(storedMsgs);
                }
            })
            .catch(() => {
                renderChatMessages(storedMsgs);
            });
    }

    let pendingMarketAttachment = null;

    function cancelChatAttachment() {
        pendingMarketAttachment = null;
        const preview = document.getElementById('chat-attachment-preview');
        if (preview) preview.classList.add('hidden');
    }

    window.openCardVideoModal = function(videoUrl, birdTitle) {
        let modal = document.getElementById('card-video-modal');
        if (modal) modal.remove();

        modal = document.createElement('div');
        modal.id = 'card-video-modal';
        modal.className = 'fixed inset-0 bg-black/85 backdrop-blur-md z-[170] flex items-center justify-center p-4 animate-fade-in';
        modal.innerHTML = `
            <div class="bg-slate-900 rounded-3xl w-full max-w-xl shadow-2xl border border-emerald-500/40 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-900 to-teal-900 text-white p-4 flex items-center justify-between">
                    <h4 class="font-bold text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-400">videocam</span> Video Clip - ${birdTitle}
                    </h4>
                    <button onclick="this.closest('#card-video-modal').remove()" class="text-slate-300 hover:text-white cursor-pointer">
                        <span class="material-symbols-outlined text-2xl">close</span>
                    </button>
                </div>
                <div class="p-4 bg-black flex items-center justify-center">
                    <video controls playsinline autoplay preload="metadata" src="${videoUrl}" class="w-full max-h-[70vh] rounded-2xl object-contain bg-black shadow-lg">
                        <source src="${videoUrl}" type="video/mp4">
                        <source src="${videoUrl}" type="video/webm">
                    </video>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    };

    let marketMediaRecorder = null;
    let marketAudioChunks = [];
    let isRecordingMarketVoice = false;

    window.toggleMarketVoiceRecording = async function() {
        const micBtn = document.getElementById('market-mic-btn');
        
        if (isRecordingMarketVoice) {
            if (marketMediaRecorder && marketMediaRecorder.state !== 'inactive') {
                marketMediaRecorder.stop();
            }
            isRecordingMarketVoice = false;
            if (micBtn) {
                micBtn.className = 'text-slate-400 hover:text-emerald-600 transition-colors p-1 cursor-pointer';
                micBtn.title = "Attach Voice Note";
            }
            return;
        }

        try {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            
            let mimeType = 'audio/webm';
            if (typeof MediaRecorder.isTypeSupported === 'function') {
                if (MediaRecorder.isTypeSupported('audio/webm')) mimeType = 'audio/webm';
                else if (MediaRecorder.isTypeSupported('audio/mp4')) mimeType = 'audio/mp4';
                else if (MediaRecorder.isTypeSupported('audio/ogg')) mimeType = 'audio/ogg';
            }

            marketMediaRecorder = new MediaRecorder(stream, { mimeType });
            marketAudioChunks = [];

            marketMediaRecorder.ondataavailable = e => {
                if (e.data && e.data.size > 0) marketAudioChunks.push(e.data);
            };

            marketMediaRecorder.onstop = () => {
                const audioBlob = new Blob(marketAudioChunks, { type: mimeType });
                const reader = new FileReader();
                reader.onload = e => {
                    showMarketPreview('audio', e.target.result, 'Voice_Note.mp3');
                    sendChatMessage('');
                };
                reader.readAsDataURL(audioBlob);
                stream.getTracks().forEach(track => track.stop());
            };

            marketMediaRecorder.start(100);
            isRecordingMarketVoice = true;

            if (micBtn) {
                micBtn.className = 'text-red-500 animate-pulse p-1 cursor-pointer font-bold flex items-center gap-1 scale-110';
                micBtn.title = "Recording... Click Mic to Stop & Send Voice Note";
            }

            if (window.showToast) window.showToast("🎙️ Voice Recording Started! Speak into your microphone.", false);
        } catch(err) {
            console.error("Microphone recording error:", err);
            if (window.showToast) window.showToast("⚠️ Microphone access failed or denied. Select audio file manually.", true);
            document.getElementById('chat-file-audio').click();
        }
    };

    function showMarketPreview(type, b64, fileName) {
        pendingMarketAttachment = { type, data: b64 };
        const preview = document.getElementById('chat-attachment-preview');
        const thumb = document.getElementById('chat-preview-thumb');
        const label = document.getElementById('chat-preview-label');

        if (label) label.textContent = `Attached ${type.toUpperCase()}: ${fileName}`;
        if (type === 'image') {
            if (thumb) thumb.innerHTML = `<img src="${b64}" class="w-full h-full object-cover" />`;
        } else if (type === 'video') {
            if (thumb) thumb.innerHTML = `<video src="${b64}" class="w-full h-full object-cover bg-black"></video>`;
        } else if (type === 'audio') {
            if (thumb) thumb.innerHTML = `<span class="material-symbols-outlined text-emerald-400 text-xl">mic</span>`;
        }
        if (preview) preview.classList.remove('hidden');
    }

    function insertChatEmoji(emoji) {
        const input = document.getElementById('chat-input-text');
        if (input) {
            input.value += emoji;
            input.focus();
        }
    }

    function handleChatImageUpload(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const localUrl = URL.createObjectURL(file);
        showMarketPreview('image', localUrl, file.name);

        const formData = new FormData();
        formData.append('image', file);

        fetch('api/upload.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            const finalUrl = (data.success && data.image_url) ? data.image_url : localUrl;
            pendingMarketAttachment = { type: 'image', data: finalUrl };
            sendChatMessage('');
            input.value = '';
        })
        .catch(() => {
            pendingMarketAttachment = { type: 'image', data: localUrl };
            sendChatMessage('');
            input.value = '';
        });
    }

    function handleChatVideoUpload(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const localUrl = URL.createObjectURL(file);
        showMarketPreview('video', localUrl, file.name);

        if (window.showToast) window.showToast("🎥 Uploading & Sending Video Clip...", false);

        const formData = new FormData();
        formData.append('video', file);

        fetch('api/upload.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            const finalUrl = (data.success && data.video_url) ? data.video_url : localUrl;
            pendingMarketAttachment = { type: 'video', data: finalUrl };
            sendChatMessage('');
            input.value = '';
        })
        .catch(err => {
            console.error("Video upload server error:", err);
            pendingMarketAttachment = { type: 'video', data: localUrl };
            sendChatMessage('');
            input.value = '';
        });
    }

    function handleChatAudioUpload(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const localUrl = URL.createObjectURL(file);
        showMarketPreview('audio', localUrl, file.name);

        const formData = new FormData();
        formData.append('audio', file);

        fetch('api/upload.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            const finalUrl = (data.success && data.audio_url) ? data.audio_url : localUrl;
            pendingMarketAttachment = { type: 'audio', data: finalUrl };
            sendChatMessage('');
            input.value = '';
        })
        .catch(() => {
            pendingMarketAttachment = { type: 'audio', data: localUrl };
            sendChatMessage('');
            input.value = '';
        });
    }

    function renderChatMessages(messages) {
        const container = document.getElementById('chat-messages-container');
        container.innerHTML = `
            <div class="text-center text-[11px] text-slate-400 py-1">
                🔒 WhatsApp End-to-End Encrypted Conversation
            </div>
        `;

        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || '{}');

        messages.forEach(msg => {
            const isMe = msg.sender_email === currentUser.email || msg.sender_name === currentUser.name;
            const bubble = document.createElement('div');
            bubble.className = `flex flex-col ${isMe ? 'items-end' : 'items-start'}`;

            let mediaHtml = '';
            if (msg.image) {
                mediaHtml += `<img src="${msg.image}" class="max-w-xs rounded-xl my-1 border border-white/20 shadow-md" />`;
            }
            if (msg.video) {
                mediaHtml += `<video controls playsinline preload="metadata" src="${msg.video}" class="max-w-xs rounded-xl my-1 border border-white/20 shadow-md bg-black"></video>`;
            }
            if (msg.audio) {
                mediaHtml += `
                    <div class="my-1.5 p-2 bg-emerald-950/40 border border-emerald-500/30 rounded-xl flex items-center gap-2 max-w-[240px]">
                        <span class="material-symbols-outlined text-emerald-400 text-xl flex-shrink-0 animate-pulse">graphic_eq</span>
                        <audio controls src="${msg.audio}" class="w-full h-8 rounded accent-emerald-500"></audio>
                    </div>
                `;
            }

            const doubleTick = isMe ? `<span class="text-sky-300 font-extrabold text-[10px] ml-1">✔✔</span>` : '';

            bubble.innerHTML = `
                <div class="max-w-[85%] rounded-2xl p-3 text-xs ${isMe ? 'bg-emerald-700 text-white rounded-br-none' : 'bg-slate-200 dark:bg-slate-800 text-slate-900 dark:text-white rounded-bl-none'} shadow-sm">
                    <span class="font-bold block text-[10px] ${isMe ? 'text-emerald-200' : 'text-slate-500'}">${msg.sender_name}</span>
                    ${mediaHtml}
                    ${msg.message ? `<p class="leading-relaxed mt-0.5">${msg.message}</p>` : ''}
                    <span class="text-[9px] block text-right mt-1 opacity-70 flex items-center justify-end gap-0.5">
                        ${msg.timestamp || 'Now'} ${doubleTick}
                    </span>
                </div>
            `;
            container.appendChild(bubble);
        });

        container.scrollTop = container.scrollHeight;
    }

    function sendChatMessage(text) {
        const sellerName = document.getElementById('chat-seller-name').textContent || 'Seller';
        let blocked = JSON.parse(sessionStorage.getItem('avinest_blocked_users') || '[]');
        if (blocked.includes(sellerName)) {
            if (window.showToast) window.showToast("🚫 You cannot send messages to a blocked user.", true);
            return;
        }

        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || '{}');
        const birdId = currentActiveBirdId || 'default';
        const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        let extraMedia = {};
        if (pendingMarketAttachment) {
            extraMedia[pendingMarketAttachment.type] = pendingMarketAttachment.data;
        }

        const newMsg = {
            id: 'msg_' + Date.now() + '_' + Math.floor(Math.random()*100),
            bird_id: birdId,
            sender_name: currentUser.name || 'Buyer',
            sender_email: currentUser.email || 'buyer@avinest.com',
            message: text,
            image: extraMedia.image || null,
            video: extraMedia.video || null,
            audio: extraMedia.audio || null,
            timestamp: timestamp,
            seen: false
        };

        // 1. Save Chat History locally
        let chatHistory = getStoredChat(birdId);
        chatHistory.push(newMsg);
        saveStoredChat(birdId, chatHistory);

        // 2. Save Inquiry to Seller's Dashboard Inbox with unread status!
        let inquiries = [];
        try {
            const storedInq = sessionStorage.getItem('avinest_inquiries');
            if (storedInq) inquiries = JSON.parse(storedInq);
        } catch(e) {}

        inquiries.unshift({
            id: 'inq_' + Date.now(),
            seller_name: sellerName,
            buyer_name: currentUser.name || 'Buyer',
            buyer_email: currentUser.email || 'buyer@avinest.com',
            message: text || (extraMedia.image ? '📷 Attachment Photo' : (extraMedia.video ? '🎥 Attachment Video' : '🎙️ Voice Note')),
            image: extraMedia.image || null,
            video: extraMedia.video || null,
            audio: extraMedia.audio || null,
            bird_title: document.getElementById('chat-bird-title').textContent || 'Bird Listing',
            date_sent: timestamp,
            seen: false
        });
        sessionStorage.setItem('avinest_inquiries', JSON.stringify(inquiries));

        // 3. Smooth Zero-Refresh Render
        renderChatMessages(chatHistory);
        cancelChatAttachment();

        fetch('api/chat.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newMsg)
        });
    }

    function sendQuickMessage(text) {
        sendChatMessage(text);
    }

    function updateBlockUI(sellerName) {
        let blocked = JSON.parse(sessionStorage.getItem('avinest_blocked_users') || '[]');
        const isBlocked = blocked.includes(sellerName);
        const btn = document.getElementById('toggle-block-btn');
        const input = document.getElementById('chat-input-text');
        
        if (btn) {
            if (isBlocked) {
                btn.className = 'bg-slate-700 hover:bg-slate-800 text-white text-[11px] px-2.5 py-1 rounded-lg font-bold transition-all flex items-center gap-1 cursor-pointer border border-red-500';
                btn.innerHTML = '<span class="material-symbols-outlined text-sm text-red-400">lock_open</span> Unblock';
            } else {
                btn.className = 'bg-red-600/80 hover:bg-red-600 text-white text-[11px] px-2.5 py-1 rounded-lg font-bold transition-all flex items-center gap-1 cursor-pointer';
                btn.innerHTML = '<span class="material-symbols-outlined text-sm">block</span> Block';
            }
        }

        if (input) {
            if (isBlocked) {
                input.disabled = true;
                input.placeholder = "🚫 User is blocked. Unblock to send messages.";
                input.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                input.disabled = false;
                input.placeholder = "Write a message to buy...";
                input.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    }

    function markPostAsSold(birdId) {
        const executeMark = () => {
            // Update session storage
            try {
                const stored = sessionStorage.getItem('avinest_listings');
                if (stored) {
                    let listings = JSON.parse(stored);
                    listings.forEach(l => {
                        if (String(l.id) === String(birdId)) l.status = 'sold';
                    });
                    sessionStorage.setItem('avinest_listings', JSON.stringify(listings));
                }
            } catch(e) {}

            fetch('api/birds.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'mark_sold', bird_id: birdId })
            }).finally(() => {
                if (window.showToast) window.showToast("🏷️ Listing marked as SOLD!");
                renderFeed();
            });
        };

        if (window.showConfirmModal) {
            window.showConfirmModal({
                title: "Mark Listing as SOLD",
                message: "Are you sure you want to mark this bird listing as SOLD? Other users will no longer be able to initiate new buy chats for this item.",
                icon: "check_circle",
                confirmText: "Yes, Mark as SOLD",
                cancelText: "Cancel",
                onConfirm: () => {
                    executeMark();
                }
            });
        } else if (confirm("Are you sure you want to mark this bird listing as SOLD?")) {
            executeMark();
        }
    }
</script>

</body>
</html>
