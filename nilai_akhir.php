<?php
function hitungNilaiAkhir($uts, $uas, $tugas): float {
    // Bobot: UTS 30%, UAS 40%, Tugas 30%
    $nilaiAkhir = (0.30 * $uts) + (0.40 * $uas) + (0.30 * $tugas);
    return (float) $nilaiAkhir;
}

// Contoh Pengujian
$uts = 80;
$uas = 85;
$tugas = 90;

$hasil = hitungNilaiAkhir($uts, $uas, $tugas);

echo "Nilai UTS   : " . $uts . "\n";
echo "Nilai UAS   : " . $uas . "\n";
echo "Nilai Tugas : " . $tugas . "\n";
echo "Nilai Akhir : " . $hasil . " (Tipe data: " . gettype($hasil) . ")\n";
?>