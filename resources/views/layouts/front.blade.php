<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Campus Creative | Agensi Digital Semarang')</title>
    <meta name="description" content="@yield('meta_description', 'Campus Creative hadir untuk mendigitalisasi bisnis Anda. Melayani pembuatan website, media sosial, multimedia, dan branding kit di Semarang.')">
    
    <style>
        /* Variabel Warna Utama (50% Putih, 25% Orange, 25% Dark Grey) */
        :root {
            --color-white: #ffffff;
            --color-white-off: #f4f6f9; 
            --color-dark-grey: #222529; 
            --color-grey-light: #6c757d;
            --color-orange: #ff6b00;
            --color-orange-light: #fff5eb;
            --gradient-orange: linear-gradient(135deg, #ff6b00 0%, #ff8c00 100%);
        }

        body {
            background-color: var(--color-white);
            color: var(--color-grey-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Navigasi / Header */
        .site-header {
            background-color: var(--color-white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 0;
        }
        
        /* Modifikasi CSS Logo untuk mendukung Gambar */
        .logo {
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--color-dark-grey);
            text-decoration: none;
            letter-spacing: -0.5px;
            display: inline-flex;
            align-items: center;
        }
        .logo span {
            color: var(--color-orange);
        }
        .logo img {
            max-height: 45px; /* Membatasi tinggi logo agar proporsional di navbar */
            width: auto;
        }

        .main-nav ul {
            list-style: none;
            display: flex;
            align-items: center; /* Memastikan semua menu sejajar vertikal */
            gap: 2rem;
            margin: 0;
            padding: 0;
        }
        .main-nav a {
            text-decoration: none;
            color: var(--color-dark-grey);
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.3s;
        }
        .main-nav a:hover {
            color: var(--color-orange);
        }

        /* Tombol Login di Navbar */
        .main-nav a.nav-btn-login {
            background-color: var(--color-orange);
            color: var(--color-white) !important;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 107, 0, 0.2);
        }
        .main-nav a.nav-btn-login:hover {
            background-color: #e66000;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 107, 0, 0.3);
        }

        /* Tombol Global */
        .btn {
            display: inline-block;
            padding: 15px 35px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .btn-primary {
            background: var(--gradient-orange);
            color: var(--color-white);
            box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 107, 0, 0.4);
            color: var(--color-white);
        }
        .btn-secondary {
            background-color: transparent;
            color: var(--color-white);
            border: 2px solid var(--color-white);
        }
        .btn-secondary:hover {
            background-color: var(--color-white);
            color: var(--color-dark-grey);
            transform: translateY(-3px);
        }

        /* Footer (Dark Grey) */
        .site-footer {
            background: var(--color-dark-grey);
            color: var(--color-white);
            padding: 5rem 2rem 2rem 2rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }
        .footer-col h4 {
            color: var(--color-orange);
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }
        .footer-col p, .footer-col ul {
            font-size: 0.95rem;
            opacity: 0.8;
            list-style: none;
            padding: 0;
            margin: 0;
            color: #cccccc;
        }
        .footer-col ul li {
            margin-bottom: 0.8rem;
        }
        .footer-col ul li a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer-col ul li a:hover {
            color: var(--color-orange);
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 2rem;
            text-align: center;
            font-size: 0.85rem;
            opacity: 0.6;
        }

        /* Responsif untuk Navigasi Mobile */
        @media (max-width: 768px) {
            .nav-container { flex-direction: column; gap: 1.5rem; }
            .main-nav ul { gap: 1rem; flex-wrap: wrap; justify-content: center; align-items: center; }
            .btn { width: 100%; margin-right: 0; text-align: center; }
        }
    </style>

    @stack('styles')

</head>
<body>

    <header class="site-header">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('storage/logo.png') }}" alt="Campus Creative Logo">
            </a>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('front.about') }}">Tentang</a></li>
                    <li><a href="{{ route('front.services') }}">Layanan</a></li>
                    <li><a href="{{ route('home') }}/#portofolio">Portofolio</a></li>
                    <li><a href="{{ route('front.blog.index') }}">Artikel</a></li>
                    <li><a href="{{ route('login') }}" class="nav-btn-login">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="{{ route('home') }}" class="logo" style="color: var(--color-white); margin-bottom: 1.5rem; display: block;">Campus <span>Creative</span></a>
                    <p>Agensi digital terpercaya di Semarang. Kami berfokus pada hasil nyata, performa tinggi, dan desain elegan untuk membantu bisnis Anda tumbuh secara digital.</p>
                </div>
                
                <div class="footer-col">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><a href="{{ route('front.services') }}">Pembuatan Website</a></li>
                        <li><a href="{{ route('front.services') }}">Pengelolaan Media Sosial</a></li>
                        <li><a href="{{ route('front.services') }}">Multimedia & Fotografi</a></li>
                        <li><a href="{{ route('front.services') }}">Branding Kit & Desain</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Tautan Perusahaan</h4>
                    <ul>
                        <li><a href="{{ route('front.about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('home') }}/#portofolio">Portofolio Karya</a></li>
                        <li><a href="{{ route('front.blog.index') }}">Artikel Blog</a></li>
                        
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Hubungi Kami</h4>
                    <p>Jl. Tamansari Hill Residen. Blok B01,<br>Kel. Mangunharjo, Kec. Tembalang,<br>Semarang, Jawa Tengah</p>
                    <p style="margin-top: 1rem;"><strong>Email:</strong> halo@campus.web.id</p>
                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/62816282136" target="_blank" style="color: inherit; text-decoration: none;">+62 816 282 136</a></p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Campus Creative - Jasa Pembuatan Website Semarang. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

</body>
</html>