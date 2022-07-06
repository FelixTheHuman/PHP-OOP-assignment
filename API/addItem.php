<?php

declare(strict_types=1);

include $_SERVER["DOCUMENT_ROOT"] . '/includes/autoload.php';

use controllers\StrategyController;
use exceptions\ExceptionProcessor;

try {
    $itemType = (string)$_POST['Type'];
    $ItemHandlingStrategy = new StrategyController($itemType);
    $ItemHandlingStrategy->instantiateStrategy();
} catch (Throwable $exception) {
    new ExceptionProcessor($exception);
}
