<?php

class Product {
    // 1. Properti (nama, harga, kategori)
    public $nama;
    public $harga;
    public $kategori;

    // 2. Constructor
    public function __construct($nama, $harga, $kategori) {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->kategori = $kategori;
    }

    // 3. Method getInfo()
    public function getInfo() {
        echo "Produk  : {$this->nama}\n";
        echo "Kategori: {$this->kategori}\n";
        echo "Harga   : Rp " . number_format($this->harga, 0, ',', '.') . "\n";
        echo "----------------------------------------\n";
    }

    // 4. Method applyDiskon($persen) - mengubah harga setelah diskon
    public function applyDiskon($persen) {
        $potongan = $this->harga * ($persen / 100);
        $this->harga -= $potongan;
        echo "[Diskon {$persen}% diterapkan pada {$this->nama}]\n";
    }
}

// Buat 2 Objek Product
$produk1 = new Product("Laptop Asus ROG", 18500000, "Elektronik");
$produk2 = new Product("Keyboard Mekanikal", 850000, "Aksesoris Komputer");

// Tampilkan Informasi Awal
echo "=== INFORMASI PRODUK SEBELUM DISKON ===\n";
$produk1->getInfo();
$produk2->getInfo();

// Terapkan Diskon
echo "\n=== PENERAPAN DISKON ===\n";
$produk1->applyDiskon(10); // Diskon 10%
$produk2->applyDiskon(20); // Diskon 20%

// Tampilkan Informasi Setelah Diskon
echo "\n=== INFORMASI PRODUK SETELAH DISKON ===\n";
$produk1->getInfo();
$produk2->getInfo();