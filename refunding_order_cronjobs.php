<?php
date_default_timezone_set('Asia/Jakarta');
$db['host'] = "localhost"; //host
$db['user'] = "root"; //username database
$db['pass'] = ""; //password database
$db['name'] = "tajalapak"; //nama database
$koneksi = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);

// Cron Jobs Order Batal setelah 1 x 24
$cek_order = mysqli_query($koneksi,"SELECT b.id_penjualan_otomatis, a.id_penjualan, a.id_pembeli, a.kode_transaksi, b.nominal, b.waktu_proses, SUBSTRING_INDEX(TIMEDIFF(NOW(), b.waktu_proses), ':', 1) as selisih FROM `rb_penjualan` a JOIN rb_penjualan_otomatis b ON a.kode_transaksi=b.kode_transaksi where a.proses='1' AND b.pembayaran='1'");
while($row = mysqli_fetch_array($cek_order)){
    if ((int)$row['selisih']>='24'){
        mysqli_query($koneksi,"UPDATE rb_penjualan set proses='x' where id_penjualan='$row[id_penjualan]'");
    }
}

// Cron Jobs Cek Paket
$cek_paket_aktif = mysqli_query($koneksi,"SELECT * FROM `rb_reseller_paket` where status='Y' AND expire_date<now()");
while($row = mysqli_fetch_array($cek_paket_aktif)){
    mysqli_query($koneksi,"DELETE FROM rb_reseller_paket where id_reseller_paket='$row[id_reseller_paket]'");
}

// transaksi_penjualan ke Reseller
// $transaksi_penjualan = mysqli_query($koneksi,"SELECT * FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan where b.status_penjual='admin' AND service!='Stok Otomatis (Pribadi)'");

// transaksi_penjualan ke Konsumen
// $transaksi_penjualan = mysqli_query($koneksi,"SELECT * FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan where b.status_penjual='reseller'");

// while($row = mysqli_fetch_array($transaksi_penjualan)){
//     mysqli_query($koneksi,"DELETE FROM rb_penjualan_detail where id_penjualan='$row[id_penjualan]'");
//     mysqli_query($koneksi,"DELETE FROM rb_penjualan where id_penjualan='$row[id_penjualan]'");
// }
