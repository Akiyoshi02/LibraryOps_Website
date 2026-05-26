<?php include('layouts/header.php');?>

<?php 

    if(isset($_GET['product_category'])){
        $product_category = $_GET['product_category'];
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ?");
        $stmt->bind_param("s", $product_category);
        $stmt->execute();
        $for_category_product = $stmt->get_result();
    } else {
        header('Location: Site.php');
    }


?>

<main>

<section class="books-section">

            <div class="container py-4">
            <h2 class="section-title"><?php echo $product_category ?></h2>
            <div class="books-row">

            <?php while($row = $for_category_product->fetch_assoc()) { ?>                          

                    <div class="book-item">
                        <div class="book-card">
                            <div class="book-image">
                                <img src="images/Books/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" class="book-img">
                            </div>
                            <div class="book-details">
                                <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>" class="book-title"><?php echo $row['product_name']; ?></a>
                                <h4 class="book-author">By <?php echo $row['product_author']; ?></h4>
                                <a href="category_product.php?product_category=<?php echo $row['product_category']; ?>" class="book-category"><?php echo $row['product_category']; ?></a>
                                <p class="book-price"  style="color: coral;">Rs. <?php echo $row['product_price']; ?></p>
                                <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>" class="btn buy-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section> 

</main>

<?php include('layouts/footer.php');?>
