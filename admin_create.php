<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Logika Tambah Data
if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $tanggal = date('Y-m-d H:i:s');
    
    $gambar = "default.png";
    if (isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != "") {
        $gambar = time() . "_" . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $gambar);
    }

    $query = "INSERT INTO kegiatan (judul, deskripsi, gambar, tanggal) VALUES ('$judul', '$deskripsi', '$gambar', '$tanggal')";
    mysqli_query($conn, $query);
    header("Location: admin.php?pesan=tambah");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan - Admin SMKN 1 Dlanggu</title>
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
        <a href="admin.php" class="sidebar-link">
            <i class="fas fa-calendar-alt"></i> <span>Data Kegiatan</span>
        </a>
        <a href="admin_create.php" class="sidebar-link active">
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

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- MAIN CONTENT -->
<div class="admin-main" id="adminMain">
    <div class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h5 class="mb-0 fw-bold" style="color: var(--text-dark);">Tambah Kegiatan</h5>
        </div>
        <a href="admin.php" style="color: var(--primary); font-weight: 500; font-size: 0.9rem;">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="admin-main-content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="admin-card animate-fadein">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-plus-circle"></i> Tambah Kegiatan Baru</h5>
                    </div>
                    <div class="card-body-custom">
                        <form method="POST" enctype="multipart/form-data" class="admin-form">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-heading me-1" style="color: var(--primary);"></i> Judul Kegiatan</label>
                                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul kegiatan..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-align-left me-1" style="color: var(--primary);"></i> Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="5" placeholder="Masukkan deskripsi kegiatan..." required></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-image me-1" style="color: var(--primary);"></i> Upload Gambar</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*" id="imageInput">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Format: JPG, PNG, GIF. Maks: 2MB</small>
                                <div id="imagePreview" style="display: none; margin-top: 12px;">
                                    <img id="previewImg" src="" alt="Preview" style="max-width: 100%; max-height: 250px; border-radius: 12px; box-shadow: 0 4px 14px rgba(124, 58, 237, 0.12);">
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <button type="submit" name="tambah" class="btn btn-purple">
                                    <i class="fas fa-save me-2"></i>Simpan Data
                                </button>
                                <a href="admin.php" class="btn btn-purple-outline">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                        </form>
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

document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>
</body>
</html>
