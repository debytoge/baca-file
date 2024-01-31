<?php
// Tentukan array path file yang akan dibaca
$path_file = array(
    '/home/user/domains/domain1.com/public_html/readme.txt',
    '/home/user/domains/domain2.co.uk/public_html/readme.txt'
);

// Buka file result.txt dalam mode tulis
$file_result = fopen('result.txt', 'w');

// Loop melalui setiap path file
foreach ($path_file as $path) {
   // Buka file dalam mode baca
   $file = fopen($path, 'r');

   // Baca isi file
   $isi_file = fread($file, filesize($path));

   // Tutup file
   fclose($file);

   // Tulis isi file ke dalam file result.txt
   fwrite($file_result, $isi_file);
}

// Tutup file result.txt
fclose($file_result);

// Tampilkan pesan sukses
echo 'Isi file berhasil disimpan ke dalam file result.txt.';
?>
