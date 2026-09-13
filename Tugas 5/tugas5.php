<?php
// parent class
class Produk{
    protected $merek;
    protected $harga;

    public function __construct($merek, $harga){
        if ($harga < 0){
            throw new Exception(" Harga tidak boleh kurang dari 0");

        }
        $this->merek = $merek;
        $this->harga = $harga; 
    }
    public function getInfo(){
        echo "Produk : Produk <br>";
        echo "Produk : " . $this->merek . "<br>";
        echo "Harga : Rp " . number_format($this->harga, 0, ',', '.') . "<br>";
    }
}

// child class makanan
class Makanan extends Produk{
    private $tanggalKadaluarsa;

    public function __construct($merek, $harga, $tanggalKadaluarsa){
        parent::__construct($merek, $harga);
        $this->tanggalKadaluarsa = $tanggalKadaluarsa;
    }
    //method overriding
    public function getInfo(){
        echo "Produk : Makanan - Mie Instan <br>";
        echo "Merek : " . $this->merek . "<br>";
        echo "Harga : Rp " . number_format($this->harga, 0, ',', '.') . "<br>";
        echo "Tanggal Kadaluarsa : " . $this->tanggalKadaluarsa . "<br>";
        echo "Status : Bagus <br>";
    }
}
// child class elektronik
class Elektronik extends Produk{
    private $garansi;

    public function __construct($merek, $harga, $garansi){
        parent::__construct($merek,$harga);
        $this->garansi = $garansi;
    }
    //method overriding
    public function getInfo(){
        echo "Produk : Elektronik - Smart TV <br>";
        echo "Merek : " . $this->merek . "<br>";
        echo "Harga : Rp " . number_format($this->harga, 0, ',', '.') . "<br>";
        echo "Garansi : " . $this->garansi . " bulan<br>";
    }
}
// membuat objek makanan
$makanan = new Makanan(
    "Indomi Rendang",
    3500,
    "2026-12-06"
);
$makanan->getInfo();
echo "<br>";


// membuat objek elektronik
$elektronik = new Elektronik(
    "Samsung",
    12000000,
    12
);
$elektronik->getInfo();

?>
