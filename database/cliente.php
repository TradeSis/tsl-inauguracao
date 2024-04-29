<?php
//Lucas 26122023 criado
include_once __DIR__ . "/../conexao.php";

//LOG
$LOG_CAMINHO = defineCaminhoLog();
if (isset($LOG_CAMINHO)) {
	$identificacao = date("dmYHis") . "-PID" . getmypid() . "-" . "cliente";
	$arquivo = fopen(defineCaminhoLog() . "cliente_" . date("dmY") . ".log", "a");
}
//LOG

if (isset($_GET['operacao'])) {
	
	$operacao = $_GET['operacao'];
	
	if ($operacao == "cadastrar") {
		$apiEntrada = 
		array("dadosEntrada" => array(
			array('codigoFilial' => $_POST['codigoFilial'],
			'cpfCnpj' => $_POST['cpfCnpj'],
			'nomeCliente' => $_POST['nomeCliente'],
			'dataNascimento' => $_POST['dataNascimento'],
			'telefone' => $_POST['telefone'])
		));

        setcookie('codigoFilial', $_POST['codigoFilial'], strtotime("+1 year"), "/", "", false, true );

		//LOG
		fwrite($arquivo, $identificacao . "_cadastro-ENTRADA->" . json_encode($apiEntrada) . "\n");
		//LOG
		
        $cliente = chamaAPI(null, '/lojas/cliente', json_encode($apiEntrada), 'PUT');

		//LOG
		fwrite($arquivo, $identificacao . "_cadastro-SAIDA->" . json_encode($cliente) . "\n");
		//LOG

		if (isset($cliente["cliente"])) {
			$codigoCliente = $cliente["cliente"][0]["codigoCliente"];
			$response = array(
				"status" => 200,
				"retorno" => "Cliente " . $_POST['cpfCnpj'] . " " . $_POST['nomeCliente'] . " cadastrado no codigo " . $codigoCliente
			);
		} else {
			if($cliente['status'] == 500){
				$response = array(
					"status" => 500,
					"retorno" => "Dados Invalidos"
				);
			} else {
				$response = $cliente;
			}
		} 

        header('Location: ../cliente_retorno.php?retorno=' . $response['retorno']);
	}
	
	if ($operacao == "busca") {
		
		$apiEntrada = 
		array("dadosEntrada" => array(
			array('codigoFilial' => $_POST['codigoFilial'],
			'codigoCliente' => null,
			'cpfCnpj' => $_POST['cpfCnpj'],)
		));
		
		setcookie('codigoFilial', $_POST['codigoFilial'], strtotime("+1 year"), "/", "", false, true );
		
		$cliente = chamaAPI(null, '/lojas/cliente', json_encode($apiEntrada), 'GET');

		if (isset($cliente["cliente"])) {
			$codigoCliente = $cliente["cliente"][0]["codigoCliente"];
			$cpfCnpj = $cliente["cliente"][0]["cpfCnpj"];
			$response = array(
				"status" => 200,
				"retorno" => "Cliente CPF " . $cpfCnpj . " possui cadastro, codigo: " . $codigoCliente
			);
		} else {
			$response = $cliente;
		}
		
		echo json_encode($response);
		return $response;

	}
}
