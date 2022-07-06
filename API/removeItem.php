<?php

declare(strict_types=1);

include $_SERVER["DOCUMENT_ROOT"] . '/includes/autoload.php';

use controllers\DatabaseController;
use exceptions\ExceptionProcessor;

try {
    $id = (string)$_GET['id'];
    $dataBase = new DatabaseController();
    $dataBase->removeItem($id);
    echo $dataBase->getItemsJson();
} catch (Throwable $exception) {
    new ExceptionProcessor($exception);
}
