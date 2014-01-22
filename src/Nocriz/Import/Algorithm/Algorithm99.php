<?php namespace Nocriz\Import\Algorithm;

/**
 * Classe Clientes
 * @author João Batista Neto
 * @copyright iMasters Fórum
 */

use Nocriz\Import\AbstractAlgorithm as AbstractAlgorithm;
use Nocriz\Import\Container as Container;
use \StdClass;
use \RuntimeException;

class Algorithm99 extends AbstractAlgorithm {
  /**
   * @var string
   */
  protected $type = '99';

  /**
   * @param   Container $container
   * @return  boolean
   */
  public function accept( Container $container ) {
      $this->container = $container;
      return $this->acceptable = true;
  }

  /**
   * @see Algorithm::execute()
   */
  public function execute() {
    if ( $this->acceptable ) {
      /*
      if ( $this->container->count() + 1 != (int) $this->container->read( 5 ) ) {
        throw new RuntimeException( 'A quantidade de linhas no arquivo não bate com o existente no trailer' );
      }
      */

      $this->container->finalize();
      echo "<pre>";
      var_dump($this->container->getLine());
      echo "<pre>";
    }
  }
}