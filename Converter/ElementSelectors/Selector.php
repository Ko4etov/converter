<?php

namespace Converter\ElementSelectors;

use Converter\ElementSelectors\Interfaces\Selector as SelectorInterface;
use Converter\Elements\Abstracts\Element;
use Exception;
use Throwable;

class Selector implements SelectorInterface
{
    private array $classInstances = [];
    private string $pathToElementClasses = 'Converter\Elements\\';

    public function getElementClass( string $type ): Element
    {
        $className = ucfirst(strtolower($type));

        $fullClassName = $this->pathToElementClasses . $className;

        try {
            class_exists($fullClassName);
        } catch (Throwable $th) {
            throw new Exception("Define class {$fullClassName} for {$className} element type");
        }

        $classInstance = $this->getClassInstance( $className, $fullClassName );

        if ( !$classInstance instanceof Element ) {
            throw new Exception("Defined class must extend " . Element::class . " class");
        }

        return $classInstance;
    }

    private function getClassInstance( string $className, string $fullClassName )
    {
        if ( empty($classInstances[$className]) ) {
            $this->classInstances[$className] = new $fullClassName;
        }
        return $this->classInstances[$className];
    }
}
?>