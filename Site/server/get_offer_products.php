<?php

include('connection.php');

$stmt = $conn -> prepare ("SELECT * FROM products WHERE product_special_offer > 0");

$stmt -> execute();

$offer_products = $stmt -> get_result(); //Array

?>