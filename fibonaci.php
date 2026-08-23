<?php
$n = 10;
$a = 0;
$b = 1;
echo "Deret Fibonacci hingga $n bilangan:\n";
for ($i = 0; $i < $n; $i++){
    if ($i == 0){
        echo $a . " ";
    } elseif ($i == 1){
        echo $b . " ";
    } else {
        $selanjutnya = $a + $b;
        echo $selanjutnya . " ";
        $a = $b;
        $b = $selanjutnya;

    }
}
echo "\n";
?>