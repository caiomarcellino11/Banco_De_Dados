<?php

class Pessoa{
    public $nome;
    public $idade;
}

$pessoa = new pessoa();

$pessoa->nome = "platini";
$pessoa->idade = 23;

echo "$pessoa->nome\n";
echo $pessoa->idade;

$pessoa01 = new pessoa();

$pessoa01->nome = "caio";
$pessoa01->idade = 18;

echo "$pessoa01->nome";
echo $pessoa01->idade;


?>