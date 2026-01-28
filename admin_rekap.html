<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
$file_helpdesk = "log_helpdesk.txt";
$file_ikm = "data_ikm.txt";
$pass_admin = "srikandi2026";
$folder_upload = "files/";

// 1. Logika Login
if (isset($_POST['login'])) {
    if ($_POST['pass'] === $pass_admin) { $_SESSION['admin'] = true; }
    else { $error = "Password salah!"; }
}
if (isset($_GET['logout'])) { session_destroy(); header("Location: admin_rekap.php"); exit; }

// 2. Logika Update Status
if (isset($_GET['update_status']) && isset($_SESSION['admin'])) {
    $lines = file($file_helpdesk);
    $idx = $_GET['update_status'];
    if (isset($lines[$idx])) {
        $cols = explode(" | ", trim($lines[$idx]));
        $cols[6] = $_GET['status']; 
        $lines[$idx] = implode(" | ", $cols) . "\n";
        file_put_contents($file_helpdesk, implode("", $lines));
    }
    header("Location: admin_rekap.php"); exit;
}

// 3. Logika Upload & Hapus File
if (isset($_SESSION['admin'])) {
    if (!is_dir($folder_upload)) mkdir($folder_upload, 0777, true);
    if (isset($_POST['upload_file'])) {
        $file_name = str_replace(" ", "_", basename($_FILES["file_pdf"]["name"]));
        if(strtolower(pathinfo($file_name, PATHINFO_EXTENSION)) == "pdf") {
            move_uploaded_file($_FILES["file_pdf"]["tmp_name"], $folder_upload . $file_name);
        }
    }
    if (isset($_GET['hapus_file'])) {
        if (file_exists($folder_upload . $_GET['hapus_file'])) unlink($folder_upload . $_GET['hapus_file']);
        header("Location: admin_rekap.php"); exit;
    }
}

// 4. Statistik & Filter
$tgl_mulai = $_POST['tgl_mulai'] ?? '';
$tgl_akhir = $_POST['tgl_akhir'] ?? '';
$instansi_counts = []; $total_skor = 0; $jumlah_responden = 0;
$data_ikm_filtered = [];

