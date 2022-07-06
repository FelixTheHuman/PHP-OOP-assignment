<?php

namespace controllers;

use configs\MysqlConfig;
use exceptions\MySqlException;
use mysqli;

class DatabaseController
{
    private mysqli $connection;

    /**
     * @throws MySqlException
     * Performs MySQL connection using default config
     */
    public function __construct()
    {
        $configs = new MysqlConfig();
        $defaultConfig = $configs->getConfig('default');
        $this->connection = new mysqli($defaultConfig['host'], $defaultConfig['login'], $defaultConfig['password'], $defaultConfig['dataBase']);

        if ($this->connection->connect_error) {
            throw new MySqlException($this->connection->connect_error);
        }
    }

    /**
     * @param string $sku
     * @param string $name
     * @param string $price
     * @param string $type
     * @param string $additional
     * @return void
     * @throws MySqlException
     */
    public function appendItem(string $sku, string $name, string $price, string $type, string $additional): void
    {
        $queryString = "INSERT INTO `Items` (sku, name, price, type, additional) VALUES ('$sku', '$name', '$price', '$type', '$additional')";
        $succeed = $this->connection->query($queryString);
        if (!$succeed) {
            throw new MySqlException("Failed to save item: ($sku, $name, $price, $type, $additional)");
        }
    }

    /**
     * @param string $json - JSON encoded array of item ID's to remove
     * @return void
     * @throws MySqlException
     */
    public function removeItem(string $json): void
    {
        $ids = json_decode($json);
        foreach ($ids as &$id) {
            $id = (int)$id;
            $queryString = "DELETE FROM Items WHERE (id = $id)";
            $succeed = $this->connection->query($queryString);
            if ($succeed === false) {
                throw new MySqlException('Failed to remove item');
            }
        }
    }

    /**
     * @return string - JSON encoded array of items
     * @throws MySqlException
     */
    public function getItemsJson(): string
    {
        $queryString = 'SELECT * FROM `Items`';
        $result = $this->connection->query($queryString);
        if ($result === false) {
            throw new MySqlException('Failed to fetch items');
        }
        $jsonArray = array('items' => array());
        while ($row = $result->fetch_assoc()) {
            $jsonArray['items'][] = $row;
        }
        return json_encode($jsonArray);
    }

    /**
     * @param string $sku
     * @return string - JSON encoded bool. True if SKU is unique, False - if not
     */
    public function isUniqueSku(string $sku): string
    {
        $queryString = "SELECT id FROM `Items` WHERE (sku = $sku)";
        $result = $this->connection->query($queryString);
        if (mysqli_num_rows($result)==0) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
}
