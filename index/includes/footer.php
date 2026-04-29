<!-- ════════════════════════════════════════════════════════════
     FOOTER
     ════════════════════════════════════════════════════════════ -->
<footer class="incredible-footer">

    <!-- Decorative wave divider -->
    <div class="footer-wave">
        <svg viewBox="0 0 1440 90" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,60 C240,100 480,20 720,60 C960,100 1200,20 1440,60 L1440,90 L0,90 Z"
                  fill="#0e1f18"/>
        </svg>
    </div>

    <div class="footer-top">
        <div class="footer-container">

            <!-- Brand Column -->
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="footer-logo-icon"><i class="fas fa-torii-gate"></i></div>
                    <div>
                        <div class="footer-logo-text">Explore <span>India</span></div>
                        <div class="footer-logo-sub">Official Travel Guide</div>
                    </div>
                </div>
                <p class="brand-desc">
                    Where every journey becomes a story.<br>
                    Discover the soul of India — one destination at a time.
                </p>
                <div class="footer-badge">
                    <i class="fas fa-award"></i> Trusted by 2M+ Travellers
                </div>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"    title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"   title="Instagram"><i class="fab fa-instagram"></i></a>
                    <!-- <a href="#" aria-label="X / Twitter" title="X"><i class="fab fa-x-twitter"></i></a> -->
                    <a href="#" aria-label="YouTube"     title="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" aria-label="Pinterest"   title="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>

            <!-- Explore Links -->
            <div class="footer-links">
                <h4><span class="footer-h4-line"></span>Explore</h4>
                <ul>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Destinations</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Experiences</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Travel Packages</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Inspiration</a></li>
                </ul>
            </div>

            <!-- Iconic Places -->
            <div class="footer-links">
                <h4><span class="footer-h4-line"></span>Iconic Places</h4>
                <ul>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Taj Mahal</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Kerala Backwaters</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Rajasthan Forts</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Varanasi Ghats</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Ladakh &amp; Spiti</a></li>
                </ul>
            </div>

            <!-- Contact + Newsletter -->
            <div class="footer-contact">
                <h4><span class="footer-h4-line"></span>Get in Touch</h4>
                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <span>Tamilnadu, India</span>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone-volume"></i></div>
                        <span>+91 7397043171</span>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <span>hello@exploreindia.travel</span>
                    </div>
                </div>
                <div class="newsletter">
                    <p class="newsletter-label"><i class="fas fa-paper-plane"></i> Stay Inspired</p>
                    <form class="newsletter-form" onsubmit="return false;">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit" aria-label="Subscribe">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                    <p class="newsletter-note">No spam, unsubscribe anytime.</p>
                </div>
            </div>

        </div><!-- /footer-container -->
    </div><!-- /footer-top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="bottom-container">
            <div class="footer-bottom-left">
                <div class="india-flag-strip">
                
                </div>
                <p>© 2026 Explore India Tourism. Made with <i class="fas fa-heart" style="color:#c0392b;"></i> in India.</p>
            </div>
            <div class="bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Use</a>
                <a href="#">Sitemap</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </div>

</footer>


<!-- ════════════════════════════════════════════════════════════
     JAVASCRIPT  (all original logic preserved)
     ════════════════════════════════════════════════════════════ -->
<script>
/* ── 1. MOBILE NAVIGATION ───────────────────────────────────── */
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const hamburgerIcon = document.getElementById('hamburgerIcon');
const navContainer  = document.getElementById('navContainer');
const mobileSearch  = navContainer.querySelector('.mobile-search');

function toggleMobileNav() {
    const isOpen = navContainer.classList.toggle('mobile-open');
    hamburgerIcon.classList.toggle('fa-bars',  !isOpen);
    hamburgerIcon.classList.toggle('fa-times',  isOpen);
    if (mobileSearch) mobileSearch.style.display = isOpen ? 'block' : 'none';
}

mobileMenuBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    toggleMobileNav();
});

document.addEventListener('click', function(e) {
    if (window.innerWidth <= 768 &&
        navContainer.classList.contains('mobile-open') &&
        !navContainer.contains(e.target) &&
        !mobileMenuBtn.contains(e.target)) {
        toggleMobileNav();
    }
});


/* ── 2. MOBILE SUBMENU ACCORDION ────────────────────────────── */
document.querySelectorAll('.nav-item.has-sub > .nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        if (window.innerWidth > 768) return;
        e.preventDefault();
        e.stopPropagation();
        const parentItem = this.closest('.nav-item');
        const isOpen = parentItem.classList.contains('open');
        document.querySelectorAll('.nav-item.open').forEach(el => el.classList.remove('open'));
        if (!isOpen) parentItem.classList.add('open');
    });
});

window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        navContainer.classList.remove('mobile-open');
        hamburgerIcon.classList.add('fa-bars');
        hamburgerIcon.classList.remove('fa-times');
        document.querySelectorAll('.nav-item.open').forEach(el => el.classList.remove('open'));
    }
});


