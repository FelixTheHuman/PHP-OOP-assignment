<?php

declare(strict_types=1);

include $_SERVER["DOCUMENT_ROOT"] . '/includes/autoload.php';

use controllers\DatabaseController;
use exceptions\ExceptionProcessor;

try {
    $dataBase = new DatabaseController();
    $itemsJson = $dataBase->getItemsJson();
    echo $itemsJson;
} catch (Throwable $exception) {
    new ExceptionProcessor($exception);
}
