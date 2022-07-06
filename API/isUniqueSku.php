<?php


declare(strict_types=1);

include $_SERVER["DOCUMENT_ROOT"] . '/includes/autoload.php';

use controllers\DatabaseController;
use exceptions\ExceptionProcessor;

try {
    $sku = (string)$_GET['sku'];
    $dataBase = new DatabaseController();
    echo $dataBase->isUniqueSku($sku);
} catch (Throwable $exception) {
    new ExceptionProcessor($exception);
}

