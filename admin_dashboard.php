<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Hitung total data
$countKegiatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kegiatan"))['total'];

// Kegiatan terbaru
$latestKegiatan = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY tanggal DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin SMKN 1 Dlanggu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body style="background: var(--bg-body);">

<!-- ADMIN SIDEBAR -->
<div class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <i class="fas fa-graduation-cap"></i>
        <span>SMKN 1 Dlanggu</span>
    </div>
    <div class="sidebar-menu">
        <div class="sidebar-menu-label">MENU UTAMA</div>
        <a href="admin_dashboard.php" class="sidebar-link active">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
        </a>
        <a href="admin.php" class="sidebar-link">
            <i class="fas fa-calendar-alt"></i> <span>Data Kegiatan</span>
        </a>
        <a href="admin_create.php" class="sidebar-link">
            <i class="fas fa-plus-circle"></i> <span>Tambah Kegiatan</span>
        </a>
        <div class="sidebar-menu-label">LAINNYA</div>
        <a href="home.php" class="sidebar-link" target="_blank">
            <i class="fas fa-external-link-alt"></i> <span>Lihat Website</span>
        </a>
        <a href="logout.php" class="sidebar-link sidebar-link-danger">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
        </a>
    </div>
</div>

<!-- SIDEBAR OVERLAY (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- MAIN CONTENT -->
<div class="admin-main" id="adminMain">
    <!-- Top Bar -->
    <div class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h5 class="mb-0 fw-bold" style="color: var(--text-dark);">Dashboard</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span style="font-size: 0.85rem; color: var(--text-muted);">
                <i class="fas fa-user-shield me-1"></i> Administrator
            </span>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="admin-main-content">
        <!-- Welcome Card -->
        <div class="dashboard-welcome animate-fadein">
            <div class="dashboard-welcome-text">
                <h3>Selamat Datang, Admin! 👋</h3>
                <p>Kelola website SMKN 1 Dlanggu dari panel ini. Anda dapat menambah, mengedit, dan menghapus data kegiatan sekolah.</p>
            </div>
            <div class="dashboard-welcome-icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="row g-4 mb-4">
            <div class="col-sm-6">
                <div class="dashboard-stat-card animate-fadein animate-fadein-1">
                    <div class="dashboard-stat-icon" style="background: linear-gradient(135deg, var(--primary), var(--accent));">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="dashboard-stat-info">
                        <div class="dashboard-stat-number"><?= $countKegiatan ?></div>
                        <div class="dashboard-stat-label">Total Kegiatan</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="dashboard-stat-card animate-fadein animate-fadein-2">
                    <div class="dashboard-stat-icon" style="background: linear-gradient(135deg, #059669, #10b981);">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="dashboard-stat-info">
                        <?php
                        $countGambar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kegiatan WHERE gambar != 'default.png'"))['total'];
                        ?>
                        <div class="dashboard-stat-number"><?= $countGambar ?></div>
                        <div class="dashboard-stat-label">Dengan Gambar</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="admin-card animate-fadein">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-clock"></i> Kegiatan Terbaru</h5>
                        <a href="admin.php" style="font-size: 0.85rem; color: var(--primary); font-weight: 500;">
                            Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body-custom p-0">
                        <?php if (mysqli_num_rows($latestKegiatan) > 0): ?>
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($latestKegiatan)): ?>
                                    <tr>
                                        <td>
                                            <?php if ($row['gambar'] != 'default.png'): ?>
                                                <img src="uploads/<?= $row['gambar'] ?>" class="img-thumbnail-custom" alt="Gambar">
                                            <?php else: ?>
                                                <div style="width: 60px; height: 45px; background: var(--primary-lightest); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-image" style="color: var(--primary-lighter);"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong><?= htmlspecialchars($row['judul']) ?></strong></td>
                                        <td>
                                            <span style="font-size: 0.85rem;">
                                                <?= date('d M Y', strtotime($row['tanggal'])) ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-inbox d-block"></i>
                            <h5>Belum Ada Data</h5>
                            <p>Mulai tambahkan kegiatan sekolah.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSidebar() {
    document.getElementById('adminSidebar').classList.toggle('sidebar-open');
    document.getElementById('sidebarOverlay').classList.toggle('active');
}

// Auto-hide alerts
setTimeout(() => {
    document.querySelectorAll('.alert-custom').forEach(el => {
        el.style.transition = 'opacity 0.5s ease';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    });
}, 4000);
</script>
</body>
</html>
