<?php

spl_autoload_register(function (string $class) {
    $path = str_replace('\\', '/', $class) . '.php';
    $fileName = $_SERVER["DOCUMENT_ROOT"] . '/includes/' . $path;

    if (file_exists($fileName)) {
        require_once($fileName);
    }
});


