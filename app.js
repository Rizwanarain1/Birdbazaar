document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    initLanguage();
    initNewsletter();
    initListBirdModal();
    initMobileDrawer();
});

/* Mobile Navigation Drawer Initialization */
function initMobileDrawer() {
    // Pages already have mob-nav-drawer and hamburger button in HTML.
    // Only create drawer if it doesn't exist (fallback for old pages).
    let drawer = document.querySelector('.mobile-nav-drawer');
    let overlay = document.querySelector('.drawer-overlay');

    if (!drawer) {
        drawer = document.createElement('nav');
        drawer.className = 'mobile-nav-drawer flex flex-col';
        drawer.innerHTML = `
            <div class="flex items-center justify-between px-6 py-5 border-b border-emerald-500/20">
                <span class="text-xl font-bold text-white">🦜 BirdBazaar</span>
                <button id="close-drawer-btn" class="text-white"><span class="material-symbols-outlined">close</span></button>
            </div>
            <div class="flex flex-col gap-1 px-4 py-6">
                <a href="index.html" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">home</span>Home</a>
                <a href="parrots.html" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">menu_book</span>Categories</a>
                <a href="marketplace.html" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">storefront</span>Marketplace</a>
                <a href="user-dashboard.html" class="text-emerald-100 px-4 py-3 rounded-xl hover:bg-emerald-700/20 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-400">dashboard</span>My Dashboard</a>
            </div>
        `;
        document.body.insertBefore(drawer, document.body.firstChild);
    }

    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'drawer-overlay';
        document.body.insertBefore(overlay, document.body.firstChild);
    }

    // DO NOT inject hamburger into header — HTML already has it.
    // Just wire up close button and overlay click.
    const closeBtn = drawer.querySelector('#close-drawer-btn');
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    overlay.addEventListener('click', closeDrawer);

    function openDrawer() {
        drawer.classList.add('open');
        overlay.classList.add('active');
    }

    function closeDrawer() {
        drawer.classList.remove('open');
        overlay.classList.remove('active');
    }

    // Wire up all hamburger buttons in HTML
    document.querySelectorAll('[onclick="openMobNav()"]').forEach(btn => {
        btn.removeAttribute('onclick');
        btn.addEventListener('click', openDrawer);
    });

    // Wire up all close buttons in HTML
    document.querySelectorAll('[onclick="closeMobNav()"]').forEach(btn => {
        btn.removeAttribute('onclick');
        btn.addEventListener('click', closeDrawer);
    });
}

/* ==========================================
   1. Theme Management (Dark/Light Mode)
   ========================================== */
function initTheme() {
    const headers = document.querySelectorAll('header');
    
    headers.forEach(header => {
        const rightContainer = header.querySelector('.flex.items-center.gap-4') || 
                               header.querySelector('.flex.items-center.gap-6') ||
                               header.lastElementChild;
                               
        if (rightContainer && !header.querySelector('.theme-toggle-btn')) {
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'theme-toggle-btn p-2 text-on-surface-variant hover:text-primary dark:text-surface-variant dark:hover:text-primary-fixed transition-colors flex items-center justify-center';
            toggleBtn.setAttribute('aria-label', 'Toggle theme');
            toggleBtn.innerHTML = `
                <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                <span class="material-symbols-outlined hidden dark:inline">light_mode</span>
            `;
            
            if (rightContainer.children.length > 0) {
                rightContainer.insertBefore(toggleBtn, rightContainer.children[rightContainer.children.length - 1]);
            } else {
                rightContainer.appendChild(toggleBtn);
            }
            
            toggleBtn.addEventListener('click', toggleTheme);
        }
    });

    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light');
    } else {
        document.documentElement.classList.add('light');
        document.documentElement.classList.remove('dark');
    }
}

function toggleTheme() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        document.documentElement.classList.add('light');
        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light');
        localStorage.setItem('theme', 'dark');
    }
}

/* ==========================================
   2. Language Translation Switcher (Urdu / English)
   ========================================== */
