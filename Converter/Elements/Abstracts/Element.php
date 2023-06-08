<?php

namespace Converter\Elements\Abstracts;
use DOMElement;
use DOMDocument;

abstract class Element
{
    abstract public function render( array $parameters, DOMDocument $document ): DOMElement|false;

    public function setElementValue( array $parameters, DOMElement $element ): void
    {
        if ( !empty($parameters['payload']['text']) )
        {
            $element->nodeValue = $parameters['payload']['text'];
        }
    }

    public function setElementParameters( array $parameters, DOMElement $element ): void
    {
        if ( !empty($parameters['parameters']) )
        {
            $styles = '';

            foreach ($parameters['parameters'] as $key => $value) {
                $key = preg_split('/(?=[A-Z])/', $key);

                $key = implode('-', $key );

                $styles .= "$key:$value;";
            }

            $element->setAttribute('style', $styles);
        }
    }
}