<?php
class Carro{
    public $marca;
    public $modelo;
}

$carro_felipe = new carro();
$carro_felipe->marca = "volkswagen";
$carro_felipe->modelo = "GOLF GTI";

echo "$carro_felipe->marca\n";
echo "$carro_felipe->modelo\n";


?>