<?php

class ContaBanco {

	private $nome;
	private $numeroConta;
	private $tipoConta;
	private $status;
	private $saldo;

// Getters e Setters

	public function getNome() {
		return $this->nome;
	}

	public function setNome($n) {
		$this->nome = $n;
	}

	public function getTipoConta() {
		return $this->tipoConta;
	}

	public function setTipoConta($tc) {
		$this->tipoConta = $tc;
	}


//  Formatar moeda em R$

	public function formatar($valor) {
	
		$numberFmt = new \NumberFormatter('pt-BR',\NumberFormatter::CURRENCY);
		$valor = $numberFmt->format($valor);
		return $valor;
	
		}


//  Abrir conta

	public function abrirConta($n, $tc) {

		$this->setNome($n);
		$this->status = true;
		$this->numeroConta = date("Y"."h"."s");


		if ($tc == "cc") {

			$this->setTipoConta("Conta Corrente");
			$this->saldo = 12;

		}elseif ($tc == "cp") {

			$this->setTipoConta("Conta Poupança");
			$this->saldo = 20;

		}

		// Exibindo valores

		$saldo = ContaBanco::formatar($this->saldo);
		
		echo "Parabéns Sr(a): $this->nome , conta gerada com sucesso!"."<br>".
		"Dados:"."<br>".
		"Nome:  $this->nome"."<br>".
		"Tipo: $this->tipoConta"."<br>".
		"Conta nº: $this->numeroConta"."<br>". 
		"Saldo: ".$saldo."<hr>";

	}


//  Fazer um Depósito

	public function depositar($valor) {

		if($this->status === false) {

			echo "Conta encerrada ou inexistente! Impossível depositar"."<hr>";
			die;
		}

		$this->saldo = $this->saldo + $valor;

		// Exibindo valores

		$valor = ContaBanco::formatar($valor);
		$saldo = ContaBanco::formatar($this->saldo);
		
		echo "Depósito efetuado com Sucesso"."<br>".
		     "Depósito: ".$valor."<br>".
		     "Saldo Atual: ".$saldo."<hr>";
	}

//  Fazer um Saque

	public function sacar($valor) {

		if($this->status === false) {

			echo "Conta encerrada ou inexistente! Impossível sacar"."<hr>";
			die;
		}

		if ($valor > $this->saldo) {

			// Exibindo valores

			$valor = ContaBanco::formatar($valor);	
			$saldo = ContaBanco::formatar($this->saldo);

			echo "Saldo insuficiente!"."<br>".
			     "saldo atual: ".$saldo."<hr>";
		}else{

			$this->saldo = $this->saldo - $valor;

			// Exibindo valores			

			$valor = ContaBanco::formatar($valor);
			$saldo = ContaBanco::formatar($this->saldo);

			echo "Saque efetuado com Sucesso"."<br>".
			     "Saque: ".$valor."<br>".
			     "Saldo Atual: ".$saldo."<hr>";

		}

	}


// Encerrar a Conta

	public function encerrar() {

		if($this->saldo < 0) {

			$valor = ContaBanco::formatar($this->saldo);

			echo "É necessário quitar o saldo devedor de: ".$valor."<hr>";

		}elseif($this->saldo > 0){

			$valor = ContaBanco::formatar($this->saldo);

			echo "É necessário antes, fazer um saque de: ".$valor."<hr>";			

		}else{

			echo "Conta encerrada com Sucesso!"."<hr>";

			$this->status = false;

		}

	}

};


$cliente1 = new ContaBanco();

// Testando

$cliente1->abrirConta("Fulano da Silva", "cc");
$cliente1->depositar(10);
$cliente1->sacar(5);
$cliente1->sacar(18);
$cliente1->sacar(17);
$cliente1->depositar(100);
$cliente1->encerrar();
$cliente1->sacar(100);
$cliente1->encerrar();


//Debug
var_dump($cliente1);
$cliente1->sacar(5);// um ou outro
//$cliente1->depositar(10);// um ou outro
