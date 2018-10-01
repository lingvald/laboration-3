<?php
include '../db/db_functions.php';

function reset_products(){
    $conn = DB::connect_to_db();

    

    mysqli_set_charset( $conn, 'utf8');
    if ($conn->connect_error)
        exit('Kunde inte ansluta. ' . $conn->connect_error);

    $conn->query('TRUNCATE TABLE `products`;');

    $result = $conn->query("INSERT INTO `products`(`name`, `category`, `price`, `calories`, `fat_content`, `cholesterol`) 
    VALUES 
    ('torskrygg', 'fisk', '188', 78, 0.5, 48.4),
    ('lax', 'fisk', '399', 181, 12, 70),
    ('kolja', 'fisk', '128', 90, 0.8, 76.6),
    ('öring', 'fisk', '190', 110, 3.3, 50),
    ('räka', 'skaldjur', '280', 77, 0.6, 147),
    ('havskräfta', 'skaldjur', '300', 106, 0.9, 140),
    ('aioli', 'tillbehör', '102', 703, 77, 300),
    ('fiskrom', 'tillbehör', '999', 120, 2.3, 360),
    ('sill', 'fisk', '70', 148, 9.1, 57),
    ('gös', 'fisk', '305', 84, 0.2, 63.2),
    ('röding', 'fisk', '390', 152, 7.9, 57.8),
    ('hälleflundra', 'fisk', '358', 145, 5.9, 61.1),
    ('tonfisk', 'fisk', '252', 138, 4.9, 38),
    ('gädda', 'fisk', '300', 107, 0.3, 59.3),
    ('braxen', 'fisk', '1000', 103, 4, 60),
    ('makrill', 'fisk', '72', 215, 15.1, 48.8),
    ('rödspätta', 'fisk', '258', 91, 0.6, 55.9),
    ('sej', 'fisk', '331.7', 82, 0.5, 58.6),
    ('tilapia', 'fisk', '510', 87, 1.6, 47),
    ('hummer', 'skaldjur', '378', 86, 1.9, 129),
    ('skagenröra', 'tillbehör', '149', 188, 13.1, 154.1),
    ('krabba', 'skaldjur', '429', 87, 1.9, 100)");

    if($result){
        print 'Produkter tillagda';
    } else {
        print 'Ett problem inträffade';
    }

}
reset_products();

?>