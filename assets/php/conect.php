<?php
//Gabriel CMR - Desenvolvimentos
// Plagio e Crime

use Dcblogdev\PdoWrapper\Database;

$options = [
    'username' => $usuario_db,
    'database' => $nome_db,
    'password' => $senha_db,
    'host' => $servidor_db
];

$db = new Database($options);