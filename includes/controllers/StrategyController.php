<?php

namespace controllers;

use exceptions\NoSuchItemTypeHandlerException;
use itemTypeHandlersPresets\ItemHandler;

class StrategyController
{
    private string $currentStrategyName;

    /**
     * @param string $strategyName
     */
    public function __construct(string $strategyName)
    {
        $this->setStrategy($strategyName);
    }

    /**
     * @param string $strategyName
     * @return void
     */
    public function setStrategy(string $strategyName): void
    {
        $lowercase = strtolower($strategyName);
        $strategyPrefix = ucfirst($lowercase);

        $this->currentStrategyName = $strategyPrefix . 'Handler';
    }

    /**
     * @return ItemHandler
     * @throws NoSuchItemTypeHandlerException
     */
    public function instantiateStrategy(): ItemHandler
    {
        $strategy = $this->currentStrategyName;
        $class = 'itemTypeHandlers\\' . $strategy;
        if (class_exists($class)) {
            return new $class();
        } else {
            throw new NoSuchItemTypeHandlerException($strategy . ' is not implemented yet');
        }
    }
}