const translations = {
    ur: {
        // Nav Links
        "Home": "ہوم",
        "Categories": "اقسام",
        "Marketplace": "مارکیٹ پلیس",
        "Community": "کمیونٹی",
        "Admin": "ایڈمن",
        "Profile": "پروفائل",
        "Urdu": "English",
        
        // Home Hero Page
        "Pakistan's #1 Avian Digital Sanctuary": "پاکستان کا نمبر 1 پرندوں کا ڈیجیٹل سینکچوئری",
        "Welcome to": "خوش آمدید",
        "The ultimate digital home for bird lovers. Learn species health & care guides, explore verified aviaries, or buy & sell birds safely with instant WhatsApp live video inspection.": "پرندوں کے شوقین افراد کا حتمی ڈیجیٹل گھر۔ پرندوں کی صحت اور دیکھ بھال کی رہنمائی حاصل کریں، تصدیق شدہ ایوریز دریافت کریں، یا واٹس ایپ لائیو ویڈیو معائنے کے ساتھ محفوظ طریقے سے پرندے خریدیں اور بیچیں۔",
        "Explore Species Guide": "پرندوں کی رہنما ڈائریکٹری",
        "Visit Live Marketplace": "لائیو مارکیٹ پلیس دیکھیں",
        "What Are You Looking For?": "آپ کیا تلاش کر رہے ہیں؟",
        "Explore BirdBazaar Portals": "برڈ بازار کے پورٹلز دریافت کریں",
        "Dedicated portals designed for avian care knowledge and safe trading.": "پرندوں کی دیکھ بھال کے علم اور محفوظ تجارت کے لیے مخصوص پورٹلز۔",
        "Knowledge Directory": "علمی ڈائریکٹری",
        "Avian Species & Care Guide": "پرندوں کی اقسام اور دیکھ بھال کی گائیڈ",
        "In-depth information on African Greys, Macaws, Cockatiels, Budgies, Lovebirds & Finches. Species origin, diet plans, DNA testing, and health guidance.": "افریقی گرے، مکاؤ، کاکاٹیل، بجی، لو برڈز اور فنچز کی تفصیلی معلومات۔ نسل کا اصل وطن، غذائی منصوبے، ڈی این اے ٹیسٹنگ، اور صحت کی رہنمائی۔",
        "Open Species Encyclopedia": "انسائیکلوپیڈیا کھولیں",
        "Trading Portal": "تجارتی پورٹل",
        "Live Buy & Sell Marketplace": "لائیو خرید و فروخت مارکیٹ",
        "Connect with verified breeders across Pakistan. Post your birds for sale, chat on WhatsApp, request live video clips, and enjoy buyer fraud protection.": "پاکستان بھر کے تصدیق شدہ بریڈرز سے جڑیں۔ اپنے پرندے فروخت کے لیے پوسٹ کریں، واٹس ایپ پر چیٹ کریں، لائیو ویڈیو دیکھیں، اور خریدار کی فراڈ سے حفاظت سے لطف اندوز ہوں۔",
        "Enter Live Marketplace": "مارکیٹ پلیس میں داخل ہوں",
        "Built For Peace Of Mind": "پرکون تجربے کے لیے تیار کردہ",
        "Why BirdBazaar Ecosystem?": "برڈ بازار ایکو سسٹم ہی کیوں؟",
        "A complete digital sanctuary designed to eliminate fraud and support avian health.": "فراڈ کے خاتمے اور پرندوں کی صحت کی معاونت کے لیے تیار کردہ مکمل ڈیجیٹل نظام۔",
        "WhatsApp Live Chat": "واٹس ایپ لائیو چیٹ",
        "Direct instant messaging with breeders. Share 1-click video clips, voice notes, and high-res photos before buying.": "بریڈرز کے ساتھ فوری پیغام رسانی۔ خریدنے سے پہلے 1-کلک پر ویڈیو کلپس، وائس نوٹس اور اعلی معیار کی تصاویر دیکھیں۔",
        "Verified Aviaries": "تصدیق شدہ ایوریز",
        "All aviaries undergo verification. Permanent fraud protection and blocked user enforcement keep trading safe.": "تمام ایوریز کی تصدیق کی جاتی ہے۔ مستقل فراڈ تحفظ اور بلاک شدہ صارف کی روک تھام تجارت کو محفوظ رکھتی ہے۔",
        "Avian Vet Care": "پرندوں کے ڈاکٹر کی دیکھ بھال",
        "Access expert species nutrition plans, health check templates, and advice from certified avian veterinarians.": "پرندوں کی مخصوص غذائی منصوبوں، صحت کی جانچ کے ٹیمپلیٹس اور تصدیق شدہ وٹنری ڈاکٹروں کے مشورے تک رسائی حاصل کریں۔",
        "Buyer Escrow Protection": "خریدار کی ایسکرو حفاظت",
        "Complete transaction safety. Verify bird health and condition before completing deal confirmation.": "مکمل تجارتی حفاظت۔ سودا مکمل کرنے سے پہلے پرندے کی صحت اور حالت کی تصدیق کریں۔",
        "Compare Security": "حفاظت کا موازنہ کریں",
        "BirdBazaar vs Traditional Groups": "برڈ بازار بمقابلہ روایتی گروپس",
        "See why bird enthusiasts and breeders choose BirdBazaar over unverified social media groups.": "جانیں کہ پرندوں کے شوقین اور بریڈرز غیر تصدیق شدہ سوشل میڈیا گروپس کے مقابلے میں برڈ بازار کو کیوں منتخب کرتے ہیں۔",
        "Feature / Security": "خصوصیت / تحفظ",
        "Unverified FB / OLX": "غیر تصدیق شدہ FB / OLX",
        "BirdBazaar Sanctuary": "برڈ بازار سینکچوئری",
        "Breeder Verification": "بریڈر کی تصدیق",
        "High Scam Risk": "فراڈ کا شدید خطرہ",
        "100% Verified Aviaries": "100% تصدیق شدہ ایوریز",
        "Live Video Inspection": "لائیو ویڈیو معائنہ",
        "Static Photos Only": "صرف جامد تصاویر",
        "1-Click WhatsApp Video": "1-کلک واٹس ایپ ویڈیو",
        "Health & Care Guides": "صحت اور دیکھ بھال کی گائیڈز",
        "None": "کوئی نہیں",
        "Full Species Encyclopedia": "مکمل پرندوں کی انسائیکلوپیڈیا",
        "Blocked User Shield": "بلاک شدہ صارف کی شیلڈ",
        "No Protection": "کوئی تحفظ نہیں",
        "Instant Message Filtering": "فوری پیغام رسانی کا فلٹر",
        "Cities Across Pakistan": "پاکستان بھر کے شہر",
        "Avian Enthusiasts": "پرندوں کے شوقین افراد",
        "Health & Care Community": "صحت اور دیکھ بھال کی کمیونٹی",
        "Ready to Explore or List Your Aviary?": "دریافت کرنے یا اپنی ایوری پوسٹ کرنے کے لیے تیار ہیں؟",
        "Join thousands of verified breeders and bird enthusiasts on Pakistan's #1 digital avian platform.": "پاکستان کے نمبر 1 ڈیجیٹل پرندوں کے پلیٹ فارم پر ہزاروں تصدیق شدہ بریڈرز اور شوقین افراد میں شامل ہوں۔",
        
        // Stats
        "50+ Bird Experts": "50+ ماہر پرندے",
        "Verified specialists providing care guidance.": "تصدیق شدہ ماہرین دیکھ بھال کی رہنمائی فراہم کرتے ہیں۔",
        "12k+ Birds Sold": "12k+ پرندے فروخت ہوئے",
        "Connecting owners with loving new homes.": "مالکان کو محبت کرنے والے نئے گھروں سے جوڑنا۔",
        "85k Happy Community": "85k خوش کمیونٹی",
        "The largest network of avian enthusiasts.": "پرندوں کے شوقین افراد کا سب سے بڑا نیٹ ورک۔",
        
        // Category headers
        "Explore by Category": "قسم کے لحاظ سے دریافت کریں",
        "Find your perfect companion from specialized species.": "خصوصی اقسام میں سے اپنا بہترین ساتھی تلاش کریں۔",
        "View All": "سب دیکھیں",
        "Parrots": "طوطے",
        "Intelligent & Talkative": "ذہین اور باتونی",
        "Cockatiels": "کاکاٹیل",
        "Affectionate & Musical": "محبت کرنے والے اور سریلے",
        "Budgies": "بجی",
        "Active & Sociable": "سرگرم اور سماجی",
        "Macaws": "مکاؤ",
        "Grand & Spectacular": "عظیم الشان اور شاندار",
        "Lovebirds": "لو برڈز",
        "Beautiful & Loyal": "خوبصورت اور وفادار",
        "Finches": "فنچز",
        "Small & Active": "چھوٹے اور چست",
        "Canaries": "کینیریز",
        "Sweet Singing Birds": "خوبصورت گانے والے پرندے",
        
        // Care section
        "Premium Care for Your Feathered Friends": "آپ کے پروں والے دوستوں کے لیے بہترین دیکھ بھال",
        "At AviNest, we believe every bird deserves a thriving life. Our platform doesn't just connect buyers and sellers—it provides a comprehensive ecosystem for avian health.": "ایوی نیسٹ میں، ہمارا ماننا ہے کہ ہر پرندہ ایک خوشحال زندگی کا مستحق ہے۔ ہمارا پلیٹ فارم صرف خریداروں اور فروخت کنندگان کو نہیں جوڑتا بلکہ یہ پرندوں کی صحت کے لیے ایک جامع ماحول فراہم کرتا ہے۔",
        "Personalized nutrition plans for every species.": "ہر قسم کے پرندے کے لیے مخصوص غذائی منصوبے فراہم کیے جاتے ہیں۔",
        "Access to top avian veterinarians globally.": "عالمی سطح پر پرندوں کے بہترین ڈاکٹروں تک رسائی۔",
        "Verified health certificates for all listed birds.": "تمام درج پرندوں کے لیے تصدیق شدہ ہیلتھ سرٹیفکیٹ۔",
        "Learn More About Bird Care": "پرندوں کی دیکھ بھال کے بارے میں مزید جانیں",
        
        // Community Home
        "Join Our Community": "ہماری کمیونٹی میں شامل ہوں",
        "Share your experiences, ask questions, and connect with fellow bird lovers from around the world.": "اپنے تجربات شیئر کریں، سوالات پوچھیں، اور دنیا بھر کے پرندوں سے محبت کرنے والوں سے جڑیں۔",
        "Discussion Forums": "بحث کے فورمز",
        "Expert advice on behavior and training.": "طرز عمل اور تربیت پر ماہرانہ مشورہ۔",
        "Local Events": "مقامی تقاریب",
        "Meet breeders and owners in your city.": "اپنے شہر کے بریڈرز اور مالکان سے ملیں۔",
        "Photo Gallery": "فوٹو گیلری",
        "Share the beauty of your birds.": "اپنے پرندوں کی خوبصورتی شیئر کریں۔",
        "Safe Trading": "محفوظ تجارت",
        "Secure payments and escrow services.": "محفوظ ادائیگیاں اور ایسکرو سروسز۔",
        
        // Footer & Join
        "Join the Nest": "گھونسلے میں شامل ہوں",
        "Subscribe for the latest bird care tips and market updates.": "پرندوں کی دیکھ بھال کے تازہ ترین مشورے اور مارکیٹ کی معلومات حاصل کرنے کے لیے سبسکرائب کریں۔",
        "Subscribe": "سبسکرائب کریں",
        "Your Email": "آپ کا ای میل",
        "Quick Links": "فوری لنکس",
        "About Us": "ہمارے بارے میں",
        "Terms of Service": "سروس کی شرائط",
        "Privacy Policy": "رازداری کی پالیسی",
        "Newsletter": "خبرنامہ",
        "Secure Payments via Stripe": "سٹرائپ کے ذریعے محفوظ ادائیگیاں",
        "Verified Breeders Only": "صرف تصدیق شدہ بریڈرز",
        
        // Parrots category page & general marketplace
        "Avian Directory": "پرندوں کی ڈائریکٹری",
        "Verified Avian Species & Care Encyclopedia": "تصدیق شدہ پرندوں کی نسلیں اور دیکھ بھال کی انسائیکلوپیڈیا",
        "Explore Pakistan's most comprehensive bird encyclopedia. Filter by species, intelligence rating, noise level, and learn about care & diet requirements before connecting with verified breeders.": "پاکستان کی سب سے جامع پرندوں کی انسائیکلوپیڈیا دریافت کریں۔ پرندوں کی نسل، ذہانت، شور کے لیول اور دیکھ بھال کی ضروریات کے لحاظ سے فلٹر کریں۔",
        "In Knowledge Catalog": "علمی کیٹلاگ میں",
        "100% Free": "100% مفت",
        "Care & Health Guides": "دیکھ بھال اور صحت کی گائیڈز",
        "Certified": "تصدیق شدہ",
        "Breeder & Vet Guidance": "بریڈر اور وٹنری ڈاکٹر کی رہنمائی",
        "All Species": "تمام نسلیں",
        "Care Guide": "دیکھ بھال کی گائیڈ",
        "Find Sellers": "فروخت کنندگان تلاش کریں",
        "Species Profile": "پرندے کی پروفائل",
        "Origin / Native Habitat": "اصل وطن / قدرتی مسکن",
        "Lifespan Expectancy": "توقع عمر",
        "Intelligence Rating": "ذہانت کا معیار",
        "Noise Volume": "شور کا حجم",
        "Care, Housing & Diet Guide": "دیکھ بھال، رہائش اور غذائی رہنما",
        "Find Sellers on Marketplace": "مارکیٹ پلیس پر فروخت کنندگان تلاش کریں",
        "Close": "بند کریں",
        "⭐ Easy Care": "⭐ آسان دیکھ بھال",
        "⚠️ Expert Only": "⚠️ صرف ماہرین کے لیے",
        "Filters": "فلٹرز",
        "Clear All": "صاف کریں",
        "Intelligence Level": "ذہانت کا لیول",
        "Intelligence": "ذہانت",
        "Genius Level": "جینئس لیول",
        "Highly Social": "انتہائی سماجی",
        "Active Learner": "فعال سیکھنے والا",
        "Noise Level": "شور کا لیول",
        "Any Volume": "کوئی بھی آواز",
        "Quiet": "خاموش",
        "Quiet (Apartment Friendly)": "خاموش (اپارٹمنٹ دوست)",
        "Moderate": "اعتدال پسند",
        "Loud": "تیز آواز",
        "Loud (Natural Callers)": "تیز آواز (فطری طور پر بولنے والے)",
        "Beginner Friendly": "شروع کرنے والوں کے لیے آسان",
        "Showing": "دکھا رہا ہے",
        "Species Varieties": "پرندوں کی اقسام",
        "Sort by:": "ترتیب دیں:",
        "Popularity": "مقبولیت",
        "Name (A-Z)": "نام (الف سے ی)",
        "Read More": "مزید پڑھیں",
        "Rare Genus": "نایاب نسل",
        "Featured": "نمایاں",
        "Origin": "اصل وطن",
        "Lifespan": "عمر کی حد",
        "Central Africa": "وسطی افریقہ",
        "South America": "جنوبی امریکہ",
        "Solomon Islands": "سلیمان جزائر",
        "Brazil": "برازیل",
        "Australia": "آسٹریلیا",
        "40-60 Years": "40-60 سال",
        "50-75 Years": "50-75 سال",
        "25-30 Years": "25-30 سال",
        "30-40 Years": "30-40 سال",
        "60 Years": "60 سال",
        "15-20 Years": "15-20 سال",
        "All Listings": "تمام لسٹنگز",
        "Avian Marketplace": "پرندوں کی مارکیٹ",
        "Buy or sell hand-raised, DNA-sexed birds from certified, ethical breeders.": "تصدیق شدہ اور اخلاقی بریڈرز سے ہاتھ کے پلے ہوئے، ڈی این اے تصدیق شدہ پرندے خریدیں یا بیچیں۔",
        "Listen Profile": "پروفائل سنیں",
        "Stop Voice": "آواز روکیں",
        "Care Cost Calculator": "دیکھ بھال کے اخراجات کا کیلکولیٹر",
        "Estimate the monthly financial and time commitment required.": "مطلوبہ ماہانہ مالیاتی اور وقت کے عزم کا اندازہ لگائیں۔",
        "Calculated Outputs": "حساب شدہ نتائج",
        "Estimated Monthly Cost:": "تخمینہ شدہ ماہانہ خرچ:",
        "Daily Commitment:": "روزانہ کا عزم:",
        
        // Admin translation
        "Admin Dashboard": "ایڈمن ڈیش بورڈ",
        "User Directory": "صارفین کی فہرست",
        "Search users by name or email...": "نام یا ای میل سے تلاش کریں...",
        "All Statuses": "تمام حالات",
        "Active": "فعال",
        "Inactive": "غیر فعال",
        "Username": "صارف کا نام",
        "Email Address": "ای میل ایڈریس",
        "Role": "کردار",
        "Status": "حیثیت",
        "Actions": "اقدامات",
        "Delete Account": "اکاؤنٹ حذف کریں",
        "Breeder": "بریڈر",
        "Seller": "فروخت کنندہ",
        "Buyer": "خریدار",
        "Total Registered Users": "کل رجسٹرڈ صارفین",
        "Active Accounts": "فعال اکاؤنٹس",
        "Pending Verification": "زیر التواء تصدیق"
    }
};

