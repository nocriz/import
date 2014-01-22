<?php namespace Nocriz\Import;
/**
 * Classe File
 * Representação de um arquivo
 * @author João Batista Neto
 * @copyright iMasters Fórum
 */

class File {
        /**
         * @var resource
         */
        private $fh;

        /**
         * @var string
         */
        private $filename;

        /**
         * @var string
         */
        private $mode = 'r';

        /**
         * @var boolean
         */
        private $opened = false;

        /**
         * Constroi o objeto que representa um arquivo.
         * @param       string $filename
         * @throws      RuntimeException
         */
        public function __construct( $filename ) {
                if ( is_file( $filename ) && is_readable( $filename ) ) {
                        if ( is_writable( $filename ) ) {
                                $this->mode = 'r+';
                        }
                } else if ( is_writable( dirname( $filename ) ) ) {
                        $this->mode = 'w+';
                } else {
                        throw new \RuntimeException( 'Sem permissões para criar o arquivo.' );
                }

                $this->filename = $filename;
        }

        /**
         * Destroi o objeto e fecha o arquivo se estiver aberto.
         */
        public function __destruct() {
                if ( is_resource( $this->fh ) ) {
                        $this->close();
                }
        }

        /**
         * Verifica se o ponteiro de arquivo está no início.
         * @return      boolean
         */
        public function bof() {
                if ( $this->opened ) {
                        return $this->tell() == 0;
                }

                return true;
        }

        /**
         * Fecha o arquivo.
         */
        public function close() {
                if ( $this->opened ) {
                        fclose( $this->fh );
                        $this->opened = false;
                }
        }

        /**
         * Verifica se o ponteiro de arquivo está no final.
         * @return      boolean
         */
        public function eof() {
                if ( $this->opened ) {
                        return feof( $this->fh );
                }

                return true;
        }

        /**
         * Recupera uma linha do arquivo.
         * @param       integer $length
         * @return      integer
         */
        public function gets( $length = 1024 ) {
                if ( $this->opened ) {
                        return fgets( $this->fh , $length );
                }
        }

        /**
         * Abre o arquivo.
         * @return      boolean
         * @throws      RuntimeException
         */
        public function open() {
                if ( !$this->opened ) {
                        $fh = fopen( $this->filename , $this->mode );

                        if ( is_resource( $fh ) ) {
                                $this->fh = $fh;
                        } else {
                                throw new RuntimeException( 'Não foi possível abrir o arquivo.' );
                        }

                        return $this->opened = true;
                }

                return false;
        }

        /**
         * Lê uma porção de bytes do arquivo.
         * @param       integer $length
         */
        public function read( $length = 1 ) {
                if ( $this->opened ) {
                        return fread( $this->fh , $length );
                }
        }

        /**
         * Define a posição do ponteiro do arquivo.
         * @param       integer $offset
         * @param       integer $whence
         */
        public function seek( $offset , $whence = SEEK_CUR ) {
                if ( $this->opened ) {
                        return fseek( $this->fh , $offset , $whence ) == 0;
                }

                return false;
        }

        /**
         * Recupera a posição do ponteiro do arquivo.
         * @return      integer
         */
        public function tell() {
                if ( $this->opened ) {
                        $tell = ftell( $this->fh );

                        return $tell === false ? -1 : $tell;
                }

                return -1;
        }

        /**
         * Escreve no arquivo.
         * @param       string $data
         * @return      integer
         */
        public function write( $data ) {
                if ( $this->opened ) {
                        return fwrite( $this->fh , $data , strlen( $data ) );
                }

                return 0;
        }
}