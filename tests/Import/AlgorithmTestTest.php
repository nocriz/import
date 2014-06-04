<?php

use Nocriz\AbstractTest as AbstractTest;
use Nocriz\Import\Algorithm\AlgorithmTest;
use Nocriz\Import\Container;

class AlgorithmTestTest extends AbstractTest
{
    public $instance;

    /**
     * Antes de cada teste verifica se a classe existe
     * e cria uma instancia da mesma
     * @return void
     */
    public function assertPreConditions()
    {
        $this->assertTrue(
                class_exists($class = 'Nocriz\Import\Algorithm\AlgorithmTest'),
                'Class not found: '.$class
        );
        $this->instance = new Nocriz\Import\Algorithm\AlgorithmTest;
    }

    public function testInstantiationWithoutArgumentsShouldWork()
    {
        $this->assertInstanceOf('Nocriz\Import\Algorithm\AlgorithmTest', $this->instance);
    }

    /**
     * @depends testInstantiationWithoutArgumentsShouldWork
     */
    public function testSetAlgorithmDataShouldWork()
    {
        $this->instance->accept( new Container('test.txt') );
        $this->assertAttributeInstanceOf('Nocriz\Import\Container', 'container', $this->instance, 'Attribute was not correctly set');
    }
}
