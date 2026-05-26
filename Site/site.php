<?php include('layouts/header.php');?>

<main>
    <section class="banner">
        <img src="Images\bookicon.png" width="200" height="100">
        <h1><font color="#000000">Journey Through the Written Word</font></h1>
        <a href="shop_now.php"><button type="button" class="overall-btn">Shop Now</button></a>
    </section>

    <section class="bottom">
        <div class="up">
            <h1>Deciding what to read next?</h1>
            <p>You’re in the right place. Tell us what titles or genres you’ve enjoyed in the past, and we’ll give you surprisingly insightful recommendations.</p>
        </div>
        <div class="space"></div>
        <div class="down">
            <h1>Quotes</h1>
            <img src="Images/purkey.jpg" width="80" height="80">
            <p>“You've gotta dance like there's nobody watching, Love like you'll never be hurt, Sing like there's nobody listening, And live like it's heaven on earth.” </p>
            <p1>― William W. Purkey</p1>
        </div>
    </section>

    <section class="books-section">
        <div class="container py-4">
            <br>
            <h1 class="section-title">Books</h1>
            <br>
            <div class="books-row">

                <?php include('server/get_offer_products.php'); ?>
                <?php while($row = $offer_products -> fetch_assoc()) { ?>                        

                    <div class="book-item">
                        <div class="book-card">
                            <div class="book-image">
                                <img src="Images/Books/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" class="book-img">
                            </div>
                            <div class="book-details">
                                <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>" class="book-title"><?php echo $row['product_name']; ?></a>
                                <h4 class="book-author">By <?php echo $row['product_author']; ?></h4>
                                <a href="category_product.php?product_category=<?php echo $row['product_category']; ?>" class="book-category"><?php echo $row['product_category']; ?></a>
                                <p class="book-price" style="color: #999999;"><s>Rs. <?php echo $row['product_price']; ?></s></p>
                                <p class="book-offer-price" style="color: coral;">Rs. <?php echo $row['product_special_offer']; ?></p>
                                <p style="font-size: 40px;"><i class="fa-brands fa-salesforce"></i></p>
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
