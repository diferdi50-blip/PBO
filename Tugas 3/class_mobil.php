<?php

class Mobil
{
    // Properti
    public $merek;
    public $warna;
    public $kecepatan;

    // Constructor
    public function __construct($merek, $warna, $kecepatan)
    {
        $this->merek = $merek;
        $this->warna = $warna;
        $this->kecepatan = $kecepatan;
    }

    // Method untuk menampilkan informasi mobil
    public function getInfo()
    {
        return "Mobil $this->merek berwarna $this->warna dengan kecepatan $this->kecepatan km/jam";
    }

    // Method menjalankan mobil
    public function jalankan()
    {
        return "Mobil berjalan...";
    }

    // Method menghentikan mobil
    public function berhenti()
    {
        return "Mobil berhenti";
    }
}


// Membuat objek pertama
$mobil1 = new Mobil("Toyota", "Merah", 100);

// Membuat objek kedua
$mobil2 = new Mobil("Honda", "Hitam", 120);

// Membuat objek ketiga
$mobil3 = new Mobil("Suzuki", "Putih", 90);


// Menampilkan informasi
echo $mobil1->getInfo();
echo "<br>";
echo $mobil1->jalankan();
echo "<br>";
echo $mobil1->berhenti();

echo "<br><br>";

echo $mobil2->getInfo();
echo "<br>";
echo $mobil2->jalankan();
echo "<br>";
echo $mobil2->berhenti();

echo "<br><br>";

echo $mobil3->getInfo();
echo "<br>";
echo $mobil3->jalankan();
echo "<br>";
echo $mobil3->berhenti();

?>