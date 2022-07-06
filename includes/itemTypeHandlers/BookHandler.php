<?php

namespace itemTypeHandlers;

use itemTypeHandlersPresets\ItemHandler;

class BookHandler extends ItemHandler
{
    protected function prepareAdditionalData(): void
    {
        $size = $_POST['Weight'];
        $this->additional = 'Weight: ' . $this->checkFloat($size) . 'KG';
    }
}