window.toggleLanguage = function() {
    const currentLang = localStorage.getItem('language') || 'en';
    const newLang = currentLang === 'en' ? 'ur' : 'en';
    applyLanguage(newLang);
};

function initLanguage() {
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('button');
        if (btn) {
            // Only trigger language toggle if it's explicitly the header language toggle button
            if (btn.id === 'lang-toggle-btn' || btn.hasAttribute('data-lang-toggle') || btn.closest('#header-lang-container')) {
                window.toggleLanguage();
                return;
            }
            // Fallback for header language button (must be in header bar, not inside modals or audio bars)
            if (btn.closest('header') && !btn.closest('[data-no-translate]')) {
                const txt = btn.textContent.trim().toLowerCase();
                if (txt === 'urdu' || txt === 'english') {
                    window.toggleLanguage();
                }
            }
        }
    });
    
    const savedLang = localStorage.getItem('language') || 'en';
    if (savedLang === 'ur') {
        applyLanguage('ur');
    }
}

function getLanguageBtn() {
    return document.getElementById('lang-toggle-btn');
}

function applyLanguage(lang) {
    localStorage.setItem('language', lang);
    const langBtn = getLanguageBtn();
    
    // Update only the text label node inside the button, keeping icon intact
    function updateBtnLabel(label) {
        if (!langBtn) return;
        // Find the last text node child and update it
        Array.from(langBtn.childNodes).forEach(node => {
            if (node.nodeType === Node.TEXT_NODE && node.textContent.trim().length > 0) {
                node.textContent = ' ' + label;
            }
        });
    }
    
    if (lang === 'ur') {
        document.documentElement.dir = 'rtl';
        updateBtnLabel('English');
        
        document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, a, span, button, option, label').forEach(elem => {
            if (elem.closest('[data-no-translate="true"]') || elem.getAttribute('data-no-translate') === 'true') return;
            
            if (elem.children.length === 0) {
                const txt = elem.textContent.trim();
                if (translations.ur[txt]) {
                    elem.setAttribute('data-orig-txt', txt);
                    elem.textContent = translations.ur[txt];
                }
            } else {
                Array.from(elem.childNodes).forEach(node => {
                    if (node.nodeType === Node.TEXT_NODE) {
                        const txt = node.textContent.trim();
                        if (translations.ur[txt]) {
                            node.setAttribute ? node.setAttribute('data-orig-txt', txt) : null;
                            node.textContent = translations.ur[txt];
                        }
                    }
                });
            }
        });
    } else {
        document.documentElement.dir = 'ltr';
        updateBtnLabel('Urdu');
        
        document.querySelectorAll('[data-orig-txt]').forEach(elem => {
            elem.textContent = elem.getAttribute('data-orig-txt');
            elem.removeAttribute('data-orig-txt');
        });
        document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, a, span, button, option, label').forEach(elem => {
            if (elem.closest('[data-no-translate="true"]') || elem.getAttribute('data-no-translate') === 'true') return;
            
            Array.from(elem.childNodes).forEach(node => {
                if (node.nodeType === Node.TEXT_NODE) {
                    const txt = node.textContent.trim();
                    for (const [enKey, urVal] of Object.entries(translations.ur)) {
                        if (txt === urVal) {
                            node.textContent = enKey;
                        }
                    }
                }
            });
        });
    }
}

/* ==========================================
   3. Newsletter Validator & Feedback Toast
   ========================================== */
function initNewsletter() {
    const subscribeBtns = document.querySelectorAll('button');
    subscribeBtns.forEach(btn => {
        if (btn.textContent.trim().toLowerCase() === 'subscribe' || btn.textContent.trim() === 'سبسکرائب کریں') {
            const input = btn.previousElementSibling;
            if (input && input.tagName === 'INPUT') {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const email = input.value.trim();
                    if (validateEmail(email)) {
                        showToast("✨ Subscribed successfully! Welcome to the Nest.");
                        input.value = '';
                    } else {
                        showToast("❌ Please enter a valid email address.", true);
                    }
                });
            }
        }
    });
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function showToast(message, isError = false) {
    let toast = document.getElementById('avi-toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'avi-toast';
        toast.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded-full shadow-2xl glass-card transition-all duration-300 opacity-0 translate-y-2 pointer-events-none text-label-md font-bold text-center';
        document.body.appendChild(toast);
    }
    
    if (isError) {
        toast.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded-full shadow-2xl border border-error/20 bg-error-container text-error transition-all duration-300 opacity-0 translate-y-2 pointer-events-none text-label-md font-bold text-center';
    } else {
        toast.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded-full shadow-2xl border border-primary/20 bg-primary-container text-on-primary-container transition-all duration-300 opacity-0 translate-y-2 pointer-events-none text-label-md font-bold text-center';
    }
    
    toast.textContent = message;
    
    setTimeout(() => {
        toast.classList.remove('opacity-0', 'translate-y-2');
        toast.classList.add('opacity-100', 'translate-y-0');
    }, 100);
    
    setTimeout(() => {
        toast.classList.remove('opacity-100', 'translate-y-0');
        toast.classList.add('opacity-0', 'translate-y-2');
    }, 3000);
}

// Make showToast accessible globally
window.showToast = showToast;

/* ==========================================
   4. FAB & Sell Birds Modal / Dynamic Listing Creator
   ========================================== */
/* ==========================================
   4. FAB & Sell Birds Modal / Dynamic Listing Creator
   ========================================== */
const LISTING_STORAGE_KEY = 'avinest_listings';

const DEFAULT_LISTINGS = [];

function getListings() {
    sessionStorage.removeItem(LISTING_STORAGE_KEY);
    return [];
}

function saveListing(listing) {
    sessionStorage.removeItem(LISTING_STORAGE_KEY);
    window.dispatchEvent(new CustomEvent('avinest-listings-updated'));
}

window.getListings = getListings;
window.saveListing = saveListing;

