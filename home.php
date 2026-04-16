<?php 
session_start();
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website resmi SMKN 1 Dlanggu Mojokerto - Sekolah Menengah Kejuruan Negeri terbaik di Dlanggu">
    <title>SMKN 1 Dlanggu - Beranda</title>
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
        <li class="nav-item"><a class="nav-link active" href="home.php"><i class="fas fa-home me-1"></i> Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="hubungi.php"><i class="fas fa-envelope me-1"></i> Hubungi Kami</a></li>
        <?php if (isset($_SESSION['admin_logged_in'])): ?>
        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a></li>
        <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO SECTION -->
<section class="hero-section" id="hero">
    <img src="uploads/hero_school.png" alt="SMKN 1 Dlanggu" class="hero-bg">
    <div class="hero-overlay"></div>
    <div class="hero-shape hero-shape-1"></div>
    <div class="hero-shape hero-shape-2"></div>
    <div class="hero-shape hero-shape-3"></div>
    <div class="hero-content">
        <div class="hero-badge">
            <i class="fas fa-star me-1"></i> Sekolah Unggulan Mojokerto
        </div>
        <h1 class="hero-title">SMKN 1 Dlanggu</h1>
        <p class="hero-subtitle">Mencetak generasi muda yang kompeten, kreatif, dan siap bersaing di dunia industri melalui pendidikan kejuruan berkualitas.</p>
        <div class="hero-buttons">
            <a href="#kegiatan" class="btn-hero-primary"><i class="fas fa-arrow-down me-2"></i>Lihat Kegiatan</a>
            <a href="hubungi.php" class="btn-hero-outline"><i class="fas fa-phone me-2"></i>Hubungi Kami</a>
        </div>
    </div>
    <div class="hero-scroll-indicator">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- STATS SECTION -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="stat-item animate-fadein animate-fadein-1">
                    <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="stat-number">1000+</div>
                    <div class="stat-label">Siswa Aktif</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item animate-fadein animate-fadein-2">
                    <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <div class="stat-number">80+</div>
                    <div class="stat-label">Tenaga Pengajar</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item animate-fadein animate-fadein-3">
                    <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                    <div class="stat-number">6</div>
                    <div class="stat-label">Program Keahlian</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item animate-fadein animate-fadein-4">
                    <div class="stat-icon"><i class="fas fa-trophy"></i></div>
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Prestasi</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KEGIATAN SECTION -->
<section class="kegiatan-section" id="kegiatan">
    <div class="container">
        <div class="section-title">
            <h2>Informasi Kegiatan Terbaru</h2>
            <p>Ikuti perkembangan terbaru dari kegiatan dan acara di SMKN 1 Dlanggu</p>
        </div>
        <div class="row g-4">
            <?php
            $query = "SELECT * FROM kegiatan ORDER BY tanggal DESC LIMIT 6";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="kegiatan-card animate-fadein">
                    <div class="card-img-wrapper">
                        <img src="<?= $row['gambar'] != 'default.png' ? 'uploads/' . $row['gambar'] : 'https://via.placeholder.com/400x250/7c3aed/ffffff?text=SMKN+1+Dlanggu' ?>" alt="<?= htmlspecialchars($row['judul']) ?>">
                        <span class="card-date-badge">
                            <i class="fas fa-calendar-alt me-1"></i>
                            <?= date('d M Y', strtotime($row['tanggal'])) ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['deskripsi']) ?></p>
                        <a href="detail.php?id=<?= $row['id'] ?>" class="btn-detail-link">
                            <i class="fas fa-arrow-right me-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            <?php 
                }
            } else {
            ?>
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-calendar-times d-block"></i>
                    <h5>Belum Ada Kegiatan</h5>
                    <p>Kegiatan terbaru akan ditampilkan di sini.</p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- SOCIAL MEDIA SECTION -->
<section class="social-section" id="sosmed">
    <div class="container">
        <div class="section-title">
            <h2>Ikuti Media Sosial Kami</h2>
            <p>Tetap terhubung dengan SMKN 1 Dlanggu melalui media sosial resmi</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <a href="https://www.instagram.com/smkn1dlanggu/" target="_blank" class="social-card social-ig animate-fadein animate-fadein-1">
                    <div class="social-icon"><i class="fab fa-instagram"></i></div>
                    <span class="social-name">Instagram</span>
                    <span class="social-handle">@smkn1dlanggu</span>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="https://www.facebook.com/smkn1dlanggu" target="_blank" class="social-card social-fb animate-fadein animate-fadein-2">
                    <div class="social-icon"><i class="fab fa-facebook-f"></i></div>
                    <span class="social-name">Facebook</span>
                    <span class="social-handle">SMKN 1 Dlanggu</span>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="https://www.youtube.com/@smkn1dlanggu" target="_blank" class="social-card social-yt animate-fadein animate-fadein-3">
                    <div class="social-icon"><i class="fab fa-youtube"></i></div>
                    <span class="social-name">YouTube</span>
                    <span class="social-handle">SMKN 1 Dlanggu</span>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="https://www.tiktok.com/@smkn1dlanggu" target="_blank" class="social-card social-tt animate-fadein animate-fadein-4">
                    <div class="social-icon"><i class="fab fa-tiktok"></i></div>
                    <span class="social-name">TikTok</span>
                    <span class="social-handle">@smkn1dlanggu</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- HUBUNGI KAMI SECTION (HOME) -->
<section class="contact-home-section" id="kontak">
    <div class="container">
        <div class="section-title">
            <h2>Hubungi Kami</h2>
            <p>Jangan ragu untuk menghubungi kami jika ada pertanyaan</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="contact-home-card h-100">
                    <h4 style="font-weight: 700; margin-bottom: 24px; color: var(--primary);"><i class="fas fa-address-book me-2"></i>Informasi Kontak</h4>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <h5>Telepon</h5>
                            <p>(0321) 513093</p>
                            <p>(0321) 513642</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h5>Email</h5>
                            <p>smkndlanggu@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h5>Alamat</h5>
                            <p>Jl. A. Yani 1, Desa Pohkecik, Kec. Dlanggu, Kab. Mojokerto, Jawa Timur 61371</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="hubungi.php" class="btn btn-purple"><i class="fas fa-arrow-right me-2"></i>Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact-map-wrapper">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.5!2d112.38!3d-7.56!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e785e0db58b6c45%3A0x7f2f9c0e7b1b48b2!2sSMKN%201%20Dlanggu!5e0!3m2!1sid!2sid!4v1681234567890!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
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
                    <li><a href="#"><i class="fas fa-globe"></i> smkn1dlanggu.sch.id</a></li>
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
// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// Navbar background change on scroll
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar-custom');
    if (window.scrollY > 50) {
        navbar.style.background = 'linear-gradient(135deg, rgba(91, 33, 182, 0.95), rgba(124, 58, 237, 0.95))';
    } else {
        navbar.style.background = '';
    }
});

// Intersection Observer for animations
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