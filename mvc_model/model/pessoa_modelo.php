<?php
class Pessoa {
    private $nome, $fone;
    function __construct($nome, $fone) {
        $this->nome = $nome;
        $this->fone = $fone;
    }
    function getNome() {
        return $this->nome;
    }
    function getFone() {
        return $this->fone;
    }
}
?>