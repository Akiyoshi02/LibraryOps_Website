<?php 

include('../server/connection.php'); 

if(isset($_POST['update_image'])){

    $product_name = $_POST['product_name'];
    $product_id = $_POST['product_id'];

    //This is the file itself (image)
    $image = $_FILES['image']['tmp_name'];

    //Image name
    $product_image = $_FILES['image'] . ".jpg";

    //Upload image
    move_uploaded_file($image, "../Images/Books/". $product_image);

    $stmt = $conn -> prepare("UPDATE products SET product_image = ? WHERE product_id = ?");

    $stmt -> bind_param('si', $product_image, $product_id);

if($stmt -> execute()){
    header('location: products.php?image_updated=Image have been updated sucessfully');
}else{
    header('location: products.php?image_failed=Error occured, try again');
}

}


?>