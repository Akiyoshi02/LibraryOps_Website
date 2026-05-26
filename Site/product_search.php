<?php
session_start();
include('server/connection.php');

if(isset($_GET['search_for_books'])) {
    $search_term = $_GET['search_for_books'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ?");
    $stmt->bind_param("s", $search_term);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header("Location: single_product.php?product_id=".$row['product_id']);
        exit();
        
    } else {
        echo '<script>alert("No books found matching your search term.");</script>';
        echo '<script>window.location.href = "site.php";</script>';
        exit();
    }
} else {
    echo '<script>alert("Please enter a search term.");</script>';
    echo '<script>window.location.href = "site.php";</script>';
    exit();
}
?>
