<?php namespace Nocriz\Import\Algorithm;

/**
 * Classe Clientes
 * @author João Batista Neto
 * @copyright iMasters Fórum
 */

use Nocriz\Import\AbstractAlgorithm as AbstractAlgorithm;
use Nocriz\Import\Container as Container;

class Algorithm01 extends AbstractAlgorithm
{
  /**
   * @var string
   */
  protected $type = '01';

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
      $this->container->seek( 4 );

      $line[ 'oco_dataHoraAbertura'   ] = vsprintf(
              '%4d-%02d-%02d %02d:%02d:%02d' , sscanf(
                      $this->container->read( 14 ),
                      '%04d%02d%02d%02d%02d%02d'
              )
      );

      $line[ 'oco_numeroChamadoCaixa' ] = trim( $this->container->read( 20 ) );
      $line[ 'oco_codigoChamadoCaixa' ] = $line[ 'oco_numeroChamadoCaixa'     ];
      $line[ 'oco_codigoAtividade'    ] = $this->container->read(  3 );

      $this->container->seek( 3 );

      $line[ 'oco_descricao'                  ] = vsprintf(
              'UNIDADE DA OCORRÊNCIA => Código Unidade - %d, Tipo Unidade - %d, Nome - %s, Endereço - %s, %s - %s, Correspondente - ',
              array_map( 'trim' , array(
                      $this->container->read( 10 ),
                      $this->container->read( 30 ),
                      $this->container->read( 40 ),
                      $this->container->read( 60 ),
                      $this->container->read( 40 ),
                      $this->container->read(  2 ),
                      $this->container->read( 10 )
              ) )
      );

      $this->container->addLine( $line );
      $this->container->gets();
    }
  }
}
