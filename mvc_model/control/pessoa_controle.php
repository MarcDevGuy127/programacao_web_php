<?php
require_once('pessoa_modelo.php');
class PessoaControlador
{
    function mostra() {
        $pessoa = new Pessoa('Maria','(86) 3323-1234');
        require_once('pessoa_visao.php');
    }
}
$pc = new PessoaControlador();
$pc->mostra();
?>