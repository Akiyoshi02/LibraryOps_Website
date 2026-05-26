<?php include('layouts/header.php'); ?>

<?php 

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;
}

?>

<?php 

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];

}else{
        header('location: products.php');
    }
    

?>

<section class="dashboard-update">

    <div class="update-content">
        <div class="update-container mt-5">
            <div class="update-overview">
                <div class="update-title update-flex-center">
                    <h1>Update Product Image</h1>
                </div>
            </div>

            <form method="POST" action="update_image.php" enctype="multipart/form-data" class="update-form">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">

                <div class="form-group">
                    <label for="image" class="update-form-label">Image</label>
                    <input type="file" class="update-form-control" id="image" name="image" required>
                </div>

                <button type="submit" name="update_image" class="custom-btn">Update Image</button>
            </form>
        </div>
    </div>

</section>

<?php include('layouts/footer.php'); ?>