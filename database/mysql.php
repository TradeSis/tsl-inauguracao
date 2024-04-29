<?php
// helio 01022023 usando conexaoMysql com parametros de banco
// helio 01022023 retirado global conexao, criado funcao conectaMysql
function conectaMysql($idEmpresa=null)
{
    $dadosConexao = defineConexaoMysql();
    $host       = $dadosConexao['host'];
    $base       = $dadosConexao['base'];
    $usuario    = $dadosConexao['usuario'];
    $senhabd    = $dadosConexao['senhadb'];
    $conexao    = mysqli_connect($host,$usuario,$senhabd,$base);
    
   
    if (isset($idEmpresa)) {
        $empresa = array();
        $sql = "SELECT * FROM empresa where empresa.idEmpresa = " . $idEmpresa;
        $buscar = mysqli_query($conexao, $sql);
        while ($row = mysqli_fetch_array($buscar, MYSQLI_ASSOC)) {
          array_push($empresa, $row);
        }
        $empresa = $empresa[0];
        $host       = $empresa['host'];
        $base       = $empresa['base'];
        if ( $empresa['usuario']!="") {
          $usuario    = $empresa['usuario'];
        }
        if ( $empresa['senhadb']!="") {
          $senhabd    = $empresa['senhadb'];
        }

        $conexao    = mysqli_connect($host,$usuario,$senhabd,$base);

    } 


    
    return $conexao;

}

?>
