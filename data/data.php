<?php
include '../db/db_functions.php';

function get_products($name){
    
    $single_product = false;
    
    $product = [];
    
    $conn = DB::connect_to_db();

    mysqli_set_charset($conn, "utf8");

    if ($conn->connect_error)
    die('Kunde inte ansluta. ' . $conn->connect_error);
    
    if (!in_array($name, ['fisk', 'tillbehör', 'skaldjur', 'alla'])){
        $result = $conn->query("SELECT * FROM `products` WHERE name='$name'");
        $single_product = true;
    } elseif ($name == 'alla'){
        $result = $conn->query("SELECT * FROM `products`");
    } else {
        $result = $conn->query("SELECT * FROM `products` WHERE category='$name'");
    }

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($single_product == true){
                $product = $row;
            } else {
                $product[] = $row;
            }
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    return $product;
}

?>