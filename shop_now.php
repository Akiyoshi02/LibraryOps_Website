<?php include('layouts/header.php');?>

<?php 

//Use the search section
if(isset($_POST['search'])){

        //Determine page number
        if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
            //If user has already entered page then page number is the one that thay selected
            $page_no = $_GET['page_no'];
        }else{
            //If user just entered the page then default page is 1 
            $page_no = 1;
        }

        $category = $_POST['category'];
        $price = $_POST['price'];

            //Return number of products
        $stmt1 = $conn -> prepare("SELECT COUNT(*) AS total_records FROM products WHERE product_category=? AND product_price<=? ");
        $stmt1 -> bind_param("sd", $category, $price);
        $stmt1 -> execute();
        $stmt1 -> bind_result($total_records);
        $stmt1 -> store_result();
        $stmt1 -> fetch();
        
            //Products per page
    $total_records_per_page = 8;

    $offset = ($page_no - 1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $ad = "2";

    $total_no_of_products = ceil($total_records/$total_records_per_page);

        //Get all products 
        $stmt2 = $conn -> prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset, $total_records_per_page");
        $stmt2 -> bind_param("sd", $category, $price);
        $stmt2 -> execute();
        $products = $stmt2 -> get_result();

        //Return all products 
}else{

    //Determine page number
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //If user has already entered page then page number is the one that thay selected
        $page_no = $_GET['page_no'];
    }else{
        //If user just entered the page then default page is 1 
        $page_no = 1;
    }

    //Return number of products
    $stmt1 = $conn -> prepare("SELECT COUNT(*) AS total_records FROM products");
    $stmt1 -> execute();
    $stmt1 -> bind_result($total_records);
    $stmt1 -> store_result();
    $stmt1 -> fetch();

    //Products per page
    $total_records_per_page = 8;

    $offset = ($page_no - 1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $ad = "2";

    $total_no_of_products = ceil($total_records/$total_records_per_page);

    //Get all products 
    $stmt2 = $conn -> prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
    $stmt2 -> execute();
    $products = $stmt2 -> get_result();
}

?>

<main>

<section class="top-categories">
        <div class="container">
            <h2 class="section-title" style="margin-bottom: 20px">Top Categories</h2>

            <div class="row category-list">

                <?php include('server/get_category_products.php'); ?>
                <?php while($row = $category_products->fetch_assoc()) { ?>

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="category-card">
                            <div class="category-image">
                                <img src="images/Books/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_category']; ?>" class="img-fluid">
                            </div>
                            <div class="category-details">
                                <a href="category_product.php?product_category=<?php echo $row['product_category']; ?>" class="category-title"><?php echo $row['product_category']; ?></a>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>

        </div>
    </section>

    <section class="our-books" id="our-books-section"> 

        <div class="container-filter">
        <h2 class="section-title" style="margin-top: 20px">Our Books</h2>

        <form action="shop_now.php#our-books-section" method="POST" class="filter-form">
            <button class="custom-btn" type="button" data-toggle="collapse" data-target="#filterPanel" aria-expanded="false" aria-controls="filterPanel">
                <span>&#9776; Filter</span>
            </button>

            <div class="collapse-content collapse" id="filterPanel">
                <div class="custom-card">
                    <form id="filterForm">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="custom-select" id="category" name="category">
                                <?php include('server/get_category_products.php'); ?>
                                <?php while($row = $category_products->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['product_category']; ?>" <?php if(isset($category) && $category == $row['product_category']) { echo 'selected'; } ?>>
                                    <?php echo $row['product_category']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Price Range</label>
                            <input type="range" class="custom-range" id="price" name="price" min="0" max="10000" step="100" value="<?php if(isset($price)) { echo $price; } else { echo "1200"; } ?>">
                            <span id="priceValue"><?php if(isset($price)) { echo $price; } else { echo "1200"; } ?></span>
                        </div>

                        <button type="submit" name="search" class="custom-btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </form>
    </div>

            <section class="books-section">
            <div class="container py-4">
            <div class="books-row">

              <?php while($row = $products->fetch_assoc()) { ?>                       

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

        </div>
    </section>

</main>

<div class="pagination-container" >
        <div class="pagination-wrapper">
            <nav class="pagination-nav">
                <ul class="custom-pagination" id="custom-pagination">

                    <li class="custom-page-item <?php if($page_no <= 1) { echo 'disabled'; } ?>" id="prev">
                        <a class="custom-page-link" href="<?php if($page_no <= 1) { echo '#'; } else { echo "?page_no=" . ($page_no - 1) . "#our-books-section"; } ?>">Previous</a>
                    </li>

                    <li class="custom-page-item" id="page1"><a class="custom-page-link" href="?page_no=1#our-books-section">1</a></li>
                    <li class="custom-page-item" id="page2"><a class="custom-page-link" href="?page_no=2#our-books-section">2</a></li>
                    <li class="custom-page-item" id="page3"><a class="custom-page-link" href="?page_no=3#our-books-section">3</a></li>
                    <li class="custom-page-item" id="page4"><a class="custom-page-link" href="?page_no=4#our-books-section">4</a></li>

                    <?php if($page_no >= 5) { ?>
                    <li class="custom-page-item" id="ellipsis"><a class="custom-page-link" href="#">...</a></li>
                    <li class="custom-page-item" id="current-page"><a class="custom-page-link" href="<?php echo "?page_no="  . $page_no . "#our-books-section"; ?>"><?php echo $page_no; ?></a></li>
                    <?php } ?>

                    <li class="custom-page-item <?php if($page_no >= $total_records_per_page) { echo 'disabled'; } ?>" id="next">
                        <a class="custom-page-link" href="<?php if($page_no >= $total_records_per_page) { echo '#'; } else { echo "?page_no=" . ($page_no + 1) . "#our-books-section"; } ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    <script>
        document.getElementById('price').addEventListener('input', function() {
            document.getElementById('priceValue').textContent = this.value;
        });

        document.addEventListener('DOMContentLoaded', function () {
            var filterButton = document.querySelector('.custom-btn');
            var filterPanel = document.querySelector('#filterPanel');

            filterButton.addEventListener('click', function () {
                filterPanel.classList.toggle('show');
            });
        });
    </script>


<?php include('layouts/footer.php');?>
