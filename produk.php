<?php

class Product
{
    // Properti
    public $nama;
    public $harga;
    public $kategori;

    // Constructor
    public function __construct($nama, $harga, $kategori)
    {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->kategori = $kategori;
    }

    // Method untuk menampilkan informasi product
    public function getInfo()
    {
        return "Nama: $this->nama | Harga: Rp$this->harga | Kategori: $this->kategori";
    }

    // Method untuk memberikan diskon
    public function applyDiskon($persen)
    {
        $diskon = $this->harga * ($persen / 100);
        $this->harga = $this->harga - $diskon;
    }
}


// Membuat objek pertama
$product1 = new Product(
    "Laptop",
    8000000,
    "Elektronik"
);

// Membuat objek kedua
$product2 = new Product(
    "Headset",
    500000,
    "Aksesoris"
);


// Menampilkan informasi sebelum diskon
echo "<h3>Data Sebelum Diskon</h3>";

echo $product1->getInfo();
echo "<br>";

echo $product2->getInfo();


// Memberikan diskon
$product1->applyDiskon(10);
$product2->applyDiskon(20);


// Menampilkan informasi setelah diskon
echo "<h3>Data Setelah Diskon</h3>";

echo $product1->getInfo();
echo "<br>";

echo $product2->getInfo();

?>