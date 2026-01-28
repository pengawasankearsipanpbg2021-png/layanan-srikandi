<?php
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $opd = $_POST['opd'];
    $pesan = $_POST['pesan'];
    $wa_admin = "628123456789"; // Ganti dengan nomor WhatsApp Anda

    $text = "Halo Admin SRIKANDI%0A%0A" .
            "Ada Keluhan Baru:%0A" .
            "Nama: $nama%0A" .
            "Unit: $opd%0A" .
            "Kendala: $pesan";

    header("Location: https://wa.me/$wa_admin?text=$text");
}
?>

<div class="container">
    <h2>Formulir Pengaduan</h2>
    <form method="POST">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>
        
        <label>Unit Kerja / OPD</label>
        <input type="text" name="opd" required>
        
        <label>Detail Kendala</label>
        <textarea name="pesan" rows="5" required></textarea>
        
        <button type="submit" name="submit" class="btn">Kirim via WhatsApp</button>
    </form>
</div>