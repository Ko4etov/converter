<?php

spl_autoload_register( function($class) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/';
    $class = str_replace('\\', '/', $class);
    require_once  $path . $class .'.php';
});

use Converter\Converter;
use Converter\ElementSelectors\Selector;

$converter = new Converter( jsonInstructionPath: $_SERVER['DOCUMENT_ROOT'] . '/instruction.json');
$converter->setElementSelector(elementSelector: Selector::class);
$converter->render();
?>