function initListBirdModal() {
    let modal = document.getElementById('list-bird-modal');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'list-bird-modal';
        modal.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-on-surface/60 dark:bg-black/70 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300';
        modal.innerHTML = `
            <div class="glass-card w-full max-w-xl p-8 rounded-2xl shadow-2xl overflow-y-auto max-h-[90vh] scale-95 transition-transform duration-300 relative text-on-surface dark:text-surface-bright bg-white dark:bg-slate-900 border border-outline-variant/30">
                <button class="absolute top-4 right-4 text-on-surface-variant hover:text-primary dark:text-surface-variant cursor-pointer" id="close-modal-btn">
                    <span class="material-symbols-outlined text-2xl">close</span>
                </button>
                <div class="flex items-center gap-2 mb-2 text-primary dark:text-primary-fixed">
                    <span class="material-symbols-outlined text-3xl">add_circle</span>
                    <h3 class="font-display-lg text-xl font-bold">Post New Bird Listing</h3>
                </div>
                <p class="text-xs text-on-surface-variant dark:text-surface-variant mb-6">Fill in the details below to list your bird for sale on the BirdBazaar Marketplace.</p>
                
                <form id="list-bird-form" class="space-y-4">
                    <div>
                        <label class="font-label-md block mb-1 font-bold text-on-surface dark:text-white">Bird Name / Species Title *</label>
                        <input type="text" id="input-bird-name" required placeholder="e.g. Hand-fed African Grey Baby" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40" />
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="font-label-md block mb-1 font-bold text-on-surface dark:text-white">Category *</label>
                            <select id="input-category" required class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40">
                                <option value="parrots" selected>Parrots</option>
                                <option value="cockatiels">Cockatiels</option>
                                <option value="budgies">Budgies</option>
                                <option value="macaws">Macaws</option>
                                <option value="lovebirds">Lovebirds</option>
                                <option value="finches">Finches</option>
                                <option value="canaries">Canaries</option>
                            </select>
                        </div>
                        <div>
                            <label class="font-label-md block mb-1 font-bold text-on-surface dark:text-white">Price (PKR / Rs.) *</label>
                            <input type="number" id="input-price" required min="1" placeholder="e.g. 45000" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40" />
                        </div>
                    </div>

                    <div>
                        <label class="font-label-md block mb-1 font-bold text-on-surface dark:text-white">Location / Origin *</label>
                        <input type="text" id="input-origin" required placeholder="e.g. Lahore, Pakistan" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40" />
                    </div>

                    <div class="p-4 rounded-xl bg-surface-container-low dark:bg-on-surface/30 border border-outline-variant/30 space-y-3">
                        <div>
                            <label class="font-label-md block mb-1 font-bold text-primary dark:text-primary-fixed flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">photo_library</span> Upload Bird Photos (Up to 3 Images)
                            </label>
                            <input type="file" id="input-images-file" accept="image/*" multiple class="w-full text-xs text-on-surface dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary-container file:text-on-primary-container hover:file:bg-primary/20 cursor-pointer" />
                            <p class="text-[11px] text-outline mt-1">Select up to 3 clear photos of your bird (JPG, PNG, WebP).</p>
                        </div>

                        <div>
                            <label class="font-label-md block mb-1 font-bold text-primary dark:text-primary-fixed flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">videocam</span> Upload Bird Video Clip (Optional 1 Video)
                            </label>
                            <input type="file" id="input-video-file" accept="video/*" class="w-full text-xs text-on-surface dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-tertiary-container file:text-on-tertiary-container hover:file:bg-tertiary/20 cursor-pointer" />
                            <p class="text-[11px] text-outline mt-1">Select a short video clip showing your bird flying or talking (MP4, WebM).</p>
                        </div>
                    </div>

                    <div>
                        <label class="font-label-md block mb-1 font-bold text-on-surface dark:text-white">Care Details & Description *</label>
                        <textarea id="input-desc" required rows="3" placeholder="Describe your bird's health condition, diet, DNA status, and age..." class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40"></textarea>
                    </div>

                    <button type="submit" id="submit-listing-btn" class="w-full bg-tertiary text-white font-bold py-3.5 rounded-xl hover:scale-101 active:scale-99 transition-transform flex items-center justify-center gap-2 shadow-lg text-sm cursor-pointer">
                        Post Listing to Marketplace <span class="material-symbols-outlined">send</span>
                    </button>
                </form>
            </div>
        `;
        document.body.appendChild(modal);
    }
    
    const closeModal = () => {
        modal.classList.remove('opacity-100', 'pointer-events-auto');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.firstElementChild.classList.remove('scale-100');
        modal.firstElementChild.classList.add('scale-95');
    };
    
    const openModal = () => {
        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
        if (!currentUser) {
            showCustomModal({
                title: "🔒 Login Required",
                message: "You need to log in to your BirdBazaar account to post a new bird listing.",
                icon: "lock",
                type: "warning",
                buttonText: "Login Now",
                onAction: () => {
                    openAuthModal();
                }
            });
            return;
        }
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
        modal.firstElementChild.classList.remove('scale-95');
        modal.firstElementChild.classList.add('scale-100');
    };
    
    window.triggerListingModal = openModal;

    const fab = document.querySelector('button.fixed.bottom-8.right-8');
    if (fab) {
        fab.addEventListener('click', openModal);
    }

    modal.querySelector('#close-modal-btn').addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
    
    const form = modal.querySelector('#list-bird-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const category = form.querySelector('#input-category').value;
        const name = form.querySelector('#input-bird-name').value.trim();
        const origin = form.querySelector('#input-origin').value.trim();
        const price = parseFloat(form.querySelector('#input-price').value);
        const description = form.querySelector('#input-desc').value.trim();

        const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || '{}');
        
        let imageUrl = 'images/african_grey.png';
        let imageUrls = [];
        let videoUrl = null;

        // Auto fallback image based on species title
        const key = name.toLowerCase();
        if (key.includes('grey') || key.includes('african')) imageUrl = 'images/african_grey.png';
        else if (key.includes('scarlet') || key.includes('macaw')) imageUrl = 'images/scarlet_macaw.png';
        else if (key.includes('conure') || key.includes('sun')) imageUrl = 'images/sun_conure.png';
        else if (key.includes('eclectus')) imageUrl = 'images/eclectus_parrot.png';
        else if (key.includes('hyacinth')) imageUrl = 'images/hyacinth_macaw.png';
        else if (key.includes('cockatiel')) imageUrl = 'images/cockatiel.png';
        else if (key.includes('budgie') || key.includes('budgerigar')) imageUrl = 'images/budgie.png';
        else if (key.includes('lovebird')) imageUrl = 'images/lovebird.png';
        else if (key.includes('finch') || key.includes('zebra') || key.includes('gouldian')) imageUrl = 'images/finch.png';
        else if (key.includes('canary')) imageUrl = 'images/canary.png';
        imageUrls.push(imageUrl);

        // Handle Multi-Images & Video Upload
        const imagesInput = form.querySelector('#input-images-file');
        const videoInput = form.querySelector('#input-video-file');

        // Read local user selected files directly into Base64 data URLs for guaranteed rendering
        const readDataUrl = (file) => new Promise(res => {
            const r = new FileReader();
            r.onload = e => res(e.target.result);
            r.onerror = () => res(null);
            r.readAsDataURL(file);
        });

        if (imagesInput && imagesInput.files && imagesInput.files.length > 0) {
            const selectedImages = [];
            for (let i = 0; i < Math.min(imagesInput.files.length, 3); i++) {
                const b64 = await readDataUrl(imagesInput.files[i]);
                if (b64) selectedImages.push(b64);
            }
            if (selectedImages.length > 0) {
                imageUrls = selectedImages;
                imageUrl = selectedImages[0];
            }
        }

        if (videoInput && videoInput.files && videoInput.files[0]) {
            try {
                const vidFile = videoInput.files[0];
                const b64Vid = await readDataUrl(vidFile);
                if (b64Vid) {
                    videoUrl = b64Vid;
                } else if (window.URL) {
                    videoUrl = URL.createObjectURL(vidFile);
                }
            } catch(e) {}
        }

        const formData = new FormData();
        let hasFiles = false;

        if (imagesInput && imagesInput.files && imagesInput.files.length > 0) {
            for (let i = 0; i < Math.min(imagesInput.files.length, 3); i++) {
                formData.append('images[]', imagesInput.files[i]);
            }
            hasFiles = true;
        }

        if (videoInput && videoInput.files && videoInput.files[0]) {
            formData.append('video', videoInput.files[0]);
            hasFiles = true;
        }

        if (hasFiles) {
            try {
                const uploadRes = await fetch('api/upload.php', {
                    method: 'POST',
                    body: formData
                });
                const uploadData = await uploadRes.json();
                if (uploadData.success) {
                    if (uploadData.image_url) imageUrl = uploadData.image_url;
                    if (Array.isArray(uploadData.image_urls) && uploadData.image_urls.length > 0) {
                        imageUrls = uploadData.image_urls;
                    }
                    if (uploadData.video_url) videoUrl = uploadData.video_url;
                }
            } catch (err) {
                console.log("Using client-side media URLs.");
            }
        }

        const newListing = {
            id: 'post_' + Date.now() + '_' + Math.floor(Math.random()*1000),
            user_id: currentUser.id || 1,
            name: name,
            sci: name + ' Species',
            origin: origin,
            life: 'Young & Healthy',
            price: price,
            volume: 'Moderate',
            friendly: true,
            intel: 'Active Learner',
            category: category,
            verified: false,
            breeder: currentUser.name || 'Registered Member',
            email: currentUser.email || 'user@avinest.com',
            date: new Date().toISOString().split('T')[0],
            image: imageUrl,
            images: imageUrls,
            video: videoUrl,
            description: description
        };

        fetch('api/birds.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newListing)
        })
        .then(res => res.json())
        .then(data => {
            sessionStorage.removeItem('avinest_listings');
            if (window.showToast) window.showToast("🎉 Listing posted successfully to Marketplace!");
            form.reset();
            closeModal();
            if (typeof fetchMyListings === 'function') fetchMyListings();
            if (typeof renderFeed === 'function') renderFeed();
            if (typeof renderMarketplace === 'function') renderMarketplace();
        })
        .catch(() => {
            saveListing(newListing);
            if (window.showToast) window.showToast("🎉 Listing posted successfully!");
            form.reset();
            closeModal();
            if (typeof fetchMyListings === 'function') fetchMyListings();
            if (typeof renderFeed === 'function') renderFeed();
        });
    });
}

