<?php

class ContaBancaria{
    public $titular;
    public $saldo;
    public $pix;

    public function __construct($t,$s,$p)
    {
       $this->titular=$t;
       $this->saldo=$s;
       $this->pix=$p;
    }

    public function depositar($p,$deposito){
        if($this->pix===$p){
            $this->saldo +=$deposito;
            return "Novo saldo após depósito de $deposito: R$ $this->saldo";
        } else {
            return "chave pix inválida!";
        }
    }
}
$platini_conta = new ContaBancaria("Platini",6000,2805);
$platini_conta->depositar(2805,100);

echo $platini_conta->depositar(2805,100);


?>