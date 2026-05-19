@extends('layouts.front')

@section('title', 'Tentang Kami | Campus Creative')

@push('styles')
<style>
    /* ==========================================================================
       Variabel Warna Utama (Sesuai Tema Home)
       ========================================================================== */
    :root {
        --color-dark-grey: #0f1115;
        --color-dark-card: #181b22;
        --color-orange: #ff6b00;
        --color-orange-hover: #e05e00;
        --color-white: #ffffff;
        --color-white-off: #f8fafc;
        --color-grey-text: #475569;
        --color-grey-light: #94a3b8;
        --color-border: #e2e8f0;
        --max-width-canvas: 1200px; /* Sedikit lebih sempit untuk halaman artikel agar nyaman dibaca */
    }

    /* Pengaturan Umum Halaman About */
    .about-page-wrapper { background-color: var(--color-white); color: var(--color-dark-grey); }
    .about-container { max-width: var(--max-width-canvas); margin: 0 auto; padding: 0 40px; }
    
    /* 1. Page Header (Hero About) */
    .about-hero { 
        background: radial-gradient(circle at 50% 0%, #1e222b 0%, var(--color-dark-grey) 100%); 
        padding: 12rem 0 8rem 0; 
        text-align: center;
        border-bottom: 4px solid var(--color-orange);
    }
    .about-hero h1 { 
        font-size: 4rem; 
        color: var(--color-white); 
        font-weight: 900; 
        letter-spacing: -1.5px;
        margin-bottom: 1.5rem;
    }
    .about-hero p { 
        font-size: 1.3rem; 
        color: var(--color-grey-light); 
        max-width: 700px; 
        margin: 0 auto; 
        line-height: 1.8;
    }

    /* 2. Sejarah Singkat (Story Section) */
    .story-section { padding: 8rem 0; background-color: var(--color-white); }
    .story-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }
    .story-content h2 {
        font-size: 2.8rem;
        font-weight: 900;
        color: var(--color-dark-grey);
        margin-bottom: 2rem;
        letter-spacing: -1px;
    }
    .story-content p {
        font-size: 1.15rem;
        color: var(--color-grey-text);
        line-height: 1.8;
        margin-bottom: 1.5rem;
        text-align: justify; /* Format Rata Kiri Kanan Sesuai Permintaan */
    }
    .story-visual {
        background: var(--color-white-off);
        border-radius: 32px;
        height: 600px;
        position: relative;
        overflow: hidden;
        border: 1px solid var(--color-border);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .story-visual-abstract {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
    }
    .story-visual-abstract svg {
        width: 120px;
        height: 120px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    /* 3. Highlight Mengapa Kami (Why Us Box) */
    .why-highlight-section { padding: 0 0 8rem 0; background-color: var(--color-white); }
    .why-box {
        background: linear-gradient(135deg, var(--color-dark-grey) 0%, #1a1e26 100%);
        border-radius: 32px;
        padding: 5rem 6rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .why-box::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background-color: var(--color-orange);
    }
    .why-box h3 {
        color: var(--color-orange);
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 1rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
    }
    .why-box p {
        font-size: 1.6rem;
        color: var(--color-white);
        line-height: 1.8;
        font-weight: 500;
        margin: 0;
        text-align: justify; /* Format Rata Kiri Kanan Sesuai Permintaan */
    }

    /* 4. Visi Misi Section */
    .vm-section { background-color: var(--color-white-off); padding: 8rem 0; border-top: 1px solid var(--color-border); }
    .vm-header { text-align: center; margin-bottom: 5rem; }
    .vm-header h2 { font-size: 3rem; font-weight: 900; color: var(--color-dark-grey); letter-spacing: -1px; }
    
    .vm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 40px;
    }
    
    .vm-card {
        background: var(--color-white);
        padding: 4rem;
        border-radius: 24px;
        border: 1px solid var(--color-border);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .vm-card-icon {
        width: 70px;
        height: 70px;
        background-color: var(--color-orange-light);
        color: var(--color-orange);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 2rem;
    }
    
    .vm-card h3 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--color-dark-grey);
        margin-bottom: 1.5rem;
    }
    
    .vm-card p.visi-text {
        font-size: 1.35rem;
        color: var(--color-grey-text);
        line-height: 1.8;
        font-weight: 500;
        text-align: justify; /* Format Rata Kiri Kanan */
    }

    .misi-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .misi-list li {
        position: relative;
        padding-left: 2.5rem;
        margin-bottom: 1.5rem;
        font-size: 1.15rem;
        color: var(--color-grey-text);
        line-height: 1.7;
        text-align: justify; /* Format Rata Kiri Kanan */
    }
    .misi-list li::before {
        content: "→";
        color: var(--color-orange);
        position: absolute;
        left: 0;
        top: 0px;
        font-weight: 900;
        font-size: 1.4rem;
    }

    /* 5. CTA Section (Diambil dari Home) */
    .cta-section { background: linear-gradient(180deg, var(--color-dark-grey) 0%, #050608 100%); color: var(--color-white); padding: 10rem 0; text-align: center; }
    .cta-section h2 { font-size: 3.8rem; margin-bottom: 2rem; color: var(--color-white); font-weight: 900; letter-spacing: -2px; }
    .cta-section p { color: #94a3b8; font-size: 1.35rem; line-height: 1.8; max-width: 800px; margin: 0 auto 4.5rem auto; text-align: center; }
    .btn-cta-max { display: inline-block; background: var(--color-orange); color: var(--color-white); padding: 22px 55px; border-radius: 14px; text-decoration: none; font-weight: 800; font-size: 1.15rem; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); box-shadow: 0 15px 35px rgba(255, 107, 0, 0.3); }
    .btn-cta-max:hover { background: var(--color-orange-hover); transform: translateY(-4px); box-shadow: 0 20px 45px rgba(255, 107, 0, 0.45); }

    /* Media Queries */
    @media (max-width: 992px) {
        .story-grid { grid-template-columns: 1fr; gap: 40px; }
        .story-visual { height: 400px; order: -1; }
        .why-box { padding: 4rem 3rem; }
        .why-box p { font-size: 1.3rem; }
    }
    @media (max-width: 768px) {
        .about-container { padding: 0 24px; }
        .about-hero { padding: 8rem 0 6rem 0; }
        .about-hero h1 { font-size: 2.8rem; }
        .story-section, .why-highlight-section, .vm-section, .cta-section { padding: 5rem 0; }
        .story-content h2, .vm-header h2 { font-size: 2.4rem; }
        .why-box { padding: 3rem 2rem; border-radius: 24px; }
        .why-box p { font-size: 1.15rem; }
        .vm-grid { grid-template-columns: 1fr; }
        .vm-card { padding: 2.5rem; }
        .cta-section h2 { font-size: 2.4rem; }
    }
</style>
@endpush

@section('content')
<div class="about-page-wrapper">

    <!-- 1. Hero About -->
    <header class="about-hero">
        <div class="about-container">
            <h1>Tentang Campus Creative</h1>
            <p>Membangun identitas digital yang kuat, relevan, dan kompetitif untuk pertumbuhan bisnis Anda di era digital.</p>
        </div>
    </header>

    <!-- 2. Sejarah Singkat -->
    <section class="story-section">
        <div class="about-container">
            <div class="story-grid">
                <div class="story-content">
                    <h2>Perjalanan Kami</h2>
                    
                    <p>Didirikan pada tahun 2020 sebagai salah satu unit bisnis dari Campus World, Campus Creative hadir sebagai penyedia layanan profesional di bidang pengembangan dan pengelolaan digital. Layanan ini berawal dari kebutuhan mendesak perusahaan, penjual, dan pemasar akan kehadiran digital yang kuat dan efektif di tengah persaingan bisnis yang semakin ketat.</p>
                    
                    <p>Sejak awal berdirinya, Campus Creative berfokus pada pengembangan website profesional yang dirancang secara khusus dengan mempertimbangkan aspek estetika, fungsionalitas, pengalaman pengguna (UX), serta optimasi SEO. Pendekatan ini memastikan setiap website tidak hanya menarik secara visual, tetapi juga mampu tampil lebih baik di mesin pencari dan memberikan pengalaman optimal bagi pengguna.</p>
                    
                    <p>Seiring perkembangan, Campus Creative memperluas layanannya dengan menghadirkan Ads Service yang membantu bisnis menjangkau audiens lebih luas melalui kampanye iklan yang tepat sasaran. Tidak berhenti di situ, Campus Creative juga berkembang menjadi agency pengelolaan akun digital, meliputi website, media sosial, YouTube, dan berbagai platform digital lainnya, untuk memastikan brand klien dikelola secara konsisten, efektif, dan berdampak.</p>
                    
                    <p>Dengan kombinasi layanan kreatif, teknologi, dan strategi pemasaran digital, Campus Creative berkomitmen menjadi mitra terpercaya dalam membantu individu maupun perusahaan membangun identitas digital yang kuat, relevan, dan kompetitif di era digital.</p>
                </div>
                
                <div class="story-visual">
                    <!-- Placeholder Visual Estetik (Opsional bisa diganti tag <img> jika ada foto tim/kantor) -->
                    <img src="{{ asset('assets/img/foto-tim.png') }}" alt="Campus Creative" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Why Us Highlight -->
    <section class="why-highlight-section">
        <div class="about-container">
            <div class="why-box">
                <h3>Mengapa Memilih Kami?</h3>
                <p>Campus Creative hadir sebagai mitra strategis yang menggabungkan kreativitas, teknologi, dan strategi digital untuk membangun kehadiran online yang kuat. Kami tidak sekadar membuat website atau mengelola akun digital, tetapi merancang pengalaman digital yang menyatu dengan identitas brand, memperkuat visibilitas, dan mendorong pertumbuhan bisnis secara berkelanjutan.</p>
            </div>
        </div>
    </section>

    <!-- 4. Visi & Misi -->
    <section class="vm-section">
        <div class="about-container">
            <div class="vm-header">
                <h2>Visi & Misi</h2>
            </div>
            
            <div class="vm-grid">
                <!-- Card Visi -->
                <div class="vm-card">
                    <div class="vm-card-icon">
                        <!-- Icon Eye / Target -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3>Visi Kami</h3>
                    <p class="visi-text">Menjadi mitra digital kreatif terpercaya yang membantu bisnis dan individu bertumbuh melalui solusi digital inovatif dan berdampak.</p>
                </div>

                <!-- Card Misi -->
                <div class="vm-card">
                    <div class="vm-card-icon">
                        <!-- Icon Flag / Goal -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                    </div>
                    <h3>Misi Kami</h3>
                    <ul class="misi-list">
                        <li>Menyediakan layanan digital kreatif yang profesional, inovatif, dan sesuai kebutuhan klien.</li>
                        <li>Mengembangkan strategi digital yang efektif untuk meningkatkan visibilitas dan daya saing bisnis.</li>
                        <li>Membangun hubungan kolaboratif yang berorientasi pada hasil nyata.</li>
                        <li>Terus beradaptasi dengan perkembangan teknologi untuk menghadirkan solusi digital terkini.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. CTA Section -->
    <section class="cta-section">
        <div class="about-container">
            <h2>Siap Mendigitalisasi Bisnis Anda?</h2>
            <p>Sinergikan kebutuhan digitalisasi proses bisnis, pembuatan platform manajemen data, serta peningkatan jangkauan brand market Anda bersama barisan tim ahli kami sekarang.</p>
            <a href="https://wa.me/62816282136" class="btn-cta-max" target="_blank">Inisiasi Konsultasi Gratis</a>
        </div>
    </section>

</div>
@endsection