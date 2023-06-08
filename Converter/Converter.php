<?php

namespace Converter;

use Converter\ElementSelectors\Interfaces\Selector as SelectorInterface;
use Exception;
use DOMDocument;
use DOMElement;
use DOMNode;

class Converter
{
    private array $instruction;
    private SelectorInterface $selector;
    private DOMDocument $document;

    public function __construct( string $jsonInstructionPath )
    {
        if (mime_content_type($jsonInstructionPath) !== 'application/json')
        {
            throw new Exception('Converter constructor only accepts json files.');
        }

        $json = file_get_contents( $jsonInstructionPath );

        $this->instruction[] = json_decode($json, true);

        $this->document = new DOMDocument();
    }

    public function setElementSelector( string $elementSelector )
    {
        $this->selector = new $elementSelector;

        if ( !$this->selector instanceof SelectorInterface ) {
            throw new Exception("Defined class must implements " . SelectorInterface::class . " interface");
        }
    }

    public function render(): void
    {
        if ( empty( $this->selector ) ) {
            throw new Exception("Set Selector class first");
        }

        foreach ($this->instruction as $element)
        {
            $this->document->appendChild($this->renderElement( parameters: $element ));
        }

        echo $this->document->saveHTML();
    }

    private function renderElement( array $parameters ): DOMElement
    {
        $elementClass = $this->selector->getElementClass( type: $parameters['type'] );

        $renderedElement = $elementClass->render( parameters: $parameters, document: $this->document );

        if ( !empty($parameters['children']) ) {
            foreach ($parameters['children'] as $children)
            {
                $renderedElement->appendChild($this->renderElement( parameters: $children ));
            }
        }

        return $renderedElement;
    }
}