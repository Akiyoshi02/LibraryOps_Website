<?php

include('connection.php');

$stmt = $conn -> prepare ("SELECT product_category, MAX(product_image) AS product_image FROM products GROUP BY product_category;");

$stmt -> execute();

$category_products = $stmt -> get_result(); //Array

?>