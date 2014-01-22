<?php
/**
 * This file is part of the Nocriz API (http://nocriz.com)
 *
 * Copyright (c) 2013  Nocriz API (http://nocriz.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

/**
 * Nocriz API 
 *
 * @package  Nocriz
 * @author   Ramon Barros <contato@ramon-barros.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| This application is installed by the Composer, 
| that provides a class loader automatically.
| Use it to seamlessly and feel free to relax.
|
*/

require __DIR__.'/../app/bootstrap.php';


$file_path = __DIR__ . DS . 'uploads' . DS . 'test.txt';
var_dump($file_path);
/*
*   Exporta dados do banco de dados para um arquivo
*/
$importer = new Nocriz\Import\Importer;

/*
* Define o algoritimo de exportação a ser utilizado
*/
$importer->addAlgorithm( new Nocriz\Import\Algorithm\Algorithm01() );
$importer->addAlgorithm( new Nocriz\Import\Algorithm\Algorithm99() );
$importer->import( new Nocriz\Import\Container( $file_path ) );