/* ==========================================
   5. Dynamic Header Auth & Role Redirection System
   ========================================== */
document.addEventListener('DOMContentLoaded', () => {
    // Purge old default listings from sessionStorage so legacy cards never render
    try {
        const stored = sessionStorage.getItem('avinest_listings');
        if (stored) {
            const parsed = JSON.parse(stored);
            const cleaned = parsed.filter(item => item.breeder !== 'Luxe Avian Farms' && item.breeder !== 'Local Avian Owner' && !['101', '102', '103', '104', '105', '106', '107', '108'].includes(String(item.id)));
            sessionStorage.setItem('avinest_listings', JSON.stringify(cleaned));
        }
    } catch(e) {}

    initListBirdModal();
    renderHeaderAuth();
});

function renderHeaderAuth() {
    const container = document.getElementById('header-auth-container');
    if (!container) return;

    const currentUser = JSON.parse(sessionStorage.getItem('avinest_current_user') || 'null');
    container.innerHTML = '';

    if (currentUser) {
        const isAdmin = currentUser.role === 'admin' || currentUser.email === 'admin@avinest.com';
        const targetDashboard = isAdmin ? 'admin.php' : 'user-dashboard.php';

        container.innerHTML = `
            <div onclick="window.location.href='${targetDashboard}'" class="flex items-center gap-1.5 bg-primary text-white px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full hover:bg-primary/90 transition-all cursor-pointer shadow-sm max-w-[120px] sm:max-w-none overflow-hidden flex-shrink-0">
                <span class="material-symbols-outlined text-[16px] sm:text-[18px] text-white flex-shrink-0">account_circle</span>
                <span class="font-bold text-xs text-white truncate hidden sm:block">${currentUser.name}</span>
                <span class="bg-white text-primary text-[10px] px-1.5 py-0.5 rounded-full font-bold flex-shrink-0">${isAdmin ? 'Admin' : 'Me'}</span>
            </div>
            <button onclick="logoutCurrentUser()" class="text-error hover:bg-error-container p-1.5 rounded-full transition-colors flex items-center justify-center cursor-pointer flex-shrink-0" title="Logout">
                <span class="material-symbols-outlined text-[18px] sm:text-[20px]">logout</span>
            </button>
        `;
    } else {
        container.innerHTML = `
            <button onclick="openAuthModal()" class="bg-primary text-white dark:bg-primary-fixed dark:text-on-primary-fixed font-label-md px-2.5 sm:px-4 py-1.5 sm:py-2 rounded-full hover:scale-102 active:scale-98 transition-transform flex items-center gap-1 shadow-sm cursor-pointer text-xs sm:text-sm flex-shrink-0" title="Login / Signup">
                <span class="material-symbols-outlined text-[18px]">login</span>
                <span class="hidden sm:inline">Login / Signup</span>
            </button>
        `;
    }

    // Synchronize Mobile Navigation Drawer Dashboard Link
    const mobDashboardLink = document.querySelector('#mob-nav-drawer a[href*="dashboard"]');
    if (mobDashboardLink) {
        if (currentUser) {
            mobDashboardLink.style.setProperty('display', 'flex', 'important');
            const isAdmin = currentUser.role === 'admin' || currentUser.email === 'admin@avinest.com';
            mobDashboardLink.setAttribute('href', isAdmin ? 'admin.php' : 'user-dashboard.php');
        } else {
            mobDashboardLink.style.setProperty('display', 'none', 'important');
        }
    }

    // Attach Mobile Navigation Drawer Listener
    const mobileBtn = document.getElementById('mobile-hamburger-btn');
    if (mobileBtn) {
        mobileBtn.addEventListener('click', () => {
            let drawer = document.getElementById('mobile-nav-drawer');
            if (drawer) {
                drawer.remove();
            } else {
                drawer = document.createElement('div');
                drawer.id = 'mobile-nav-drawer';
                drawer.className = 'mobile-menu-drawer animate-fade-in';
                drawer.innerHTML = `
                    <a href="index.php" class="font-bold text-sm text-primary dark:text-primary-fixed py-2 border-b border-slate-100 dark:border-slate-800">🏠 Home</a>
                    <a href="parrots.php" class="font-bold text-sm text-slate-700 dark:text-slate-200 py-2 border-b border-slate-100 dark:border-slate-800">🦜 Categories & Species</a>
                    <a href="marketplace.php" class="font-bold text-sm text-slate-700 dark:text-slate-200 py-2 border-b border-slate-100 dark:border-slate-800">🛒 Marketplace Feed</a>
                    ${currentUser ? `<a href="${currentUser.role === 'admin' ? 'admin.php' : 'user-dashboard.php'}" class="font-bold text-sm text-emerald-600 dark:text-emerald-400 py-2">👤 My Account Dashboard</a>` : ''}
                `;
                document.querySelector('header').appendChild(drawer);
            }
        });
    }
}

/* Custom UI Modal Engine (Replaces Browser default alerts) */
window.showCustomModal = function({ title, message, icon = 'info', type = 'primary', buttonText = 'OK', onAction = null }) {
    let modal = document.getElementById('custom-ui-modal');
    if (modal) modal.remove();

    modal = document.createElement('div');
    modal.id = 'custom-ui-modal';
    modal.className = 'fixed inset-0 bg-black/70 backdrop-blur-sm z-[150] flex items-center justify-center p-4 transition-all duration-300';
    modal.innerHTML = `
        <div class="bg-surface dark:bg-on-surface p-8 rounded-3xl max-w-sm w-full shadow-2xl relative border border-outline-variant/30 text-center animate-fade-in">
            <div class="w-16 h-16 rounded-full bg-primary-container text-primary mx-auto flex items-center justify-center mb-4 shadow-sm">
                <span class="material-symbols-outlined text-3xl">${icon}</span>
            </div>
            <h3 class="font-display-lg text-xl font-bold text-primary dark:text-primary-fixed mb-2">${title}</h3>
            <p class="text-sm text-on-surface-variant dark:text-surface-variant mb-6">${message}</p>
            <button id="custom-modal-btn" class="w-full bg-primary text-white dark:bg-primary-fixed dark:text-on-primary-fixed font-label-md py-3 rounded-xl hover:scale-102 active:scale-98 transition-transform shadow-md font-bold">
                ${buttonText}
            </button>
        </div>
    `;
    document.body.appendChild(modal);

    modal.querySelector('#custom-modal-btn').addEventListener('click', () => {
        modal.remove();
        if (typeof onAction === 'function') onAction();
    });
};

/* Amazing Animated Success Modal Engine */
window.showSuccessModal = function({ title, message, icon = 'verified', badge = 'SUCCESS', buttonText = 'Awesome!', onConfirm = null }) {
    let modal = document.getElementById('success-custom-modal');
    if (modal) modal.remove();

    modal = document.createElement('div');
    modal.id = 'success-custom-modal';
    modal.className = 'fixed inset-0 bg-black/75 backdrop-blur-md z-[200] flex items-center justify-center p-4 transition-all duration-300 animate-fade-in';
    modal.innerHTML = `
        <div class="bg-slate-900 text-white p-6 sm:p-8 rounded-3xl max-w-md w-full shadow-2xl relative border-2 border-emerald-500/50 text-center animate-scale-up">
            <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-emerald-600 to-emerald-400 text-white mx-auto flex items-center justify-center mb-5 shadow-lg shadow-emerald-500/30">
                <span class="material-symbols-outlined text-4xl">${icon}</span>
            </div>
            <span class="bg-emerald-500/20 text-emerald-300 text-[10px] font-extrabold px-3.5 py-1 rounded-full uppercase tracking-wider mb-3 inline-block border border-emerald-400/30">${badge}</span>
            <h3 class="text-xl sm:text-2xl font-extrabold text-white mb-2 tracking-tight">${title}</h3>
            <p class="text-xs sm:text-sm text-slate-300 mb-6 leading-relaxed font-medium">${message}</p>
            <button id="success-modal-close-btn" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold py-3.5 rounded-xl transition-all shadow-lg text-xs sm:text-sm cursor-pointer border-none flex items-center justify-center gap-2">
                ${buttonText} <span class="material-symbols-outlined text-base">arrow_forward</span>
            </button>
        </div>
    `;
    document.body.appendChild(modal);

    modal.querySelector('#success-modal-close-btn').addEventListener('click', () => {
        modal.remove();
        if (typeof onConfirm === 'function') onConfirm();
    });
};

