<?php

namespace Converter\ElementSelectors\Interfaces;

use Converter\Elements\Abstracts\Element;

interface Selector
{
    public function getElementClass( string $type ): Element;
}
?>