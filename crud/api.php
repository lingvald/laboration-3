<?php

header("Content-Type:application/json", "charset=utf-8");

require "../data/data.php";


$API_KEY = $_GET['key'];
$is_authorized = false;

if(DB::api_key_exists_in_db($API_KEY))
	$is_authorized = true;

if($is_authorized == false){
	echo 'Du har inte angett en giltlig nyckel.';
	exit;
}

if(!empty($_GET['name']) && $is_authorized == true){

	$name = $_GET['name'];

	$name = mb_strtolower($name,'UTF-8');
	
	$product = get_products($name);
	if(empty($product)){
		response(200,"Produkten Hittades Inte",NULL);
	} else {
		response(200,"Produkt Hittad",$product);
	}
	
} else {
	response(400,"Invalid Request",NULL);
}

function response($status, $message, $data){

	header("HTTP/1.1 " . $status);
	
	$response['status'] 		= $status;
	$response['message'] 		= $message;
	$response['data'] 			= $data;
	$json 						= json_encode($response);
	echo $json;
}

?>