<?php

class Produtos{
    public $preco;
}

$produto01 = new Produtos();
$produto01 ->preco = 11;

$produto02 = new Produtos();
$produto02 ->preco = 13;

$produto03 = new Produtos();
$produto03 ->preco = 15;

$soma = $produto01->preco + $produto02->preco + $produto03->preco;

echo "$soma";











?>