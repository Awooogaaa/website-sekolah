<?php 
session_start();
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hubungi SMKN 1 Dlanggu Mojokerto - Telepon, Email, dan Alamat lengkap">
    <title>Hubungi Kami - SMKN 1 Dlanggu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
  <div class="container">
    <a class="navbar-brand" href="home.php">
        <i class="fas fa-graduation-cap"></i> SMKN 1 Dlanggu
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="home.php"><i class="fas fa-home me-1"></i> Beranda</a></li>
        <li class="nav-item"><a class="nav-link active" href="hubungi.php"><i class="fas fa-envelope me-1"></i> Hubungi Kami</a></li>
        <?php if (isset($_SESSION['admin_logged_in'])): ?>
        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a></li>
        <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- PAGE HEADER -->
<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-headset me-2"></i>Hubungi Kami</h1>
        <p>Kami siap membantu Anda. Silakan hubungi kami melalui informasi di bawah ini.</p>
        <nav class="mt-3">
            <ol class="breadcrumb breadcrumb-custom justify-content-center">
                <li class="breadcrumb-item"><a href="home.php">Beranda</a></li>
                <li class="breadcrumb-item active">Hubungi Kami</li>
            </ol>
        </nav>
    </div>
</section>

<!-- CONTACT CARDS -->
<section class="contact-page-section">
    <div class="container">
        <div class="row g-4 mb-5 justify-content-center">
            <!-- Telepon -->
            <div class="col-md-6 col-lg-4">
                <div class="contact-detail-card animate-fadein animate-fadein-1">
                    <div class="contact-detail-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4>Telepon</h4>
                    <p>(0321) 513093</p>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">(0321) 513642</p>
                </div>
            </div>
            <!-- Email -->
            <div class="col-md-6 col-lg-4">
                <div class="contact-detail-card animate-fadein animate-fadein-2">
                    <div class="contact-detail-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4>Email</h4>
                    <p>smkndlanggu@gmail.com</p>
                </div>
            </div>
            <!-- Alamat -->
            <div class="col-md-6 col-lg-4">
                <div class="contact-detail-card animate-fadein animate-fadein-3">
                    <div class="contact-detail-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>Alamat</h4>
                    <p>Jl. A. Yani 1, Desa Pohkecik, Kec. Dlanggu, Kab. Mojokerto, Jawa Timur 61371</p>
                </div>
            </div>
        </div>

        <!-- MAP -->
        <div class="row g-4 justify-content-center">
            <div class="col-lg-10">
                <div class="admin-card">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-map-marked-alt"></i> Lokasi Sekolah</h5>
                    </div>
                    <div style="padding: 0;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.5!2d112.38!3d-7.56!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e785e0db58b6c45%3A0x7f2f9c0e7b1b48b2!2sSMKN%201%20Dlanggu!5e0!3m2!1sid!2sid!4v1681234567890!5m2!1sid!2sid" width="100%" height="400" style="border:0; border-radius: 0 0 16px 16px;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Developer credit -->
        <div class="text-center mt-4">
            <p class="text-muted" style="font-size: 0.85rem;">
                <i class="fas fa-info-circle me-1"></i>
                Website ini dikembangkan oleh: <strong>Putra Perdana Kurniawan</strong>
            </p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <h5><i class="fas fa-graduation-cap me-2"></i>SMKN 1 Dlanggu</h5>
                <p>Sekolah Menengah Kejuruan Negeri 1 Dlanggu merupakan sekolah unggulan di Kabupaten Mojokerto yang berkomitmen mencetak lulusan berkualitas dan siap kerja.</p>
                <div class="footer-social-icons">
                    <a href="https://www.instagram.com/smkn1dlanggu/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/smkn1dlanggu" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/@smkn1dlanggu" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.tiktok.com/@smkn1dlanggu" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5>Navigasi</h5>
                <ul class="footer-link-list">
                    <li><a href="home.php"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                    <li><a href="hubungi.php"><i class="fas fa-chevron-right"></i> Hubungi Kami</a></li>
                    <li><a href="login.php"><i class="fas fa-chevron-right"></i> Login Admin</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Kontak</h5>
                <ul class="footer-link-list">
                    <li><a href="tel:0321513093"><i class="fas fa-phone"></i> (0321) 513093</a></li>
                    <li><a href="mailto:smkndlanggu@gmail.com"><i class="fas fa-envelope"></i> smkndlanggu@gmail.com</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Alamat</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i>Jl. A. Yani 1, Desa Pohkecik, Kec. Dlanggu, Kab. Mojokerto, Jawa Timur 61371</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> SMKN 1 Dlanggu. All Rights Reserved. | Dikembangkan oleh <strong>Putra Perdana Kurniawan</strong></p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.animate-fadein').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'all 0.6s ease-out';
    observer.observe(el);
});
</script>
</body>
</html>