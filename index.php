<?php
// 1. SETTING WAKTU & STATUS ADMIN
date_default_timezone_set('Asia/Jakarta'); 
$jam_sekarang = (int)date('H');
$hari_sekarang = (int)date('N'); 
$tanggal_input = date("Y-m-d H:i:s");

// Jam Kerja: Senin-Jumat, 08:00 - 16:00
if ($hari_sekarang <= 5 && $jam_sekarang >= 8 && $jam_sekarang < 16) {
    $status_admin = "Online";
    $status_color = "success";
    $pesan_status = "Admin sedang bertugas. Respon akan lebih cepat.";
} else {
    $status_admin = "Offline";
    $status_color = "danger";
    $pesan_status = "Di luar jam kerja. Laporan akan diproses pada hari kerja berikutnya.";
}

// 2. LOGIKA HELPDESK (Simpan ke File & Redirect ke WA)
if (isset($_POST['kirim_wa'])) {
    $nama = $_POST['nama'];
    $opd = $_POST['opd'];
    $wa_pelapor = $_POST['wa_pelapor']; // AMBIL NOMOR WA PELAPOR
    $kategori = $_POST['kategori'];
    $pesan = $_POST['pesan'];
    $status_awal = "Proses";
    $wa_admin = "6282334779494"; // GANTI NOMOR ADMIN ANDA DISINI

    // Simpan ke log (Urutan: Waktu | Nama | OPD | WA Pelapor | Kategori | Kendala | Status)
    $data_log = "$tanggal_input | $nama | $opd | $wa_pelapor | $kategori | $pesan | $status_awal\n";
    file_put_contents("log_helpdesk.txt", $data_log, FILE_APPEND);

    // Redirect ke WhatsApp Admin (Menyertakan link chat balik ke pelapor)
    $text_wa = urlencode("Halo Admin SRIKANDI,\n\nAda Kendala Baru:\nNama: $nama\nUnit Kerja: $opd\nNo. WA Pelapor: $wa_pelapor\nKategori: $kategori\nKendala: $pesan\n\nKlik untuk balas: https://wa.me/$wa_pelapor");
    header("Location: https://wa.me/$wa_admin?text=$text_wa");
    exit;
}

