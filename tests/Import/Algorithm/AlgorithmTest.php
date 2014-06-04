<?php namespace Nocriz\Import\Algorithm;

/**
 * Classe Clientes
 * @author João Batista Neto
 * @copyright iMasters Fórum
 */

use Nocriz\Import\AbstractAlgorithm as AbstractAlgorithm;
use Nocriz\Import\Container as Container;

class AlgorithmTest extends AbstractAlgorithm
{
  /**
   * @var string
   */
  protected $type = '1';

  /**
   * @param   Container $container
   * @return  boolean
   */
  public function accept(Container $container)
  {
      $this->container = $container;

      return $this->acceptable = true;
  }

  /**
   * @see Algorithm::execute()
   */
  public function execute()
  {
    if ($this->acceptable) {

      $line = array();

      $this->container->seek( 0 );
      $line['type'] = $this->container->read( 1 );

      $this->container->seek( 1 );
      $line['value1'] = $this->container->read( 1 );

      $this->container->seek( 1 );
      $line['value2'] = $this->container->read( 5 );

      $this->container->seek( 1 );
      $line['value3'] = $this->container->read( 5 );
      $line['value4'] = $this->container->read( 5 );

      $this->container->addLine( $line );

      $this->container->gets();

    }
  }
}
