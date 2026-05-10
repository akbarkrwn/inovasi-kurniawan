<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Paspor Rusak & Hilang</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: 'DM Sans', sans-serif; background: #060d1f; color: #e2e8f0; overflow-x: hidden; font-size: 15px; line-height: 1.6; }
        h1, h2, h3, h4 { font-family: 'Syne', sans-serif; line-height: 1.2; }

        :root {
            --blue: #3b82f6;
            --blue-bright: #60a5fa;
            --blue-dark: #1d4ed8;
            --blue-glow: rgba(59,130,246,.22);
            --gold: #f59e0b;
            --gold-light: #fef3c7;
            --bg: #060d1f;
            --bg2: #0b1528;
            --bg3: #0f1e38;
            --card: rgba(15,30,56,.75);
            --card-border: rgba(59,130,246,.18);
            --card-border-h: rgba(59,130,246,.45);
            --s50: #f8fafc; --s100: #f1f5f9; --s200: #e2e8f0;
            --s300: #cbd5e1; --s400: #94a3b8; --s500: #64748b;
            --s600: #475569; --s700: #334155; --s800: #1e293b; --s900: #0f172a;
            --r: 16px; --rsm: 10px;
            --sh: 0 1px 3px rgba(0,0,0,.3), 0 4px 20px rgba(0,0,0,.2);
            --shmd: 0 4px 6px rgba(0,0,0,.3), 0 12px 40px rgba(0,0,0,.35);
            --glow: 0 0 40px rgba(59,130,246,.15);
        }

        /* ─── BACKGROUND LOGO WATERMARK ─── */
        .bg-logo-watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: min(900px, 110vw);
            height: min(900px, 110vw);
            pointer-events: none;
            z-index: 0;
            opacity: 0.035;
            filter: blur(1px) grayscale(1) brightness(3);
            background-image: url("{{ asset('images/logo.png') }}");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
        }
        /* subtle animated grid overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(59,130,246,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        /* top glow blobs */
        body::after {
            content: '';
            position: fixed;
            top: -200px;
            left: -200px;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59,130,246,.12) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }
        .blob-r {
            position: fixed;
            bottom: -150px;
            right: -150px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59,130,246,.09) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }

        /* ─── EVERYTHING ABOVE z=0 ─── */
        nav, section, footer, .fcs { position: relative; z-index: 1; }

        /* ─── NAV ─── */
        .nav { position:sticky; top:0; z-index:100; background:rgba(6,13,31,.88); backdrop-filter:blur(20px); border-bottom:1px solid rgba(59,130,246,.15); }
        .nav-inner { max-width:1100px; margin:0 auto; padding:0 24px; height:68px; display:flex; align-items:center; justify-content:space-between; }
        .nav-brand { display:flex; align-items:center; gap:12px; text-decoration:none; }
        .nav-logo { width:40px; height:40px; border-radius:12px; overflow:hidden; border:1.5px solid rgba(59,130,246,.35); background:rgba(59,130,246,.1); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .nav-logo img { width:28px; height:28px; object-fit:contain; }
        .nav-name { font-family:'Syne',sans-serif; font-weight:800; font-size:15px; color:white; letter-spacing:-.2px; display:block; }
        .nav-sub { font-size:11px; color:var(--blue-bright); opacity:.8; display:block; line-height:1; letter-spacing:.02em; }
        .nav-links { display:flex; align-items:center; gap:4px; }
        .nav-links a { padding:7px 15px; border-radius:8px; font-size:14px; font-weight:500; color:#94a3b8; text-decoration:none; transition:background .15s,color .15s; }
        .nav-links a:hover { background:rgba(59,130,246,.12); color:white; }
        .nav-cta { background:var(--blue)!important; color:white!important; border-radius:10px!important; box-shadow:0 0 20px rgba(59,130,246,.3); }
        .nav-cta:hover { background:#2563eb!important; box-shadow:0 0 30px rgba(59,130,246,.5)!important; }

        /* ─── HERO ─── */
        .hero { background: transparent; border-bottom:1px solid rgba(59,130,246,.12); padding:90px 24px 80px; overflow:hidden; }
        /* hero-specific bg logo (bigger, section-level) */
        .hero-bg-logo {
            position: absolute;
            right: -80px;
            top: 50%;
            transform: translateY(-50%);
            width: 600px;
            height: 600px;
            opacity: 0.055;
            filter: grayscale(1) brightness(4);
            background-image: url("{{ asset('images/logo.png') }}");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            pointer-events: none;
            z-index: 0;
        }
        .hero-inner { max-width:1100px; margin:0 auto; display:grid; grid-template-columns:1fr 420px; gap:64px; align-items:center; position:relative; z-index:1; }
        .eyebrow { display:inline-flex; align-items:center; gap:7px; padding:6px 14px; background:rgba(59,130,246,.12); border:1px solid rgba(59,130,246,.3); border-radius:99px; font-size:12px; font-weight:600; color:var(--blue-bright); letter-spacing:.06em; margin-bottom:20px; }
        .eyebrow-dot { width:6px; height:6px; border-radius:50%; background:var(--blue-bright); animation:blink 2s ease-in-out infinite; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
        .hero h1 { font-size:clamp(2.2rem,4.5vw,3.4rem); font-weight:800; color:white; letter-spacing:-1.5px; margin-bottom:16px; }
        .hero h1 span { color:var(--blue-bright); position:relative; }
        .hero h1 span::after { content:''; position:absolute; left:0; bottom:-4px; width:100%; height:2px; background:linear-gradient(90deg, var(--blue-bright), transparent); border-radius:2px; }
        .hero-desc { font-size:16px; color:#94a3b8; line-height:1.8; max-width:480px; margin-bottom:32px; }
        .hero-btns { display:flex; gap:12px; flex-wrap:wrap; }

        .btn { display:inline-flex; align-items:center; gap:8px; padding:13px 26px; border-radius:var(--rsm); font-size:14px; font-weight:600; text-decoration:none; transition:all .18s; }
        .btn-blue { background:var(--blue); color:white; box-shadow:0 0 24px rgba(59,130,246,.4); }
        .btn-blue:hover { background:#2563eb; transform:translateY(-2px); box-shadow:0 0 40px rgba(59,130,246,.55); }
        .btn-outline { background:rgba(255,255,255,.06); color:#cbd5e1; border:1px solid rgba(255,255,255,.12); backdrop-filter:blur(8px); }
        .btn-outline:hover { background:rgba(255,255,255,.1); border-color:rgba(255,255,255,.22); transform:translateY(-2px); }

        /* Hero right card */
        .hcard { background:var(--card); border:1px solid var(--card-border); border-radius:20px; padding:28px; box-shadow:var(--shmd), var(--glow); backdrop-filter:blur(16px); }
        .hcard-hd { display:flex; align-items:center; gap:12px; padding-bottom:20px; border-bottom:1px solid rgba(255,255,255,.07); margin-bottom:20px; }
        .hcard-icon { width:44px; height:44px; border-radius:12px; background:linear-gradient(135deg,var(--blue),#1d4ed8); display:flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:0 0 20px rgba(59,130,246,.4); }
        .hcard-icon img { width:24px; height:24px; object-fit:contain; filter:brightness(0) invert(1); }
        .hcard-title { font-size:15px; font-weight:700; color:white; font-family:'Syne',sans-serif; }
        .hcard-sub { font-size:12px; color:#64748b; }
        .irow { display:flex; align-items:flex-start; gap:12px; padding:14px 0; border-bottom:1px solid rgba(255,255,255,.05); }
        .irow:last-child { border-bottom:none; padding-bottom:0; }
        .iicon { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .iicon.g { background:rgba(22,163,74,.15); } .iicon.a { background:rgba(217,119,6,.15); } .iicon.b { background:rgba(59,130,246,.15); }
        .iicon svg { width:16px; height:16px; }
        .iicon.g svg { color:#4ade80; } .iicon.a svg { color:#fbbf24; } .iicon.b svg { color:var(--blue-bright); }
        .irow strong { display:block; font-size:13px; font-weight:600; color:#e2e8f0; margin-bottom:2px; }
        .irow p { font-size:13px; color:#64748b; line-height:1.55; }

        /* ─── SECTIONS ─── */
        .sec { padding:88px 24px; }
        .sec-alt { background:rgba(11,21,40,.6); }
        .sec-in { max-width:1100px; margin:0 auto; }
        .sec-hd { text-align:center; margin-bottom:52px; }
        .stag { display:inline-block; padding:5px 14px; border-radius:99px; font-size:12px; font-weight:700; letter-spacing:.1em; margin-bottom:14px; text-transform:uppercase; }
        .stag-b { background:rgba(59,130,246,.15); color:var(--blue-bright); border:1px solid rgba(59,130,246,.25); }
        .stag-r { background:rgba(239,68,68,.12); color:#f87171; border:1px solid rgba(239,68,68,.2); }
        .sec-hd h2 { font-size:clamp(1.7rem,3vw,2.4rem); font-weight:800; color:white; letter-spacing:-.8px; margin-bottom:12px; }
        .sec-hd p { font-size:15px; color:#64748b; max-width:520px; margin:0 auto; line-height:1.75; }

        /* ─── GALLERY (4 items, no paspor1) ─── */
        .gallery { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:36px; }
        .gitem { border-radius:16px; overflow:hidden; border:1px solid rgba(59,130,246,.15); background:var(--card); box-shadow:var(--sh); transition:transform .25s,box-shadow .25s,border-color .25s; backdrop-filter:blur(8px); }
        .gitem:hover { transform:translateY(-6px); box-shadow:var(--shmd), 0 0 30px rgba(59,130,246,.15); border-color:rgba(59,130,246,.4); }
        .gitem img { width:100%; height:190px; object-fit:cover; display:block; }
        .glabel-wrap { padding:12px 14px; display:flex; align-items:center; gap:8px; }
        .gbadge { width:24px; height:24px; border-radius:6px; background:rgba(59,130,246,.18); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .gbadge svg { width:13px; height:13px; color:var(--blue-bright); }
        .gbadge.red { background:rgba(239,68,68,.15); }
        .gbadge.red svg { color:#f87171; }
        .gbadge.amber { background:rgba(245,158,11,.15); }
        .gbadge.amber svg { color:#fbbf24; }
        .glabel { font-size:12px; font-weight:600; color:#94a3b8; line-height:1.3; }
        .glabel strong { display:block; font-size:12.5px; color:#cbd5e1; margin-bottom:1px; }

        /* ─── WARNING ─── */
        .warn { display:flex; gap:14px; align-items:flex-start; padding:18px 22px; background:rgba(217,119,6,.1); border:1px solid rgba(245,158,11,.3); border-radius:var(--rsm); margin-bottom:36px; border-left:3px solid #f59e0b; }
        .warn svg { width:18px; height:18px; color:#fbbf24; flex-shrink:0; margin-top:2px; }
        .warn p { font-size:13.5px; color:#d4a017; line-height:1.65; }
        .warn strong { color:#fbbf24; }

        /* ─── STEP GRID ─── */
        .sgrid { display:grid; grid-template-columns:repeat(2,1fr); gap:14px; }
        .scard { background:var(--card); border:1px solid var(--card-border); border-radius:var(--r); padding:22px; display:flex; gap:16px; box-shadow:var(--sh); transition:transform .2s,box-shadow .2s,border-color .2s; backdrop-filter:blur(8px); }
        .scard:hover { transform:translateY(-3px); box-shadow:var(--shmd); border-color:var(--card-border-h); }
        .scard.danger { border-color:rgba(239,68,68,.25); background:rgba(239,68,68,.06); }
        .scard.danger:hover { border-color:rgba(239,68,68,.5); }
        .scard.ok { border-color:rgba(22,163,74,.25); background:rgba(22,163,74,.06); }
        .scard.ok:hover { border-color:rgba(22,163,74,.5); }
        .snum { width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-family:'Syne',sans-serif; font-weight:700; font-size:16px; flex-shrink:0; background:rgba(59,130,246,.15); color:var(--blue-bright); border:1px solid rgba(59,130,246,.2); }
        .snum.danger { background:rgba(239,68,68,.15); color:#f87171; border-color:rgba(239,68,68,.2); }
        .snum.ok { background:rgba(22,163,74,.15); color:#4ade80; border-color:rgba(22,163,74,.2); }
        .sbody h4 { font-size:14px; font-weight:700; color:#e2e8f0; margin-bottom:5px; }
        .sbody p { font-size:13px; color:#64748b; line-height:1.65; }

        /* ─── TIMELINE ─── */
        .tl { display:flex; flex-direction:column; }
        .tli { display:flex; gap:20px; }
        .tl-l { display:flex; flex-direction:column; align-items:center; }
        .tln { width:42px; height:42px; border-radius:12px; background:linear-gradient(135deg,var(--blue),#1d4ed8); color:white; font-family:'Syne',sans-serif; font-weight:700; font-size:15px; display:flex; align-items:center; justify-content:center; flex-shrink:0; z-index:1; box-shadow:0 0 16px rgba(59,130,246,.35); }
        .tln.d { background:linear-gradient(135deg,#dc2626,#991b1b); box-shadow:0 0 16px rgba(220,38,38,.35); }
        .tlline { width:2px; flex:1; background:linear-gradient(to bottom, rgba(59,130,246,.3), rgba(59,130,246,.05)); margin:6px 0; min-height:20px; }
        .tli:last-child .tlline { display:none; }
        .tlc { background:var(--card); border:1px solid var(--card-border); border-radius:var(--r); padding:18px 22px; flex:1; margin-bottom:12px; box-shadow:var(--sh); transition:transform .2s,box-shadow .2s,border-color .2s; backdrop-filter:blur(8px); }
        .tlc:hover { transform:translateY(-2px); box-shadow:var(--shmd); border-color:var(--card-border-h); }
        .tlc.d { border-color:rgba(239,68,68,.25); background:rgba(239,68,68,.06); }
        .tlc.d:hover { border-color:rgba(239,68,68,.45); }
        .tlc h4 { font-size:14px; font-weight:700; color:#e2e8f0; margin-bottom:5px; display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
        .tlc p { font-size:13px; color:#64748b; line-height:1.65; }
        .bdanger { font-size:10px; font-weight:700; letter-spacing:.06em; padding:2px 9px; background:rgba(239,68,68,.15); color:#f87171; border-radius:99px; border:1px solid rgba(239,68,68,.25); }

        /* ─── CTA BOX ─── */
        .ctabox { margin-top:40px; position:relative; overflow:hidden; border:1px solid rgba(59,130,246,.2); border-radius:24px; padding:48px 40px; text-align:center; background:linear-gradient(135deg, rgba(15,30,56,.95) 0%, rgba(6,13,31,.98) 100%); box-shadow:var(--glow); }
        .ctabox::before { content:''; position:absolute; inset:0; background-image:url("{{ asset('images/logo.png') }}"); background-repeat:no-repeat; background-size:320px; background-position:center; opacity:.04; filter:grayscale(1) brightness(5); pointer-events:none; }
        .ctabox-inner { position:relative; z-index:1; }
        .ctabox h3 { font-size:22px; font-weight:800; color:white; margin-bottom:8px; letter-spacing:-.5px; }
        .ctabox p { font-size:14px; color:#64748b; margin-bottom:28px; }
        .btn-wa { display:inline-flex; align-items:center; gap:10px; padding:14px 28px; border-radius:var(--rsm); background:linear-gradient(135deg,#25d366,#128c49); color:white; font-size:14px; font-weight:600; text-decoration:none; transition:all .2s; box-shadow:0 0 24px rgba(37,211,102,.3); }
        .btn-wa:hover { transform:translateY(-3px); box-shadow:0 0 40px rgba(37,211,102,.5); }
        .btn-wa svg { width:18px; height:18px; }

        /* ─── FOOTER ─── */
        .foot { background:rgba(4,9,20,.95); color:#475569; padding:52px 24px 32px; border-top:1px solid rgba(59,130,246,.1); }
        .foot-in { max-width:1100px; margin:0 auto; }
        .foot-top { display:grid; grid-template-columns:1.5fr 1fr 1fr; gap:40px; padding-bottom:32px; border-bottom:1px solid rgba(255,255,255,.05); margin-bottom:28px; }
        .foot-brand { display:flex; align-items:center; gap:10px; margin-bottom:12px; }
        .foot-logo { width:36px; height:36px; border-radius:10px; overflow:hidden; border:1.5px solid rgba(59,130,246,.3); background:rgba(59,130,246,.1); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .foot-logo img { width:24px; height:24px; object-fit:contain; }
        .foot-bname { font-family:'Syne',sans-serif; font-weight:800; font-size:15px; color:white; }
        .foot-desc { font-size:13px; line-height:1.75; color:#475569; }
        .foot-col h5 { font-size:11px; font-weight:700; letter-spacing:.12em; color:#64748b; text-transform:uppercase; margin-bottom:16px; }
        .foot-col a { display:block; font-size:13px; color:#475569; text-decoration:none; margin-bottom:10px; transition:color .15s; }
        .foot-col a:hover { color:var(--blue-bright); }
        .foot-bot { display:flex; align-items:center; justify-content:space-between; font-size:12px; color:#334155; }
        .fdot { width:6px; height:6px; border-radius:50%; background:#22c55e; display:inline-block; margin-right:6px; box-shadow:0 0 6px #22c55e; }

        /* ─── FLOATING CS ─── */
        .fcs { position:fixed; bottom:28px; right:24px; z-index:999; }
        .fbtn { width:58px; height:58px; border-radius:50%; background:linear-gradient(135deg,#25d366,#128c49); display:flex; align-items:center; justify-content:center; text-decoration:none; box-shadow:0 4px 20px rgba(37,211,102,.5); animation:flt 3s ease-in-out infinite; transition:transform .2s,box-shadow .2s; position:relative; }
        .fbtn:hover { transform:scale(1.1)!important; box-shadow:0 8px 32px rgba(37,211,102,.6); animation:none; }
        .fbtn img { width:30px; height:30px; object-fit:contain; filter:brightness(0) invert(1); }
        @keyframes flt { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-7px)} }
        .fbtn::before { content:''; position:absolute; inset:-6px; border-radius:50%; border:2px solid rgba(37,211,102,.3); animation:pr 2.5s ease-out infinite; }
        @keyframes pr { 0%{opacity:1;transform:scale(.9)} 100%{opacity:0;transform:scale(1.45)} }
        .ftip { position:absolute; right:70px; top:50%; transform:translateY(-50%); background:#0f172a; color:white; font-size:12px; font-weight:600; padding:6px 13px; border-radius:8px; white-space:nowrap; pointer-events:none; opacity:0; transition:opacity .15s; border:1px solid rgba(255,255,255,.08); }
        .ftip::after { content:''; position:absolute; right:-5px; top:50%; transform:translateY(-50%); border:5px solid transparent; border-right:none; border-left-color:#0f172a; }
        .fcs:hover .ftip { opacity:1; }

        /* ─── REVEAL ─── */
        .rv { opacity:0; transform:translateY(24px); transition:opacity .6s ease,transform .6s ease; }
        .rv.in { opacity:1; transform:translateY(0); }

        /* ─── RESPONSIVE ─── */
        @media(max-width:900px) {
            .hero-inner { grid-template-columns:1fr; gap:40px; }
            .gallery { grid-template-columns:repeat(2,1fr); }
            .sgrid { grid-template-columns:1fr; }
            .foot-top { grid-template-columns:1fr; gap:28px; }
            .nav-links { display:none; }
            .hero-bg-logo { display:none; }
        }
        @media(max-width:600px) {
            .hero { padding:52px 20px 44px; }
            .sec { padding:60px 20px; }
            .gallery { grid-template-columns:1fr 1fr; }
        }
    </style>
</head>
<body>
<div class="blob-r"></div>
<div class="bg-logo-watermark"></div>

{{-- NAVBAR --}}
<nav class="nav">
    <div class="nav-inner">
        <a href="#" class="nav-brand">
            <div class="nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Immigration">
            </div>
            <div>
                <span class="nav-name">IMMIGRATION INFO</span>
                <span class="nav-sub">Layanan Informasi Publik</span>
            </div>
        </a>
        <div class="nav-links">
            <a href="#rusak">Paspor Rusak</a>
            <a href="#hilang">Paspor Hilang</a>
            <a href="https://api.whatsapp.com/send/?phone=62811460377&text=Halo%2C+saya+ingin+bertanya&type=phone_number&app_absent=0" target="_blank" class="nav-cta">Hubungi CS</a>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="hero" id="layanan" style="position:relative;">
    <div class="hero-bg-logo"></div>
    <div class="hero-inner">
        <div class="rv">
            <div class="eyebrow"><span class="eyebrow-dot"></span>Layanan Imigrasi Digital</div>
            <h1>Informasi<br><span>Paspor Rusak</span><br>& Hilang</h1>
            <p class="hero-desc">Website layanan publik untuk memberikan informasi mengenai penggantian paspor rusak maupun paspor hilang secara jelas, cepat, dan mudah dipahami masyarakat.</p>
            <div class="hero-btns">
                <a href="#rusak" class="btn btn-blue">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Paspor Rusak
                </a>
                <a href="#hilang" class="btn btn-outline">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    Paspor Hilang
                </a>
            </div>
        </div>

        <div class="rv" style="transition-delay:.12s">
            <div class="hcard">
                <div class="hcard-hd">
                    <div class="hcard-icon">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                    </div>
                    <div>
                        <div class="hcard-title">Smart Immigration Service</div>
                        <div class="hcard-sub">Pelayanan Informasi Modern</div>
                    </div>
                </div>
                <div class="irow">
                    <div class="iicon g"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg></div>
                    <div><strong>Informasi Valid & Terpercaya</strong><p>Membantu masyarakat memahami kategori paspor rusak dan proses kehilangan paspor berdasarkan prosedur resmi.</p></div>
                </div>
                <div class="irow">
                    <div class="iicon a"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
                    <div><strong>Hindari Biaya Hangus</strong><p>Kurangi risiko penolakan pendaftaran online yang menyebabkan biaya tidak dapat dikembalikan.</p></div>
                </div>
                <div class="irow">
                    <div class="iicon b"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg></div>
                    <div><strong>Layanan Ramah Masyarakat</strong><p>Tampilan bersih dan modern yang mudah dipahami oleh semua kalangan masyarakat.</p></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PASPOR RUSAK --}}
<section class="sec sec-alt" id="rusak">
    <div class="sec-in">
        <div class="sec-hd rv">
            <span class="stag stag-b">PASPOR RUSAK</span>
            <h2>Kategori & Ketentuan Paspor Rusak</h2>
            <p>Informasi penting terkait kategori kerusakan paspor yang perlu Anda ketahui sebelum melakukan pendaftaran online.</p>
        </div>

        {{-- Gallery: paspor2–paspor5 saja (paspor1 dihapus) --}}
        <div class="gallery rv" style="transition-delay:.08s">
            @php
            $items = [
                ['file'=>'paspor2','label'=>'Paspor Terbakar','sub'=>'Hangus / Gosong','icon'=>'fire','type'=>'red'],
                ['file'=>'paspor3','label'=>'Paspor Dicoret','sub'=>'Terdapat Tulisan/Coretan','icon'=>'pen','type'=>'amber'],
                ['file'=>'paspor4','label'=>'Paspor Basah','sub'=>'Tinta Luntur / Terendam','icon'=>'drop','type'=>'blue'],
                ['file'=>'paspor5','label'=>'Paspor Robek','sub'=>'Halaman Sobek / Rusak','icon'=>'tear','type'=>'red'],
            ];
            @endphp
            @foreach($items as $i => $item)
            <div class="gitem">
                <img src="{{ asset('images/' . $item['file'] . '.jpeg') }}" alt="{{ $item['label'] }}">
                <div class="glabel-wrap">
                    <div class="gbadge {{ $item['type'] === 'red' ? 'red' : ($item['type'] === 'amber' ? 'amber' : '') }}">
                        @if($item['icon'] === 'fire')
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/><path d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"/></svg>
                        @elseif($item['icon'] === 'pen')
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        @elseif($item['icon'] === 'drop')
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2C12 2 4 10.5 4 15a8 8 0 0016 0c0-4.5-8-13-8-13z"/></svg>
                        @else
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        @endif
                    </div>
                    <div class="glabel"><strong>{{ $item['label'] }}</strong>{{ $item['sub'] }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="warn rv" style="transition-delay:.12s">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <p><strong>Perhatian:</strong> Biaya pendaftaran yang telah dibayarkan <strong>tidak dapat dikembalikan</strong> apabila paspor Anda terdeteksi rusak oleh sistem. Pastikan kondisi paspor sebelum mendaftar melalui M-Paspor.</p>
        </div>

        @php
        $rusak = [
            ['n'=>'1','title'=>'Cek Kondisi Paspor Lama','text'=>'Jika Anda ingin melakukan penggantian paspor, pastikan terlebih dahulu paspor lama Anda tidak masuk ke dalam kategori paspor rusak.','c'=>''],
            ['n'=>'2','title'=>'Kategori Paspor Rusak','text'=>'Paspor dinyatakan rusak apabila: halaman robek, terdapat coretan, dimakan rayap, terbakar, atau tinta luntur akibat basah.','c'=>''],
            ['n'=>'3','title'=>'Daftar via M-Paspor (Jika Paspor Baik)','text'=>'Jika paspor lama dipastikan masih dalam kondisi baik, Anda dapat melakukan pendaftaran online melalui aplikasi M-Paspor.','c'=>'ok'],
            ['n'=>'4','title'=>'Biaya Hangus Jika Paspor Rusak','text'=>'Jika tetap mendaftar online sementara paspor lama termasuk rusak, biaya yang telah dibayarkan akan hangus dan tidak dapat dikembalikan.','c'=>'danger'],
            ['n'=>'5','title'=>'Datang Langsung ke Kantor Imigrasi','text'=>'Sangat disarankan untuk langsung datang ke kantor imigrasi terdekat tanpa mendaftar online jika paspor memiliki ciri kerusakan.','c'=>''],
            ['n'=>'6','title'=>'Masih Ragu? Hubungi CS','text'=>'Jika masih ragu apakah paspor termasuk rusak atau tidak, datang langsung ke kantor atau hubungi nomor customer service kami.','c'=>''],
        ];
        @endphp
        <div class="sgrid">
            @foreach($rusak as $i => $item)
            <div class="scard {{ $item['c'] }} rv" style="transition-delay:{{ $i * 0.07 }}s">
                <div class="snum {{ $item['c'] }}">{{ $item['n'] }}</div>
                <div class="sbody">
                    <h4>{{ $item['title'] }}</h4>
                    <p>{{ $item['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PASPOR HILANG --}}
<section class="sec" id="hilang">
    <div class="sec-in">
        <div class="sec-hd rv">
            <span class="stag stag-r">PASPOR HILANG</span>
            <h2>Prosedur Pengurusan Paspor Hilang</h2>
            <p>Tahapan yang wajib dilakukan apabila paspor lama Anda hilang. Ikuti setiap langkah secara berurutan.</p>
        </div>

        @php
        $hilang = [
            ['title'=>'Pastikan Paspor Lama Ada','text'=>'Untuk penggantian paspor, paspor lama wajib dibawa dan fisiknya harus ada di tangan Anda saat datang ke kantor imigrasi.','d'=>false],
            ['title'=>'Datang ke Kantor Imigrasi','text'=>'Jika paspor lama tidak ditemukan setelah dicari, segera datang ke kantor imigrasi terdekat. Jangan langsung mendaftar online.','d'=>false],
            ['title'=>'Lapor ke Petugas Imigrasi','text'=>'Anda wajib melapor kepada petugas imigrasi agar nomor paspor lama Anda dapat dicari melalui database sistem imigrasi.','d'=>false],
            ['title'=>'Lapor ke Kantor Polisi','text'=>'Selanjutnya Anda akan diarahkan ke kantor polisi untuk membuat laporan kehilangan dan mendapatkan surat keterangan resmi.','d'=>false],
            ['title'=>'Proses BAP di Kantor Imigrasi','text'=>'Setelah mendapatkan surat keterangan kehilangan dari kepolisian, kembali ke kantor imigrasi untuk proses Berita Acara Pemeriksaan (BAP).','d'=>false],
            ['title'=>'Jangan Daftar Online Permohonan Baru','text'=>'Jika Anda memiliki paspor lama tetapi mendaftar online dengan permohonan baru, sistem otomatis menolak dan biaya akan hangus tanpa pengembalian.','d'=>true],
        ];
        @endphp

        <div class="tl">
            @foreach($hilang as $i => $item)
            <div class="tli rv" style="transition-delay:{{ $i * 0.08 }}s">
                <div class="tl-l">
                    <div class="tln {{ $item['d'] ? 'd' : '' }}">{{ $i+1 }}</div>
                    <div class="tlline"></div>
                </div>
                <div class="tlc {{ $item['d'] ? 'd' : '' }}">
                    <h4>{{ $item['title'] }}@if($item['d'])<span class="bdanger">Penting</span>@endif</h4>
                    <p>{{ $item['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="ctabox rv" style="transition-delay:.2s">
            <div class="ctabox-inner">
                <h3>Masih ada pertanyaan?</h3>
                <p>Hubungi customer service kami melalui WhatsApp untuk mendapatkan panduan lebih lanjut.</p>
                <a href="https://api.whatsapp.com/send/?phone=62811460377&text=Halo%2C+saya+ingin+bertanya&type=phone_number&app_absent=0" target="_blank" class="btn-wa">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Hubungi CS via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="foot">
    <div class="foot-in">
        <div class="foot-top">
            <div>
                <div class="foot-brand">
                    <div class="foot-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Immigration">
                    </div>
                    <span class="foot-bname">Immigration Info</span>
                </div>
                <p class="foot-desc">Website informasi layanan publik untuk paspor rusak dan paspor hilang. Dibuat untuk membantu masyarakat memahami prosedur imigrasi dengan mudah dan jelas.</p>
            </div>
            <div class="foot-col">
                <h5>Navigasi</h5>
                <a href="#rusak">Paspor Rusak</a>
                <a href="#hilang">Paspor Hilang</a>
                <a href="#layanan">Beranda</a>
            </div>
            <div class="foot-col">
                <h5>Kontak</h5>
                <a href="https://api.whatsapp.com/send/?phone=62811460377&text=Halo%2C+saya+ingin+bertanya&type=phone_number&app_absent=0" target="_blank">WhatsApp CS</a>
                <a href="#">Kantor Imigrasi</a>
                <a href="#">M-Paspor App</a>
            </div>
        </div>
        <div class="foot-bot">
            <span>© 2026 Immigration Public Information Service</span>
            <span><span class="fdot"></span>Sistem Aktif</span>
        </div>
    </div>
</footer>

{{-- FLOATING CS --}}
<div class="fcs">
    <span class="ftip">Tanya CS</span>
    <a href="https://api.whatsapp.com/send/?phone=62811460377&text=Halo%2C+saya+ingin+bertanya&type=phone_number&app_absent=0" target="_blank" class="fbtn" aria-label="Hubungi Customer Service">
        <img src="{{ asset('images/tanya.png') }}" alt="CS">
    </a>
</div>

<script>
    const obs = new IntersectionObserver(e => e.forEach(el => { if(el.isIntersecting) el.target.classList.add('in'); }), { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
    document.querySelectorAll('.rv').forEach(el => obs.observe(el));
</script>
</body>
</html>