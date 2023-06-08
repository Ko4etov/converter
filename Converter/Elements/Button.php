<?php

namespace Converter\Elements;

use Converter\Elements\Abstracts\Element;
use DOMElement;
use DOMDocument;

class Button extends Element
{
    public function render( array $parameters, DOMDocument $document ): DOMElement|false
    {
        $element = $document->createElement('button');
        $this->setElementValue( parameters: $parameters, element: $element );
        $this->setElementParameters( parameters: $parameters, element: $element );
        $this->setButtonUrl( parameters: $parameters, element: $element );
        return $element;
    }

    private function setButtonUrl( array $parameters, DOMElement $element): void
    {
        if ( !empty($parameters['payload']['link']['payload']) )
        {
            $element->setAttribute('href', $parameters['payload']['link']['payload']);
        }
    }
}
?>