/* ── 3. SEARCH ───────────────────────────────────────────────── */
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        const q = this.value.trim();
        if (q) { window.location.href = 'search.php?q=' + encodeURIComponent(q); }
    }
});


/* ── 4. WISHLIST GUARD ───────────────────────────────────────── */
function wishlistClick() {
    <?php if (!isset($_SESSION['user_id'])): ?>
        alert('Please login to view your wishlist ❤️');
        return;
    <?php endif; ?>
    window.location.href = 'wishlist.php';
}


/* ── 5. HERO VIDEO CAROUSEL ─────────────────────────────────── */
const videos = document.querySelectorAll('.hero-video');
let currentIndex = 0;
let isMuted = true;

function showVideo(index) {
    videos.forEach((v, i) => {
        v.classList.remove('active');
        v.pause();
        if (i === index) {
            v.classList.add('active');
            v.currentTime = 0;
            v.muted = isMuted;
            v.play().catch(() => {});
        }
    });
}

function nextVideo() { currentIndex = (currentIndex + 1) % videos.length; showVideo(currentIndex); }
function prevVideo() { currentIndex = (currentIndex - 1 + videos.length) % videos.length; showVideo(currentIndex); }

function toggleSound() {
    isMuted = !isMuted;
    videos[currentIndex].muted = isMuted;
    document.getElementById('speakerIcon').className = isMuted ? 'fas fa-volume-mute' : 'fas fa-volume-up';
}

if (videos.length > 0) setInterval(nextVideo, 8000);


/* ── 6. ATTRACTIONS SLIDER — ARROWS + DRAG + TOUCH ─────────── */
const attrSlider = document.getElementById('attrSlider');
if (attrSlider) {
    function slideRight() { attrSlider.scrollLeft += 300; }
    function slideLeft()  { attrSlider.scrollLeft -= 300; }

    (function() {
        let isDragging = false, startX = 0, startScroll = 0, hasMoved = false;

        attrSlider.addEventListener('mousedown', function(e) {
            isDragging = true; hasMoved = false;
            startX = e.pageX; startScroll = attrSlider.scrollLeft;
            attrSlider.classList.add('is-dragging');
        });

        document.addEventListener('mousemove', function(e) {
            if (!isDragging) return;
            const delta = e.pageX - startX;
            if (Math.abs(delta) > 4) hasMoved = true;
            attrSlider.scrollLeft = startScroll - delta;
        });

        document.addEventListener('mouseup', function() {
            if (!isDragging) return;
            isDragging = false;
            attrSlider.classList.remove('is-dragging');
        });

        attrSlider.addEventListener('click', function(e) {
            if (hasMoved) { e.preventDefault(); e.stopPropagation(); }
        }, true);
    })();

    attrSlider.addEventListener('touchstart', function() {}, { passive: true });
}


/* ── 7. EXPERIENCE CARDS FADE-IN ────────────────────────────── */
const expCards = document.querySelectorAll('.experience-card');
const expObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
}, { threshold: 0.12 });
expCards.forEach(c => expObserver.observe(c));


/* ── 8. LESSER KNOWN WONDERS CAROUSEL ──────────────────────── */
const wonders = [
    { img:'sl1.jpg', title:'Madla',        loc:'Madhya Pradesh'     },
    { img:'sl2.jpg', title:'Spiti Valley', loc:'Himachal Pradesh'   },
    { img:'sl3.jpg', title:'Ziro Valley',  loc:'Arunachal Pradesh'  },
    { img:'sl4.jpg', title:'Tawang',       loc:'Arunachal Pradesh'  },
    { img:'sl5.jpg', title:'Chopta',       loc:'Uttarakhand'        },
];
let wonderIdx = 1;
const track = document.getElementById('track');

function renderWonders() {
    if (!track) return;
    track.innerHTML = '';
    const left  = (wonderIdx - 1 + wonders.length) % wonders.length;
    const right = (wonderIdx + 1) % wonders.length;

    [left, wonderIdx, right].forEach((i, pos) => {
        const card = document.createElement('div');
        card.className = 'card' + (pos === 1 ? ' center' : '');
        card.innerHTML = `
            <img src="${wonders[i].img}" alt="${wonders[i].title}">
            <div class="caption">
                <h3>${wonders[i].title}</h3>
                <span><i class="fas fa-location-dot"></i> ${wonders[i].loc}</span>
            </div>`;
        track.appendChild(card);
    });
}

function next() { wonderIdx = (wonderIdx + 1) % wonders.length; renderWonders(); }
function prev() { wonderIdx = (wonderIdx - 1 + wonders.length) % wonders.length; renderWonders(); }

if (track) renderWonders();


/* ── 9. EXPERIENCE NAVIGATION ───────────────────────────────── */
function goToExperience(type) {
    window.location.href = "experience.php?type=" + encodeURIComponent(type);
}
</script>

</body>
</html>