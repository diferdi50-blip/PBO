<?php
require_once '../Catatan.php';
$c = new Catatan();
$hasil = $c->setJudul("Keempat")
    ->setIsi("Database Penjualan")
    ->save();
echo $hasil ? "Berhasil disimpan" : "Gagal";