if (file_exists($file_ikm)) {
    foreach(file($file_ikm) as $line) {
        $d = explode(" | ", trim($line));
        if(count($d) < 6) continue;
        $tgl = date('Y-m-d', strtotime($d[0]));
        if (($tgl_mulai && $tgl < $tgl_mulai) || ($tgl_akhir && $tgl > $tgl_akhir)) continue;
        $data_ikm_filtered[] = $d;
        $instansi_counts[$d[2]] = ($instansi_counts[$d[2]] ?? 0) + 1;
        $total_skor += ($d[3] + $d[4]);
        $jumlah_responden++;
    }
}
$nilai_ikm = ($jumlah_responden > 0) ? round(($total_skor / ($jumlah_responden * 2)) * 25, 2) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Layanan SRIKANDI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background: #f4f7fa; font-size: 0.85rem; }
        .card { border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .print-only { display: none; }
        
        @media print {
            body { background: white; }
            .no-print, .nav-pills, .btn, .dropdown, .filter-box { display: none !important; }
            .card { box-shadow: none !important; border: 1px solid #eee !important; }
            .print-only { display: block !important; text-align: center; margin-bottom: 20px; }
            .table { width: 100% !important; border-collapse: collapse; }
            .table-responsive { overflow: visible !important; }
            /* Memaksa elemen cetak muncul meski di tab tersembunyi */
            .tab-pane { display: block !important; opacity: 1 !important; visibility: visible !important; }
            #printable-area { visibility: visible !important; }
        }
    </style>
</head>
<body class="p-2 p-md-4">

<div class="container-fluid">
    <?php if (!isset($_SESSION['admin'])): ?>
        <div class="card mx-auto p-4 shadow mt-5" style="max-width:350px;">
            <h5 class="text-center fw-bold text-primary mb-4">ADMIN LOGIN</h5>
            <form method="POST">
                <input type="password" name="pass" class="form-control mb-3 text-center" placeholder="Password" required autofocus>
                <button name="login" class="btn btn-primary w-100">MASUK</button>
            </form>
        </div>
    <?php else: ?>
        
        <div class="d-flex justify-content-between align-items-center mb-4 no-print">
            <h4 class="fw-bold text-primary mb-0"><i class="bi bi-shield-lock"></i> Admin Panel</h4>
            <a href="?logout=true" class="btn btn-danger btn-sm px-3">Logout</a>
        </div>

        <div class="row g-3 mb-4 no-print filter-box">
            <div class="col-12 col-lg-3">
                <div class="card p-3 h-100 shadow-sm border-start border-primary border-4">
                    <form method="POST">
                        <label class="small fw-bold mb-1">Filter Periode</label>
                        <input type="date" name="tgl_mulai" class="form-control form-control-sm mb-1" value="<?= $tgl_mulai ?>">
                        <input type="date" name="tgl_akhir" class="form-control form-control-sm mb-2" value="<?= $tgl_akhir ?>">
                        <button type="submit" class="btn btn-primary btn-sm w-100">Terapkan</button>
                    </form>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card p-3 h-100 shadow-sm text-center">
                    <p class="text-muted small mb-1">Nilai Survei Kepuasan Srikandi</p>
                    <h2 class="fw-bold text-primary mb-0"><?= $nilai_ikm ?></h2>
                    <small class="text-muted"><?= $jumlah_responden ?> Responden</small>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card p-3 h-100 shadow-sm">
                    <h6 class="fw-bold small mb-2">Responden Per Instansi</h6>
                    <div style="height: 120px;"><canvas id="chartInstansi"></canvas></div>
                </div>
            </div>
        </div>

        <ul class="nav nav-pills mb-3 gap-2 no-print" id="pills-tab">
            <li class="nav-item"><button class="nav-link active btn-sm fw-bold" data-bs-toggle="pill" data-bs-target="#h">Helpdesk</button></li>
            <li class="nav-item"><button class="nav-link btn-sm fw-bold" data-bs-toggle="pill" data-bs-target="#i">Data Survei</button></li>
            <li class="nav-item"><button class="nav-link btn-sm fw-bold btn-warning text-dark" data-bs-toggle="pill" data-bs-target="#u">Manual Book</button></li>
        </ul>

        <div class="tab-content">
            <div id="h" class="tab-pane fade show active">
                <div class="d-flex justify-content-between align-items-center mb-2 no-print">
                    <h6 class="fw-bold mb-0">Antrean Helpdesk</h6>
                    <button onclick="printDiv('print-h', 'Laporan Helpdesk')" class="btn btn-success btn-sm"><i class="bi bi-file-pdf"></i> Export Helpdesk</button>
                </div>
                <div class="card shadow-sm" id="print-h">
                    <div class="print-only">
                        <h3>LAPORAN ANTREAN HELPDESK SRIKANDI</h3>
                        <p>Periode: <?= $tgl_mulai ?: 'Awal' ?> s/d <?= $tgl_akhir ?: 'Sekarang' ?></p>
                        <hr>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 small">
                            <thead class="table-primary">
                                <tr><th>Waktu</th><th>Pelapor</th><th>Kategori</th><th>Masalah</th><th>Status</th><th class="no-print text-center">Aksi</th></tr>
                            </thead>
                            <tbody>
                                <?php if(file_exists($file_helpdesk)): 
                                    foreach(array_reverse(file($file_helpdesk), true) as $idx => $line): 
                                    $c = explode(" | ", trim($line)); if(count($c) < 7) continue;
                                    $tgl_d = date('Y-m-d', strtotime($c[0]));
                                    if(($tgl_mulai && $tgl_d < $tgl_mulai) || ($tgl_akhir && $tgl_d > $tgl_akhir)) continue;
                                ?>
                                <tr>
                                    <td><?= date('d/m/y H:i', strtotime($c[0])) ?></td>
                                    <td><strong><?= $c[1] ?></strong><br><small class="text-muted"><?= $c[2] ?></small></td>
                                    <td><?= $c[4] ?></td>
                                    <td><div style="max-width:200px;"><?= $c[5] ?></div></td>
                                    <td><span class="badge bg-<?= ($c[6]=='Selesai'?'success':'warning text-dark') ?>"><?= $c[6] ?></span></td>
                                    <td class="no-print text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm border dropdown-toggle" data-bs-toggle="dropdown">Opsi</button>
                                            <ul class="dropdown-menu shadow border-0">
                                                <li><a class="dropdown-item py-2" href="?update_status=<?= $idx ?>&status=Proses">Set Proses</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item fw-bold text-success py-2" href="javascript:void(0)" onclick="kirimWA('<?= $idx ?>', '<?= addslashes($c[1]) ?>', '<?= $c[3] ?>')"><i class="bi bi-whatsapp"></i> Selesai & WA</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="i" class="tab-pane fade">
                <div class="d-flex justify-content-between align-items-center mb-2 no-print">
                    <h6 class="fw-bold mb-0">Hasil Survei Layanan Srikandi</h6>
                    <button onclick="printDiv('print-i', 'Laporan IKM')" class="btn btn-info btn-sm text-white"><i class="bi bi-file-pdf"></i> Export IKM</button>
                </div>
                <div class="card shadow-sm p-2" id="print-i">
                    <div class="print-only">
                        <h3>LAPORAN Layanan Survei Srikandi</h3>
                        <p>Periode: <?= $tgl_mulai ?: 'Awal' ?> s/d <?= $tgl_akhir ?: 'Sekarang' ?></p>
                        <hr>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle mb-0 small">
                            <thead class="table-dark text-center">
                                <tr><th>Tanggal</th><th>Nama / OPD</th><th>Q1</th><th>Q2</th><th>Saran</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach(array_reverse($data_ikm_filtered) as $ci): ?>
                                <tr>
                                    <td><?= date('d/m/y', strtotime($ci[0])) ?></td>
                                    <td><strong><?= $ci[1] ?></strong><br><?= $ci[2] ?></td>
                                    <td class="text-center"><?= $ci[3] ?></td><td class="text-center"><?= $ci[4] ?></td>
                                    <td><small><?= $ci[5] ?></small></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="u" class="tab-pane fade no-print">
                <div class="card p-4 shadow-sm">
                    <h6 class="fw-bold mb-3">Upload Manual Book Baru</h6>
                    <form method="POST" enctype="multipart/form-data" class="row g-2 mb-4">
                        <div class="col-9"><input type="file" name="file_pdf" class="form-control form-control-sm" accept=".pdf" required></div>
                        <div class="col-3"><button type="submit" name="upload_file" class="btn btn-primary btn-sm w-100">Upload</button></div>
                    </form>
                    <table class="table table-sm small">
                        <thead><tr><th>Nama File</th><th>Ukuran</th><th class="text-center">Aksi</th></tr></thead>
                        <tbody>
                            <?php 
                            $files = is_dir($folder_upload) ? array_diff(scandir($folder_upload), array('.', '..')) : [];
                            foreach($files as $f): ?>
                            <tr>
                                <td><?= str_replace("_", " ", $f) ?></td>
                                <td><?= round(filesize($folder_upload.$f)/1024, 1) ?> KB</td>
                                <td class="text-center"><a href="?hapus_file=<?= $f ?>" class="text-danger" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Fungsi Print Terpisah
function printDiv(divId, title) {
    let originalTitle = document.title;
    document.title = title + " - " + new Date().toLocaleDateString();
    
    // Sembunyikan semua elemen kecuali area yang dipilih
    let content = document.getElementById(divId);
    let originalContent = document.body.innerHTML;
    
    document.body.innerHTML = content.outerHTML;
    window.print();
    
    // Kembalikan ke tampilan semula
    location.reload(); 
}

// Fungsi WhatsApp Otomatis
function kirimWA(id, nama, wa) {
    let no_wa = wa.trim();
    if (no_wa.startsWith('0')) { no_wa = '62' + no_wa.substring(1); }
    let pesan = "Halo *" + nama + "*,\n\nLaporan Kendala SRIKANDI Yang Anda Alami telah dinyatakan *SELESAI*.\n\nSilahkan Coba Kembali.";
    window.open("https://wa.me/" + no_wa + "?text=" + encodeURIComponent(pesan), '_blank');
    setTimeout(() => { window.location.href = "?update_status=" + id + "&status=Selesai"; }, 500);
}

// Chart Instansi
const ctx = document.getElementById('chartInstansi');
if(ctx) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($instansi_counts)) ?>,
            datasets: [{
                label: 'Responden',
                data: <?= json_encode(array_values($instansi_counts)) ?>,
                backgroundColor: 'rgba(13, 110, 253, 0.7)',
                borderRadius: 5
            }]
        },
        options: { 
            responsive: true, maintainAspectRatio: false, indexAxis: 'y',
            plugins: { legend: { display: false } },
            scales: { x: { beginAtZero: true, ticks: { font: {size: 9} } }, y: { ticks: { font: {size: 9} } } }
        }
    });
}
</script>
</body>
</html>