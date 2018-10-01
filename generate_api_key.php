<?php 

include 'db/db_functions.php';

if($_GET['name'])
    DB::generate_api_key($_GET['name']);

?>