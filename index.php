<?php
echo "Hello, World!
gw Ferdi";
?>
<?php
class persegi_panjang
{
    public $panjang;
    public $lebar;

    public function luas_persegi_panjang()
    {
        return $this->panjang * $this->lebar;
    }
}
$perhitungan = new persegi_panjang();
$perhitungan->panjang = 10;
$perhitungan->lebar = 90;