window.showConfirmModal = function({ title, message, icon = 'help', confirmText = 'Confirm', cancelText = 'Cancel', onConfirm = null }) {
    let modal = document.getElementById('confirm-ui-modal');
    if (modal) modal.remove();

    modal = document.createElement('div');
    modal.id = 'confirm-ui-modal';
    modal.className = 'fixed inset-0 bg-black/70 backdrop-blur-sm z-[150] flex items-center justify-center p-4 transition-all duration-300';
    modal.innerHTML = `
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl max-w-sm w-full shadow-2xl relative border border-slate-200 dark:border-slate-800 text-center animate-fade-in">
            <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/40 text-red-600 dark:text-red-400 mx-auto flex items-center justify-center mb-4 shadow-sm">
                <span class="material-symbols-outlined text-3xl">${icon}</span>
            </div>
            <h3 class="font-display-lg text-xl font-bold text-slate-900 dark:text-white mb-2">${title}</h3>
            <p class="text-sm text-slate-600 dark:text-slate-300 mb-6 leading-relaxed">${message}</p>
            <div class="flex gap-3">
                <button id="confirm-cancel-btn" class="flex-1 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-white font-bold py-3 px-4 rounded-xl border border-slate-300 dark:border-slate-700 transition-all cursor-pointer">
                    ${cancelText}
                </button>
                <button id="confirm-ok-btn" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition-all cursor-pointer border-none">
                    ${confirmText}
                </button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);

    modal.querySelector('#confirm-cancel-btn').addEventListener('click', () => {
        modal.remove();
    });

    modal.querySelector('#confirm-ok-btn').addEventListener('click', () => {
        modal.remove();
        if (typeof onConfirm === 'function') onConfirm();
    });
};

window.logoutCurrentUser = function() {
    showConfirmModal({
        title: "Logout Confirmation",
        message: "Are you sure you want to log out of your BirdBazaar account?",
        icon: "logout",
        confirmText: "Yes, Logout",
        cancelText: "Cancel",
        onConfirm: () => {
            sessionStorage.removeItem('avinest_current_user');
            fetch('api/auth.php?action=logout').finally(() => {
                if (window.showToast) window.showToast("Logged out successfully");
                window.location.href = 'index.php';
            });
        }
    });
};

window.togglePasswordVisibility = function(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('.material-symbols-outlined');
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility';
    }
};

window.openAuthModal = function() {
    let authModal = document.getElementById('auth-modal-overlay');
    if (!authModal) {
        authModal = document.createElement('div');
        authModal.id = 'auth-modal-overlay';
        authModal.className = 'fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] flex items-center justify-center p-4 transition-all duration-300';
        authModal.innerHTML = `
            <div class="bg-surface dark:bg-on-surface p-8 rounded-3xl max-w-md w-full shadow-2xl relative border border-outline-variant/30">
                <button id="close-auth-modal" class="absolute top-6 right-6 text-outline hover:text-on-surface">
                    <span class="material-symbols-outlined text-2xl">close</span>
                </button>
                <div class="flex items-center gap-2.5 mb-6">
                    <img src="images/logo.png" alt="BirdBazaar Logo" class="w-10 h-10 object-contain" />
                    <h3 class="font-display-lg text-headline-md font-bold text-primary dark:text-primary-fixed">BirdBazaar Portal</h3>
                </div>
                
                <!-- Auth Tabs -->
                <div class="flex border-b border-outline-variant/30 mb-6">
                    <button id="tab-login" class="flex-1 py-2 font-bold text-primary border-b-2 border-primary">Login</button>
                    <button id="tab-signup" class="flex-1 py-2 text-outline">Signup</button>
                </div>

                <!-- Login Form -->
                <form id="auth-login-form" class="space-y-4">
                    <div>
                        <label class="font-label-md block mb-1 text-on-surface dark:text-white">Email Address</label>
                        <input type="email" id="login-email" required placeholder="Enter your email address" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40" />
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="font-label-md text-on-surface dark:text-white">Password</label>
                            <button type="button" id="btn-show-forgot" class="text-xs text-primary font-bold hover:underline">Forgot Password?</button>
                        </div>
                        <div class="relative">
                            <input type="password" id="login-password" required placeholder="••••••••" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 pr-10 focus:border-primary dark:bg-on-surface/40 transition-colors" />
                            <button type="button" onclick="togglePasswordVisibility('login-password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors flex items-center justify-center cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                        <p id="login-password-error" class="text-xs text-red-500 font-bold mt-1.5 hidden flex items-center gap-1">❌ Ghalat password darj kiya gaya hai. Baraye meherbani sahi password dobara try karein.</p>
                    </div>
                    <button type="submit" class="w-full bg-primary text-white font-label-md py-3 rounded-lg hover:scale-101 transition-transform flex items-center justify-center gap-2 shadow-md">
                        Login to Dashboard <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </form>

                <!-- Signup Form -->
                <form id="auth-signup-form" class="space-y-4 hidden">
                    <div>
                        <label class="font-label-md block mb-1 text-on-surface dark:text-white">Full Name</label>
                        <input type="text" id="signup-name" required placeholder="John Doe" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40" />
                    </div>
                    <div>
                        <label class="font-label-md block mb-1 text-on-surface dark:text-white">Email Address</label>
                        <input type="email" id="signup-email" required placeholder="user@gmail.com" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40" />
                    </div>
                    <div>
                        <label class="font-label-md block mb-1 text-on-surface dark:text-white">Password</label>
                        <div class="relative">
                            <input type="password" id="signup-password" required placeholder="••••••••" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 pr-10 focus:border-primary dark:bg-on-surface/40" />
                            <button type="button" onclick="togglePasswordVisibility('signup-password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors flex items-center justify-center cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="font-label-md block mb-1 text-on-surface dark:text-white">Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="signup-confirm-password" required placeholder="••••••••" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 pr-10 focus:border-primary dark:bg-on-surface/40" />
                            <button type="button" onclick="togglePasswordVisibility('signup-confirm-password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors flex items-center justify-center cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-primary text-white font-label-md py-3 rounded-lg hover:scale-101 transition-transform flex items-center justify-center gap-2 shadow-md">
                        Create Account <span class="material-symbols-outlined">person_add</span>
                    </button>
                </form>

                <!-- Forgot Password Form -->
                <form id="auth-forgot-form" class="space-y-4 hidden">
                    <p class="text-xs text-on-surface-variant mb-2">Enter your registered email address. We will generate and download an MS Word (.doc) recovery file to your device.</p>
                    <div>
                        <label class="font-label-md block mb-1 text-on-surface dark:text-white">Registered Email Address</label>
                        <input type="email" id="forgot-email" required placeholder="your.email@avinest.com" class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40" />
                    </div>
                    <button type="submit" class="w-full bg-tertiary text-white font-label-md py-3 rounded-lg hover:scale-101 transition-transform flex items-center justify-center gap-2 shadow-md">
                        Download MS Word Recovery <span class="material-symbols-outlined">description</span>
                    </button>
                    <button type="button" id="btn-back-to-login" class="w-full text-center text-xs text-outline hover:underline pt-2">Back to Login</button>
                </form>
            </div>
        `;
        document.body.appendChild(authModal);

        // Tab & Form Switching
        const tabLogin = authModal.querySelector('#tab-login');
        const tabSignup = authModal.querySelector('#tab-signup');
        const formLogin = authModal.querySelector('#auth-login-form');
        const formSignup = authModal.querySelector('#auth-signup-form');
        const formForgot = authModal.querySelector('#auth-forgot-form');
        const btnShowForgot = authModal.querySelector('#btn-show-forgot');
        const btnBackToLogin = authModal.querySelector('#btn-back-to-login');
        const loginPassInput = authModal.querySelector('#login-password');
        const loginPassErr = authModal.querySelector('#login-password-error');

        // Clear password error when user types
        if (loginPassInput) {
            loginPassInput.addEventListener('input', () => {
                if (loginPassErr) loginPassErr.classList.add('hidden');
                loginPassInput.classList.remove('border-red-500', 'ring-1', 'ring-red-500');
            });
        }

        tabLogin.addEventListener('click', () => {
            tabLogin.className = 'flex-1 py-2 font-bold text-primary border-b-2 border-primary';
            tabSignup.className = 'flex-1 py-2 text-outline';
            formLogin.classList.remove('hidden');
            formSignup.classList.add('hidden');
            formForgot.classList.add('hidden');
        });

        tabSignup.addEventListener('click', () => {
            tabSignup.className = 'flex-1 py-2 font-bold text-primary border-b-2 border-primary';
            tabLogin.className = 'flex-1 py-2 text-outline';
            formSignup.classList.remove('hidden');
            formLogin.classList.add('hidden');
            formForgot.classList.add('hidden');
        });

        btnShowForgot.addEventListener('click', () => {
            formLogin.classList.add('hidden');
            formSignup.classList.add('hidden');
            formForgot.classList.remove('hidden');
        });

        btnBackToLogin.addEventListener('click', () => {
            formForgot.classList.add('hidden');
            formLogin.classList.remove('hidden');
        });

        authModal.querySelector('#close-auth-modal').addEventListener('click', () => {
            authModal.remove();
        });

        // Submit Login Handler
        formLogin.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = authModal.querySelector('#login-email').value.trim();
            const password = authModal.querySelector('#login-password').value;

            // Reset password error
            if (loginPassErr) loginPassErr.classList.add('hidden');
            if (loginPassInput) loginPassInput.classList.remove('border-red-500', 'ring-1', 'ring-red-500');

            // 1. Check if user account was deleted by Admin
            let deletedUsers = [];
            try {
                const stored = sessionStorage.getItem('avinest_deleted_users');
                if (stored) deletedUsers = JSON.parse(stored);
            } catch(err) {}

            if (deletedUsers.includes(email.toLowerCase())) {
                authModal.remove();
                window.showCustomModal({
                    title: "⛔ Account Deleted",
                    message: `Aapka BirdBazaar account (${email}) Administrator ki taraf se delete kar diya gaya hai. Aap ab is account se login nahi kar sakte.`,
                    icon: "block",
                    type: "error",
                    buttonText: "Understand"
                });
                return;
            }

            fetch('api/auth.php?action=login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.user) {
                    sessionStorage.setItem('avinest_current_user', JSON.stringify(data.user));
                    authModal.remove();
                    renderHeaderAuth();
                    redirectUserByRole(data.user);
                } else {
                    if (data.error_code === 'wrong_password') {
                        // Show inline error under password input
                        if (loginPassErr) {
                            loginPassErr.textContent = "❌ Incorrect password. Please check your credentials and try again.";
                            loginPassErr.classList.remove('hidden');
                        }
                        if (loginPassInput) {
                            loginPassInput.classList.add('border-red-500', 'ring-1', 'ring-red-500');
                            loginPassInput.focus();
                        }
                    } else if (data.error_code === 'account_not_found') {
                        // Pop-up for unregistered account
                        window.showCustomModal({
                            title: "⚠️ Account Not Registered",
                            message: `Is email address (${email}) par koi account registered nahi hai. Pehle naya account register karein.`,
                            icon: "person_add",
                            type: "warning",
                            buttonText: "Register Now",
                            onAction: () => {
                                tabSignup.click();
                                const signupEmailInput = authModal.querySelector('#signup-email');
                                if (signupEmailInput) signupEmailInput.value = email;
                            }
                        });
                    } else if (data.error_code === 'account_deactivated' || (data.message && data.message.includes('deactivated'))) {
                        authModal.remove();
                        openReactivationAppealModal(email);
                    } else {
                        fallbackAuthLogin(email, password, authModal);
                    }
                }
            })
            .catch(() => {
                fallbackAuthLogin(email, password, authModal);
            });
        });

        // Submit Signup Handler
        formSignup.addEventListener('submit', (e) => {
            e.preventDefault();
            const rawName = authModal.querySelector('#signup-name').value.trim();
            const name = capitalizeTitleCase(rawName);
            const email = authModal.querySelector('#signup-email').value.trim();
            const password = authModal.querySelector('#signup-password').value;
            const confirmPassword = authModal.querySelector('#signup-confirm-password').value;

            if (password !== confirmPassword) {
                window.showCustomModal({
                    title: "❌ Passwords Do Not Match",
                    message: "Baraye meherbani dono password field me ek jaisa password likhein.",
                    icon: "error",
                    type: "error",
                    buttonText: "OK"
                });
                return;
            }

            fetch('api/auth.php?action=register', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, email, password, role: 'user' })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.user) {
                    data.user.name = name;
                    sessionStorage.setItem('avinest_current_user', JSON.stringify(data.user));
                    authModal.remove();
                    renderHeaderAuth();
                    redirectUserByRole(data.user);
                } else if (data.error_code === 'account_permanently_deleted' || (data.message && data.message.includes('permanently deleted'))) {
                    window.showCustomModal({
                        title: "⛔ Account Permanently Deleted",
                        message: `Is email address (${email}) ko Administrator ki taraf se permanently delete kar diya gaya hai. Aap is email se naya account register nahi kar sakte.`,
                        icon: "block",
                        type: "error",
                        buttonText: "Understand"
                    });
                } else if (data.error_code === 'email_already_exists' || (data.message && data.message.includes('already registered'))) {
                    window.showCustomModal({
                        title: "⚠️ Email Already Registered",
                        message: `Yeh email address (${email}) pehle se registered hai. Baraye meherbani Log In karein ya naya email address istemal karein.`,
                        icon: "alternate_email",
                        type: "warning",
                        buttonText: "Go to Log In",
                        onAction: () => {
                            tabLogin.click();
                            const loginEmailInput = authModal.querySelector('#login-email');
                            if (loginEmailInput) loginEmailInput.value = email;
                        }
                    });
                } else if (data.error_code === 'db_offline' || (data.message && data.message.includes('Database Connection Error'))) {
                    fallbackAuthSignup(name, email, password, authModal);
                } else {
                    window.showCustomModal({
                        title: "⚠️ Registration Error",
                        message: data.message || "Failed to create account.",
                        icon: "error",
                        type: "error",
                        buttonText: "OK"
                    });
                }
            })
            .catch(() => {
                fallbackAuthSignup(name, email, password, authModal);
            });
        });

        // Submit Forgot Password Handler
        formForgot.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = authModal.querySelector('#forgot-email').value.trim();

            fetch('api/auth.php?action=forgot_password', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.user) {
                    downloadMsWordPasswordDoc(data.user);
                    if (window.showToast) window.showToast("📄 MS Word Recovery Document Downloaded!");
                    authModal.remove();
                } else {
                    fallbackForgotPassword(email, authModal);
                }
            })
            .catch(() => {
                fallbackForgotPassword(email, authModal);
            });
        });
    }
};

function capitalizeTitleCase(str) {
    if (!str) return '';
    return str.split(' ')
              .map(w => w.length > 0 ? w.charAt(0).toUpperCase() + w.slice(1).toLowerCase() : '')
              .join(' ');
}

function fallbackAuthLogin(email, password, modal) {
    const showInlinePasswordError = () => {
        const passErr = modal ? modal.querySelector('#login-password-error') : null;
        const passInput = modal ? modal.querySelector('#login-password') : null;
        if (passErr) {
            passErr.textContent = "❌ Incorrect password. Please check your credentials and try again.";
            passErr.classList.remove('hidden');
        }
        if (passInput) {
            passInput.classList.add('border-red-500', 'ring-1', 'ring-red-500');
            passInput.focus();
        }
    };

    let deletedUsers = [];
    try {
        const stored = sessionStorage.getItem('avinest_deleted_users');
        if (stored) deletedUsers = JSON.parse(stored);
    } catch(e) {}

    // 1. Check if user account was deleted by Admin
    if (deletedUsers.includes(email.toLowerCase())) {
        if (modal) modal.remove();
        window.showCustomModal({
            title: "⛔ Account Deleted",
            message: `Aapka BirdBazaar account (${email}) Administrator ki taraf se delete kar diya gaya hai. Aap ab is account se login nahi kar sakte.`,
            icon: "block",
            type: "error",
            buttonText: "Understand"
        });
        return;
    }

    // 2. Admin Account Password Check (Broad Admin Match for admin@canopy.com, admin@avinest.com, etc.)
    const isAdmin = email.toLowerCase().includes('admin') || email.toLowerCase().endsWith('@avinest.com') || email.toLowerCase().endsWith('@canopy.com');
    if (isAdmin) {
        if (password !== 'admin123') {
            showInlinePasswordError();
            return;
        }
        const userObj = {
            id: 1,
            name: 'BirdBazaar Admin',
            email: email,
            role: 'admin',
            status: 'active'
        };
        sessionStorage.setItem('avinest_current_user', JSON.stringify(userObj));
        if (modal) modal.remove();
        renderHeaderAuth();
        redirectUserByRole(userObj);
        return;
    }

    // 3. Seed Breeder Accounts Password Check
    const seedBreeders = {
        'luxe@avianfarms.com': { id: 2, name: 'Luxe Avian Farms', role: 'breeder', status: 'active' },
        'sunny@wings.com': { id: 3, name: 'Sunny Wings Breeding', role: 'breeder', status: 'active' },
        'apex@breeders.com': { id: 4, name: 'Apex Breeders', role: 'breeder', status: 'active' },
        'tiny@wings.com': { id: 5, name: 'Tiny Wings Aviary', role: 'breeder', status: 'unactive' }
    };

    const seedBreeder = seedBreeders[email.toLowerCase()];
    if (seedBreeder) {
        if (password !== 'password123') {
            showInlinePasswordError();
            return;
        }
        if (seedBreeder.status === 'unactive') {
            if (modal) modal.remove();
            openReactivationAppealModal(email);
            return;
        }
        const userObj = {
            id: seedBreeder.id,
            name: seedBreeder.name,
            email: email,
            role: 'breeder',
            status: 'active'
        };
        sessionStorage.setItem('avinest_current_user', JSON.stringify(userObj));
        if (modal) modal.remove();
        renderHeaderAuth();
        redirectUserByRole(userObj);
        return;
    }

    // 4. Session Storage Registered Users Password Check
    let users = JSON.parse(sessionStorage.getItem('avinest_users') || '[]');
    const existing = users.find(u => u.email.toLowerCase() === email.toLowerCase());

    if (existing) {
        if (existing.password && existing.password !== password) {
            showInlinePasswordError();
            return;
        } else if (!existing.password && password !== 'password123' && password !== 'user123') {
            showInlinePasswordError();
            return;
        }

        if (existing.status && (existing.status.toLowerCase() === 'inactive' || existing.status.toLowerCase() === 'unactive')) {
            if (modal) modal.remove();
            openReactivationAppealModal(email);
            return;
        }
        sessionStorage.setItem('avinest_current_user', JSON.stringify(existing));
        if (modal) modal.remove();
        renderHeaderAuth();
        redirectUserByRole(existing);
        return;
    }

    // 5. Unregistered Account Popup
    window.showCustomModal({
        title: "⚠️ Account Not Registered",
        message: `Is email address (${email}) par koi account registered nahi hai. Baraye meherbani pehle naya account register karein.`,
        icon: "person_add",
        type: "warning",
        buttonText: "Register Now",
        onAction: () => {
            const tabSignup = modal ? modal.querySelector('#tab-signup') : null;
            if (tabSignup) tabSignup.click();
            const signupEmailInput = modal ? modal.querySelector('#signup-email') : null;
            if (signupEmailInput) signupEmailInput.value = email;
        }
    });
}

function fallbackAuthSignup(name, email, modal) {
    let deletedUsers = [];
    try {
        const stored = sessionStorage.getItem('avinest_deleted_users');
        if (stored) deletedUsers = JSON.parse(stored);
    } catch(e) {}

    if (deletedUsers.includes(email.toLowerCase())) {
        window.showCustomModal({
            title: "⛔ Account Permanently Deleted",
            message: `Is email address (${email}) ko Administrator ki taraf se permanently delete kar diya gaya hai. Aap is email se naya account register nahi kar sakte.`,
            icon: "block",
            type: "error",
            buttonText: "Understand"
        });
        return;
    }

    let users = JSON.parse(sessionStorage.getItem('avinest_users') || '[]');
    const existing = users.find(u => u.email.toLowerCase() === email.toLowerCase());

    if (existing) {
        window.showCustomModal({
            title: "⚠️ Email Already Registered",
            message: `Yeh email address (${email}) pehle se registered hai. Baraye meherbani Log In karein ya naya email address istemal karein.`,
            icon: "alternate_email",
            type: "warning",
            buttonText: "Go to Log In",
            onAction: () => {
                const tabLogin = modal ? modal.querySelector('#tab-login') : null;
                if (tabLogin) tabLogin.click();
                const loginEmailInput = modal ? modal.querySelector('#login-email') : null;
                if (loginEmailInput) loginEmailInput.value = email;
            }
        });
        return;
    }

    const formattedName = capitalizeTitleCase(name);
    const passwordInput = modal ? modal.querySelector('#signup-password') : null;
    const pwd = passwordInput ? passwordInput.value : 'password123';

    const newUser = {
        id: Date.now(),
        name: formattedName,
        email: email,
        password: pwd,
        role: 'user',
        status: 'active'
    };

    users.unshift(newUser);
    sessionStorage.setItem('avinest_users', JSON.stringify(users));
    sessionStorage.setItem('avinest_current_user', JSON.stringify(newUser));

    modal.remove();
    renderHeaderAuth();
    redirectUserByRole(newUser);
}

function openReactivationAppealModal(userEmail) {
    let appealModal = document.getElementById('appeal-modal-overlay');
    if (!appealModal) {
        appealModal = document.createElement('div');
        appealModal.id = 'appeal-modal-overlay';
        appealModal.className = 'fixed inset-0 bg-black/70 backdrop-blur-sm z-[110] flex items-center justify-center p-4';
        appealModal.innerHTML = `
            <div class="bg-surface dark:bg-on-surface p-8 rounded-3xl max-w-md w-full shadow-2xl relative border border-error/30">
                <button id="close-appeal-modal" class="absolute top-6 right-6 text-outline hover:text-on-surface">
                    <span class="material-symbols-outlined text-2xl">close</span>
                </button>
                <div class="flex items-center gap-2 mb-4 text-error">
                    <span class="material-symbols-outlined text-3xl">lock</span>
                    <h3 class="font-display-lg text-xl font-bold">Account Deactivated</h3>
                </div>
                <p class="text-xs text-on-surface-variant mb-4">Your account (<strong class="text-primary">${userEmail}</strong>) has been deactivated by the Administrator. You can submit an appeal request directly to the Admin below.</p>
                
                <form id="appeal-request-form" class="space-y-4">
                    <div>
                        <label class="font-label-md block mb-1 text-on-surface dark:text-white">Reason / Message for Reactivation</label>
                        <textarea id="appeal-reason-text" required rows="4" placeholder="Please explain why your account should be reactivated..." class="w-full rounded-lg border-outline-variant bg-surface-container-low text-body-md p-3 focus:border-primary dark:bg-on-surface/40"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary text-white font-label-md py-3 rounded-lg hover:scale-101 transition-transform flex items-center justify-center gap-2 shadow-md">
                        Submit Request to Admin <span class="material-symbols-outlined">send</span>
                    </button>
                </form>
            </div>
        `;
        document.body.appendChild(appealModal);

        appealModal.querySelector('#close-appeal-modal').addEventListener('click', () => {
            appealModal.remove();
        });

        appealModal.querySelector('#appeal-request-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const reason = appealModal.querySelector('#appeal-reason-text').value.trim();

            let requests = JSON.parse(sessionStorage.getItem('avinest_reactivation_requests') || '[]');
            requests = requests.filter(r => r.email.toLowerCase() !== userEmail.toLowerCase());
            requests.push({
                email: userEmail,
                message: reason,
                date: new Date().toLocaleDateString()
            });
            sessionStorage.setItem('avinest_reactivation_requests', JSON.stringify(requests));

            // Also post to inquiry API as backup
            fetch('api/inquiry.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    buyer_name: `REACTIVATION APPEAL (${userEmail})`,
                    buyer_email: userEmail,
                    message: `[REACTIVATION REQUEST]: ${reason}`
                })
            }).finally(() => {
                window.showCustomModal({
                    title: "📩 Reactivation Request Sent",
                    message: "Aap ki account reactivation request Admin Dashboard ko bhej di gayi hai! Administrator aap ki appeal review karega.",
                    icon: "mark_email_read",
                    type: "success",
                    buttonText: "OK"
                });
                appealModal.remove();
            });
        });
    }
}

function fallbackForgotPassword(email, modal) {
    let users = JSON.parse(sessionStorage.getItem('avinest_users') || '[]');
    let user = users.find(u => u.email.toLowerCase() === email.toLowerCase());

    if (!user) {
        if (email.toLowerCase() === 'admin@birdbazaar.com') {
            user = { name: 'BirdBazaar Admin', email: 'admin@birdbazaar.com', role: 'admin', status: 'active' };
        } else {
            window.showCustomModal({
                title: "⚠️ Account Not Registered",
                message: `Is email address (${email}) par koi registered account nahi mila.`,
                icon: "search_off",
                type: "warning",
                buttonText: "OK"
            });
            return;
        }
    }

    user.recovery_code = "BB-" + Math.floor(100000 + Math.random() * 900000);
    downloadMsWordPasswordDoc(user);
    if (window.showToast) window.showToast("📄 MS Word Recovery Document Downloaded!");
    modal.remove();
}

function redirectUserByRole(user) {
    const isAdmin = user.role === 'admin' || (user.email && user.email.toLowerCase() === 'admin@birdbazaar.com');
    if (isAdmin) {
        window.location.href = 'admin.php';
    } else {
        window.location.href = 'user-dashboard.php';
    }
}

/**
 * Downloads a formatted MS Word (.doc) document containing user password recovery info
 */
function downloadMsWordPasswordDoc(user) {
    const headerHtml = `<html xmlns:o='urn:schemas-microsoft-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
<head>
<meta charset='utf-8'>
<title>BirdBazaar Account Password Recovery</title>
<style>
body { font-family: Arial, sans-serif; margin: 40px; color: #181c19; }
.header { text-align: center; border-bottom: 3px solid #396553; padding-bottom: 15px; margin-bottom: 25px; }
.title { font-size: 24px; font-weight: bold; color: #396553; }
.subtitle { font-size: 14px; color: #717974; }
.card { background-color: #f8f9ff; border: 1px solid #c1c8c2; padding: 20px; border-radius: 10px; margin-bottom: 25px; }
.field-label { font-weight: bold; color: #396553; }
.code-box { font-size: 20px; font-weight: bold; color: #785a00; background-color: #ffe083; padding: 10px; border-radius: 5px; text-align: center; font-family: monospace; letter-spacing: 2px; }
.footer { font-size: 12px; color: #717974; border-top: 1px solid #c1c8c2; padding-top: 15px; text-align: center; }
</style>
</head>
<body>
<div class='header'>
    <div class='title'>BirdBazaar Avian Marketplace & Discovery</div>
    <div class='subtitle'>Official Account Security & Password Recovery Document</div>
</div>

<p>Dear <strong>${user.name}</strong>,</p>
<p>You have requested a password recovery document for your BirdBazaar account. Please find your account recovery credentials below:</p>

<div class='card'>
    <p><span class='field-label'>Account Name:</span> ${user.name}</p>
    <p><span class='field-label'>Registered Email:</span> ${user.email}</p>
    <p><span class='field-label'>Account Role:</span> ${(user.role || 'User').toUpperCase()}</p>
    <p><span class='field-label'>Account Status:</span> ${(user.status || 'Active').toUpperCase()}</p>
    <p><span class='field-label'>Security Recovery Key:</span></p>
    <div class='code-box'>${user.recovery_code || ('BB-' + Math.floor(100000 + Math.random() * 900000))}</div>
</div>

<p><strong>Instructions to Reset Your Password:</strong></p>
<ol>
    <li>Open the BirdBazaar Portal at your browser.</li>
    <li>Click on <strong>Login / Signup</strong> in the header bar.</li>
    <li>Enter your registered email address and the <strong>Security Recovery Key</strong> above as your temporary password.</li>
    <li>Once logged in to your User Dashboard, you can update your password under settings.</li>
</ol>

<div class='footer'>
    <p>© 2026 BirdBazaar Security Systems. This is a confidential password recovery document. Do not share it with anyone.</p>
</div>
</body>
</html>`;

    const blob = new Blob(['\ufeff', headerHtml], {
        type: 'application/msword'
    });

    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `BirdBazaar_Password_Recovery_${user.name.replace(/[^a-zA-Z0-9]/g, '_')}.doc`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}
