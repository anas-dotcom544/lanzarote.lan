<?

$limite = 30;
$totalPares = 0;
$totalImpares = 0;

for ($i = 1; $i <= $limite; $i++) {

    if ($i % 2 == 0) {
        $totalPares ++;
    } else {
        $totalImpares ++;
    }
}

echo "Total de pares: {$totalPares}. Total de impares: {$totalImpares}  ";

?>