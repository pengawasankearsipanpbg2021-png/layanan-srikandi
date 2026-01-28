<?php
if(isset($_POST['kirim_wa'])){
    $nama = urlencode($_POST['nama']);
    $opd = urlencode($_POST['opd']);
    $pesan = urlencode($_POST['pesan']);
    
    // Ganti nomor di bawah dengan nomor WhatsApp admin (awali dengan 62)
    $wa_number = "628123456789"; 

    $text = "Halo *Admin SRIKANDI*,%0A"
          . "Ada laporan kendala baru:%0A%0A"
          . "*Nama:* $nama%0A"
          . "*Unit Kerja:* $opd%0A"
          . "*Kendala:* $pesan%0A%0A"
          . "Mohon bantuannya segera. Terima kasih.";

    header("Location: https://wa.me/$wa_number?text=$text");
    exit;
}
?>