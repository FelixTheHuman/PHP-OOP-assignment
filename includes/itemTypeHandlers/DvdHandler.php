<?php

namespace itemTypeHandlers;

use itemTypeHandlersPresets\ItemHandler;

class DvdHandler extends ItemHandler
{
    /**
     * @return void
     * @throws \exceptions\NonNumericStringException
     */
    protected function prepareAdditionalData(): void
    {
        $size = $_POST['Size'];
        $this->additional = 'Size: ' . $this->checkFloat($size) . ' MB';
    }
}
