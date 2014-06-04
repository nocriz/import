<?php namespace Nocriz\Import;

/**
 * Interface Algorithm
 * Interface para definição de um algorítimo de importação
 * @author João Batista Neto
 * @copyright iMasters Fórum
 */
interface Algorithm
{
        /**
         * Define o contexto do algorítimo.
         * @param       Container $container
         * @return      boolean
         */
        public function accept( Container $container );

        /**
         * Executa o algorítimo
         */
        public function execute();
}
