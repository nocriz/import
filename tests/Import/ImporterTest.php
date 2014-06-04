<?php

use Nocriz\AbstractTest as AbstractTest;
use Nocriz\Import\Importer;
use Nocriz\Import\Algorithm\AlgorithmTest;
use Nocriz\Import\Container;

class ContainerTest {}

class ImporterTest extends AbstractTest
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
                class_exists($class = 'Nocriz\Import\Importer'),
                'Class not found: '.$class
        );
        $this->instance = new Nocriz\Import\Importer();
    }

    public function testInstantiationWithoutArgumentsShouldWork()
    {
        $this->assertInstanceOf('Nocriz\Import\Importer', $this->instance);
    }

    /**
     * @depends testInstantiationWithoutArgumentsShouldWork
     */
    public function testSetAlgorithmDataShouldWork()
    {
        $this->assertEquals(new Importer(), $this->instance, 'Returned value should be the same instance for fluent interface');

        $algorithm = new AlgorithmTest();
        $instance = new Importer();
        $instance->addAlgorithm( new AlgorithmTest() );
        $this->assertAttributeEquals(array($algorithm), 'algorithms', $instance, 'Attribute was not correctly set');
    }

    /**
     * @depends testInstantiationWithoutArgumentsShouldWork
     */
    public function testSetDataShouldWork() {
        $file = APP_ROOT . DS . 'tests' . DS . 'test.txt';
        $this->instance->addAlgorithm( new AlgorithmTest() );
        $this->instance->import( new Container($file) );
        $return = array(
            array(
                 "type" => "1"
                ,"value1" => "a"
                ,"value2" => "00001"
                ,"value3" => "aaaaa"
                ,"value4" => "00008"
            ),
            array(
                 "type" => "2"
                ,"value1" => "b"
                ,"value2" => "00002"
                ,"value3" => "bbbbb"
                ,"value4" => "00009"
            )
        );
        $this->assertEquals($return, $this->instance->data);
    }
}
