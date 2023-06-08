<?php

namespace Converter\Elements;

use Converter\Elements\Abstracts\Element;
use DOMElement;
use DOMDocument;

class Image extends Element
{
    public function render( array $parameters, DOMDocument $document ): DOMElement|false
    {
        $element = $document->createElement('img');
        $this->setElementValue( parameters: $parameters, element: $element );
        $this->setElementParameters( parameters: $parameters, element: $element );
        $this->setImageUrl( parameters: $parameters, element: $element );
        return $element;
    }

    private function setImageUrl( array $parameters, DOMElement $element): void
    {
        if ( !empty($parameters['payload']['image']['url']) )
        {
            $element->setAttribute('src', $parameters['payload']['image']['url']);
        }
    }
}
?>