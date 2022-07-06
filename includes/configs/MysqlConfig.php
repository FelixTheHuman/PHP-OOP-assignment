<?php

namespace configs;

class MysqlConfig
{
    private array $default = array(
        'host' => 'localhost',
        'login' => 'id19023862_admin',
        'password' => '1D5rkRB>6\O+Sv8>',
        'dataBase' => 'id19023862_juniortest'
    );

    /**
     * @param $configName
     * @return array - array of config data
     */
    public function getConfig($configName): array
    {
        return $this->$configName;
    }
}
