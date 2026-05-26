<?php include('layouts/header.php');?>

<?php 


if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt = $conn -> prepare ("SELECT * FROM products WHERE product_id = ?");
    $stmt -> bind_param("i", $product_id);
    $stmt -> execute();
    $product = $stmt -> get_result();
} else {
    header('Location: Site.php');
}

?>

<main>
<div class="product-container mt-5">

        <div class="product-row">

            <?php while($row = $product -> fetch_assoc()) { ?>

                <div class="product-item">

                    <div class="product-details">
                        <div class="product-category">
                            <a href="category_product.php?product_category=<?php echo $row['product_category']; ?>" style="text-decoration: none; list-style: none;">
                                <span class="category-badge"><?php echo $row['product_category']; ?></span>
                            </a>
                        </div>

                        <h2 class="product-title"><?php echo $row['product_name']; ?></h2>

                        <p class="product-price"  style="color: coral;">Rs. <?php echo $row['product_price']; ?></p>

                        <strong><p class="product-description-title">Description</p></strong>

                        <p class="product-author">Author: <?php echo $row['product_author']; ?></p>

                        <p class="product-description"><?php echo $row['product_description']; ?></p>

                        <form class="add-to-cart-form" action="cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>"/>
                            <input type="hidden" name="product_image" value="<?php echo $row['product_image'];?>"/>
                            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                            <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>

                            <div class="form-outline">
                                <input type="number" name="product_quantity" value="1" min="1" class="quantity-input"/>
                            </div>
                            <button name="add_to_cart" class="btn add-to-cart-btn" type="submit">
                                Add to cart
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                    </div>

                    <div class="product-image">
                        <img src="images/Books/<?php echo $row['product_image'];?>" alt="<?php echo $row['product_name'];?>" class="image">
                    </div>

                </div>

            <?php } ?>
        </div>

        <hr/>

        <div class="category-row">
            <div class="category-column">
                <h4 class="category-title">Genres</h4>

                <?php include('server/get_category_products.php'); ?>
                <?php while($row = $category_products -> fetch_assoc()) { ?>
                    <a href="category_product.php?product_category=<?php echo $row['product_category']; ?>" class="category-link">
                        <span class="category-badge"><?php echo $row['product_category'];?></span>
                    </a>
                <?php } ?>
            </div>
        </div>

    </div>
</main>

<?php include('layouts/footer.php');?>
