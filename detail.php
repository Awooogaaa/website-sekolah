<?php 
session_start();
include 'koneksi.php';

// Ambil data berdasarkan ID
if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id='$id'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars(substr($row['deskripsi'], 0, 150)) ?>">
    <title><?= htmlspecialchars($row['judul']) ?> - SMKN 1 Dlanggu</title>
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

<!-- PAGE HEADER -->
<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-newspaper me-2"></i>Detail Kegiatan</h1>
        <nav class="mt-3">
            <ol class="breadcrumb breadcrumb-custom justify-content-center">
                <li class="breadcrumb-item"><a href="home.php">Beranda</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($row['judul']) ?></li>
            </ol>
        </nav>
    </div>
</section>

<!-- DETAIL CONTENT -->
<section style="padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="admin-card animate-fadein" style="overflow: hidden;">
                    <!-- Gambar -->
                    <?php if ($row['gambar'] != 'default.png'): ?>
                    <div style="width: 100%; max-height: 450px; overflow: hidden;">
                        <img src="uploads/<?= $row['gambar'] ?>" alt="<?= htmlspecialchars($row['judul']) ?>" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <?php else: ?>
                    <div style="width: 100%; height: 300px; background: linear-gradient(135deg, var(--primary-lightest), var(--accent-light)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image fa-4x" style="color: var(--primary-lighter);"></i>
                    </div>
                    <?php endif; ?>

                    <div class="card-body-custom" style="padding: 36px;">
                        <!-- Badge tanggal -->
                        <div style="margin-bottom: 16px;">
                            <span style="background: linear-gradient(135deg, var(--primary), var(--accent)); color: white; padding: 6px 16px; border-radius: 50px; font-size: 0.8rem; font-weight: 600;">
                                <i class="fas fa-calendar-alt me-1"></i>
                                <?= date('d M Y, H:i', strtotime($row['tanggal'])) ?> WIB
                            </span>
                        </div>

                        <!-- Judul -->
                        <h2 style="font-weight: 700; font-size: 1.8rem; color: var(--text-dark); margin-bottom: 20px; line-height: 1.3;">
                            <?= htmlspecialchars($row['judul']) ?>
                        </h2>

                        <!-- Deskripsi -->
                        <div style="color: var(--text-muted); font-size: 1rem; line-height: 1.8;">
                            <?= nl2br(htmlspecialchars($row['deskripsi'])) ?>
                        </div>

                        <!-- Back button -->
                        <div style="margin-top: 36px; padding-top: 24px; border-top: 1px solid var(--primary-lightest);">
                            <a href="home.php#kegiatan" class="btn btn-purple">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="admin-card" style="position: sticky; top: 80px;">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-list"></i> Kegiatan Lainnya</h5>
                    </div>
                    <div class="card-body-custom" style="padding: 16px;">
                        <?php
                        $otherQuery = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id != '$id' ORDER BY tanggal DESC LIMIT 5");
                        if (mysqli_num_rows($otherQuery) > 0):
                            while ($other = mysqli_fetch_assoc($otherQuery)):
                        ?>
                        <a href="detail.php?id=<?= $other['id'] ?>" style="display: flex; gap: 12px; padding: 12px; border-radius: var(--radius-sm); transition: var(--transition); text-decoration: none; color: var(--text-dark); margin-bottom: 4px;" 
                           onmouseover="this.style.background='var(--primary-lightest)'" 
                           onmouseout="this.style.background='transparent'">
                            <?php if ($other['gambar'] != 'default.png'): ?>
                            <img src="uploads/<?= $other['gambar'] ?>" style="width: 60px; height: 45px; object-fit: cover; border-radius: 8px; flex-shrink: 0;">
                            <?php else: ?>
                            <div style="width: 60px; height: 45px; background: var(--primary-lightest); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fas fa-image" style="color: var(--primary-lighter); font-size: 0.8rem;"></i>
                            </div>
                            <?php endif; ?>
                            <div style="min-width: 0;">
                                <h6 style="font-size: 0.85rem; font-weight: 600; margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <?= htmlspecialchars($other['judul']) ?>
                                </h6>
                                <small style="color: var(--text-muted); font-size: 0.75rem;">
                                    <i class="fas fa-calendar-alt me-1"></i><?= date('d M Y', strtotime($other['tanggal'])) ?>
                                </small>
                            </div>
                        </a>
                        <?php 
                            endwhile;
                        else: ?>
                        <p class="text-center text-muted" style="padding: 20px 0; font-size: 0.9rem;">Tidak ada kegiatan lainnya.</p>
                        <?php endif; ?>
                    </div>
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
</body>
</html>
