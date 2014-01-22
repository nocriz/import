<?php namespace Nocriz\Import;

/**
 * Classe Container
 * Implementação de um container que contém os dados a serem importados.
 * @author João Batista Neto
 * @copyright iMasters Fórum
 */

use Nocriz\Import\File as File;
use Nocriz\Import\Algorithm as Algorithm;
use \Countable as Countable;

/**
 * Implementação de um container que contém os dados a serem importados.
 */
class Container implements Countable {
        /**
         * @var array
         */
        private $data = array();

        /**
         * @var File
         */
        private $file;

        /**
         * @var Algorithm
         */
        private $algorithm;

        /**
         * Constroi o objeto do container para um arquivo específico
         * @param       string $filename
         */
        public function __construct( $filename ) {
                $this->file = new File( $filename );
                $this->file->open();
        }

        /**
         * Adiciona uma linha que acaba de ser interpretada por um
         * algorítimo qualquer.
         * @param       array $line
         */
        public function addLine( $line , $key=null) {
                if(strlen($key)>0){
                        $this->data[$key] = $line;
                }else{
                        $this->data[] = $line;
                }                
        }

        public function getLine($key=null){
                if(strlen($key)>0){
                        return $this->data[$key];
                }else{
                        return $this->data;
                }
        }

        /**
         * Configura o container com um algorítimo.
         * @param       Algorithm $algorithm
         */
        public function configure( Algorithm $algorithm ) {
                $this->algorithm = $algorithm;
                $this->algorithm->accept( $this );
        }

        /**
         * Conta o total de linhas já importadas.
         * @return      integer
         * @see         Countable::count()
         */
        public function count() {
                return count( $this->data );
        }

        /**
         * Executa a importação utilizando um algorítimo previamente
         * configurado.
         */
        public function execute() {
                $this->algorithm->execute();
        }

        /**
         * Finaliza a importação.
         */
        public function finalize() {
                $this->file->close();
                printf( "Finalizando\n" );

                //var_dump( $this->data );
        }

        /**
         * Recupera uma linha inteira do arquivo.
         * @return      string
         */
        public function gets() {
                return $this->file->gets();
        }

        /**
         * Lê uma porção de bytes do arquivo.
         * @param       integer $length
         * @return      string
         */
        public function read( $length ) {
                return $this->file->read( $length );
        }

        public function seek( $offset , $whence = SEEK_CUR ) {
                $this->file->seek( $offset , $whence );
        }

        /**
         * Verifica se o container ainda é válido (o arquivo já chegou no fim).
         * @return      boolean
         */
        public function valid() {
                return  !$this->file->eof();
        }
}
