<?php namespace Nocriz\Import;

/**
 * Classe AbstractAlgorithm
 * Base para implementação do algorítimo de importação.
 * @author João Batista Neto
 * @copyright iMasters Fórum
 */

use Nocriz\Import\Algorithm as Algorithm;
use Nocriz\Import\Container as Container;

/**
 * Base para implementação do algorítimo de importação.
 */
abstract class AbstractAlgorithm implements Algorithm
{
    /**
     * @var boolean
     */
    protected $acceptable = false;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var string
     */
    protected $type;

    /**
     * @param  Container $container
     * @return boolean
     */
    public function accept(Container $container)
    {
        if ( $container->read( 1 ) != $this->type ) {
            $container->seek( -1 );

            return $this->acceptable = false;
        }

        $this->container = $container;

        return $this->acceptable = true;
    }
}
