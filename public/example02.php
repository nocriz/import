<?php

require __DIR__.'/../app/bootstrap.php';

$file_path = __DIR__ . DS . 'uploads' . DS . 'con_usuarios.csv';

/*
 *   Exporta dados do banco de dados para um arquivo
 */
$importer = new Nocriz\Import\Importer();

/*
* Define o algoritimo de exportação a ser utilizado
*/
$importer->addAlgorithm( new Nocriz\Import\Algorithm\AlgorithmCSV() );
$importer->import( new Nocriz\Import\Container( $file_path ) );

$columns = $importer->data[0];
unset($importer->data[0]);
$columns = array_merge($columns, $importer->data[1]);
unset($importer->data[1]);

d($columns);

function onlynumber($string) {
    return preg_replace('/\D/', '', $string);
}

ini_set('memory_limit', '256M');
$clientes = array();
foreach ($importer->data as $key => $cliente) {
    $id = null;
    if (isset($cliente[1]) && strlen($cliente[1])>0 && $cliente[1] !== '' && !is_null($cliente[1])) {
        $id = (int)strip_tags($cliente[1]);
        if (isset($id) && $id > 0) {
            $input = array();
            $input['debug'] = true;
            $input['user'] = isset($cliente[3]) ? trim(strip_tags($cliente[3])) : null;
            $input['password'] = isset($cliente[4]) ? trim(strip_tags($cliente[4])) : null;
            $input['password_confirmation'] = $input['password'];
            $input['nome'] = isset($cliente[6]) ? trim(strip_tags($cliente[6])) : null;
            $input['created_at'] = isset($cliente[7]) ? trim(strip_tags($cliente[7])) : null;
            $input['email'] = isset($cliente[8]) ? trim(strip_tags($cliente[8])) : null;
            $input['email_confirmation'] = $input['email'];
            $input['doc'] = isset($cliente[10]) ? onlynumber((string)trim(strip_tags($cliente[10]))) : null;
            $input['atuacao'] = isset($cliente[11]) ? trim(strip_tags($cliente[11])) : null;
            $input['endereco_comercial']['rua'] = isset($cliente[12]) ? trim(strip_tags($cliente[12])) : null;
            $input['endereco_comercial']['numero'] = isset($cliente[13]) ? trim(strip_tags($cliente[13])) : null;
            $input['endereco_comercial']['complemento'] = isset($cliente[14]) ? trim(strip_tags($cliente[14])) : null;
            $input['endereco_comercial']['bairro'] = isset($cliente[15]) ? trim(strip_tags($cliente[15])) : null;
            $input['endereco_comercial']['cep'] = isset($cliente[17]) ? onlynumber((string)trim(strip_tags($cliente[17]))) : null;
            $input['endereco_comercial']['cidade'] = isset($cliente[18]) ? trim(strip_tags($cliente[18])) : null;
            $input['endereco_comercial']['uf'] = isset($cliente[19]) ? trim(strip_tags($cliente[19])) : null;

            $input['telefone_comercial'] = isset($cliente[20]) ? onlynumber(trim(strip_tags($cliente[20]))) : null;
            $input['telefone_comercial_ramal'] = isset($cliente[21]) ? onlynumber(trim(strip_tags($cliente[21]))) : null;
            $input['telefone_comercial_fax'] = isset($cliente[22]) ? onlynumber(trim(strip_tags($cliente[22]))) : null;
            $input['telefone_comercial_celular'] = isset($cliente[23]) ? onlynumber(trim(strip_tags($cliente[23]))) : null;

            $input['endereco_residencial']['rua'] = isset($cliente[25]) ? trim(strip_tags($cliente[25])) : null;
            $input['endereco_residencial']['numero'] = isset($cliente[26]) ? trim(strip_tags($cliente[26])) : null;
            $input['endereco_residencial']['complemento'] = isset($cliente[27]) ? trim(strip_tags($cliente[27])) : null;
            $input['endereco_residencial']['bairro'] = isset($cliente[28]) ? trim(strip_tags($cliente[28])) : null;
            $input['endereco_residencial']['cep'] = isset($cliente[30]) ? onlynumber((string)trim(strip_tags($cliente[30]))) : null;
            $input['endereco_residencial']['cidade'] = isset($cliente[31]) ? trim(strip_tags($cliente[31])) : null;
            $input['endereco_residencial']['uf'] = isset($cliente[32]) ? trim(strip_tags($cliente[32])) : null;

            $input['telefone_pessoal'] = isset($cliente[33]) ? onlynumber(trim(strip_tags($cliente[33]))) : null;
            $input['telefone_pessoal_fax'] = isset($cliente[35]) ? onlynumber(trim(strip_tags($cliente[35]))) : null;
            $input['telefone_pessoal_celular'] = isset($cliente[36]) ? onlynumber(trim(strip_tags($cliente[36]))) : null;
            $input['oab'] = isset($cliente[39]) ? trim(strip_tags($cliente[39])) : null;
            $clientes[$id] = new Cadastro\Cliente($input);
        }
    }
}

d($clientes);

function d($dump) {
    echo "<pre>";
    echo var_dump($dump);
    echo "</pre>";
}