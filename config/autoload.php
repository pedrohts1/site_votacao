<?php
// Autoloader simples para carregar classes automaticamente
spl_autoload_register(function ($class) {
    $directories = [
        'models/',
        'views/',
        'controllers/',
        'dao/',
        'services/',
        'config/'
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
?>

