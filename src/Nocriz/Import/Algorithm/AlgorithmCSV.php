<?php namespace Nocriz\Import\Algorithm;

/**
 * Classe Clientes
 * @author Ramon Barros
 * @copyright Nocriz
 */

use Nocriz\Import\AbstractAlgorithm as AbstractAlgorithm;
use Nocriz\Import\Container as Container;

class AlgorithmCSV extends AbstractAlgorithm
{
  /**
   * @var string
   */
  protected $type = 'csv';

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

      $csvData = $this->container->gets();
      $csvDelim = ";";
      $csvEnclosure = '"';
      $csvEscape = '\\';

      $csv = str_getcsv($csvData, $csvDelim, $csvEnclosure, $csvEscape);

      $this->container->addLine( $csv );

    }
  }
}
