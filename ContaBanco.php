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

		echo "Parabéns Sr(a): $this->nome , conta gerada com sucesso!"."<br>".
		"Dados:"."<br>".
		"Nome:  $this->nome"."<br>".
		"Tipo: $this->tipoConta"."<br>".
		"Conta nº: $this->numeroConta"."<br>". 
		"Saldo: $this->saldo"."<br>";
	}

};


$cliente1 = new ContaBanco();


// Testando

$cliente1->abrirConta("Fulano da Silva", "cc");

// Debug
//var_dump($cliente1);