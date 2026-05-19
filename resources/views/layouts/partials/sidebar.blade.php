<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <span>Base CMS</span>
        <button class="btn-close-sidebar" onclick="toggleSidebar()">&times;</button>
    </div>

    <style>
        /* === ACCORDION SIDEBAR CSS (Warna Base CMS, Struktur E-Rapor) === */
        #sidenav-collapse-main {
            overflow-y: auto !important;
            overflow-x: hidden !important;
            height: calc(100vh - 65px);
            padding-bottom: 40px;
        }
        #sidenav-collapse-main::-webkit-scrollbar { width: 4px; }
        #sidenav-collapse-main::-webkit-scrollbar-track { background: transparent; }
        #sidenav-collapse-main::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.15); border-radius: 4px; }
        #sidenav-collapse-main::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.3); }

        .navbar-nav { list-style: none; padding-left: 0; margin: 0; margin-top: 10px; display: flex; flex-direction: column; }
        .nav-item { margin: 0; padding: 0; list-style: none; }

        .nav-link {
            color: #c2c7d0 !important;
            font-weight: 500 !important;
            border-radius: 6px !important;
            margin: 0.15rem 0.5rem !important;
            padding: 0.65rem 1rem !important;
            transition: all 0.2s ease;
            position: relative;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            background-color: #495057 !important;
            color: #ffffff !important;
        }

        .nav-link.active {
            background-color: transparent !important; 
            color: #ffffff !important;
            font-weight: 700 !important;
        }

        /* Garis penanda menu aktif di sebelah kiri */
        .navbar-nav > .nav-item > .nav-link.active::before {
            content: '';
            position: absolute;
            left: -0.5rem;
            top: 15%;
            height: 70%;
            width: 4px;
            background-color: #ffffff;
            border-radius: 0 4px 4px 0;
            display: block;
        }

        /* Level 2 Indentation (Sub-Menu) */
        .category-wrapper .nav-link {
            margin: 0.15rem 0.5rem 0.15rem 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.85rem !important;
        }
        .category-wrapper .nav-link.active { color: #ffffff !important; font-weight: 700 !important; }
        .category-wrapper .nav-link.active::before { display: none; }

        /* Kategori Laci (Accordion Toggle) */
        .sidenav-category-toggle {
            padding: 0.75rem 1rem;
            margin: 0.5rem 0.5rem 0.25rem 0.5rem;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.05);
            text-decoration: none;
        }
        .sidenav-category-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
            text-decoration: none;
        }
        .sidenav-category-toggle .cat-title {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 1px;
            color: #c2c7d0; 
            text-transform: uppercase;
        }
        .sidenav-category-toggle .cat-icon {
            font-size: 0.75rem;
            transition: transform 0.3s ease;
            color: rgba(255,255,255,0.5);
        }
        .sidenav-category-toggle[aria-expanded="true"] {
            border-left: 3px solid #ffffff; 
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidenav-category-toggle[aria-expanded="true"] .cat-icon {
            transform: rotate(180deg);
            color: #ffffff;
        }
        .sidenav-category-toggle[aria-expanded="true"] .cat-title {
            color: #ffffff;
        }
        
        .category-wrapper {
            padding-left: 0.25rem;
            border-left: 1px dashed rgba(255,255,255,0.2);
            margin-left: 1rem;
            margin-bottom: 0.5rem;
            display: none; /* Disembunyikan secara default */
        }
        .category-wrapper.show {
            display: block; /* Ditampilkan jika aktif */
        }
        .icon-wrapper {
            width: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
    </style>

    <div id="sidenav-collapse-main">
        <ul class="navbar-nav">
            
            {{-- 1. DASHBOARD --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <div class="icon-wrapper"><i class="fas fa-home"></i></div>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            {{-- ========================================================= --}}
            {{-- 2. MANAJEMEN ARTIKEL (KATEGORI ACCORDION) --}}
            {{-- ========================================================= --}}
            @php
                $isArtikelActive = request()->routeIs('admin.posts.*');
            @endphp
            <li class="nav-item mt-2">
                <a class="sidenav-category-toggle" onclick="toggleAccordion('catArtikel', this)" aria-expanded="{{ $isArtikelActive ? 'true' : 'false' }}">
                    <span class="cat-title">Manajemen Artikel</span>
                    <i class="fas fa-chevron-down cat-icon"></i>
                </a>
                
                <div class="category-wrapper {{ $isArtikelActive ? 'show' : '' }}" id="catArtikel">
                    <ul class="navbar-nav" style="margin-top:0;">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.posts.index') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                                <span class="nav-link-text">Semua Artikel</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.posts.create') ? 'active' : '' }}" href="{{ route('admin.posts.create') }}">
                                <span class="nav-link-text">Tulis Artikel</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- ========================================================= --}}
            {{-- 3. KONTEN BERANDA (KATEGORI ACCORDION) --}}
            {{-- ========================================================= --}}
            @php
                $isBerandaActive = request()->routeIs('admin.beranda.*');
            @endphp
            <li class="nav-item mt-2">
                <a class="sidenav-category-toggle" onclick="toggleAccordion('catBeranda', this)" aria-expanded="{{ $isBerandaActive ? 'true' : 'false' }}">
                    <span class="cat-title">Konten Beranda</span>
                    <i class="fas fa-chevron-down cat-icon"></i>
                </a>
                
                <div class="category-wrapper {{ $isBerandaActive ? 'show' : '' }}" id="catBeranda">
                    <ul class="navbar-nav" style="margin-top:0;">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.beranda.hero.*') ? 'active' : '' }}" href="{{ route('admin.beranda.hero.index') }}">
                                <span class="nav-link-text">1. Hero Image (Slider)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.beranda.clients.*') ? 'active' : '' }}" href="{{ route('admin.beranda.clients.index') }}">
                                <span class="nav-link-text">2. Logo Klien</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.beranda.services.*') ? 'active' : '' }}" href="{{ route('admin.beranda.services.index') }}">
                                <span class="nav-link-text">3. Layanan Utama</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.beranda.portfolios.*') ? 'active' : '' }}" href="{{ route('admin.beranda.portfolios.index') }}">
                                <span class="nav-link-text">4. Karya / Portofolio</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.beranda.testimonials.*') ? 'active' : '' }}" href="{{ route('admin.beranda.testimonials.index') }}">
                                <span class="nav-link-text">5. Review Client</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-text">6. Informasi Bisnis</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>

{{-- Skrip Javascript murni untuk mengatur buka/tutup laci Accordion --}}
<script>
    function toggleAccordion(wrapperId, buttonElement) {
        // Ambil elemen dropdown wrapper-nya
        var wrapper = document.getElementById(wrapperId);
        
        // Cek status saat ini
        var isExpanded = buttonElement.getAttribute('aria-expanded') === 'true';
        
        if (isExpanded) {
            // Jika sedang terbuka, maka tutup
            wrapper.classList.remove('show');
            buttonElement.setAttribute('aria-expanded', 'false');
        } else {
            // Jika sedang tertutup, maka buka
            wrapper.classList.add('show');
            buttonElement.setAttribute('aria-expanded', 'true');
        }
    }
</script>