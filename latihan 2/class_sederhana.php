<?php
// nama file : mahasiswa.php
class Mahasiswa {
    // properti
    public $nama;
    public $nim;
    public $jurusan;

    // contructor
    public function __construct($nama,$nim,$jurusan){
        $this->nama = $nama;
        $this->nim = $nim;
        $this->jurusan = $jurusan;
    }
    //method
    public function getInfo(){
        return "Nama : $this->nama, NIM : $this->nim, Jurusan : $this->jurusan"; 
    }
    public function setJurusan($jurusan){
        $this->jurusan = $jurusan;
    }
}
// instasi objek
$mhs1 = new Mahasiswa("Ferdi", "H1101251029", "Sistem Informasi");
$mhs2 = new Mahasiswa("Megan", "H1101251000", "DKV");

echo $mhs1->getInfo() . "<br>";
echo $mhs2->getInfo() . "<br>";

$mhs1->setJurusan("Manajemen Informatika");
echo $mhs1->getInfo() . "<br>";

?>