<?php

class Mobil
{
    // 1. Properti Private
    private $merek;
    private $warna;
    private $kecepatan;

    // 2. Constructor
    public function __construct($merek, $warna, $kecepatan)
    {
        $this->merek = $merek;
        $this->setWarna($warna);           
        $this->setKecepatan($kecepatan);   
    }

    // 3. Method Getter (untuk mengambil nilai properti private)
    public function getMerek()
    {
        return $this->merek;
    }

    public function getWarna()
    {
        return $this->warna;
    }

    public function getKecepatan()
    {
        return $this->kecepatan;
    }

    // 4. Method Setter Warna (dengan validasi)
    public function setWarna($warna)
    {
        if (empty(trim($warna))) {
            echo "Error: Warna tidak boleh kosong!\n";
        } elseif (strlen($warna) < 3) {
            echo "Error: Warna minimal harus 3 karakter!\n";
        } else {
            $this->warna = $warna;
        }
    }

    // 5. Method Setter Kecepatan (dengan validasi)
    public function setKecepatan($kecepatan)
    {
        if ($kecepatan < 0) {
            echo "Error: Kecepatan tidak boleh negatif!\n";
        } elseif ($kecepatan > 200) {
            echo "Error: Kecepatan maksimal adalah 200 km/jam! (Kecepatan {$kecepatan} dibatasi ke 200)\n";
            $this->kecepatan = 200; 
        } else {
            $this->kecepatan = $kecepatan;
        }
    }

    // 6. Method getInfo()
    public function getInfo()
    {
        echo "Mobil {$this->getMerek()} | Warna: {$this->getWarna()} | Kecepatan Maks: {$this->getKecepatan()} km/jam\n";
    }

    // Method Pendukung
    public function jalankan()
    {
        echo "Mobil {$this->getMerek()} berjalan...\n";
    }

    public function berhenti()
    {
        echo "Mobil {$this->merek} berhenti.\n";
    }
}

// === UJI COBA DAN PENGUJIAN VALIDASI ===

// Pengujian 1: Kecepatan > 200 (Yaris & Civic) akan otomatis dibatasi ke 200 km/jam sesuai aturan
$mobil1 = new Mobil("Toyota GR Yaris", "Putih", 230);
$mobil1->getInfo();
echo "\n";

// Pengujian 2: Mencoba mengubah warna & kecepatan dengan nilai yang valid dan invalid (Uji Validasi)
$mobil2 = new Mobil("Honda Civic Type R", "Hitam", 180);
$mobil2->getInfo();

echo "--- Pengujian Validasi Setter ---\n";
$mobil2->setWarna("Ke");           
$mobil2->setKecepatan(-50);      
$mobil2->setWarna("Biru");        
$mobil2->setKecepatan(190);       
$mobil2->getInfo();
