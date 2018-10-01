<?php

class DB {

    function connect_to_db(){
        return new mysqli('localhost', 'admin_user', 'admin1234', 'fish_market');
    }

    function get_all_products_from_db() {
        $products = [];
        $conn = DB::connect_to_db();
        mysqli_set_charset( $conn, 'utf8');
        if ($conn->connect_error)
            exit('Kunde inte ansluta. ' . $conn->connect_error);
    
        $result = $conn->query("SELECT * FROM `products` utf8_bin");
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        return $products;
    }

    function delete_product($product_to_delete){
        $conn = DB::connect_to_db();
        mysqli_set_charset( $conn, 'utf8');
        if ($conn->connect_error)
            exit('Kunde inte ansluta. ' . $conn->connect_error);
    
        $result = $conn->query("DELETE FROM `products` WHERE `name`='$product_to_delete'");
        if($result){
            print "'$product_to_delete' raderades från databasen med ett lyckat resultat.";
        }
        $conn->close();
    }

    function update_product($product_to_update, $what_to_update, $update_to){
        $conn = DB::connect_to_db();
        mysqli_set_charset( $conn, 'utf8');
        if ($conn->connect_error)
            exit('Kunde inte ansluta. ' . $conn->connect_error);
    
        $result = $conn->query("UPDATE `products` SET $what_to_update='$update_to' WHERE `name`='$product_to_update'");
        if($result){
            print_r($result);
        }
        $conn->close();
    }

    function generate_api_key($name){
        $key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
        $username = str_replace(' ', '', $name);
        $username = strtolower($username);
        $date = date('Y-m-d H:i:s');
    
        $conn = DB::connect_to_db();
        mysqli_set_charset( $conn, 'utf8');
        
        if ($conn->connect_error)
            die('Kunde inte ansluta. ' . $conn->connect_error);
        
        $result = $conn->query("INSERT INTO `api_keys`(`api_key`, `name`, `date`) 
        VALUES ('$key', '$username', '$date')");
        
        if($result){
            print 'Ny API-Nyckel genererad åt ' . $name;
            print '<br>';
            print $key;
        } else {
            print 'error';
        }
        
        $conn->close();
    }

    function api_key_exists_in_db($API_KEY){
        $conn = DB::connect_to_db();
        if ($conn->connect_error)
        exit('Kunde inte ansluta. ' . $conn->connect_error);
        $result = $conn->query("SELECT `api_key`, `name`, `is_admin` FROM `api_keys` WHERE `api_key`='$API_KEY'");
        $API_KEY_INFORMATION = $result->fetch_assoc();
        $conn->close();
        return $API_KEY_INFORMATION;
    }

}

?>