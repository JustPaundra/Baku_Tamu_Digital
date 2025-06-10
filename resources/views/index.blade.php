<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital - Diskominfo Kabupaten Malang</title>
    <link rel="icon" href="{{ asset('asset/logo2.png') }}" type="image/png">
    <link rel="stylesheet" href="style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Add this right after the header opening tag -->
    <header>
        <div class="logo-container">
            <img src="asset/logo.png" alt="Logo Diskominfo" class="logo">
            <div class="header-title">
                <h1>Buku Tamu Digital</h1>
                <h2>Dinas Komunikasi dan Informatika Kabupaten Malang</h2>
            </div>
        </div>
        <nav class="top-nav">
            <div class="nav-icons">
                <a href="#kata-pengantar" class="nav-link">
                    <div class="icon-wrapper"><i class="fas fa-book-open"></i></div>
                </a>
                <a href="#alur" class="nav-link">
                    <div class="icon-wrapper"><i class="fas fa-route"></i></div>
                </a>
                <a href="#form-pendaftaran" class="nav-link">
                    <div class="icon-wrapper"><i class="fas fa-file-alt"></i></div>
                </a>
                <a href="#daftar-kunjungan" class="nav-link">
                    <div class="icon-wrapper"><i class="fas fa-list-alt"></i></div>
                </a>
                <a href="{{ route('login') }}" class="nav-link">
                    <div class="icon-wrapper"><i class="fas fa-user-shield"></i></div>
                </a>
            </div>
        </nav>
    </header>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <main>
        <section id="kata-pengantar" style="text-align: justify;">
            <h2>Kata Pengantar</h2>
            <p>
                Selamat datang di <strong>Sistem Buku Tamu Digital</strong> Dinas Komunikasi dan Informatika Kabupaten Malang.  
                Kami dengan senang hati menyambut Anda di instansi kami. Sistem ini dirancang untuk mempermudah proses 
                monitoring dan pencatatan kunjungan secara lebih efisien, akurat, dan ramah lingkungan.
            </p>
            <p>
                Dengan menggunakan sistem ini, Anda dapat mencatat kehadiran dengan lebih praktis, sehingga kami dapat 
                memberikan pelayanan yang lebih baik serta meningkatkan transparansi dan keamanan dalam pengelolaan data kunjungan.
            </p>
            <p>
                Terima kasih atas kunjungan Anda. Kami berharap sistem ini dapat memberikan pengalaman yang lebih nyaman dan modern bagi Anda.
            </p>
        </section>
        
        

        <section id="alur">
            <h2>Alur Pendaftaran</h2>           
            <img src="asset/alur.png" alt="Alur Pendaftaran" class="section-image">

        </section>

        <section id="form-pendaftaran">
            <h2>Form Pengunjung</h2>
            <form id="guest-form">

                <div class="clock-container"></div>
                <div class="form-group">
                    <label></label>
                    <input type="text" id="datetime" readonly>
                </div>                

                <div class="form-group">
                    <label for="nama">Nama Pengunjung:</label>
                    <input type="text" id="nama" required>
                </div>

                <div class="form-group">
                    <label for="instansi">Instansi Asal:</label>
                    <input type="text" id="instansi" required>
                </div>

                <div class="form-group">
                    <label for="telepon">Nomor Telepon (WhatsApp):</label>
                    <input type="tel" id="telepon" required>
                </div>

                <div class="form-group">
                    <label for="tujuan">Tujuan Kedatangan:</label>
                    <textarea id="tujuan" required></textarea>
                </div>

                <div class="form-group">
                    <label>Tanda Tangan:</label>
                    <canvas id="signature-pad"></canvas>
                    <button type="button" id="clear-signature">Hapus Tanda Tangan</button>
                </div>

                <div class="form-group">
                    <label>Foto:</label>
                    <div id="camera-container">
                        <video id="camera" autoplay playsinline></video>
                        <canvas id="photo-canvas" style="display: none;"></canvas>
                        <button type="button" id="take-photo">Ambil Foto</button>
                        <button type="button" id="retake-photo" style="display: none;">Ulangi Foto ? </button>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Kirim</button>
            </form>
        </section>

            <section id="daftar-kunjungan">
                <h2>Daftar Kunjungan Hari Ini</h2>
                <div id="visitor-list">
                    <!-- Daftar pengunjung akan ditambahkan secara dinamis -->
                </div>
            </section>
        </main>

        <footer>
            <div class="footer-container">
                <div class="logo-section">
                    <div class="logo-grid">
                        <img src="asset/logo.png" alt="Logo Pemkab Malang" class="footer-logo">
                        <img src="asset/logo2.png" alt="Logo Smart City" class="footer-logo">
                        <img src="asset/berakhlak.png" alt="Logo Kominfo" class="footer-logo">
                    </div>
                </div>
        
                <div class="footer-content">
                    <div class="social-media">
                        <h3>Ikuti Kami</h3>
                        <div class="social-links">
                            <a href="https://www.facebook.com/kominfokabmlg" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://twitter.com/kominfokabmlg" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/kominfokabmlg" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@DinasKominfoKabupatenMalang" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.tiktok.com/@kominfokabmlg" target="_blank"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                
                    <div class="related-links">
                        <h3>Link Terkait</h3>
                        <ul>
                            <li><a href="https://malangkab.go.id" target="_blank">Website Resmi Kabupaten Malang</a></li>
                            <li><a href="https://lapor.go.id" target="_blank">LAPOR!</a></li>
                            <li><a href="https://ppid.malangkab.go.id" target="_blank">PPID</a></li>
                        </ul>
                    </div>
                
                    <div class="contact-info">
                        <h3>Kontak Kami</h3>
                        <p>
                            Alamat: 
                            <a href="https://maps.app.goo.gl/CYDjMi1tgw2izfSs5" 
                               target="_blank" 
                               rel="noopener noreferrer">
                               Jl. Agus Salim No.7 Lt.3, Kiduldalem, Kec. Klojen, Kota Malang
                            </a>
                        </p>
                        <p>
                            Email: <a href="mailto:kominfo@malangkab.go.id">kominfo@malangkab.go.id</a>
                            Telepon: <a href="tel:0341408788">0341-408788</a>
                        </p>
                    </div>
                    
                    
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Dinas Komunikasi dan Informatika Kabupaten Malang</p>
            </div>
        </footer>

        <button id="scrollTopBtn" title="Kembali ke atas">
            <i class="fas fa-arrow-up"></i>
        </button>
    
        <script src="script.js"></script>
        <script src="/path/to/your/script.js"></script>
    </body>
    </html>
    
        

    <script src="script.js"></script>
    <script src="/path/to/your/script.js"></script>

</body>
</html>