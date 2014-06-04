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

$file_path = __DIR__ . DS . 'uploads' . DS . 'frete.csv';

/*
*   Exporta dados do banco de dados para um arquivo
*/
$importer = new Nocriz\Import\Importer;

/*
* Define o algoritimo de exportação a ser utilizado
*/
$importer->addAlgorithm( new Nocriz\Import\Algorithm\AlgorithmCSV() );
//$importer->addAlgorithm( new Nocriz\Import\Algorithm\Algorithm99() );
$importer->import( new Nocriz\Import\Container( $file_path ) );

echo "<pre>";
$columns = array();
$registers = array();

$x=15;
foreach ($importer->data as $key => $value) {
    if (count($value) == $x+1) {
        for ($i=0; $i < $x; $i++) {
            $val = trim(utf8_decode($value[$i]));
            if ($key == 0) {
                if (preg_match('/De ([0-9]+) a ([0-9]+) Kg/', $val, $match)) {
                    $columns[] = $match[1] . '_' . $match[2];
                } else {
                    $columns[] = strtolower($val);
                }
            } else {
                if ($columns[$i] != 'estado' && $columns[$i] != 'cidade') {
                    $registers[$key][$columns[$i]] = preg_replace('/[R\$\s]{2,}/', '', trim($val));
                } else {
                    $registers[$key][$columns[$i]] = trim($val);
                }
            }
        }
    }
}

$regiao = array();
//var_dump($registers);
foreach ($registers as $register) {
    $estado = $register['estado'];
    $cidade = $register['cidade'];
    unset($register['estado']);
    unset($register['cidade']);
    $regiao[$estado][$cidade] = $register;
}

function getZoneId($uf)
{
    $zone = array(
        'AC' => 440,
        'AL' => 441,
        'AP' => 442,
        'AM' => 443,
        'BA' => 444,
        'CE' => 445,
        'DF' => 446,
        'ES' => 447,
        'GO' => 448,
        'MA' => 449,
        'MT' => 450,
        'MS' => 451,
        'MG' => 452,
        'PA' => 453,
        'PB' => 454,
        'PR' => 455,
        'PE' => 456,
        'PI' => 457,
        'RJ' => 458,
        'RN' => 459,
        'RS' => 460,
        'RO' => 461,
        'RR' => 462,
        'SC' => 463,
        'SP' => 464,
        'SE' => 465,
        'TO' => 466
    );

    return $zone[$uf];
}