// 3. LOGIKA SIMPAN IKM
if (isset($_POST['submit_ikm'])) {
    $nama_ikm = $_POST['nama_ikm'];
    $instansi_ikm = $_POST['instansi_ikm'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $saran = str_replace("\n", " ", $_POST['saran']);
    
    // Format: Waktu | Nama | Instansi | Q1 | Q2 | Saran
    $data_ikm = "$tanggal_input | $nama_ikm | $instansi_ikm | $q1 | $q2 | $saran\n";
    file_put_contents("data_ikm.txt", $data_ikm, FILE_APPEND);

    echo "<script>alert('Terima kasih! Penilaian IKM telah disimpan.'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Layanan Aplikasi Srikandi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .hero-section { background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: white; padding: 50px 0; border-bottom-left-radius: 50px; border-bottom-right-radius: 50px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-wa { background-color: #25d366; color: white; transition: 0.3s; }
        .btn-wa:hover { background-color: #128c7e; color: white; transform: translateY(-2px); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="bi bi-archive-fill me-2 text-primary"></i>LAYANAN SRIKANDI V.1 </a>
    </div>
</nav>

<header class="hero-section text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Pusat Layanan SRIKANDI</h1>
        <p class="lead opacity-75">Bantuan teknis dan panduan pengelolaan arsip digital terintegrasi.</p>
        
        <div class="d-inline-block p-3 rounded-4 bg-white shadow-sm mt-3">
            <span class="badge bg-<?php echo $status_color; ?> rounded-circle p-2"> </span>
            <span class="text-dark fw-bold ms-2">Admin Status: <?php echo $status_admin; ?></span>
            <div class="small text-muted px-2"><?php echo $pesan_status; ?></div>
        </div>
    </div>
</header>

<div class="container my-5">
    <div class="row g-4">
        
        <div class="col-md-7">
            <div class="card p-4 h-100 border-top border-primary border-5">
                <h4 class="mb-4 fw-bold text-primary"><i class="bi bi-headset me-2"></i>Kirim Pengaduan</h4>
                <form method="POST">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Unit Kerja / OPD</label>
                            <input type="text" name="opd" class="form-control" placeholder="Nama OPD" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Nomor WhatsApp Pelapor</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                                <input type="number" name="wa_pelapor" class="form-control" placeholder="Contoh: 08123456789" required>
                            </div>
                            <small class="text-muted" style="font-size: 0.7rem;">Gunakan format angka tanpa spasi (Misal: 0812xx)</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kategori Masalah</label>
                        <select name="kategori" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <option value="Lupa Password">Lupa Password / Login</option>
                            <option value="Kendala TTE">Kendala TTE / E-Sign</option>
                            <option value="Registrasi Surat">Registrasi Surat</option>
                            <option value="Penyusutan Arsip">Penyusutan Arsip</option>
                            <option value="Error Sistem">Error Sistem / Bug</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Detail Kendala</label>
                        <textarea name="pesan" class="form-control" rows="4" placeholder="Jelaskan masalah secara detail..." required></textarea>
                    </div>
                    <button type="submit" name="kirim_wa" class="btn btn-wa w-100 fw-bold py-3 shadow-sm">
                        <i class="bi bi-whatsapp me-2"></i>Kirim Aduan via WhatsApp
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card p-4 shadow-sm border-0 h-100">
                <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-cloud-download"></i> Pusat Unduhan</h5>
                <p class="text-muted small">Unduh panduan penggunaan aplikasi SRIKANDI:</p>
                <div class="row g-2">
                    <?php 
                    $dir = "files/";
                    if (is_dir($dir)):
                        $files = array_diff(scandir($dir), array('.', '..'));
                        foreach($files as $file): ?>
                            <div class="col-12">
                                <div class="card p-2 shadow-sm border-0 bg-light">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-3 me-3"></i>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h6 class="mb-0 small fw-bold text-truncate"><?= str_replace("_", " ", $file) ?></h6>
                                            <a href="<?= $dir.$file ?>" class="small text-decoration-none" download>Unduh PDF</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card p-4 bg-dark text-white border-0 shadow-lg">
                <h4 class="text-center mb-4 text-primary">Survei Kepuasan Layanan Srikandi</h4>
                <form method="POST">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small">Nama Lengkap</label>
                            <input type="text" name="nama_ikm" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Instansi/OPD</label>
                            <input type="text" name="instansi_ikm" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    
                    <div class="row text-center mb-4">
                        <div class="col-md-6">
                            <p class="small mb-2">1. Kemudahan Layanan Aplikasi Srikandi?</p>
                            <div class="d-flex justify-content-center gap-2">
                                <?php for($i=1;$i<=4;$i++): ?>
                                    <input class="btn-check" type="radio" name="q1" id="q1_<?php echo $i; ?>" value="<?php echo $i; ?>" required>
                                    <label class="btn btn-outline-primary btn-sm" for="q1_<?php echo $i; ?>"><?php echo $i; ?></label>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="small mb-2">2. Kecepatan Respon Admin Srikandi?</p>
                            <div class="d-flex justify-content-center gap-2">
                                <?php for($i=1;$i<=4;$i++): ?>
                                    <input class="btn-check" type="radio" name="q2" id="q2_<?php echo $i; ?>" value="<?php echo $i; ?>" required>
                                    <label class="btn btn-outline-primary btn-sm" for="q2_<?php echo $i; ?>"><?php echo $i; ?></label>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>

                    <textarea name="saran" class="form-control form-control-sm mb-3" placeholder="Saran & Masukan..."></textarea>
                    <button type="submit" name="submit_ikm" class="btn btn-primary w-100 fw-bold">Kirim Penilaian</button>
                </form>
            </div>
        </div>

    </div>
</div>

<footer class="text-center py-4 text-muted border-top bg-white">
    <p class="mb-0">&copy; 2026 Pengelola SRIKANDI Kab Purbalingga.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>