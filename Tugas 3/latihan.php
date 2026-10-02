<?php
// fungsi dengan parameter $uts,$uas,$tugas
function hitungNilaiAkhir($uts, $uas, $tugas)
{
    $nilaiAkhir = ($uts * 0.4) + ($uas * 0.4) + ($tugas * 0.2);
    //mengembalikan nilai akhir
    return $nilaiAkhir;
}

//contoh pengujian
$nilaiuts = 90;
$nilaiuas = 93;
$nilaitugas = 97;

$hasil = hitungNilaiAkhir($nilaiuts, $nilaiuas, $nilaitugas);
//menampilkan hasil
echo "Nilai Akhir Ferdi adalah : " . round($hasil, 2) . "\n";
