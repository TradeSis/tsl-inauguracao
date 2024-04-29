<?php
// helio 21032023 - chamaAPI, mudanca definição do primeiro parametro, ele será a URL, caso passado
// helio 03022023 alterado de if api para case(switch)
// helio 01022023 usando padrao defineConexaoApi
// helio 31012023 16:16 -  criado

function chamaAPI ($URL,$apiUrlParametros,$apiEntrada,$apiMethod, $apiHeaders = null) {

	if ($URL) {
		$apiIP=$URL;
	} else {
		$apiIP = defineConexaoApi();
	}
	
	$apiRetorno = array();
    
	// retirado switch, que testava o primeiro parametro
    $apiUrl = $apiIP.$apiUrlParametros;  
	
	if(!isset($apiHeaders)){
		$apiHeaders = array(
			"Content-Type: application/json"
		);
	}
	
	
 	$apiCurl = curl_init($apiUrl);
	curl_setopt($apiCurl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($apiCurl, CURLOPT_CUSTOMREQUEST, $apiMethod);
	curl_setopt($apiCurl, CURLOPT_HTTPHEADER, $apiHeaders );
	
    /* helio 26.04.2023 incluido parametros */
    curl_setopt($apiCurl, CURLOPT_ENCODING, '' );
    curl_setopt($apiCurl, CURLOPT_MAXREDIRS, 10 );
    curl_setopt($apiCurl, CURLOPT_SSL_VERIFYHOST, false );
    curl_setopt($apiCurl, CURLOPT_SSL_VERIFYPEER, false );
    /**/

	if (isset($apiEntrada)) { 
		/* echo json_encode($apiEntrada);
		return; */
		curl_setopt($apiCurl, CURLOPT_POSTFIELDS, $apiEntrada); 
	}

	$apiResponse = curl_exec($apiCurl);
	$apiInfo     = curl_getinfo($apiCurl);

	curl_close($apiCurl);
          
	//if ($apiInfo['http_code'] == 200) {
		$apiRetorno = json_decode($apiResponse, true);
	//}
	return $apiRetorno;

}

?>


