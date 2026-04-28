<?php include "includes/header.php"; ?>
    <style>
  
    /* ─── HERO VIDEO ──────────────────────────────────────────────── */
    .video-hero { position:relative; width:100%; height:90vh; overflow:hidden; }
    .hero-video {
        position:absolute; top:0; left:0;
        width:100%; height:100%; object-fit:cover;
        opacity:0; transition:opacity .7s ease;
    }
    .hero-video.active { opacity:1; z-index:1; }
    .video-nav {
        position:absolute; top:50%; transform:translateY(-50%);
        background:rgba(0,0,0,0.38); color:#fff; border:none;
        width:52px; height:52px; border-radius:50%;
        cursor:pointer; z-index:5; font-size:20px;
        backdrop-filter:blur(6px); transition:all .3s;
        display:flex; align-items:center; justify-content:center;
    }
    .video-nav:hover { background:rgba(0,0,0,.6); transform:translateY(-50%) scale(1.1); }
    .video-nav.left { left:20px; }
    .video-nav.right { right:20px; }
    .speaker-btn {
        position:absolute; right:20px; bottom:20px;
        background:rgba(0,0,0,0.45); color:#fff; border:none;
        width:46px; height:46px; border-radius:50%; cursor:pointer;
        z-index:5; font-size:17px; backdrop-filter:blur(6px);
        display:flex; align-items:center; justify-content:center;
    }
    @media (max-width:768px) {
        .video-hero { height:60vh; }
        .video-nav { width:40px; height:40px; font-size:16px; }
    }

    /* ═══════════════════════════════════════════════════════════════
       UNIFIED BACKGROUND APPLIED TO ALL CONTENT SECTIONS
       ═══════════════════════════════════════════════════════════════ */
    .attractions-section,
    .experience-modern,
    .plan-your-trip,
    .wonders,
    .testimonials-section {
        background-color: var(--site-bg);
        background-image: var(--site-pattern);
    }

    /* Clear old section-specific backgrounds */
    .attractions-section { padding:50px 0; }
    .experience-modern { padding:20px 20px; text-align:center; }
    .plan-your-trip { padding:110px 20px; position:relative; overflow:hidden; }
    .plan-your-trip::before { display:none; } /* remove old pattern overlay (now unified) */
    .testimonials-section { padding:90px 20px; overflow:hidden; position:relative; }
    .testimonials-section::before { display:none; } /* remove old pattern overlay */

    /* ─── ATTRACTIONS ────────────────────────────────────────────── */
    .section-title {
        font-family:'Montserrat',sans-serif;
        font-size:clamp(40px,8vw,80px);
        font-weight:800; letter-spacing:0;
        text-transform:uppercase; text-align:center;
        color:#6b4f2a; margin-bottom:10px;
    }
    .section-title::after {
        content:""; width:60px; height:3px;
        background:#FF9933; display:block; margin:10px auto 0;
    }
    .section-title1 {
        font-family:'Montserrat',sans-serif;
        text-align:center; color:#8a6740; margin-bottom:32px;
        font-size:clamp(14px,3vw,20px);
    }
    .slider-wrapper { position:relative; display:flex; align-items:center; }

    /* ── DRAG-TO-SCROLL SLIDER ─────────────────────────────────── */
    .attractions-slider {
        display:flex; gap:25px;
        overflow-x:auto;           /* always scrollable (hidden scrollbar) */
        scroll-behavior:smooth;
        padding:10px 10px 20px;
        cursor:grab;               /* show grab cursor on desktop */
        -webkit-overflow-scrolling:touch; /* smooth iOS momentum */
        scrollbar-width:none;      /* Firefox */
        -ms-overflow-style:none;   /* IE/Edge */
    }
    .attractions-slider::-webkit-scrollbar { display:none; } /* Chrome/Safari */
    .attractions-slider.is-dragging {
        cursor:grabbing;
        scroll-behavior:auto;      /* disable smooth while dragging for responsiveness */
    }
    .attractions-slider.is-dragging .attraction-card { pointer-events:none; }

   

    /* Scroll indicator pill */
    .scroll-hint {
        text-align:center; margin-top:18px;
        font-size:12px; color:#b08a5a;
        letter-spacing:1px; text-transform:uppercase;
        opacity:.75;
        display:flex; align-items:center; justify-content:center; gap:8px;
    }
    .scroll-hint .hint-track {
        width:60px; height:4px; background:rgba(0,0,0,0.08);
        border-radius:4px; overflow:hidden;
        position:relative;
    }
    .scroll-hint .hint-thumb {
        position:absolute; left:0; top:0; height:100%;
        width:30%; background:linear-gradient(90deg,#FF9933,#138808);
        border-radius:4px; animation:hintSlide 1.8s ease-in-out infinite alternate;
    }
    @keyframes hintSlide { from { left:0; } to { left:70%; } }

    .attraction-card {
        min-width:200px; height:410px; border-radius:18px;
        overflow:hidden; background:#000; position:relative;
        cursor:pointer; transition:transform .4s,box-shadow .4s;
        flex-shrink:0;
    }
    .attraction-card img { width:100%; height:100%; object-fit:cover; transition:transform .6s; }
    .attraction-card::after {
        content:""; position:absolute; inset:0;
        background:linear-gradient(to top,rgba(0,0,0,.7),transparent);
    }
    .card-content { position:absolute; bottom:20px; left:20px; color:#fff; z-index:2; }
    .card-content h3 { font-size:20px; margin-bottom:5px; }
    .card-content p { font-size:14px; opacity:.85; }
    .attraction-card:hover { transform:translateY(-10px) scale(1.03); box-shadow:0 25px 40px rgba(0,0,0,.4); }
    .attraction-card:hover img { transform:scale(1.15); }
    .nav-btn {
        position:absolute; width:45px; height:45px;
        border-radius:50%; border:none; background:#fff;
        box-shadow:0 6px 15px rgba(0,0,0,.2); cursor:pointer;
        z-index:10; font-size:16px; transition:transform .3s;
        display:flex; align-items:center; justify-content:center;
    }
    .nav-btn:hover { transform:scale(1.1); }
    .nav-btn.left { left:-15px; }
    .nav-btn.right { right:-15px; }
    @media (max-width:768px) {
        .attraction-card { min-width:220px; height:380px; }
        .attractions-slider { gap:15px; }
        .nav-btn { display:none; }
    }

    /* ─── EXPERIENCE INDIA ───────────────────────────────────────── */
    .experience-heading { font-family:'Montserrat',sans-serif; font-size:clamp(36px,7vw,72px); font-weight:900; margin-bottom:12px; color:#3a2504; }
    .experience-heading span { background:linear-gradient(90deg,#ff9933,#d4af37,#138808); -webkit-background-clip:text; background-clip:text; color:transparent; }
    .experience-subtitle { font-size:17px; color:#7a5c30; max-width:680px; margin:0 auto 70px; line-height:1.6; }
    .experience-cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:28px; max-width:1400px; margin:0 auto; }
    .experience-card {
        position:relative; height:300px; border-radius:22px;
        overflow:hidden; box-shadow:0 10px 28px rgba(0,0,0,.1);
        cursor:pointer;
        opacity:0; transform:translateY(40px);
        transition:opacity .8s ease,transform .8s ease,box-shadow .4s;
    }
    .experience-card.visible { opacity:1; transform:translateY(0); }
    .experience-card:hover { transform:translateY(-10px) scale(1.03); box-shadow:0 22px 48px rgba(0,0,0,.18); }
    .card-bg { position:absolute; inset:0; background-size:cover; background-position:center; transition:transform .6s; }
    .experience-card:hover .card-bg { transform:scale(1.1); }
    .card-overlay {
        position:absolute; inset:0;
        background:linear-gradient(to top,rgba(0,0,0,.7),rgba(0,0,0,.18));
        display:flex; flex-direction:column; justify-content:flex-end;
        padding:28px; color:#fff; text-align:left;
    }
    .card-overlay i { font-size:32px; margin-bottom:10px; background:linear-gradient(135deg,#ff9933,#138808); -webkit-background-clip:text; color:transparent; }
    .card-overlay h3 { font-size:20px; font-weight:700; margin-bottom:6px; }
    .card-overlay p { font-size:14px; opacity:.9; line-height:1.45; }

    /* ─── PLAN YOUR TRIP ─────────────────────────────────────────── */
    .section-header { text-align:center; margin-bottom:70px; }
    .section-header h2 { font-family:'Playfair Display',serif; font-size:clamp(2.2rem,5vw,3.8rem); color:#1a0f00; margin-bottom:14px; font-weight:700; }
    .section-header h2 span { color:#c41e3a; font-weight:800; }
    .section-header p { font-size:1.15rem; color:#5c4730; max-width:660px; margin:0 auto; line-height:1.6; }
    .steps-wrapper { display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:36px; position:relative; }
    .trip-step {
        background:rgba(255,255,255,0.82);
        backdrop-filter:blur(8px);
        padding:46px 32px 44px; border-radius:22px;
        box-shadow:0 14px 44px rgba(0,0,0,.08);
        transition:all .4s; position:relative; overflow:hidden;
        text-align:center; border:1px solid rgba(212,175,55,.15);
    }
    .trip-step:hover { transform:translateY(-14px); box-shadow:0 28px 64px rgba(212,175,55,.22); }
    .trip-step::after { content:attr(data-step); position:absolute; top:-10px; right:-10px; font-size:8rem; font-family:'Playfair Display',serif; font-weight:900; color:rgba(212,175,55,.07); pointer-events:none; }
    .step-icon { width:88px; height:88px; background:linear-gradient(135deg,#d4af37,#f4d03f); color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:2rem; margin:0 auto 24px; box-shadow:0 8px 28px rgba(212,175,55,.32); transition:all .5s; }
    .trip-step:hover .step-icon { transform:scale(1.1) rotate(5deg); }
    .trip-step h3 { font-family:'Playfair Display',serif; font-size:1.7rem; color:#1a0f00; margin-bottom:14px; }
    .trip-step p { color:#6b5a40; line-height:1.65; font-size:1.02rem; }
    .action-area { text-align:center; margin-top:72px; }
    .btn-primary { display:inline-block; padding:17px 44px; background:#c41e3a; color:#fff; font-size:1.15rem; font-weight:600; border-radius:50px; text-decoration:none; transition:all .4s; box-shadow:0 8px 28px rgba(196,30,58,.22); }
    .btn-primary:hover { background:#a1122f; transform:translateY(-4px); box-shadow:0 16px 42px rgba(196,30,58,.32); }

    /* ─── WONDERS CAROUSEL ───────────────────────────────────────── */
    .wonders { text-align:center; padding:10px 0; }
    .subtitle { color:#8a6740; letter-spacing:3px; }
    .title { font-size:clamp(32px,5vw,58px); font-weight:800; color:#3a2504; margin-bottom:40px; }
    .carousel { width:100%; overflow:hidden; }
    .carousel-track { display:flex; justify-content:center; align-items:center; gap:22px; }
    .card { flex:0 0 28%; position:relative; opacity:.5; transition:.5s; border-radius:30px; }
    .card img { width:100%; height:380px; object-fit:cover; border-radius:30px; }
    .card.center { flex:0 0 42%; opacity:1; }
    .caption { position:absolute; bottom:25px; left:25px; color:#fff; text-align:left; }
    .caption h3 { color:#ffb703; font-size:clamp(20px,3vw,34px); font-weight:900; }
    .caption p { font-size:14px; }
    .controls { margin-top:25px; }
    .controls button { background:none; border:none; font-size:28px; cursor:pointer; margin:0 15px; color:#6b4f2a; }
    @media (max-width:768px) {
        .card { flex:0 0 38%; } .card.center { flex:0 0 60%; }
        .card img { height:260px; }
    }

    /* ─── TESTIMONIALS ───────────────────────────────────────────── */
    .testimonials-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:36px; align-items:stretch; }
    .testimonial-card {
        background:rgba(255,255,255,0.82);
        backdrop-filter:blur(8px);
        padding:38px 30px; border-radius:26px;
        box-shadow:0 14px 38px rgba(0,0,0,.08);
        transition:all .4s; position:relative;
        overflow:hidden; border:1px solid rgba(212,175,55,.15);
    }
    .testimonial-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg,#d4af37,#f4d03f,#d4af37); border-radius:26px 26px 0 0; }
    .testimonial-card:hover { transform:translateY(-10px); box-shadow:0 22px 55px rgba(212,175,55,.22); }
    .quote-icon { font-size:2.8rem; color:#d4af37; opacity:.2; margin-bottom:18px; }
    .quote-text { font-size:1.1rem; line-height:1.75; color:#444; margin-bottom:28px; font-style:italic; }
    .author { display:flex; align-items:center; gap:14px; }
    .author-avatar { width:56px; height:56px; border-radius:50%; overflow:hidden; border:3px solid #d4af37; flex-shrink:0; }
    .author-avatar img { width:100%; height:100%; object-fit:cover; }
    .author-info h4 { font-family:'Playfair Display',serif; font-size:1.2rem; color:#2d1b0a; margin:0; }
    .author-info span { font-size:.9rem; color:#999; }
    @media (max-width:768px) {
        .testimonials-grid { display:flex; gap:18px; overflow-x:auto; scroll-snap-type:x mandatory; -webkit-overflow-scrolling:touch; padding-bottom:8px; }
        .testimonials-grid::-webkit-scrollbar { display:none; }
        .testimonial-card { min-width:90%; flex:0 0 90%; scroll-snap-align:start; }
    }

   
    </style>


<!-- ════════════════════════════════════════════════════════════
     HEADER
     ════════════════════════════════════════════════════════════ -->


<!-- ════════════════════════════════════════════════════════════
     HERO VIDEO
     ════════════════════════════════════════════════════════════ -->
<section class="video-hero">
    <video class="hero-video active" src="India-360.mp4" autoplay muted loop disablepictureinpicture></video>
    <video class="hero-video"        src="Spiritual.mp4"  autoplay muted loop disablepictureinpicture></video>
    <video class="hero-video"        src="Heritage.mp4"   autoplay muted loop disablepictureinpicture></video>

    <button class="video-nav left"  onclick="prevVideo()"><i class="fas fa-chevron-left"></i></button>
    <button class="video-nav right" onclick="nextVideo()"><i class="fas fa-chevron-right"></i></button>
    <button class="speaker-btn"     onclick="toggleSound()"><i class="fas fa-volume-mute" id="speakerIcon"></i></button>
</section>


<!-- ════════════════════════════════════════════════════════════
     ATTRACTIONS SLIDER
     ════════════════════════════════════════════════════════════ -->
<?php include "../db.php"; ?>
<section class="attractions-section">
    <h2 class="section-title">Attractions</h2>
    <h2 class="section-title1">worth a thousand stories</h2>

    <div class="slider-wrapper">
        <button class="nav-btn left" onclick="slideLeft()">❮</button>
        <div class="attractions-slider" id="attrSlider">
            <?php
            $res = mysqli_query($conn,"SELECT p.*,s.sub_category_name FROM places p JOIN sub_categories s ON p.sub_category_id=s.id");
            while ($p = mysqli_fetch_assoc($res)):
            ?>
            <div class="attraction-card">
                <img src="../uploads/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['place_name']) ?>">
                <div class="card-content">
                    <h3><?= htmlspecialchars($p['place_name']) ?></h3>
                    <p><?= htmlspecialchars($p['location']) ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <button class="nav-btn right" onclick="slideRight()">❯</button>
    </div>

    <!-- Scroll hint indicator -->
    <div class="scroll-hint">
        <span>drag or swipe to explore</span>
        <div class="hint-track"><div class="hint-thumb"></div></div>
    </div>
</section>


<!-- ════════════════════════════════════════════════════════════
     EXPERIENCE INDIA
     ════════════════════════════════════════════════════════════ -->
<section class="experience-modern">
    <h2 class="experience-heading">Experience <span>India</span></h2>
    <p class="experience-subtitle">Discover journeys shaped by culture, nature, and tradition</p>

    <div class="experience-cards">
        <div class="experience-card"  onclick="goToExperience('Beaches')"  >
            <div class="card-bg" style="background-image:url('https://thumbs.dreamstime.com/blog/2023/12/golden-sands-to-azure-waters-why-photographers-find-goa-s-beaches-irresistible-88688-image203861442.jpg');"></div>
            <div class="card-overlay"><i class="fas fa-umbrella-beach"></i><h3>Sea Shores &amp; Beaches</h3><p>Golden sands, blue waters, peaceful sunsets</p></div>
            
        </div>
        <div class="experience-card"  onclick="goToExperience('Hill Stations')"  >
            <div class="card-bg" style="background-image:url('https://dynamic-media-cdn.tripadvisor.com/media/photo-o/06/81/42/bb/the-misty-mountains.jpg?w=900&h=-1&s=1');"></div>
            <div class="card-overlay"><i class="fas fa-mountain"></i><h3>Hill Stations</h3><p>Misty mountains and cool retreats</p></div>
        </div>
        <div class="experience-card"  onclick="goToExperience('Heritage')" >
            <div class="card-bg" style="background-image:url('https://upload.wikimedia.org/wikipedia/commons/1/1d/Taj_Mahal_%28Edited%29.jpeg');"></div>
            <div class="card-overlay"><i class="fas fa-landmark"></i><h3>Heritage &amp; Culture</h3><p>Forts, monuments &amp; ancient traditions</p></div>
        </div>
        <div class="experience-card"  onclick="goToExperience('Festivals')"  >
            <div class="card-bg" style="background-image:url('https://people.com/thmb/rsb20cJKBW_qjM3lQyfaItOYHJ0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc():focal(614x449:616x451)/Holi-01-a63575dc03ed467f8922efe3992a4060.jpg');"></div>
            <div class="card-overlay"><i class="fas fa-drum"></i><h3>Festivals</h3><p>Colors, celebrations &amp; vibrant rituals</p></div>
        </div>
        <div class="experience-card" onclick="goToExperience('Adventure')"  >
            <div class="card-bg" style="background-image:url('https://aquaterra.in/wp-content/uploads/2019/10/Camp-Aquaterra-Rishikesh-20.jpg');"></div>
            <div class="card-overlay"><i class="fas fa-hiking"></i><h3>Adventure</h3><p>Trekking, rafting &amp; thrilling escapes</p></div>
        </div>
        <div class="experience-card"  onclick="goToExperience('Food')"  >
            <div class="card-bg" style="background-image:url('https://sukhis.com/app/uploads/2022/12/image5-2-1024x849.jpg');"></div>
            <div class="card-overlay"><i class="fas fa-utensils"></i><h3>Food &amp; Cuisine</h3><p>Flavors from every corner of India</p></div>
        </div>
        <div class="experience-card"  onclick="goToExperience('Wildlife')"  >
            <div class="card-bg" style="background-image:url('https://www.wildernesstravel.com/wp-content/uploads/2024/11/bengal-tiger-mother-with-cubs-kanha-national-park-india-deer-1040x784.jpg');"></div>
            <div class="card-overlay"><i class="fas fa-paw"></i><h3>Wildlife</h3><p>Forests, safaris &amp; rare species</p></div>
        </div>
        <div class="experience-card"  onclick="goToExperience('Pilgrimage')"  >
            <div class="card-bg" style="background-image:url('https://images.alphacoders.com/541/541010.jpg');"></div>
            <div class="card-overlay"><i class="fas fa-place-of-worship"></i><h3>Pilgrimage</h3><p>Sacred temples, spiritual journeys &amp; divine experiences</p></div>
        </div>
    </div>
</section>


<!-- ════════════════════════════════════════════════════════════
     PLAN YOUR TRIP
     ════════════════════════════════════════════════════════════ -->
<section class="plan-your-trip">
    <div class="container">
        <div class="section-header">
            <h2>Plan Your <span>Dream Journey</span></h2>
            <p>Three simple steps to turn your Indian adventure from dream to reality</p>
        </div>
        <div class="steps-wrapper">
            <div class="trip-step" data-step="1">
                <div class="step-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h3>Choose Your Destination</h3>
                <p>From Himalayan peaks to tropical beaches, discover the India that calls to you</p>
            </div>
            <div class="trip-step" data-step="2">
                <div class="step-icon"><i class="fas fa-heart"></i></div>
                <h3>Select Your Experience</h3>
                <p>Adventure, spirituality, heritage, wellness, food journeys — choose your vibe</p>
            </div>
            <div class="trip-step" data-step="3">
                <div class="step-icon"><i class="fas fa-plane-departure"></i></div>
                <h3>Book &amp; Go Now</h3>
                <p>Secure bookings, expert guidance and unforgettable memories await</p>
            </div>
        </div>
        <div class="action-area">
            <a href="#explore" class="btn-primary">Start Planning Now →</a>
        </div>
    </div>
</section>


<!-- ════════════════════════════════════════════════════════════
     LESSER KNOWN WONDERS CAROUSEL
     ════════════════════════════════════════════════════════════ -->
<section class="wonders">
    <p class="subtitle">Uncover India's</p>
    <h1 class="title">LESSER KNOWN WONDERS</h1>
    <div class="carousel">
        <div class="carousel-track" id="track"></div>
    </div>
    <div class="controls">
        <button onclick="prev()">&#8592;</button>
        <button onclick="next()">&#8594;</button>
    </div>
</section>


<!-- ════════════════════════════════════════════════════════════
     TESTIMONIALS
     ════════════════════════════════════════════════════════════ -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="section-title" style="font-size:clamp(1.8rem,4vw,3rem);color:#2d1b0a;font-family:'Playfair Display',serif;font-weight:700;">Stories from Travelers</h2>
        <p class="section-subtitle" style="font-size:1.1rem;color:#7c6a46;margin-bottom:50px;max-width:680px;margin-left:auto;margin-right:auto;">Real experiences from souls who discovered the magic of India</p>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                <p class="quote-text">"India didn't just change my trip — it changed my life. The colors, the chaos, the kindness… every moment felt like a dream."</p>
                <div class="author">
                    <div class="author-avatar"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex"></div>
                    <div class="author-info"><h4>Alex Thompson</h4><span>United Kingdom</span></div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                <p class="quote-text">"From the snow-capped Himalayas to the serene backwaters of Kerala — India is not a country, it's a feeling."</p>
                <div class="author">
                    <div class="author-avatar"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Priya"></div>
                    <div class="author-info"><h4>Priya Sharma</h4><span>Mumbai, India</span></div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                <p class="quote-text">"Watching the sunrise over the Ganges in Varanasi was the most spiritual moment of my life. India heals the soul."</p>
                <div class="author">
                    <div class="author-avatar"><img src="https://randomuser.me/api/portraits/men/68.jpg" alt="Daniel"></div>
                    <div class="author-info"><h4>Daniel Weber</h4><span>California, USA</span></div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include "includes/footer.php"; ?>