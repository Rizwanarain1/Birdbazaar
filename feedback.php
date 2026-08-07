<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- BirdBazaar | Community Hub & Feedback -->
<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Community Hub & Reviews | BirdBazaar</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Custom CSS Styles -->
    <link href="styles.css" rel="stylesheet" />

    <!-- Tailwind CSS -->
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
                        "outline": "#717973",
                        "surface-container-low": "#eff4ff",
                        "tertiary": "#735c00"
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .star-rating span {
            cursor: pointer;
            transition: color 0.15s ease-in-out, transform 0.15s ease-in-out;
        }
        .star-rating span:hover, .star-rating span.active {
            color: #f59e0b !important;
            transform: scale(1.15);
        }
    </style>
    <!-- Custom JavaScript App -->
    <script src="app.js" defer></script>
</head>

<body class="font-body-md text-slate-900 bg-[#f8f9ff] dark:bg-slate-950 dark:text-slate-100 min-h-screen flex flex-col justify-between custom-scrollbar">

    <!-- Mobile Nav Drawer Backdrop -->
    <div id="mob-nav-overlay" class="drawer-overlay" onclick="closeMobNav()"></div>
    
    <!-- Mobile Nav Drawer -->
    <nav id="mob-nav-drawer" class="mobile-nav-drawer flex flex-col">
        <div class="flex items-center justify-between px-6 py-5 border-b border-emerald-500/20">
            <div class="flex items-center gap-2.5">
                <img src="images/logo.png" alt="BirdBazaar Logo" class="w-14 h-14 object-contain" />
                <span class="text-xl font-bold text-white tracking-tight">BirdBazaar</span>
            </div>
            <button onclick="closeMobNav()" class="text-white"><span class="material-symbols-outlined">close</span></button>
        </div>
        <div class="flex flex-col gap-1 px-4 py-6">
            <a href="index.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">home</span>Home</a>
            <a href="parrots.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">menu_book</span>Categories</a>
            <a href="marketplace.php" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">storefront</span>Marketplace</a>
            <a href="feedback.php" class="text-white font-semibold px-4 py-3 rounded-xl bg-emerald-700/30 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">forum</span>Community & Feedback</a>
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
            <div onclick="window.location.href='index.php'" class="flex items-center gap-2.5 cursor-pointer flex-shrink-0">
                <img src="images/logo.png" alt="BirdBazaar Logo" class="w-16 h-16 sm:w-20 sm:h-20 object-contain" />
                <span class="font-display-lg text-lg sm:text-2xl font-bold text-slate-900 dark:text-emerald-400 truncate max-w-[120px] sm:max-w-none tracking-tight">BirdBazaar</span>
            </div>
        </div>
        <nav class="hidden md:flex items-center gap-8 font-semibold text-sm">
            <a class="text-slate-700 dark:text-slate-300 hover:text-emerald-700 transition-colors" href="index.php">Home</a>
            <a class="text-slate-700 dark:text-slate-300 hover:text-emerald-700 transition-colors" href="parrots.php">Categories</a>
            <a class="text-slate-700 dark:text-slate-300 hover:text-emerald-700 transition-colors" href="marketplace.php">Marketplace</a>
            <a class="text-emerald-800 dark:text-emerald-400 font-bold border-b-2 border-emerald-700 pb-1" href="feedback.php">Community & Feedback</a>
        </nav>
        <div class="flex items-center gap-2 md:gap-4">
            <div id="header-auth-container" class="flex items-center gap-2"></div>
            <button onclick="openMobNav()" class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 text-slate-900 dark:bg-slate-800 dark:text-emerald-300">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="w-full max-w-container-max mx-auto px-4 sm:px-6 md:px-margin-desktop py-8 space-y-12">
        
        <!-- Hero Title Banner -->
        <div class="relative bg-gradient-to-br from-emerald-950 via-slate-900 to-emerald-900 text-white rounded-3xl p-6 sm:p-10 shadow-xl overflow-hidden border border-emerald-500/30">
            <div class="relative z-10 max-w-2xl">
                <span class="bg-emerald-500/30 text-emerald-300 text-xs font-bold px-3.5 py-1 rounded-full uppercase tracking-wider mb-4 inline-block border border-emerald-400/40">Community Voices & Official Hub</span>
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight mb-3 font-display-lg text-white">BirdBazaar Feedback & Announcements</h1>
                <p class="text-emerald-100 text-xs sm:text-sm leading-relaxed mb-6 font-medium">Share your experiences, rate your transactions, and participate in official announcements with breeders and bird enthusiasts across Pakistan.</p>
                <a href="#feedback-form-card" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs sm:text-sm px-5 py-3 rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                    <span class="material-symbols-outlined text-lg">rate_review</span> Give Your Rating & Review
                </a>
            </div>
            <!-- Background Decorative Symbol -->
            <span class="material-symbols-outlined absolute -bottom-10 -right-10 text-white/10 text-[220px] pointer-events-none">forum</span>
        </div>

        <!-- Section 1: Official Admin Announcements & User Discussions -->
        <section class="space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-200 dark:border-slate-800 pb-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-emerald-400 flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-600">campaign</span> Official Admin Announcements & Discussions
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 font-medium">Official posts from BirdBazaar Administrators. You can reply and discuss below!</p>
                </div>
                <div id="admin-post-btn-container"></div>
            </div>

            <!-- Admin Post Creator Form (Visible only for Admin) -->
            <div id="admin-create-post-card" class="hidden bg-slate-900 text-white p-6 rounded-2xl border border-emerald-500/50 shadow-xl">
                <h3 class="text-lg font-bold mb-3 flex items-center gap-2 text-emerald-400">
                    <span class="material-symbols-outlined">add_comment</span> Post Official Announcement
                </h3>
                <form id="admin-announcement-form" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-200 mb-1">Announcement Title</label>
                        <input type="text" id="ann-title" required placeholder="e.g. New Marketplace Security & Breeder Verification Rules" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-400 focus:outline-none focus:border-emerald-400 font-medium" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-200 mb-1">Message Details</label>
                        <textarea id="ann-content" rows="3" required placeholder="Write the announcement message details here..." class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-400 focus:outline-none focus:border-emerald-400 font-medium"></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('admin-create-post-card').classList.add('hidden')" class="px-4 py-2 text-xs font-bold text-slate-300 hover:text-white">Cancel</button>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2 rounded-xl font-bold text-xs shadow-md transition-all">Publish Announcement</button>
                    </div>
                </form>
            </div>

            <!-- Announcements Container -->
            <div id="announcements-list-container" class="space-y-6">
                <!-- Dynamically Rendered via JS -->
            </div>
        </section>

        <!-- Section 2: Ratings Summary & Community Reviews Feed -->
        <section class="space-y-8">
            
            <!-- Summary Rating Box + Rating Form Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Rating Score Summary Card -->
                <div class="bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-md flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900 dark:text-emerald-400 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-500">stars</span> Community Satisfaction
                        </h3>
                        <div class="flex items-baseline gap-3 mb-2">
                            <span id="summary-avg-rating" class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white">5.0</span>
                            <div class="flex flex-col">
                                <div id="summary-stars-html" class="flex text-amber-400 text-lg">⭐⭐⭐⭐⭐</div>
                                <span id="summary-total-count" class="text-xs text-slate-700 dark:text-slate-300 font-bold">Based on 0 reviews</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed mb-6 font-medium">Real ratings from buyers, sellers, and verified bird breeders across Pakistan.</p>
                    </div>

                    <!-- Rating Progress Bars -->
                    <div id="rating-bars-container" class="space-y-2.5 border-t border-slate-200 dark:border-slate-800 pt-4 text-xs font-bold text-slate-800 dark:text-slate-200">
                        <div class="flex items-center gap-2">
                            <span>5 Stars</span>
                            <div class="flex-1 bg-slate-200 dark:bg-slate-800 h-2.5 rounded-full overflow-hidden">
                                <div id="bar-5" class="bg-emerald-500 h-full w-full transition-all"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span>4 Stars</span>
                            <div class="flex-1 bg-slate-200 dark:bg-slate-800 h-2.5 rounded-full overflow-hidden">
                                <div id="bar-4" class="bg-emerald-400 h-full w-0 transition-all"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Feedback Form Card -->
                <div id="feedback-form-card" class="lg:col-span-2 bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-md">
                    <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-emerald-400 mb-1 flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-600">edit_note</span> Submit Your Review & Star Rating
                    </h3>
                    <p class="text-xs text-slate-700 dark:text-slate-300 mb-6 font-medium">Tell us about your experience with BirdBazaar website, bird listings, or breeders.</p>

                    <form id="user-feedback-form" onsubmit="submitUserFeedback(event)" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-900 dark:text-white mb-1">Your Name</label>
                            <input type="text" id="fb-name" required placeholder="e.g. Usama Khan" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-xl px-4 py-2.5 text-xs text-slate-900 dark:text-white font-medium focus:outline-none focus:border-emerald-500 focus:bg-white dark:focus:bg-slate-900" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
                            <div>
                                <label class="block text-xs font-bold text-slate-900 dark:text-white mb-1">Category / Aspect</label>
                                <select id="fb-category" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-xl px-4 py-2.5 text-xs text-slate-900 dark:text-white font-bold focus:outline-none focus:border-emerald-500 cursor-pointer">
                                    <option value="Website Experience">Website Experience</option>
                                    <option value="Bird Quality">Bird Quality & Health</option>
                                    <option value="Breeder Trust">Breeder Trust & Security</option>
                                    <option value="Customer Support">Customer Support</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-900 dark:text-white mb-1">Select Star Rating</label>
                                <div id="star-picker" class="star-rating flex items-center gap-1 text-2xl text-slate-300">
                                    <span data-star="1" class="material-symbols-outlined active">star</span>
                                    <span data-star="2" class="material-symbols-outlined active">star</span>
                                    <span data-star="3" class="material-symbols-outlined active">star</span>
                                    <span data-star="4" class="material-symbols-outlined active">star</span>
                                    <span data-star="5" class="material-symbols-outlined active">star</span>
                                    <span id="star-text" class="text-xs font-bold text-amber-600 ml-2">5 Stars</span>
                                </div>
                                <input type="hidden" id="fb-rating" value="5" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-900 dark:text-white mb-1">Your Detailed Feedback</label>
                            <textarea id="fb-comment" rows="3" required placeholder="Describe your experience with BirdBazaar..." class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-xl px-4 py-2.5 text-xs text-slate-900 dark:text-white font-medium focus:outline-none focus:border-emerald-500 focus:bg-white dark:focus:bg-slate-900"></textarea>
                        </div>

                        <button type="button" onclick="submitUserFeedback(event)" class="w-full sm:w-auto bg-emerald-700 hover:bg-emerald-600 text-white font-extrabold text-xs px-6 py-3 rounded-xl shadow-md transition-all cursor-pointer flex items-center justify-center gap-2 border-none">
                            <span class="material-symbols-outlined text-sm">send</span> Submit Review
                        </button>
                    </form>
                </div>
            </div>

            <!-- Reviews Feed Header & Filters -->
            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-200 dark:border-slate-800 pb-4">
                    <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-emerald-400 flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-600">rate_review</span> Verified Community Reviews
                    </h3>
                    <div class="flex items-center gap-2 overflow-x-auto max-w-full py-1">
                        <button onclick="filterFeedbacks('all')" class="fb-filter-btn px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-700 text-white shadow-sm">All</button>
                        <button onclick="filterFeedbacks(5)" class="fb-filter-btn px-3.5 py-1.5 rounded-full text-xs font-bold bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:bg-slate-300">5 Stars ⭐</button>
                        <button onclick="filterFeedbacks(4)" class="fb-filter-btn px-3.5 py-1.5 rounded-full text-xs font-bold bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:bg-slate-300">4 Stars ⭐</button>
                    </div>
                </div>

                <!-- Reviews Feed Grid -->
                <div id="reviews-feed-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Dynamically Rendered via JS -->
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="w-full mt-16 bg-primary dark:bg-slate-900 py-10 sm:py-16 px-4 sm:px-6 md:px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-8 max-w-container-max mx-auto rounded-t-3xl border-t border-white/10 text-white">
        <div class="md:col-span-1">
            <div class="flex items-center gap-2 mb-6">
                <img src="images/logo.png" alt="BirdBazaar Logo" class="h-20 sm:h-24 w-auto object-contain cursor-pointer" onclick="window.location.href='index.php'" />
            </div>
            <p class="text-xs text-emerald-100/70 leading-relaxed mb-6 font-normal">
                Pakistan's premier digital sanctuary for bird lovers, species knowledge, health guidance, and safe aviary trading.
            </p>
        </div>
        <div>
            <h5 class="font-bold mb-4 text-sm sm:text-base">Quick Links</h5>
            <ul class="space-y-3 text-xs sm:text-sm text-emerald-100/80">
                <li><a href="index.php" class="hover:text-emerald-300 transition-colors">Home Sanctuary</a></li>
                <li><a href="parrots.php" class="hover:text-emerald-300 transition-colors">Species Guide</a></li>
                <li><a href="marketplace.php" class="hover:text-emerald-300 transition-colors">Live Marketplace</a></li>
                <li><a href="feedback.php" class="hover:text-emerald-300 transition-colors font-bold text-white">Community & Feedback</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-bold mb-4 text-sm sm:text-base">Categories</h5>
            <ul class="space-y-3 text-xs sm:text-sm text-emerald-100/80">
                <li><a href="parrots.php?cat=parrots" class="hover:text-emerald-300 transition-colors">Parrots</a></li>
                <li><a href="parrots.php?cat=budgies" class="hover:text-emerald-300 transition-colors">Budgies</a></li>
                <li><a href="parrots.php?cat=cockatiels" class="hover:text-emerald-300 transition-colors">Cockatiels</a></li>
                <li><a href="parrots.php?cat=macaws" class="hover:text-emerald-300 transition-colors">Macaws</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-bold mb-4 text-sm sm:text-base">Join the Nest</h5>
            <p class="text-xs text-emerald-100/70 leading-relaxed mb-4">Subscribe for the latest bird care tips and market updates.</p>
            <div class="flex flex-col gap-2">
                <input type="email" placeholder="Your Email" class="w-full bg-slate-900 border border-emerald-500/30 rounded-xl px-4 py-2 text-xs text-white placeholder-slate-400 focus:outline-none focus:border-emerald-400" />
                <button class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs py-2 rounded-xl shadow-md transition-all cursor-pointer">Subscribe</button>
            </div>
        </div>
        <div class="md:col-span-4 mt-8 sm:mt-12 pt-6 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-400">
            <p>© 2026 BirdBazaar. Celebrating Avian Life.</p>
            <div class="flex items-center gap-6">
                <span>⚡ WhatsApp Verified</span>
                <span>🛡️ Escrow Protection</span>
                <span>🇵🇰 Pakistan's #1 Avian Network</span>
            </div>
        </div>
    </footer>

    <!-- Page Logic Script -->
    <script>
        let allFeedbacks = [];
        let selectedStarRating = 5;
        let activeFilter = 'all';

        document.addEventListener('DOMContentLoaded', () => {
            setupStarPicker();
            setupAdminPostPrivilege();
            loadAnnouncements();
            loadFeedbacks();

            // Submit feedback listener
            document.getElementById('user-feedback-form').addEventListener('submit', (e) => {
                e.preventDefault();
                submitUserFeedback();
            });

            // Admin post announcement listener
            const annForm = document.getElementById('admin-announcement-form');
            if (annForm) {
                annForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    publishAdminAnnouncement();
                });
            }
        });

        // Pre-fill user data if logged in
        function setupStarPicker() {
            const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
            if (currentUser) {
                if (document.getElementById('fb-name')) document.getElementById('fb-name').value = currentUser.name || '';
                if (document.getElementById('fb-email')) document.getElementById('fb-email').value = currentUser.email || '';
            }

            const stars = document.querySelectorAll('#star-picker span[data-star]');
            const starText = document.getElementById('star-text');
            const ratingInput = document.getElementById('fb-rating');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const val = parseInt(star.getAttribute('data-star'));
                    selectedStarRating = val;
                    ratingInput.value = val;
                    starText.textContent = `${val} Star${val > 1 ? 's' : ''}`;
                    
                    stars.forEach((s, idx) => {
                        if (idx < val) {
                            s.classList.add('active');
                        } else {
                            s.classList.remove('active');
                        }
                    });
                });
            });
        }

        // Show Admin Post Creator button if logged in as Admin
        function setupAdminPostPrivilege() {
            const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
            const btnContainer = document.getElementById('admin-post-btn-container');
            const isAdmin = currentUser && (currentUser.role === 'admin' || currentUser.email === 'admin@avinest.com');

            if (isAdmin && btnContainer) {
                btnContainer.innerHTML = `
                    <button onclick="document.getElementById('admin-create-post-card').classList.toggle('hidden')" class="bg-emerald-700 hover:bg-emerald-600 text-white font-bold text-xs px-4 py-2.5 rounded-xl shadow-md transition-all flex items-center gap-1.5 cursor-pointer">
                        <span class="material-symbols-outlined text-base">add_box</span> Post Official Announcement
                    </button>
                `;
            }
        }

        // Load Admin Announcements & User Comment Threads
        function loadAnnouncements() {
            fetch('api/feedback.php?action=list_announcements')
                .then(res => res.json())
                .then(data => {
                    if (data.success && Array.isArray(data.data)) {
                        renderAnnouncements(data.data);
                    }
                })
                .catch(() => {
                    document.getElementById('announcements-list-container').innerHTML = '<p class="text-xs text-slate-500 italic">No announcements posted yet.</p>';
                });
        }

        function renderAnnouncements(list) {
            const container = document.getElementById('announcements-list-container');
            if (list.length === 0) {
                container.innerHTML = '<p class="text-xs text-slate-400 italic">No announcements posted yet.</p>';
                return;
            }

            const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
            const isAdmin = currentUser && (currentUser.role === 'admin' || currentUser.email === 'admin@avinest.com');

            container.innerHTML = list.map(ann => {
                const comments = ann.comments || [];
                return `
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border-2 border-emerald-500/30 shadow-md relative space-y-4">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 border-b border-slate-200 dark:border-slate-800 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="bg-emerald-700 text-white text-[11px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider flex items-center gap-1 shadow-sm">
                                    <span class="material-symbols-outlined text-xs">verified</span> ${ann.category || 'Announcement'}
                                </span>
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">${ann.admin_name} • ${ann.date_formatted}</span>
                            </div>
                            ${isAdmin ? `<button onclick="deleteAnnouncementPost(${ann.id})" class="text-red-600 dark:text-red-400 hover:underline text-xs font-bold flex items-center gap-1"><span class="material-symbols-outlined text-sm">delete</span> Delete Post</button>` : ''}
                        </div>

                        <div>
                            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white mb-2">${ann.title}</h3>
                            <p class="text-xs sm:text-sm text-slate-800 dark:text-slate-200 leading-relaxed font-normal whitespace-pre-line">${ann.content}</p>
                        </div>

                        <!-- Comment Thread Section -->
                        <div class="bg-slate-100 dark:bg-slate-950 p-4 sm:p-5 rounded-2xl border border-slate-300 dark:border-slate-800 space-y-3">
                            <h4 class="text-xs font-extrabold text-slate-900 dark:text-emerald-400 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-emerald-600">forum</span> Community Replies (${comments.length})
                            </h4>

                            <div class="space-y-2.5 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                                ${comments.length > 0 ? comments.map(c => `
                                    <div class="p-3.5 bg-white dark:bg-slate-900 rounded-xl text-xs border border-slate-200 dark:border-slate-800 shadow-sm">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-extrabold text-emerald-900 dark:text-emerald-300 flex items-center gap-1 text-xs">
                                                <span class="material-symbols-outlined text-sm">account_circle</span> ${c.user_name}
                                            </span>
                                            <span class="text-[10px] font-semibold text-slate-500 dark:text-slate-400">${c.date_formatted}</span>
                                        </div>
                                        <p class="text-slate-800 dark:text-slate-100 font-normal leading-relaxed">${c.comment_text}</p>
                                    </div>
                                `).join('') : '<p class="text-xs text-slate-500 dark:text-slate-400 font-medium italic">No replies yet. Be the first to comment!</p>'}
                            </div>

                            <!-- Reply Box -->
                            <div class="flex gap-2 pt-2 border-t border-slate-300 dark:border-slate-800">
                                <input type="text" id="reply-input-${ann.id}" placeholder="Write a reply under this announcement..." class="w-full bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 dark:text-white font-medium focus:outline-none focus:border-emerald-500" />
                                <button onclick="submitUserReply(${ann.id})" class="bg-emerald-700 hover:bg-emerald-600 text-white font-bold text-xs px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center gap-1 flex-shrink-0 cursor-pointer">
                                    <span class="material-symbols-outlined text-sm">send</span> Reply
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Submit user comment reply
        window.submitUserReply = function(announcementId) {
            const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
            if (!currentUser) {
                if (window.showCustomModal) {
                    window.showCustomModal({
                        title: "🔒 Login Required",
                        message: "You need to log in to your BirdBazaar account to reply to official announcements.",
                        icon: "lock",
                        type: "warning",
                        buttonText: "Login Now",
                        onAction: () => {
                            if (window.openAuthModal) window.openAuthModal();
                        }
                    });
                }
                return;
            }

            const replyInput = document.getElementById(`reply-input-${announcementId}`);
            if (!replyInput || !replyInput.value.trim()) return;

            const text = replyInput.value.trim();
            fetch('api/feedback.php?action=submit_comment', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    announcement_id: announcementId,
                    user_name: currentUser.name || 'Avian Lover',
                    user_email: currentUser.email || 'user@birdbazaar.com',
                    comment_text: text
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    replyInput.value = '';
                    loadAnnouncements();
                    if (window.showToast) window.showToast("💬 Reply posted!");
                }
            });
        };

        // Publish Admin Announcement
        function publishAdminAnnouncement() {
            const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
            const title = document.getElementById('ann-title').value.trim();
            const content = document.getElementById('ann-content').value.trim();

            fetch('api/feedback.php?action=create_announcement', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    admin_name: currentUser ? currentUser.name : 'AviNest Admin',
                    title: title,
                    content: content,
                    category: 'Official Update'
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('admin-announcement-form').reset();
                    document.getElementById('admin-create-post-card').classList.add('hidden');
                    loadAnnouncements();
                    if (window.showToast) window.showToast("📢 Announcement published!");
                }
            });
        }

        // Delete Announcement Post (Admin Only)
        window.deleteAnnouncementPost = function(id) {
            if (confirm("Are you sure you want to delete this announcement post?")) {
                fetch(`api/feedback.php?action=delete_announcement&id=${id}`, { method: 'POST' })
                    .then(res => res.json())
                    .then(data => {
                        loadAnnouncements();
                        if (window.showToast) window.showToast("Deleted announcement!");
                    });
            }
        };

        // Load Feedbacks
        function loadFeedbacks() {
            fetch('api/feedback.php?action=list_feedbacks')
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        allFeedbacks = data.data || [];
                        updateSummaryCard(data.summary || {});
                        renderFeedbacks();
                    }
                })
                .catch(() => {
                    document.getElementById('reviews-feed-container').innerHTML = '<p class="text-xs text-slate-500 italic">No reviews yet.</p>';
                });
        }

        function updateSummaryCard(summary) {
            if (document.getElementById('summary-avg-rating')) {
                document.getElementById('summary-avg-rating').textContent = summary.average || '5.0';
            }
            if (document.getElementById('summary-total-count')) {
                document.getElementById('summary-total-count').textContent = `Based on ${summary.total || 0} reviews`;
            }
            if (document.getElementById('summary-stars-html')) {
                const rounded = Math.round(summary.average || 5);
                document.getElementById('summary-stars-html').textContent = '⭐'.repeat(rounded);
            }
        }

        window.filterFeedbacks = function(rating) {
            activeFilter = rating;
            document.querySelectorAll('.fb-filter-btn').forEach(btn => {
                btn.className = 'fb-filter-btn px-3.5 py-1.5 rounded-full text-xs font-bold bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:bg-slate-300';
            });
            event.target.className = 'fb-filter-btn px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-700 text-white shadow-sm';
            renderFeedbacks();
        };

        function renderFeedbacks() {
            const container = document.getElementById('reviews-feed-container');
            let filtered = allFeedbacks;

            if (activeFilter !== 'all') {
                filtered = allFeedbacks.filter(f => parseInt(f.rating) === parseInt(activeFilter));
            }

            if (filtered.length === 0) {
                container.innerHTML = '<div class="col-span-full text-center py-12 text-slate-500 font-medium italic text-xs">No reviews matching filter.</div>';
                return;
            }

            container.innerHTML = filtered.map(f => `
                <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col justify-between space-y-4 hover:shadow-md transition-shadow">
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-full bg-emerald-700 text-white font-extrabold flex items-center justify-center text-sm shadow-sm">
                                    ${(f.user_name || 'U').charAt(0).toUpperCase()}
                                </div>
                                <div>
                                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white flex items-center gap-1.5 flex-wrap">
                                        ${f.user_name}
                                        <span class="bg-emerald-700 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-md shadow-sm">
                                            User ID: #${f.user_id ? f.user_id : f.id}
                                        </span>
                                    </h4>
                                    <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400">${f.date_formatted}</span>
                                </div>
                            </div>
                            <span class="bg-emerald-100 dark:bg-emerald-950 text-emerald-900 dark:text-emerald-300 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full border border-emerald-300 dark:border-emerald-800">
                                ${f.category || 'General'}
                            </span>
                        </div>
                        <div class="text-amber-400 text-xs mb-2">
                            ${'⭐'.repeat(parseInt(f.rating || 5))}
                        </div>
                        <p class="text-xs sm:text-sm text-slate-800 dark:text-slate-100 leading-relaxed font-normal italic">"${f.comment}"</p>
                    </div>
                </div>
            `).join('');
        }

        // Submit User Feedback
        window.submitUserFeedback = function(e) {
            if (e) e.preventDefault();
            const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
            if (!currentUser) {
                if (window.showCustomModal) {
                    window.showCustomModal({
                        title: "🔒 Login Required",
                        message: "Feedback ya Star Rating dene ke liye pehle apne BirdBazaar account me login karein.",
                        icon: "lock",
                        type: "warning",
                        buttonText: "Login / Register Now",
                        onAction: () => {
                            if (window.openAuthModal) window.openAuthModal();
                        }
                    });
                } else if (window.openAuthModal) {
                    window.openAuthModal();
                }
                return;
            }

            const nameInput = document.getElementById('fb-name');
            const name = (nameInput && nameInput.value.trim()) ? nameInput.value.trim() : (currentUser.name || 'Avian Lover');
            const category = document.getElementById('fb-category').value;
            const rating = document.getElementById('fb-rating').value;
            const commentInput = document.getElementById('fb-comment');
            const comment = commentInput ? commentInput.value.trim() : '';

            if (!comment) {
                if (window.showCustomModal) {
                    window.showCustomModal({
                        title: "⚠️ Missing Comment Details",
                        message: "Baraye meherbani feedback comment box me apne taassurat zaroor likhein.",
                        icon: "warning",
                        type: "warning",
                        buttonText: "OK"
                    });
                } else {
                    alert("Baraye meherbani feedback comment zaroor darj karein.");
                }
                return;
            }

            fetch('api/feedback.php?action=submit_feedback', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    user_id: currentUser.id || 1,
                    user_name: name,
                    user_email: currentUser.email || 'user@birdbazaar.com',
                    category: category,
                    rating: parseInt(rating || 5),
                    comment: comment
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (commentInput) commentInput.value = '';
                    setupStarPicker();
                    loadFeedbacks();
                    if (window.showSuccessModal) {
                        window.showSuccessModal({
                            title: "🎉 Review Submitted Successfully!",
                            message: "Shukriya! Aapka feedback aur star rating BirdBazaar community par live publish ho gaya hai.",
                            icon: "star",
                            badge: "FEEDBACK LIVE",
                            buttonText: "Awesome!",
                            onConfirm: () => {
                                document.getElementById('reviews-feed-container').scrollIntoView({ behavior: 'smooth' });
                            }
                        });
                    }
                } else {
                    alert(data.message || "Failed to submit feedback.");
                }
            })
            .catch(err => {
                alert("Error submitting feedback: " + err.message);
            });
        };
    </script>
</body>

</html>
