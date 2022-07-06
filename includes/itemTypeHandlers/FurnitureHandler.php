<?php

namespace itemTypeHandlers;

use itemTypeHandlersPresets\ItemHandler;

class FurnitureHandler extends ItemHandler
{
    /**
     * @return void
     * @throws \exceptions\NonNumericStringException
     */
    protected function prepareAdditionalData(): void
    {
        $height = $this->checkFloat($_POST['Height']);
        $width = $this->checkFloat($_POST['Width']);
        $length = $this->checkFloat($_POST['Length']);
        $this->additional = 'Dimension: ' . $height . 'x' . $width . 'x' . $length;
    }
}
