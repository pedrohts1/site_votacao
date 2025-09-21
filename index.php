<?php
// Arquivo principal - ponto de entrada da aplicação
session_start();

// Incluir configurações
require_once 'config/database.php';
require_once 'config/autoload.php';

// Incluir o roteador
require_once 'config/router.php';

// Inicializar a aplicação
$router = new Router();
$router->run();
?>