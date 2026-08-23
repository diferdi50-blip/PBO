<?php

class PersegiPanjang
{
    public $panjang;
    public $lebar;

    public function __construct($panjang, $lebar)
    {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }

    public function hitungLuas()
    {
        return $this->panjang * $this->lebar;
    }
}

$persegiPanjang = new PersegiPanjang(10, 5);

echo "Panjang: " . $persegiPanjang->panjang . " cm<br>";
echo "Lebar: " . $persegiPanjang->lebar . " cm<br>";
echo "Luas persegi panjang: " . $persegiPanjang->hitungLuas() . " cm²";

?>