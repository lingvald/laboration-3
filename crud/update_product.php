<?php 

include 'db/db_functions.php';

$is_authorized = false;
$product_to_update = $_GET['name'];
$what_to_update = $_GET['what_to_update'];
$update_to = $_GET['update_to'];


$ADMIN_API_KEY = $_GET['key'];
$key = DB::api_key_exists_in_db($ADMIN_API_KEY);


print 'produkt att uppdatera: ' . $product_to_update;
print '<br>';
print 'vad som ska uppdateras: ' . $what_to_update;
print '<br>';
print 'vad det ska uppdateras till: ' . $update_to . $ADMIN_API_KEY;


// if($key && $key['name'] == 'admin')
//     $is_authorized = true;

// if($is_authorized == true){
//     print 'test';
// } else {
//     print 'Du har inte behörighet att utföra detta.';
// }
?>