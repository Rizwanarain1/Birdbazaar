<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>BirdBazaar | User Dashboard</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- Custom CSS & Tailwind -->
    <link href="styles.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-surface": "#121c2a",
                        "primary-fixed": "#c0edd4",
                        "primary": "#002d1d",
                        "primary-container": "#1a4332",
                        "surface-bright": "#f8f9ff",
                        "surface-variant": "#d9e3f6",
                        "background": "#f8f9ff",
                        "outline": "#717973",
                        "surface-container-low": "#eff4fa",
                        "outline-variant": "#c1c8c2",
                        "tertiary": "#735c00"
                    },
                    spacing: {
                        "margin-desktop": "64px",
                        "container-max": "1280px"
                    },
                    fontFamily: {
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
<body class="bg-surface text-on-surface dark:bg-on-surface dark:text-surface-bright font-body-md min-h-screen">

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
        <a href="marketplace.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">storefront</span>Marketplace</a>
        <a href="user-dashboard.php" class="text-white font-semibold px-4 py-3 rounded-xl bg-emerald-700/30 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">dashboard</span>My Dashboard</a>
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
<header class="sticky top-0 z-40 flex justify-between items-center px-4 sm:px-6 md:px-margin-desktop py-4 w-full max-w-container-max mx-auto bg-surface/80 dark:bg-on-surface/80 backdrop-blur-md shadow-sm border-b border-outline-variant/20">
    <div class="flex items-center gap-2">
        <span class="text-2xl">🦜</span>
        <span class="font-display-lg text-headline-md font-bold text-primary dark:text-primary-fixed cursor-pointer" onclick="window.location.href='index.php'">BirdBazaar</span>
        <span class="bg-primary-container text-primary font-bold text-xs px-2.5 py-0.5 rounded-full ml-2 hidden sm:inline">User Portal</span>
    </div>
    <nav class="hidden md:flex items-center gap-8 font-label-md">
        <a class="text-on-surface-variant hover:text-primary dark:text-surface-variant" href="index.php">Home</a>
        <a class="text-on-surface-variant hover:text-primary dark:text-surface-variant" href="parrots.php">Categories</a>
        <a class="text-on-surface-variant hover:text-primary dark:text-surface-variant" href="marketplace.php">Marketplace Feed</a>
    </nav>
    <div class="flex items-center gap-2">
        <div id="header-auth-container" class="flex items-center gap-2"></div>
        <!-- Hamburger Button (mobile only) -->
        <button onclick="openMobNav()" class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-primary/10 text-primary dark:text-emerald-300">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>

<main class="max-w-container-max mx-auto px-3 sm:px-6 md:px-margin-desktop py-6 sm:py-8 animate-fade-in w-full overflow-hidden">
    <!-- User Overview Banner -->
    <div class="bg-surface-container-low dark:bg-on-surface/40 rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 mb-6 sm:mb-8 border border-outline-variant/30 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4 sm:gap-6 w-full">
        <div class="flex items-center gap-3 sm:gap-4 min-w-0">
            <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-primary text-white font-bold text-xl sm:text-2xl flex items-center justify-center shadow-md flex-shrink-0" id="user-avatar-text">
                U
            </div>
            <div class="min-w-0">
                <div class="flex items-center gap-2 flex-wrap">
                    <h2 class="font-display-lg text-xl sm:text-2xl font-bold text-primary dark:text-primary-fixed truncate" id="user-display-name">Member User</h2>
                    <span class="bg-emerald-100 text-emerald-800 text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full font-bold flex-shrink-0">Verified Owner</span>
                </div>
                <p class="text-on-surface-variant text-xs sm:text-sm truncate" id="user-display-email">member@birdbazaar.com</p>
                <p class="text-outline text-[10px] sm:text-xs mt-0.5 truncate">Verified Member • Joined August 2026</p>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 sm:gap-3 w-full md:w-auto">
            <button onclick="window.triggerListingModal ? window.triggerListingModal() : null" class="bg-tertiary text-white px-4 sm:px-5 py-2.5 rounded-xl font-label-md text-xs sm:text-sm hover:bg-tertiary/90 transition-all flex items-center justify-center gap-2 shadow-md cursor-pointer w-full sm:w-auto">
                <span class="material-symbols-outlined text-base sm:text-lg">add_circle</span>
                Post New Bird Listing
            </button>
            <button id="user-logout-btn" class="border border-error text-error hover:bg-error-container hover:text-on-error-container px-4 py-2.5 rounded-xl font-label-md text-xs sm:text-sm transition-all flex items-center justify-center gap-1 cursor-pointer w-full sm:w-auto">
                <span class="material-symbols-outlined text-base sm:text-lg">logout</span>
                Logout
            </button>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-8 sm:mb-10 w-full">
        <div class="p-4 sm:p-6 rounded-2xl bg-surface-container-low dark:bg-on-surface/30 border border-outline-variant/20 shadow-sm flex items-center gap-3 sm:gap-4 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-primary-container text-primary flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-xl sm:text-2xl">pets</span>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] sm:text-xs text-outline font-medium truncate">My Active Listings</p>
                <h3 class="text-lg sm:text-2xl font-bold text-primary dark:text-primary-fixed truncate" id="stat-my-listings">0</h3>
            </div>
        </div>
        <div class="p-4 sm:p-6 rounded-2xl bg-surface-container-low dark:bg-on-surface/30 border border-outline-variant/20 shadow-sm flex items-center gap-3 sm:gap-4 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-secondary-container text-on-secondary-fixed-variant flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-xl sm:text-2xl">mail</span>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] sm:text-xs text-outline font-medium truncate">Inquiries Received</p>
                <h3 class="text-lg sm:text-2xl font-bold text-primary dark:text-primary-fixed truncate" id="stat-my-inquiries">0</h3>
            </div>
        </div>
        <div class="p-4 sm:p-6 rounded-2xl bg-surface-container-low dark:bg-on-surface/30 border border-outline-variant/20 shadow-sm flex items-center gap-3 sm:gap-4 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-xl sm:text-2xl">verified</span>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] sm:text-xs text-outline font-medium truncate">Account Trust Rating</p>
                <h3 class="text-lg sm:text-2xl font-bold text-primary dark:text-primary-fixed truncate">4.9 ★</h3>
            </div>
        </div>
    </div>

    <!-- My Listings Section -->
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-display-lg text-xl font-bold text-primary dark:text-primary-fixed flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">storefront</span>
                My Avian Listings
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="my-listings-grid">
            <!-- Rendered dynamically -->
        </div>
    </div>

    <!-- Received Buyer Inquiries Section -->
    <div>
        <h3 class="font-display-lg text-xl font-bold text-primary dark:text-primary-fixed mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">mark_email_unread</span>
            Received Buyer Inquiries
        </h3>
        <div class="bg-white dark:bg-on-surface/40 rounded-2xl shadow-sm border border-outline-variant/20 overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-outline-variant/20 bg-surface-container-low dark:bg-on-surface/60 text-label-md text-outline">
                        <th class="p-4">Buyer Name</th>
                        <th class="p-4">Buyer Email</th>
                        <th class="p-4">Message</th>
                        <th class="p-4">Date</th>
                    </tr>
                </thead>
                <tbody id="inquiries-tbody">
                    <!-- Rendered dynamically -->
                </tbody>
            </table>
        </div>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Load User Profile Data from Session
        const currentData = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
        
        if (currentData) {
            document.getElementById('user-display-name').textContent = currentData.name || 'Avian Breeder';
            document.getElementById('user-display-email').textContent = currentData.email || 'user@avinest.com';
            document.getElementById('user-display-role').textContent = (currentData.role || 'user').toUpperCase();
            document.getElementById('user-avatar-box').textContent = (currentData.name || 'U').charAt(0).toUpperCase();
        }

        loadUserNotifications();
        fetchMyListings();
        fetchMyInquiries();

        document.getElementById('user-logout-btn').addEventListener('click', () => {
            if (window.logoutCurrentUser) {
                window.logoutCurrentUser();
            } else {
                sessionStorage.removeItem('avinest_current_user');
                window.location.href = 'index.php';
            }
        });
    });

    function loadUserNotifications() {
        const container = document.getElementById('notifications-container');
        if (!container) return;
        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || '{}');
        let notifications = [];
        try {
            const stored = sessionStorage.getItem('avinest_user_notifications');
            if (stored) notifications = JSON.parse(stored);
        } catch(e) {}

        const myNotifs = notifications.filter(n => n.user_email === currentUser.email);
        container.innerHTML = '';
        if (myNotifs.length > 0) {
            myNotifs.forEach((n, idx) => {
                const alertBox = document.createElement('div');
                alertBox.className = 'bg-red-100 dark:bg-red-900/40 border-l-4 border-red-600 text-red-900 dark:text-red-200 p-4 rounded-2xl shadow-md mb-6 animate-fade-in flex items-center justify-between gap-4';
                alertBox.innerHTML = `
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-600 text-2xl">error</span>
                        <div>
                            <h4 class="font-bold text-sm">Post Deletion & Email Notice</h4>
                            <p class="text-xs">${n.message} (Email alert dispatched to <strong>${n.email_sent_to}</strong>)</p>
                        </div>
                    </div>
                    <button onclick="dismissNotif(${idx})" class="text-xs font-bold text-red-700 dark:text-red-300 hover:underline cursor-pointer bg-red-200 dark:bg-red-800/60 px-3 py-1 rounded-lg">Dismiss Alert</button>
                `;
                container.appendChild(alertBox);
            });
        }
    }

    window.dismissNotif = function(index) {
        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || '{}');
        try {
            const stored = sessionStorage.getItem('avinest_user_notifications');
            if (stored) {
                let notifications = JSON.parse(stored);
                let count = 0;
                notifications = notifications.filter(n => {
                    if (n.user_email === currentUser.email) {
                        if (count === index) { count++; return false; }
                        count++;
                    }
                    return true;
                });
                sessionStorage.setItem('avinest_user_notifications', JSON.stringify(notifications));
            }
        } catch(e) {}
        loadUserNotifications();
    };

    function fetchMyListings() {
        const grid = document.getElementById('my-listings-grid');
        if (!grid) return;
        grid.innerHTML = '';
        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || '{}');

        let sessionListings = [];
        try {
            const stored = sessionStorage.getItem('avinest_listings');
            if (stored) sessionListings = JSON.parse(stored);
        } catch(e) {}

        let userPosts = sessionListings.filter(l => 
            (l.breeder && currentUser.name && l.breeder.toLowerCase() === currentUser.name.toLowerCase()) ||
            (l.email && currentUser.email && l.email.toLowerCase() === currentUser.email.toLowerCase()) ||
            String(l.user_id) === String(currentUser.id)
        );

        fetch('api/birds.php')
            .then(res => res.json())
            .then(data => {
                let dbData = [];
                if (data.success && Array.isArray(data.data)) {
                    dbData = data.data.filter(l => 
                        (l.breeder && currentUser.name && l.breeder.toLowerCase() === currentUser.name.toLowerCase()) ||
                        String(l.user_id) === String(currentUser.id)
                    );
                }
                if (dbData.length > 0) {
                    sessionStorage.removeItem('avinest_listings');
                    renderMyListingsCards(dbData, []);
                } else {
                    renderMyListingsCards([], userPosts);
                }
            })
            .catch(() => {
                renderMyListingsCards([], userPosts);
            });
    }

    function renderMyListingsCards(dbData, userPosts) {
        const grid = document.getElementById('my-listings-grid');
        if (!grid) return;
        
        const uniqueFeed = [];
        const seenIds = new Set();
        const seenKeys = new Set();

        [...dbData, ...userPosts].forEach(item => {
            const idStr = String(item.id);
            const key = (item.name || '').toLowerCase().trim() + '_' + Math.round(Number(item.price));
            if (!seenIds.has(idStr) && !seenKeys.has(key)) {
                seenIds.add(idStr);
                seenKeys.add(key);
                uniqueFeed.push(item);
            }
        });
        const combined = uniqueFeed;

        document.getElementById('stat-my-listings').textContent = combined.length;
        grid.innerHTML = '';

        if (combined.length === 0) {
            grid.innerHTML = `
                <div class="col-span-full py-8 text-center bg-white dark:bg-on-surface/30 rounded-2xl p-6 border border-outline-variant/20">
                    <span class="material-symbols-outlined text-outline text-4xl mb-2">storefront</span>
                    <p class="text-on-surface-variant font-bold text-sm">No listings found for your account.</p>
                    <p class="text-outline text-xs mt-1 mb-4">Click below to post your bird for sale on the Marketplace!</p>
                    <button onclick="window.triggerListingModal ? window.triggerListingModal() : null" class="bg-tertiary text-white px-4 py-2 rounded-xl text-xs font-bold inline-flex items-center gap-1 cursor-pointer">
                        <span class="material-symbols-outlined text-sm">add_circle</span> Post Bird Listing
                    </button>
                </div>
            `;
            return;
        }

        combined.forEach(bird => {
            const hasVideo = !!bird.video;
            const photoCount = Array.isArray(bird.images) && bird.images.length > 0 ? bird.images.length : 1;

            const card = document.createElement('div');
            card.id = 'dash-card-' + bird.id;
            card.className = 'bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shadow-md hover:shadow-xl border border-slate-200 dark:border-slate-800 p-5 flex flex-col justify-between transition-all duration-300';
            card.innerHTML = `
                <div>
                    <div class="h-48 rounded-2xl overflow-hidden mb-4 relative bg-slate-900 shadow-inner">
                        <img src="${bird.image || 'images/african_grey.png'}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="${bird.name}" />
                        <span class="absolute top-3 right-3 bg-emerald-800/90 text-white text-xs px-3.5 py-1.5 rounded-2xl font-extrabold shadow-md border border-white/20">
                            PKR ${Number(bird.price).toLocaleString()}
                        </span>
                        <div class="absolute bottom-3 left-3 flex gap-1.5">
                            <span class="bg-black/60 backdrop-blur-md text-white text-[10px] px-2.5 py-1 rounded-full font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs text-emerald-400">photo_library</span> ${photoCount} ${photoCount === 1 ? 'Photo' : 'Photos'}
                            </span>
                            ${hasVideo ? `
                                <span class="bg-emerald-600/90 backdrop-blur-md text-white text-[10px] px-2.5 py-1 rounded-full font-bold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">videocam</span> Video Clip
                                </span>
                            ` : ''}
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between items-start">
                            <h4 class="font-bold text-base text-slate-900 dark:text-white leading-tight">${bird.name}</h4>
                            <span class="bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-[11px] px-2.5 py-0.5 rounded-full font-extrabold whitespace-nowrap">
                                ${bird.category || 'Parrots'}
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs text-emerald-600">location_on</span> ${bird.origin || 'Pakistan'} • <span class="material-symbols-outlined text-xs">calendar_month</span> ${bird.date || 'Recent'}
                        </p>
                        <p class="text-xs text-slate-600 dark:text-slate-300 line-clamp-2 italic">${bird.description || 'Health checked, hand-reared bird listing.'}</p>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-slate-100 dark:border-slate-800/80 gap-2">
                    <button onclick='openListingDetailsModal(${JSON.stringify(bird).replace(/'/g, "&apos;")})' class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-3 rounded-xl text-xs shadow-sm transition-all flex items-center justify-center gap-1 cursor-pointer">
                        <span class="material-symbols-outlined text-sm">visibility</span> View Details
                    </button>
                    <button onclick="deleteMyListing('${bird.id}', '${(bird.name || '').replace(/'/g, "\\'")}')" class="bg-red-100 dark:bg-red-950/60 hover:bg-red-600 text-red-600 hover:text-white font-bold py-2.5 px-3 rounded-xl text-xs transition-all flex items-center gap-1 cursor-pointer" title="Delete Listing">
                        <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                </div>
            `;
            grid.appendChild(card);
        });
    }

    function fetchMyInquiries() {
        const tbody = document.getElementById('inquiries-tbody');
        if (!tbody) return;
        tbody.innerHTML = '';
        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || '{}');
        let blocked = JSON.parse(sessionStorage.getItem('avinest_blocked_users') || '[]');

        let inquiries = [];
        try {
            const stored = sessionStorage.getItem('avinest_inquiries');
            if (stored) inquiries = JSON.parse(stored);
        } catch(e) {}

        const userInq = inquiries.filter(i => 
            !i.seller_name || i.seller_name.toLowerCase() === (currentUser.name || '').toLowerCase()
        );

        document.getElementById('stat-my-inquiries').textContent = userInq.length;

        if (userInq.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="p-6 text-center text-outline text-xs italic">
                        No buyer inquiries received yet.
                    </td>
                </tr>
            `;
            return;
        }

        userInq.forEach((inq) => {
            const isBlocked = blocked.includes(inq.buyer_name);
            const isUnread = inq.seen === false;

            const tr = document.createElement('tr');
            tr.className = `border-b border-outline-variant/10 hover:bg-surface-container-low dark:hover:bg-on-surface/50 text-xs text-on-surface transition-colors ${isUnread ? 'bg-emerald-50/70 dark:bg-emerald-950/30 font-semibold' : ''}`;
            tr.innerHTML = `
                <td class="p-4 font-bold text-primary dark:text-primary-fixed flex items-center gap-2">
                    ${isUnread ? '<span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>' : ''}
                    <span>${inq.buyer_name || 'Anonymous'}</span>
                    ${isBlocked ? '<span class="bg-red-100 text-red-700 text-[10px] px-1.5 py-0.5 rounded font-bold">BLOCKED</span>' : ''}
                </td>
                <td class="p-4 text-outline font-mono text-[11px]">${inq.buyer_email || 'n/a'}</td>
                <td class="p-4 max-w-xs truncate text-on-surface-variant dark:text-surface-variant">
                    <span class="font-bold text-emerald-700 dark:text-emerald-300 mr-1">[${inq.bird_title || 'Listing'}]:</span>
                    ${inq.message || 'Interested in your bird listing.'}
                </td>
                <td class="p-4 text-outline text-[11px] whitespace-nowrap">${inq.date_sent || 'Recent'}</td>
                <td class="p-4 text-right">
                    <div class="flex items-center justify-end gap-1.5">
                        <button onclick="openChatThreadModal('${(inq.buyer_name || '').replace(/'/g, "\\'")}', '${(inq.buyer_email || '').replace(/'/g, "\\'")}', '${(inq.bird_title || '').replace(/'/g, "\\'")}')" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-[11px] px-3 py-1.5 rounded-xl shadow-sm hover:from-emerald-500 hover:to-teal-500 transition-all flex items-center gap-1 cursor-pointer">
                            <span class="material-symbols-outlined text-xs">chat</span> Open Chat Thread
                        </button>
                        <button onclick="toggleBlockUser('${(inq.buyer_name || '').replace(/'/g, "\\'")}')" class="${isBlocked ? 'bg-slate-700 text-white' : 'bg-red-100 text-red-700 hover:bg-red-600 hover:text-white'} font-bold text-[11px] px-2.5 py-1.5 rounded-xl transition-all flex items-center gap-1 cursor-pointer" title="${isBlocked ? 'Unblock User' : 'Block User'}">
                            <span class="material-symbols-outlined text-xs">${isBlocked ? 'lock_open' : 'block'}</span>
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    let dashMediaRecorder = null;
    let dashAudioChunks = [];
    let isRecordingDashVoice = false;
    let pendingDashAttachment = null;

    function clearDashAttachment() {
        pendingDashAttachment = null;
        const modal = document.getElementById('dash-chat-modal');
        if (modal) {
            const preview = modal.querySelector('#dash-attachment-preview');
            if (preview) preview.classList.add('hidden');
        }
    }

    window.toggleDashboardVoiceRecording = async function() {
        const modal = document.getElementById('dash-chat-modal');
        if (!modal) return;
        const micBtn = modal.querySelector('#dash-mic-btn');

        if (isRecordingDashVoice) {
            if (dashMediaRecorder && dashMediaRecorder.state !== 'inactive') {
                dashMediaRecorder.stop();
            }
            isRecordingDashVoice = false;
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

            dashMediaRecorder = new MediaRecorder(stream, { mimeType });
            dashAudioChunks = [];

            dashMediaRecorder.ondataavailable = e => {
                if (e.data && e.data.size > 0) dashAudioChunks.push(e.data);
            };

            dashMediaRecorder.onstop = () => {
                const audioBlob = new Blob(dashAudioChunks, { type: mimeType });
                const reader = new FileReader();
                reader.onload = e => {
                    pendingDashAttachment = { type: 'audio', data: e.target.result };
                    const preview = modal.querySelector('#dash-attachment-preview');
                    const label = modal.querySelector('#dash-preview-label');
                    const thumb = modal.querySelector('#dash-preview-thumb');
                    if (label) label.textContent = 'Voice Note recorded! Click send below.';
                    if (thumb) thumb.innerHTML = `<span class="material-symbols-outlined text-emerald-400 text-xl">mic</span>`;
                    if (preview) preview.classList.remove('hidden');
                };
                reader.readAsDataURL(audioBlob);
                stream.getTracks().forEach(track => track.stop());
            };

            dashMediaRecorder.start(100);
            isRecordingDashVoice = true;

            if (micBtn) {
                micBtn.className = 'text-red-500 animate-pulse p-1 cursor-pointer font-bold flex items-center gap-1 scale-110';
                micBtn.title = "Recording... Click Mic to Stop & Send Voice Note";
            }

            if (window.showToast) window.showToast("🎙️ Voice Recording Started! Speak into your microphone.", false);
        } catch(err) {
            console.error("Microphone recording error:", err);
            if (window.showToast) window.showToast("⚠️ Microphone access failed or denied.", true);
        }
    };

    window.insertDashEmoji = function(emoji) {
        const modal = document.getElementById('dash-chat-modal');
        if (!modal) return;
        const input = modal.querySelector('#dash-chat-input');
        if (input) {
            input.value += emoji;
            input.focus();
        }
    };

    window.openChatThreadModal = function(buyerName, buyerEmail, birdTitle) {
        let modal = document.getElementById('dash-chat-modal');
        if (modal) modal.remove();

        let blocked = JSON.parse(sessionStorage.getItem('avinest_blocked_users') || '[]');
        const isBlocked = blocked.includes(buyerName);

        modal = document.createElement('div');
        modal.id = 'dash-chat-modal';
        modal.className = 'fixed inset-0 bg-black/75 backdrop-blur-sm z-[160] flex items-center justify-center p-2 sm:p-4 animate-fade-in';
        modal.innerHTML = `
            <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl w-full max-w-lg shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col h-[85vh] max-h-[560px]">
                <!-- Header -->
                <div class="bg-gradient-to-r from-emerald-800 to-teal-900 text-white p-4 flex items-center justify-between shadow-md">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-500 text-slate-950 font-bold flex items-center justify-center text-base shadow-sm">
                            ${buyerName.charAt(0).toUpperCase()}
                        </div>
                        <div>
                            <h4 class="font-bold text-sm leading-tight flex items-center gap-1.5">
                                <span>${buyerName}</span>
                                ${isBlocked ? '<span class="bg-red-600 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">BLOCKED</span>' : ''}
                            </h4>
                            <p class="text-[11px] text-emerald-200 font-mono">${buyerEmail}</p>
                        </div>
                    </div>
                    <button id="close-dash-chat-btn" class="text-emerald-200 hover:text-white transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-2xl">close</span>
                    </button>
                </div>

                <!-- Messages Body -->
                <div id="dash-chat-messages" class="flex-1 p-4 overflow-y-auto space-y-3 bg-slate-50 dark:bg-slate-950/60 custom-scrollbar text-xs">
                    <div class="text-center text-[11px] text-slate-400 py-1">
                        🔒 Direct Seller-Buyer Messenger Thread
                    </div>
                </div>

                <!-- Attachment Preview -->
                <div id="dash-attachment-preview" class="hidden px-3 py-2 bg-emerald-100 dark:bg-emerald-950 border-t border-emerald-300 dark:border-emerald-800 flex items-center justify-between animate-fade-in">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div id="dash-preview-thumb" class="w-10 h-10 rounded-xl overflow-hidden bg-black flex items-center justify-center flex-shrink-0 text-white text-xs border border-white/20"></div>
                        <div>
                            <p id="dash-preview-label" class="font-bold text-xs text-emerald-900 dark:text-emerald-200 truncate">Attachment selected</p>
                            <p class="text-[10px] text-emerald-700 dark:text-emerald-400">⚡ Instant Send Attachment</p>
                        </div>
                    </div>
                    <button type="button" onclick="clearDashAttachment()" class="text-slate-500 hover:text-red-600 p-1 cursor-pointer">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>

                <!-- Emojis -->
                <div class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800/80 border-t border-slate-200 dark:border-slate-800 flex gap-1.5 overflow-x-auto text-[11px] items-center scrollbar-none">
                    <button type="button" onclick="insertDashEmoji('😀')" class="hover:scale-125 transition-transform">😀</button>
                    <button type="button" onclick="insertDashEmoji('😊')" class="hover:scale-125 transition-transform">😊</button>
                    <button type="button" onclick="insertDashEmoji('👍')" class="hover:scale-125 transition-transform">👍</button>
                    <button type="button" onclick="insertDashEmoji('❤️')" class="hover:scale-125 transition-transform">❤️</button>
                    <button type="button" onclick="insertDashEmoji('🦜')" class="hover:scale-125 transition-transform">🦜</button>
                    <button type="button" onclick="insertDashEmoji('💰')" class="hover:scale-125 transition-transform">💰</button>
                    <button type="button" onclick="insertDashEmoji('✅')" class="hover:scale-125 transition-transform">✅</button>
                    <button type="button" onclick="insertDashEmoji('🙏')" class="hover:scale-125 transition-transform">🙏</button>
                </div>

                <!-- Input Form -->
                <form id="dash-chat-form" class="p-2 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 flex gap-1.5 items-center">
                    <input type="file" id="dash-file-image" accept="image/*" class="hidden" />
                    <input type="file" id="dash-file-video" accept="video/*" class="hidden" />
                    <input type="file" id="dash-file-audio" accept="audio/*" class="hidden" />

                    <button type="button" onclick="document.getElementById('dash-file-image').click()" ${isBlocked ? 'disabled' : ''} class="text-slate-400 hover:text-emerald-600 transition-colors p-1 cursor-pointer ${isBlocked ? 'opacity-50' : ''}" title="Attach Photo">
                        <span class="material-symbols-outlined text-xl">image</span>
                    </button>
                    <button type="button" onclick="document.getElementById('dash-file-video').click()" ${isBlocked ? 'disabled' : ''} class="text-slate-400 hover:text-emerald-600 transition-colors p-1 cursor-pointer ${isBlocked ? 'opacity-50' : ''}" title="Attach Video Clip">
                        <span class="material-symbols-outlined text-xl">videocam</span>
                    </button>
                    <button type="button" id="dash-mic-btn" onclick="toggleDashboardVoiceRecording()" ${isBlocked ? 'disabled' : ''} class="text-slate-400 hover:text-emerald-600 transition-colors p-1 cursor-pointer ${isBlocked ? 'opacity-50' : ''}" title="Record Voice Note / Attach Audio">
                        <span class="material-symbols-outlined text-xl">mic</span>
                    </button>

                    <input type="text" id="dash-chat-input" ${isBlocked ? 'disabled placeholder="🚫 User is blocked."' : 'placeholder="Type message or caption text..."'} class="flex-1 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-800 p-2 text-xs focus:outline-none focus:ring-1 focus:ring-emerald-500 ${isBlocked ? 'opacity-50' : ''}" />
                    
                    <button type="submit" ${isBlocked ? 'disabled' : ''} class="bg-emerald-600 hover:bg-emerald-500 text-white p-2 rounded-xl shadow-md transition-all flex items-center justify-center cursor-pointer ${isBlocked ? 'opacity-50' : ''}">
                        <span class="material-symbols-outlined text-lg">send</span>
                    </button>
                </form>
            </div>
        `;
        document.body.appendChild(modal);

        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || '{}');
        const container = modal.querySelector('#dash-chat-messages');

        const renderMessageBubble = (m) => {
            const isMe = m.sender_email === currentUser.email || m.sender_name === currentUser.name;
            const bubble = document.createElement('div');
            bubble.className = `flex flex-col ${isMe ? 'items-end' : 'items-start'}`;

            let mediaHtml = '';
            if (m.image) mediaHtml += `<img src="${m.image}" class="max-w-xs rounded-xl my-1 border border-white/20 shadow-md" />`;
            if (m.video) mediaHtml += `<video controls playsinline preload="metadata" src="${m.video}" class="max-w-xs rounded-xl my-1 border border-white/20 shadow-md bg-black"></video>`;
            if (m.audio) mediaHtml += `<audio controls src="${m.audio}" class="my-1 max-w-[220px]"></audio>`;

            const doubleTick = isMe ? `<span class="text-sky-300 font-extrabold text-[10px] ml-1">✔✔</span>` : '';

            bubble.innerHTML = `
                <div class="max-w-[85%] rounded-2xl p-3 text-xs ${isMe ? 'bg-emerald-700 text-white rounded-br-none' : 'bg-slate-200 dark:bg-slate-800 text-slate-900 dark:text-white rounded-bl-none'} shadow-sm">
                    <span class="font-bold block text-[10px] ${isMe ? 'text-emerald-200' : 'text-slate-500'}">${m.sender_name || m.buyer_name}</span>
                    ${mediaHtml}
                    ${m.message ? `<p class="leading-relaxed mt-0.5">${m.message}</p>` : ''}
                    <span class="text-[9px] block text-right mt-1 opacity-70 flex items-center justify-end gap-0.5">
                        ${m.date_sent || m.timestamp || 'Now'} ${doubleTick}
                    </span>
                </div>
            `;
            container.appendChild(bubble);
            container.scrollTop = container.scrollHeight;
        };

        // Gather thread messages
        let inquiries = [];
        try {
            const storedInq = sessionStorage.getItem('avinest_inquiries');
            if (storedInq) inquiries = JSON.parse(storedInq);
        } catch(e) {}

        const buyerMsgs = inquiries.filter(i => (i.buyer_name && i.buyer_name.toLowerCase() === buyerName.toLowerCase()) || (i.buyer_email && i.buyer_email.toLowerCase() === buyerEmail.toLowerCase()));
        buyerMsgs.forEach(m => renderMessageBubble(m));

        modal.querySelector('#close-dash-chat-btn').addEventListener('click', () => modal.remove());

        // File Selection Handlers with Preview Card!
        const showPreview = (type, b64, fileName) => {
            pendingDashAttachment = { type, data: b64 };
            const preview = modal.querySelector('#dash-attachment-preview');
            const thumb = modal.querySelector('#dash-preview-thumb');
            const label = modal.querySelector('#dash-preview-label');

            label.textContent = `Attached ${type.toUpperCase()}: ${fileName}`;
            if (type === 'image') {
                thumb.innerHTML = `<img src="${b64}" class="w-full h-full object-cover" />`;
            } else if (type === 'video') {
                thumb.innerHTML = `<video src="${b64}" class="w-full h-full object-cover bg-black"></video>`;
            } else if (type === 'audio') {
                thumb.innerHTML = `<span class="material-symbols-outlined text-emerald-400 text-xl">mic</span>`;
            }
            preview.classList.remove('hidden');
        };

        modal.querySelector('#dash-file-image').addEventListener('change', function() {
            if (!this.files || !this.files[0]) return;
            const file = this.files[0];
            const r = new FileReader();
            r.onload = e => {
                showPreview('image', e.target.result, file.name);
                sendDashboardMsg('');
                this.value = '';
            };
            r.readAsDataURL(file);
        });

        modal.querySelector('#dash-file-video').addEventListener('change', function() {
            if (!this.files || !this.files[0]) return;
            const file = this.files[0];
            const r = new FileReader();
            r.onload = e => {
                showPreview('video', e.target.result, file.name);
                sendDashboardMsg('');
                this.value = '';
            };
            r.readAsDataURL(file);
        });

        modal.querySelector('#dash-file-audio').addEventListener('change', function() {
            if (!this.files || !this.files[0]) return;
            const file = this.files[0];
            const r = new FileReader();
            r.onload = e => {
                showPreview('audio', e.target.result, file.name);
                sendDashboardMsg('');
                this.value = '';
            };
            r.readAsDataURL(file);
        });

        const sendDashboardMsg = (text) => {
            const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            
            let extraMedia = {};
            if (pendingDashAttachment) {
                extraMedia[pendingDashAttachment.type] = pendingDashAttachment.data;
            }

            const replyObj = {
                id: 'inq_' + Date.now(),
                seller_name: currentUser.name || 'Seller',
                buyer_name: buyerName,
                buyer_email: buyerEmail,
                sender_name: currentUser.name || 'Seller',
                sender_email: currentUser.email || 'seller@avinest.com',
                message: text,
                image: extraMedia.image || null,
                video: extraMedia.video || null,
                audio: extraMedia.audio || null,
                date_sent: timeStr,
                seen: true
            };

            inquiries.push(replyObj);
            sessionStorage.setItem('avinest_inquiries', JSON.stringify(inquiries));

            // Smooth Append without modal refresh!
            renderMessageBubble(replyObj);
            clearDashAttachment();
        };

        // Form Submit Handler
        modal.querySelector('#dash-chat-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const input = modal.querySelector('#dash-chat-input');
            const text = input.value.trim();
            if (!text && !pendingDashAttachment) return;

            sendDashboardMsg(text);
            input.value = '';
        });
    };

    window.replyToBuyer = function(buyerName, buyerEmail) {
        if (window.showCustomModal) {
            window.showCustomModal({
                title: `💬 Deal & Reply to ${buyerName}`,
                message: `Send direct deal response or price offer to ${buyerEmail}:`,
                icon: "chat",
                type: "primary",
                buttonText: "Open Marketplace Messenger",
                onAction: () => {
                    window.location.href = 'marketplace.php';
                }
            });
        }
    };

    window.toggleBlockUser = function(userName) {
        let blocked = JSON.parse(sessionStorage.getItem('avinest_blocked_users') || '[]');
        if (blocked.includes(userName)) {
            blocked = blocked.filter(u => u !== userName);
            sessionStorage.setItem('avinest_blocked_users', JSON.stringify(blocked));
            if (window.showToast) window.showToast(`🔓 Unblocked ${userName}`);
            if (typeof fetchMyInquiries === 'function') fetchMyInquiries();
        } else {
            if (window.showConfirmModal) {
                window.showConfirmModal({
                    title: "Block User",
                    message: `Are you sure you want to block ${userName}? They will no longer be able to message you or deal with your listings.`,
                    icon: "block",
                    confirmText: "Yes, Block User",
                    cancelText: "Cancel",
                    onConfirm: () => {
                        blocked.push(userName);
                        sessionStorage.setItem('avinest_blocked_users', JSON.stringify(blocked));
                        if (window.showToast) window.showToast(`🚫 Blocked ${userName}`);
                        if (typeof fetchMyInquiries === 'function') fetchMyInquiries();
                    }
                });
            }
        }
    };

    window.deleteMyListing = function(birdId, birdName) {
        const executeDelete = () => {
            const cardElem = document.getElementById('dash-card-' + birdId);
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
                    if (window.showToast) window.showToast("🗑️ Your listing has been deleted successfully!");
                });
        };

        if (window.showConfirmModal) {
            window.showConfirmModal({
                title: "Delete Your Bird Listing",
                message: "Are you sure you want to delete this listing? It will be permanently removed from the Marketplace and your dashboard.",
                icon: "delete",
                confirmText: "Yes, Delete Listing",
                cancelText: "Cancel",
                onConfirm: () => {
                    executeDelete();
                }
            });
        } else if (confirm("Are you sure you want to delete this bird listing?")) {
            executeDelete();
        }
    };
</script>
</body>
</html>
