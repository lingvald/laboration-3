<?php 

include '../db/db_functions.php';

$is_authorized = false;
$product_to_delete = $_GET['name'];
$ADMIN_API_KEY = $_GET['key'];
$key = DB::api_key_exists_in_db($ADMIN_API_KEY);

if($key['is_admin'])
    $is_authorized = true;

if($is_authorized == true){
    DB::delete_product($product_to_delete);
} else {
    print 'Du har inte behörighet att utföra detta.';
}

?>