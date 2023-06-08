<?php

namespace Converter\Elements;

use Converter\Elements\Abstracts\Element;
use DOMElement;
use DOMDocument;

class Block extends Element
{
    public function render( array $parameters, DOMDocument $document  ): DOMElement|false
    {
        $element = $document->createElement('div');
        $this->setElementValue( parameters: $parameters, element: $element );
        $this->setElementParameters( parameters: $parameters, element: $element );
        return $element;
    }
}
?>