function getCities($zone_id)
{
  $cities = array(
    array(
      'city_id' => 0,
      'zone_id' => 440,
      'name'    => 'Rio Branco',
      'status'  => 1
    ),
    array(
      'city_id' => 1,
      'zone_id' => 441,
      'name'    => 'Maceió',
      'status'  => 1
    ),
    array(
      'city_id' => 2,
      'zone_id' => 442,
      'name'    => 'Macapá',
      'status'  => 1
    ),
    array(
      'city_id' => 3,
      'zone_id' => 443,
      'name'    => 'Manaus',
      'status'  => 1
    ),
    array(
      'city_id' => 4,
      'zone_id' => 444,
      'name'    => 'Salvador',
      'status'  => 1
    ),
    array(
      'city_id' => 5,
      'zone_id' => 445,
      'name'    => 'Fortaleza',
      'status'  => 1
    ),
    array(
      'city_id' => 6,
      'zone_id' => 446,
      'name'    => 'Brasília',
      'status'  => 1
    ),
    array(
      'city_id' => 7,
      'zone_id' => 447,
      'name'    => 'Vitória',
      'status'  => 1
    ),
    array(
      'city_id' => 8,
      'zone_id' => 448,
      'name'    => 'Goiânia',
      'status'  => 1
    ),
    array(
      'city_id' => 9,
      'zone_id' => 449,
      'name'    => 'São Luís',
      'status'  => 1
    ),
    array(
      'city_id' => 10,
      'zone_id' => 450,
      'name'    => 'Cuiabá',
      'status'  => 1
    ),
    array(
      'city_id' => 11,
      'zone_id' => 451,
      'name'    => 'Campo Grande',
      'status'  => 1
    ),
    array(
      'city_id' => 12,
      'zone_id' => 452,
      'name'    => 'Belo Horizonte',
      'status'  => 1
    ),
    array(
      'city_id' => 13,
      'zone_id' => 453,
      'name'    => 'Belém',
      'status'  => 1
    ),
    array(
      'city_id' => 14,
      'zone_id' => 454,
      'name'    => 'João Pessoa',
      'status'  => 1
    ),
    array(
      'city_id' => 15,
      'zone_id' => 455,
      'name'    => 'Curitiba',
      'status'  => 1
    ),
    array(
      'city_id' => 16,
      'zone_id' => 456,
      'name'    => 'Recife',
      'status'  => 1
    ),
    array(
      'city_id' => 17,
      'zone_id' => 457,
      'name'    => 'Teresina',
      'status'  => 1
    ),
    array(
      'city_id' => 18,
      'zone_id' => 458,
      'name'    => 'Rio de Janeiro',
      'status'  => 1
    ),
    array(
      'city_id' => 19,
      'zone_id' => 459,
      'name'    => 'Natal',
      'status'  => 1
    ),
    array(
      'city_id' => 20,
      'zone_id' => 460,
      'name'    => 'Porto Alegre',
      'status'  => 1
    ),
    array(
      'city_id' => 21,
      'zone_id' => 461,
      'name'    => 'Porto Velho',
      'status'  => 1
    ),
    array(
      'city_id' => 22,
      'zone_id' => 462,
      'name'    => 'Boa Vista',
      'status'  => 1
    ),
    array(
      'city_id' => 23,
      'zone_id' => 463,
      'name'    => 'Florianópolis',
      'status'  => 1
    ),
    array(
      'city_id' => 24,
      'zone_id' => 464,
      'name'    => 'São Paulo',
      'status'  => 1
    ),
    array(
      'city_id' => 25,
      'zone_id' => 465,
      'name'    => 'Aracaju',
      'status'  => 1
    ),
    array(
      'city_id' => 26,
      'zone_id' => 466,
      'name'    => 'Palmas',
      'status'  => 1
    )
  );
  $city_data = $cities[recursive_array_search((int) $zone_id, $cities)];

  return $city_data;
}

function recursive_array_search($needle, $haystack)
{
    foreach ($haystack as $key=>$value) {
        $current_key=$key;
        if ($needle==$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }

    return false;
}

var_dump($regiao);

foreach ($regiao as $estado=>$pesos) {
    $zone_id = getZoneId($estado);
    $city = getCities($zone_id);
    $city = utf8_decode($city['name']);
    foreach ($pesos as $cidade => $peso) {
        $sql  = "INSERT INTO oc_weight_region SET ";
        $sql .= " weight_geo_zone_id = '5', ";
        $sql .= " weight_country_id = '30', ";
        $sql .= " weight_zone = '{$estado}', ";
        $sql .= " weight_zone_id = '{$zone_id}', ";
        if ($cidade == $city) {
            $city = $city;
        } else {
            $city = 'Interior';
        }

        $x=0;
        $rate = array();
        foreach ($peso as $p => $v) {
            $valor = str_replace(',', '.', str_replace('.', '', $v));
            if ($x % 2 == 0) {
                $pp = explode('_', $p);
                $rate[] = $pp[0].($x>0?'.1':'').':'.$valor;
                $rate[] = $pp[1].':'.$valor;
            } else {
                $pp = explode('_', $p);
                $rate[] = $pp[0].'.1:'.$valor;
                $rate[] = $pp[1].':'.$valor;
            }
            $x++;
        }
        $rate = implode(',', $rate);
        $sql .= " weight_city = '{$city}', ";
        $sql .= " weight_rate = '{$rate}'";
        $sql .= ";\n";
        echo $sql;
    }

}
