<?php
abstract class ProdukMainan
{
    protected $id;
    protected $nama;
    protected $hargaDasar;

    public function __construct($id, $nama, $hargaDasar)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->hargaDasar = $hargaDasar;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getHargaDasar()
    {
        return $this->hargaDasar;
    }

    abstract public function hitungTotal();
    abstract public function getJenis();
}

// Boneka
class Boneka extends ProdukMainan
{
    private $tinggiCm;

    public function __construct($id, $nama, $hargaDasar, $tinggiCm)
    {
        parent::__construct($id, $nama, $hargaDasar);
        $this->tinggiCm = $tinggiCm;
    }

    public function hitungTotal()
    {
        return $this->hargaDasar + (2000 * $this->tinggiCm);
    }

    public function getJenis()
    {
        return "Boneka";
    }

    public function cetakDetail()
    {
        return "Tinggi: " . $this->tinggiCm . " cm";
    }
}

// Lego
class Lego extends ProdukMainan
{
    private $keping;

    public function __construct($id, $nama, $hargaDasar, $keping)
    {
        parent::__construct($id, $nama, $hargaDasar);
        $this->keping = $keping;
    }

    public function hitungTotal()
    {
        return $this->hargaDasar + (200 * $this->keping);
    }

    public function getJenis()
    {
        return "Lego";
    }

    public function cetakDetail()
    {
        return "Keping: " . $this->keping;
    }
}

// Mobil Mainan
class MobilMainan extends ProdukMainan
{
    private $skala;

    public function __construct($id, $nama, $hargaDasar, $skala)
    {
        parent::__construct($id, $nama, $hargaDasar);
        $this->skala = $skala;
    }

    public function hitungTotal()
    {
        $total = $this->hargaDasar * $this->skala;

        // Digit akhir NIM = 9
        if ($this->skala > 9) {
            $total = $total * 0.9;
        }

        return $total;
    }

    public function getJenis()
    {
        return "Mobil Mainan";
    }

    public function cetakDetail()
    {
        return "Skala: " . $this->skala;
    }
}

// 5 objek
$produk = [
    new Boneka("P01", "Iren", 50000, 30),
    new Lego("P02", "Ferdi", 70000, 100),
    new MobilMainan("P03", "Grey", 100000, 10),
    new Boneka("P04", "Wilham", 60000, 40),
    new Lego("P05", "Eric", 80000, 150)
];

$totalSemua = 0;

// Tampilan tabel
echo "<h3>Daftar Produk Mainan</h3>";

echo "<table border='1' cellpadding='5'>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>ID</th>";
echo "<th>Nama</th>";
echo "<th>Jenis</th>";
echo "<th>Harga Dasar</th>";
echo "<th>Total</th>";
echo "</tr>";

for ($i = 0; $i < 5; $i++)
{
    $total = $produk[$i]->hitungTotal();
    $totalSemua = $totalSemua + $total;

    echo "<tr>";
    echo "<td>" . ($i + 1) . "</td>";
    echo "<td>" . $produk[$i]->getId() . "</td>";
    echo "<td>" . $produk[$i]->getNama() . "</td>";
    echo "<td>" . $produk[$i]->getJenis() . "</td>";
    echo "<td>Rp" . $produk[$i]->getHargaDasar() . "</td>";
    echo "<td>Rp" . $total . "</td>";
    echo "</tr>";
}

echo "<tr>";
echo "<td colspan='5'><b>Total Keseluruhan</b></td>";
echo "<td><b>Rp" . $totalSemua . "</b></td>";
echo "</tr>";

echo "</table>";

echo "<h3>Detail Produk</h3>";

for ($i = 0; $i < 5; $i++)
{
    echo $produk[$i]->getNama() . " - ";
    echo $produk[$i]->getJenis() . " - ";
    echo $produk[$i]->cetakDetail() . "<br>";
}

?>