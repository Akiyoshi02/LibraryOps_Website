<?php 

include('../server/connection.php'); 

if(isset($_POST['create_product'])){
    $product_name = $_POST['name'];
    $product_description = $_POST['description'];
    $product_price = $_POST['price'];
    $product_special_offer = $_POST['offer'];
    $product_author = $_POST['author'];

    $product_category = $_POST['category'];

    $otherCategory = isset($_POST['otherCategory']) ? trim($_POST['otherCategory']) : '';

    if ($product_category === 'other' && !empty($otherCategory)) {
        $product_category = $otherCategory;
    }


    //This is the file itself (image)
    $image = $_FILES['image']['tmp_name'];

    //Image name
    $product_image = $_FILES['image'] . ".jpg";

    //Upload image
    move_uploaded_file($image, "../images/Books/". $product_image);

    $stmt = $conn -> prepare("INSERT INTO products (product_name, product_description, product_price, product_special_offer, product_image, product_category, product_author)
    VALUES (? , ? , ? , ? , ? , ? , ?)");

$stmt -> bind_param('ssddsss', $product_name, $product_description, $product_price, $product_special_offer, $product_image, $product_category, $product_author);

if($stmt -> execute()){
    header('location: products.php?product_created=Product has been created sucessfully');
}else{
    header('location: products.php?product_failed=Error occured, try again');
}

}


?>
