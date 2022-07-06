<?php

namespace itemTypeHandlersPresets;

use controllers\DatabaseController;
use exceptions\MySqlException;
use exceptions\NonNumericStringException;

abstract class ItemHandler
{
    protected string $additional;
    private string $sku;
    private string $name;
    private string $price;
    private string $type;

    /**
     * @throws MySqlException
     * @throws NonNumericStringException
     */
    public function __construct()
    {
        $this->prepareBasicData();
        $this->prepareAdditionalData();
        $this->saveItem();
    }

    /**
     * @return void
     * @throws NonNumericStringException
     */
    protected function prepareBasicData(): void
    {
        $this->sku = $this->sanitizeString($_POST['SKU']);
        $this->name = $this->sanitizeString($_POST['Name']);
        $this->price = $this->checkFloat($_POST['Price']) . ' $';
        $this->type = $this->sanitizeString($_POST['Type']);
    }

    /**
     * @param string $variable
     * @return string
     */
    protected function sanitizeString(string $variable): string
    {
        $XssSanitized = htmlspecialchars($variable);
        return $XssSanitized;
    }

    /**
     * @param string $variable
     * @return float
     * @throws NonNumericStringException
     */
    protected function checkFloat(string $variable): float
    {
        if (is_numeric($variable)) {
            return (float)$variable;
        } else {
            throw new NonNumericStringException('V');
        }
    }

    /**
     * @return void
     */
    abstract protected function prepareAdditionalData(): void;

    /**
     * @return void
     * @throws MySqlException
     */
    private function saveItem(): void
    {
        $connection = new DatabaseController();
        $connection->appendItem($this->sku, $this->name, $this->price, $this->type, $this->additional);
    }
}
