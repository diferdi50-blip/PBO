<?php
function hitungluaspersegi($panjang, $lebar){
    return $panjang * $lebar;
}
$panjang = 14;
$lebar = 9;
$luas = hitungluaspersegi($panjang, $lebar);
echo "Luas Persegi Panjang adalah : $luas cm2";
?>