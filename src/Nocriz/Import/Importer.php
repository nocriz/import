<?php namespace Nocriz\Import;

use Nocriz\Import\Algorithm as Algorithm;
use Nocriz\Import\Container as Container;

/**
 * Implementação de um importador que aceita vários
 * algorítimos de importação.
 */
class Importer {
        /**
         * @var array[Algorithm]
         */
        private $algorithms;

        public $data = array();

        /**
         * Adiciona um algorítimo de importação.
         * @param       Algorithm $algorithm
         */
        public function addAlgorithm( Algorithm $algorithm ) {
                $this->algorithms[] = $algorithm;
        }

        /**
         * Importa os dados de um determinado container.
         * @param       Container $container
         * @throws      BadMethodCallException
         */
        public function import( Container $container ) {
                if ( count( $this->algorithms ) > 0 ) {
                        while ( $container->valid() ) {
                                foreach ( $this->algorithms as $algorithm ) {
                                        $container->configure( $algorithm );
                                        $container->execute();
                                }
                        }
                } else {
                        throw new BadMethodCallException( 'Nenhum algorítimo de importação definido.' );
                }
        }
}