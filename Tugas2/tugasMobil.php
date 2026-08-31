<?php

class Mobil
{
    // 1. Properti
    public $merek;
    public $warna;
    public $kecepatan;

    // 2. Constructor untuk inisialisasi properti
    public function __construct($merek, $warna, $kecepatan)
    {
        $this->merek = $merek;
        $this->warna = $warna;
        $this->kecepatan = $kecepatan;
    }

    // 3. Method getInfo()
    public function getInfo()
    {
        echo "Mobil {$this->merek} | Warna: {$this->warna} | Kecepatan Maks: {$this->kecepatan} km/jam\n";
    }

    // 4. Method jalankan()
    public function jalankan()
    {
        echo "Mobil {$this->merek} berjalan...\n";
    }

    // 5. Method berhenti()
    public function berhenti()
    {
        echo "Mobil {$this->merek} berhenti.\n";
    }
}

// Inisialisasi 3 Objek Berbeda
$mobil1 = new Mobil("Toyota GR Yaris", "Putih", 230);
$mobil2 = new Mobil("Honda Civic Type R", "Hitam", 272);
$mobil3 = new Mobil("Mazda 3", "Merah", 210);

// Uji Coba Objek 1
$mobil1->getInfo();
$mobil1->jalankan();
$mobil1->berhenti();
echo "\n";

// Uji Coba Objek 2
$mobil2->getInfo();
$mobil2->jalankan();
$mobil2->berhenti();
echo "\n";

// Uji Coba Objek 3
$mobil3->getInfo();
$mobil3->jalankan();
$mobil3->berhenti();
