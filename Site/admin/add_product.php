<?php include('layouts/header.php'); ?>

<?php 

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
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

<section class="dashboard-section">

    <div class="dashboard-content">
        <div class="product-container mt-5">
            <div class="overview-section">
                <div class="title custom-flex-center">
                    <h1>Add Product</h1>
                </div>
            </div>

            <form enctype="multipart/form-data" method="POST" action="create_product.php" class="custom-form">
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="name" placeholder="Enter product title">
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter product description">
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter product price">
                    </div>
                    <div class="form-col">
                        <label for="specialOffer" class="form-label">Special Offer</label>
                        <input type="text" class="form-control" id="specialOffer" name="offer" placeholder="Enter special offer">
                    </div>
                </div>

    <div class="form-group">
        <label for="category" class="edit-form-label">Category</label>
        <select class="edit-form-select" id="category" name="category" onchange="toggleTextarea()">
        <?php
                include('get_category_products.php');
                while($row = $category_products->fetch_assoc()) {
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
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Enter product author">
                </div>
                <div class="form-group">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <button type="submit" class="custom-btn" name="create_product">Add Product</button>
            </form>
        </div>
    </div>
</section>

<?php include('layouts/footer.php'); ?>