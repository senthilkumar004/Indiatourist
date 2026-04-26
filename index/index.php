<?php
session_start();
include "../db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore India</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    /* ─── RESET ─────────────────────────────────────────────────── */
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif; scroll-behavior:smooth; }

    /* ═══════════════════════════════════════════════════════════════
       UNIFIED SITE BACKGROUND
       All content sections share the same warm saffron-cream base
       with a soft mandala SVG pattern overlay for depth.
       ═══════════════════════════════════════════════════════════════ */
    :root {
        --site-bg: #fdf7ef;
        --site-pattern: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='60' cy='60' r='40' fill='none' stroke='%23d4af37' stroke-width='0.4' stroke-opacity='0.15'/%3E%3Ccircle cx='60' cy='60' r='28' fill='none' stroke='%23d4af37' stroke-width='0.4' stroke-opacity='0.12'/%3E%3Ccircle cx='60' cy='60' r='16' fill='none' stroke='%23d4af37' stroke-width='0.4' stroke-opacity='0.10'/%3E%3Cpath d='M60 20 L64 44 L80 30 L70 52 L92 50 L74 62 L88 80 L66 70 L60 94 L54 70 L32 80 L46 62 L28 50 L50 52 L40 30 L56 44 Z' fill='none' stroke='%23FF9933' stroke-width='0.35' stroke-opacity='0.08'/%3E%3C/svg%3E") repeat;
    }

    /* ─── HEADER WRAPPER (sticky — ONE element handles stickiness) ─ */
    .header-container {
        position: sticky;
        top: 0;
        z-index: 9999;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.10);
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }

    /* ─── HEADER TOP ─────────────────────────────────────────────── */
    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 30px;
        background: rgba(44,205,44,0.35);
        border-bottom: 1px solid rgba(0,0,0,0.06);
        gap: 16px;
    }

    /* Logo */
    .logo-section { display:flex; align-items:center; gap:12px; flex-shrink:0; text-decoration:none; }
    .logo {
        width:56px; height:56px;
        background: linear-gradient(135deg,#FF9933,#FFFFFF,#138808);
        border-radius:14px;
        display:flex; align-items:center; justify-content:center;
        font-size:22px; color:#000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.10);
        transition: transform .3s;
    }
    .logo:hover { transform:scale(1.06); }
    .logo-text {
        font-size:24px; font-weight:800;
        background: linear-gradient(90deg,#FF9933,#138808);
        -webkit-background-clip:text; background-clip:text; color:transparent;
    }
    .tagline { font-size:11px; color:#666; font-weight:500; margin-top:2px; }

    /* Search */
    .search-section { flex:1; max-width:560px; margin:0 20px; }
    .search-container { position:relative; }
    .search-input {
        width:100%; padding:12px 18px 12px 46px;
        border-radius:50px; border:1px solid rgba(0,0,0,0.10);
        background:rgba(255,255,255,0.85);
        font-size:14px; outline:none;
        transition:all .3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .search-input::placeholder { color:#999; }
    .search-input:focus {
        background:#fff;
        border-color:rgba(255,153,51,0.5);
        box-shadow:0 4px 16px rgba(0,0,0,0.08);
    }
    .search-icon { position:absolute; left:16px; top:50%; transform:translateY(-50%); color:#aaa; font-size:15px; }

    /* User section */
    .user-section { display:flex; align-items:center; gap:14px; flex-shrink:0; }
    .wishlist {
        position:relative; cursor:pointer;
        width:44px; height:44px;
        display:flex; align-items:center; justify-content:center;
        border-radius:50%; background:rgba(255,255,255,0.8);
        border:1px solid rgba(0,0,0,0.06);
        box-shadow:0 2px 8px rgba(0,0,0,0.04);
        transition:all .3s;
    }
    .wishlist:hover { background:rgba(255,240,245,0.95); transform:translateY(-2px); }
    .wishlist i { font-size:18px; color:#ff6b81; }
    .wishlist-count {
        position:absolute; top:-5px; right:-5px;
        background:linear-gradient(135deg,#ff6b81,#ff4757);
        color:#fff; border-radius:50%; width:18px; height:18px;
        font-size:10px; font-weight:600;
        display:flex; align-items:center; justify-content:center;
        box-shadow:0 2px 6px rgba(255,107,129,0.35);
    }
    .user-info {
        display:flex; align-items:center; gap:10px;
        background:rgba(255,255,255,0.8); padding:7px 16px 7px 10px;
        border-radius:50px; cursor:pointer;
        border:1px solid rgba(0,0,0,0.06);
        box-shadow:0 2px 8px rgba(0,0,0,0.04);
        transition:all .3s;
    }
    .user-info:hover { background:#fff; transform:translateY(-2px); box-shadow:0 4px 14px rgba(0,0,0,0.07); }
    .user-icon {
        width:36px; height:36px;
        background:linear-gradient(135deg,#FF9933,#138808);
        border-radius:50%; display:flex; align-items:center;
        justify-content:center; font-size:16px; color:#fff;
    }
    .user-name { font-weight:600; font-size:14px; color:#333; }
    .login-text { font-size:11px; color:#777; }
    .login-text a, .user-info a { text-decoration:none; color:inherit; }

    /* Hamburger — desktop hidden */
    .mobile-menu-btn {
        display:none;
        background:rgba(255,255,255,0.85); border:1px solid rgba(0,0,0,0.09);
        color:#555; font-size:18px; cursor:pointer;
        padding:9px 11px; border-radius:10px;
        transition:all .3s; flex-shrink:0;
    }
    .mobile-menu-btn:hover { background:#fff; color:#333; }

    /* ─── NAV BAR ─────────────────────────────────────────────── */
    .nav-container {
        background: rgba(251,247,247,1);
        padding: 4px 20px;
        border-top: 1px solid rgba(0,0,0,0.04);
    }
    .nav-menu {
        display:flex; justify-content:center;
        list-style:none; flex-wrap:wrap; gap:4px;
        margin:0; padding:4px 0;
    }
    .nav-item { position:relative; }
    .nav-link {
        display:block; padding:10px 20px;
        text-decoration:none; color:#444;
        font-weight:600; border-radius:50px;
        transition:all .25s; text-align:center;
        background:rgba(255,255,255,0.8);
        border:1px solid rgba(0,0,0,0.05);
        font-size:13.5px; white-space:nowrap;
        box-shadow:0 2px 6px rgba(0,0,0,0.03);
        pointer-events:auto;
        cursor:pointer;
    }
    .nav-link:hover {
        background:#fff; transform:translateY(-2px);
        box-shadow:0 5px 14px rgba(0,0,0,0.07);
        color:#138808; border-color:rgba(19,136,8,0.25);
    }
    .nav-link.active {
        background:linear-gradient(135deg,rgba(255,153,51,.1),rgba(19,136,8,.1));
        color:#138808; border-color:rgba(19,136,8,.3);
    }

    /* Arrow icon */
    .arrow { font-size:9px; margin-left:4px; transition:transform .3s; display:inline-block; }
    .nav-item.open > .nav-link .arrow,
    .nav-item:hover > .nav-link .arrow { transform:rotate(180deg); }

    /* ─── DROPDOWN SUB-MENU ──────────────────────────────────────── */
    .sub-menu {
        position:absolute; top:calc(100% + 6px); left:0;
        min-width:160px;
        background:rgba(255,255,255,0.98);
        backdrop-filter:blur(14px);
        box-shadow:0 12px 32px rgba(0,0,0,0.14);
        border-radius:12px; padding:8px 0;
        opacity:0; visibility:hidden;
        transform:translateY(10px);
        transition:all .25s ease;
        z-index:10000;
        list-style:none;
    }
    .sub-menu li { list-style:none; }
    .sub-menu a {
        display:block; padding:10px 18px;
        color:#1a3a2a; font-weight:500; font-size:13.5px;
        text-decoration:none;
        transition:background .2s, color .2s;
    }
    .sub-menu a:hover { background:#f5f5f5; color:#ff9933; padding-left:22px; }

    @media (min-width:769px) {
        .nav-item.has-sub:hover > .sub-menu {
            opacity:1; visibility:visible; transform:translateY(0);
        }
    }

    /* ─── MOBILE STYLES ──────────────────────────────────────────── */
    @media (max-width:768px) {
        .header-top {
            display:grid;
            grid-template-columns: auto 1fr auto auto;
            align-items:center;
            padding:10px 14px;
            gap:10px;
        }
        .mobile-menu-btn { display:flex; align-items:center; justify-content:center; order:1; }
        .logo-section { order:2; justify-self:center; }
        .logo { width:40px; height:40px; font-size:17px; }
        .logo-text { font-size:18px; }
        .tagline { display:none; }
        .search-section { display:none; }
        .user-section { order:3; gap:8px; }
        .user-info { padding:6px 10px 6px 8px; }
        .user-name { display:none; }
        .login-text { font-size:11px; }

        .nav-container {
            padding:0;
            overflow:hidden;
            max-height:0;
            transition:max-height .35s ease;
        }
        .nav-container.mobile-open { max-height:1200px; }

        .mobile-search { display:block; padding:10px 14px 0; }
        .mobile-search .search-input { border-radius:12px; }

        .nav-menu { flex-direction:column; gap:0; padding:6px 10px 10px; }
        .nav-link {
            width:100%; text-align:left; border-radius:10px;
            padding:13px 16px; font-size:14px;
            border-bottom:none;
        }

        .sub-menu {
            position:static !important;
            opacity:1 !important; visibility:visible !important;
            transform:none !important;
            box-shadow:none !important;
            border-radius:8px !important;
            background:rgba(245,245,245,0.95) !important;
            padding:4px 0 4px 14px !important;
            margin:4px 0 4px 10px !important;
            border-left:3px solid #FF9933;
            display:none;
        }
        .nav-item.open > .sub-menu { display:block; }
        .nav-item.open > .nav-link .arrow { transform:rotate(180deg); }
    }

    @media (max-width:480px) {
        .logo-text { font-size:16px; }
        .wishlist { width:38px; height:38px; }
    }

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
        min-width:290px; height:500px; border-radius:18px;
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

    /* ─── FOOTER ─────────────────────────────────────────────────── */
    .incredible-footer { background:linear-gradient(to bottom,#0f172a,#0b1120); color:#cbd5f5; font-family:'Inter',system-ui,sans-serif; }
    .footer-top { padding:80px 5% 64px; border-bottom:1px solid rgba(56,189,248,.08); }
    .footer-container { max-width:1280px; margin:0 auto; display:grid; grid-template-columns:2fr 1fr 1fr 1.4fr; gap:46px 36px; }
    @media (max-width:1024px) { .footer-container { grid-template-columns:1fr 1fr; } }
    @media (max-width:640px) { .footer-container { grid-template-columns:1fr; text-align:center; } }
    .footer-brand .logo-wrapper { font-family:'Playfair Display',serif; font-size:2.2rem; font-weight:800; margin-bottom:1.2rem; color:#fff; }
    .logo-accent { color:#38bdf8; }
    .brand-desc { line-height:1.7; color:#94a3b8; font-size:.96rem; margin-bottom:1.8rem; }
    .social-icons { display:flex; gap:12px; }
    .social-icons a { width:42px; height:42px; border-radius:50%; background:rgba(56,189,248,.12); color:#38bdf8; display:flex; align-items:center; justify-content:center; transition:all .35s; }
    .social-icons a:hover { background:#38bdf8; color:#fff; transform:translateY(-4px); }
    .footer-links h4, .footer-contact h4 { color:#fff; font-size:1.1rem; font-weight:700; margin-bottom:1.4rem; }
    .footer-links ul { list-style:none; padding:0; margin:0; }
    .footer-links li { margin-bottom:.85rem; }
    .footer-links a { color:#cbd5f5; text-decoration:none; font-size:.95rem; transition:all .3s; display:inline-block; }
    .footer-links a:hover { color:#38bdf8; transform:translateX(5px); }
    .footer-contact p { margin:.75rem 0; color:#94a3b8; font-size:.95rem; }
    .footer-contact i { color:#38bdf8; margin-right:10px; width:18px; text-align:center; }
    .newsletter { margin-top:1.6rem; }
    .newsletter p { font-size:.93rem; color:#94a3b8; margin-bottom:.8rem; }
    .newsletter-form { display:flex; max-width:330px; overflow:hidden; border-radius:50px; background:rgba(255,255,255,.07); }
    .newsletter-form input { flex:1; padding:13px 20px; border:none; background:transparent; color:#fff; font-size:.94rem; }
    .newsletter-form input::placeholder { color:#94a3b8; }
    .newsletter-form button { background:#38bdf8; color:#fff; border:none; width:58px; font-size:1.25rem; cursor:pointer; transition:background .35s; }
    .newsletter-form button:hover { background:#0ea5e9; }
    .footer-bottom { background:rgba(0,0,0,.22); padding:22px 5%; font-size:.9rem; color:#94a3b8; }
    .bottom-container { max-width:1280px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; }
    .bottom-links a { color:#cbd5f5; text-decoration:none; margin-left:22px; transition:color .3s; }
    .bottom-links a:hover { color:#38bdf8; }
    @media (max-width:640px) { .bottom-container { flex-direction:column; text-align:center; } .bottom-links a { margin:0 10px; } }
    </style>
</head>
<body>

<!-- ════════════════════════════════════════════════════════════
     HEADER
     ════════════════════════════════════════════════════════════ -->
<div class="header-container">

    <div class="header-top">
        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
            <i class="fas fa-bars" id="hamburgerIcon"></i>
        </button>

        <a href="index.php" class="logo-section" style="text-decoration:none;">
            <div class="logo"><i class="fas fa-torii-gate"></i></div>
            <div>
                <div class="logo-text">Explore India</div>
                <div class="tagline">Discover Destinations, Culture &amp; Heritage</div>
            </div>
        </a>

        <div class="search-section">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Search destinations, heritage sites, hotels...">
            </div>
        </div>

        <div class="user-section">
            <div class="wishlist" id="wishlistBtn" onclick="wishlistClick()">
                <i class="fas fa-heart"></i>
                <?php if (isset($_SESSION['user_id'])):
                    $res = mysqli_query($conn,"SELECT COUNT(*) AS total FROM wishlist WHERE user_id='".$_SESSION['user_id']."'");
                    $count = mysqli_fetch_assoc($res)['total'];
                ?>
                    <span class="wishlist-count"><?= $count ?></span>
                <?php endif; ?>
            </div>

            <div class="user-info">
                <div class="user-icon"><i class="fas fa-user"></i></div>
                <div>
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <div class="user-name">Hello, <?= htmlspecialchars($_SESSION['user_name']) ?></div>
                        <a href="logout.php" onclick="return confirm('Do you really want to sign out?');" style="text-decoration:none;">
                            <div class="login-text">Sign out</div>
                        </a>
                    <?php else: ?>
                        <div class="user-name">Welcome</div>
                        <a href="login.php" style="text-decoration:none;">
                            <div class="login-text">Sign in</div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="nav-container" id="navContainer">
        <div class="mobile-search" style="display:none;">
            <div class="search-container" style="padding:0;">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search destinations...">
            </div>
        </div>

        <?php
        include "../db.php";
        $currentCategory = isset($_GET['category']) ? $_GET['category'] : '';
        $categories = mysqli_query($conn,"SELECT * FROM categories ORDER BY id ASC");
        ?>

        <ul class="nav-menu" id="navMenu">
            <?php while ($cat = mysqli_fetch_assoc($categories)):
                $catId = $cat['id'];
                $active = ($currentCategory == $catId) ? 'active' : '';
                $subs = mysqli_query($conn,"SELECT * FROM sub_categories WHERE category_id='$catId' ORDER BY id ASC");
                $hasSub = mysqli_num_rows($subs) > 0;
            ?>
            <li class="nav-item <?= $hasSub ? 'has-sub' : '' ?>">
                <a href="category.php?category=<?= $catId ?>"
                   class="nav-link <?= $active ?>">
                    <?= htmlspecialchars($cat['category_name']) ?>
                    <?php if ($hasSub): ?>
                        <i class="fas fa-chevron-down arrow"></i>
                    <?php endif; ?>
                </a>
                <?php if ($hasSub): ?>
                <ul class="sub-menu">
                    <?php while ($sub = mysqli_fetch_assoc($subs)): ?>
                    <li>
                        <a href="subcategory.php?sub=<?= $sub['id'] ?>">
                            <?= htmlspecialchars($sub['sub_category_name']) ?>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endwhile; ?>
        </ul>

    </div>
</div>


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




<!-- ════════════════════════════════════════════════════════════
     FOOTER
     ════════════════════════════════════════════════════════════ -->
<footer class="incredible-footer">
    <div class="footer-top">
        <div class="footer-container">
            <div class="footer-brand">
                <div class="logo-wrapper"><span class="logo-text" style="color:#fff;font-family:'Playfair Display',serif;">Let's Explore</span><span class="logo-accent">India</span></div>
                <p class="brand-desc">Where every journey becomes a story.<br>Discover the soul of India — one destination at a time.</p>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Explore</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Destinations</a></li>
                    <li><a href="#">Experiences</a></li>
                    <li><a href="#">Travel Packages</a></li>
                    <li><a href="#">Inspiration</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Iconic Places</h4>
                <ul>
                    <li><a href="#">Taj Mahal</a></li>
                    <li><a href="#">Kerala Backwaters</a></li>
                    <li><a href="#">Rajasthan Forts</a></li>
                    <li><a href="#">Varanasi Ghats</a></li>
                    <li><a href="#">Ladakh &amp; Spiti</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h4>Get in Touch</h4>
                <p><i class="fas fa-map-marker-alt"></i> Tamilnadu, India</p>
                <p><i class="fas fa-phone-volume"></i> +91 7397043171</p>
                <p><i class="fas fa-envelope"></i> hello@exploreindia.travel</p>
                <div class="newsletter">
                    <p>Stay inspired</p>
                    <form class="newsletter-form" onsubmit="return false;">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit">→</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="bottom-container">
            <p>© 2026 Explore India Tourism.</p>
            <div class="bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Use</a>
                <a href="#">Sitemap</a>
            </div>
        </div>
    </div>
</footer>


<!-- ════════════════════════════════════════════════════════════
     JAVASCRIPT
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

setInterval(nextVideo, 8000);


/* ── 6. ATTRACTIONS SLIDER — ARROWS + DRAG + TOUCH ─────────── */
const attrSlider = document.getElementById('attrSlider');

// Arrow buttons (unchanged behaviour)
function slideRight() { attrSlider.scrollLeft += 300; }
function slideLeft()  { attrSlider.scrollLeft -= 300; }

// ── Mouse drag-to-scroll (desktop) ──────────────────────────
(function() {
    let isDragging = false;
    let startX     = 0;
    let startScroll = 0;
    let hasMoved    = false;           // distinguish drag from click

    attrSlider.addEventListener('mousedown', function(e) {
        isDragging  = true;
        hasMoved    = false;
        startX      = e.pageX;
        startScroll = attrSlider.scrollLeft;
        attrSlider.classList.add('is-dragging');
    });

    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        const delta = e.pageX - startX;
        if (Math.abs(delta) > 4) hasMoved = true;  // moved enough to count as drag
        attrSlider.scrollLeft = startScroll - delta;
    });

    document.addEventListener('mouseup', function() {
        if (!isDragging) return;
        isDragging = false;
        attrSlider.classList.remove('is-dragging');
    });

    // Prevent card clicks firing after a drag
    attrSlider.addEventListener('click', function(e) {
        if (hasMoved) { e.preventDefault(); e.stopPropagation(); }
    }, true);
})();

// ── Touch scroll (mobile) — native CSS handles this;
//    pointer-events fix ensures cards don't block swipe ────────
attrSlider.addEventListener('touchstart', function() {}, { passive: true });


/* ── 7. EXPERIENCE CARDS FADE-IN ────────────────────────────── */
const expCards = document.querySelectorAll('.experience-card');
const expObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
}, { threshold: 0.12 });
expCards.forEach(c => expObserver.observe(c));


/* ── 8. LESSER KNOWN WONDERS CAROUSEL ──────────────────────── */
const wonders = [
    { img:'sl1.jpg', title:'Madla',       loc:'Madhya Pradesh' },
    { img:'sl2.jpg', title:'Spiti Valley', loc:'Himachal Pradesh' },
    { img:'sl3.jpg', title:'Ziro Valley',  loc:'Arunachal Pradesh' },
    { img:'sl4.jpg', title:'Tawang',       loc:'Arunachal Pradesh' },
    { img:'sl5.jpg', title:'Chopta',       loc:'Uttarakhand' },
];
let wonderIdx = 1;
const track = document.getElementById('track');

function renderWonders() {
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

renderWonders();
</script>

<script>

function goToExperience(type) {
    window.location.href = "experience.php?type=" + encodeURIComponent(type);
}

</script>


</body>
</html>