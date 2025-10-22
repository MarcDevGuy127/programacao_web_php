<?php
// app/Core/Autoloader.php

spl_autoload_register(function ($class) {
    // Namespace base da aplicação
    $prefix = 'App\\';
    // Diretório base da aplicação
    $base_dir = __DIR__ . '/../'; // Pasta app

    // Verifica se a classe usa o namespace base
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Não, passa para o próximo autoloader registrado
        return;
    }

    // Obtém o nome relativo da classe
    $relative_class = substr($class, $len);

    // Substitui o prefixo do namespace por diretórios e adiciona .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Se o arquivo existir, inclui ele
    if (file_exists($file)) {
        require_once $file;
    }
});