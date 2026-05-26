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
        $stmt = $conn -> prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt -> bind_param('i', $product_id);
        $stmt -> execute();
        $products = $stmt -> get_result();

    }elseif(isset($_POST['edit_btn'])){

        $product_id = $_POST['product_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $offer = $_POST['offer'];
        $author = $_POST['author'];
        
        $category = $_POST['category'];

        $otherCategory = isset($_POST['otherCategory']) ? trim($_POST['otherCategory']) : '';

    if ($category === 'other' && !empty($otherCategory)) {
        $category = $otherCategory;
    }

        $stmt = $conn->prepare("UPDATE products SET product_name = ? , product_author = ? , product_category = ? , product_description = ? , product_price = ? , product_special_offer = ? WHERE product_id = ?");
        $stmt -> bind_param('ssssddi', $title, $author, $category, $description, $price, $offer, $product_id);

        if($stmt -> execute()){
            header('location: products.php?edit_success_message=Product has been updated successfully');
        }else{
            header('location: products.php?edit_faliure_message=Error occured, try again');
        }

    }else{
        header('location: products.php');
        exit;
    }
    

?>

<script>
        function toggleTextarea() {
            var categorySelect = document.getElementById('category');
            var otherText = document.getElementById('otherText');
            if (categorySelect.value === 'other') {
                otherText.style.display = 'block';
            } else {
                otherText.style.display = 'none';
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            toggleTextarea();
        });
    </script>

<section class="edit-dashboard">

    <div class="edit-dash-content">
        <div class="edit-container mt-5">
            <div class="edit-overview">
                <div class="edit-title edit-flex-center">
                    <h1>Edit Product</h1>
                </div>
            </div>

            <form method="POST" action="edit_product.php" enctype="multipart/form-data" class="edit-form">
                <?php foreach($products as $product) { ?>

                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                
                <div class="form-group">
                    <label for="title" class="edit-form-label">Title</label>
                    <input type="text" class="edit-form-control" id="title" name="title" value="<?php echo $product['product_name']; ?>">
                </div>

                <div class="form-group">
                    <label for="description" class="edit-form-label">Description</label>
                    <input class="edit-form-control" id="description" rows="3" name="description" value="<?php echo $product['product_description']; ?>">
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label for="price" class="edit-form-label">Price</label>
                        <input type="text" class="edit-form-control" id="price" name="price" value="<?php echo $product['product_price']; ?>">
                    </div>
                    <div class="form-col">
                        <label for="offer" class="edit-form-label">Offer</label>
                        <input type="text" class="edit-form-control" id="offer" name="offer" value="<?php echo $product['product_special_offer']; ?>">
                    </div>
                </div>

                <div class="form-group">
        <label for="category" class="edit-form-label">Category</label>
        <select class="edit-form-select" id="category" name="category" onchange="toggleTextarea()">
        <?php
                include('get_category_products.php');
                while ($row = $category_products->fetch_assoc()) {
                    $selected = isset($category) && $category == $row['product_category'] ? 'selected' : '';
                    echo "<option value='{$row['product_category']}' {$selected}>{$row['product_category']}</option>";
                }
                ?>
            <option value="other">Other</option>
        </select>
    </div>
    <div class="form-group" id="otherText" style="display:none;">
        <label for="other-category" class="edit-form-label">New Category</label>
        <input type="text" class="edit-form-" id="other-category" name="otherCategory" placeholder="Enter new category"></input>
    </div>

                <div class="form-group">
                    <label for="author" class="edit-form-label">Author</label>
                    <input type="text" class="edit-form-control" id="author" name="author" value="<?php echo $product['product_author']; ?>">
                </div>

                <button type="submit" name="edit_btn" class="custom-btn">Save Changes</button>

                <?php } ?>
            </form>
        </div>
    </div>
</section>

<?php include('layouts/footer.php'); ?>