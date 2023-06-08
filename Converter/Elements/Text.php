<?php

namespace Converter\Elements;

use Converter\Elements\Abstracts\Element;
use DOMElement;
use DOMDocument;

class Text extends Element
{
    public function render( array $parameters, DOMDocument $document ): DOMElement|false
    {
        $element = $document->createElement('p');
        $this->setElementValue( parameters: $parameters, element: $element );
        $this->setElementParameters( parameters: $parameters, element: $element );
        return $element;
    }
}
?>