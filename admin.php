<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Logika Hapus Data
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $getData = mysqli_query($conn, "SELECT gambar FROM kegiatan WHERE id='$id'");
    $rowData = mysqli_fetch_assoc($getData);
    if ($rowData && $rowData['gambar'] != 'default.png' && file_exists("uploads/" . $rowData['gambar'])) {
        unlink("uploads/" . $rowData['gambar']);
    }
    mysqli_query($conn, "DELETE FROM kegiatan WHERE id='$id'");
    header("Location: admin.php?pesan=hapus");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kegiatan - Admin SMKN 1 Dlanggu</title>
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
        <a href="admin_dashboard.php" class="sidebar-link">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
        </a>
        <a href="admin.php" class="sidebar-link active">
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
            <h5 class="mb-0 fw-bold" style="color: var(--text-dark);">Data Kegiatan</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="admin_create.php" class="btn btn-purple btn-sm">
                <i class="fas fa-plus-circle me-1"></i> Tambah Baru
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-main-content">
        <!-- Alert Messages -->
        <?php if (isset($_GET['pesan'])): ?>
            <?php if ($_GET['pesan'] == 'tambah'): ?>
            <div class="alert alert-custom alert-success-custom mb-3 animate-fadein">
                <i class="fas fa-check-circle"></i> Data kegiatan berhasil ditambahkan!
            </div>
            <?php elseif ($_GET['pesan'] == 'edit'): ?>
            <div class="alert alert-custom alert-success-custom mb-3 animate-fadein">
                <i class="fas fa-check-circle"></i> Data kegiatan berhasil diperbarui!
            </div>
            <?php elseif ($_GET['pesan'] == 'hapus'): ?>
            <div class="alert alert-custom alert-success-custom mb-3 animate-fadein">
                <i class="fas fa-check-circle"></i> Data kegiatan berhasil dihapus!
            </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- DATA TABLE -->
        <div class="admin-card">
            <div class="card-header-custom">
                <h5><i class="fas fa-list"></i> Daftar Kegiatan</h5>
                <?php 
                $countQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM kegiatan");
                $totalData = mysqli_fetch_assoc($countQuery)['total'];
                ?>
                <span class="badge" style="background: var(--primary); font-size: 0.8rem; padding: 6px 14px; border-radius: 50px;">
                    <?= $totalData ?> Data
                </span>
            </div>
            <div class="card-body-custom p-0">
                <?php
                $data = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY id DESC");
                if (mysqli_num_rows($data) > 0):
                ?>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
                            <tr>
                                <td class="text-center fw-bold"><?= $no++ ?></td>
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
                                    <span style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 0.85rem; color: var(--text-muted);">
                                        <?= htmlspecialchars($row['deskripsi']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span style="font-size: 0.85rem;">
                                        <i class="fas fa-calendar-alt me-1" style="color: var(--primary-light);"></i>
                                        <?= date('d M Y', strtotime($row['tanggal'])) ?>
                                    </span>
                                    <br>
                                    <span style="font-size: 0.75rem; color: var(--text-light);">
                                        <?= date('H:i', strtotime($row['tanggal'])) ?> WIB
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="admin_edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <a href="admin.php?hapus=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </a>
                                    </div>
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
                    <p>Tidak ada data kegiatan. Klik tombol "Tambah Baru" untuk menambahkan data.</p>
                    <a href="admin_create.php" class="btn btn-purple mt-3">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Sekarang
                    </a>
                </div>
                <?php endif; ?>
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