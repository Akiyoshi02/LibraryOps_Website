<?php include('layouts/header.php'); ?>

<?php 

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;
}

?>

<?php 
    
    //Determine page number
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //If user has already entered page then page number is the one that thay selected
        $page_no = $_GET['page_no'];
    }else{
        //If user just entered the page then default page is 1 
        $page_no = 1;
    }

        //Return number of products
    $stmt1 = $conn -> prepare("SELECT COUNT(*) AS total_records FROM orders");
    $stmt1 -> execute();
    $stmt1 -> bind_result($total_records);
    $stmt1 -> store_result();
    $stmt1 -> fetch();
    
            //Products per page
    $total_records_per_page = 10;

    $offset = ($page_no - 1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $ad = "2";

    $total_no_of_products = ceil($total_records/$total_records_per_page);

        //Get all products 
        $stmt2 = $conn -> prepare("SELECT * FROM orders LIMIT $offset, $total_records_per_page");
        $stmt2 -> execute();
        $orders = $stmt2 -> get_result();

?>

<section class="dashboard-section">

<div class="dashboard-content">
    <div class="product-container mt-5">

        <div class="dashboard-overview">
            <div class="dashboard-title custom-flex-center">
                <h1>Orders</h1>
            </div>

            <?php if(isset($_GET['order_updated'])) { ?>
                <p class="massage-message massage-text-green center-message"><?php echo $_GET['order_updated'] ?></p>
            <?php } ?>

            <?php if(isset($_GET['order_failed'])) { ?>
                <p class="massage-message massage-text-red center-message"><?php echo $_GET['order_failed'] ?></p>
            <?php } ?>

            <?php if(isset($_GET['order_delete_successfully'])) { ?>
                <p class="massage-message massage-text-green center-message"><?php echo $_GET['order_delete_successfully'] ?></p>
            <?php } ?>

            <?php if(isset($_GET['order_delete_faliure'])) { ?>
                <p class="massage-message massage-text-red center-message"><?php echo $_GET['order_delete_faliure'] ?></p>
            <?php } ?>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>User ID</th>
                    <th>User Phone</th>
                    <th>User Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach($orders as $order) { ?>

                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['order_status']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['user_id']; ?></td>
                    <td><?php echo $order['user_phone']; ?></td>
                    <td><?php echo $order['user_address']; ?></td>
                    <td><a class="blue-btn" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a></td>
                    <td><a class="red-btn" href="delete_order.php?order_id=<?php echo $order['order_id']; ?>">Delete</a></td>
                </tr>

            <?php } ?>

            </tbody>
        </table>

        <div class="pagination-container">
    <ul class="pagination" id="pagination">

        <li class="page-item <?php if($page_no <= 1) { echo 'disabled'; } ?>" id="prev">
            <a class="page-link" href="<?php if($page_no <= 1) { echo '#'; } else { echo "?page_no=".$page_no-1; } ?>">Previous</a>
        </li>

        <li class="page-item" id="page1"><a class="page-link" href="?page_no=1">1</a></li>
        <li class="page-item" id="page2"><a class="page-link" href="?page_no=2">2</a></li>
        <li class="page-item" id="page3"><a class="page-link" href="?page_no=3">3</a></li>

        <?php if($page_no >= 4) { ?>
            <li class="page-item" id="page3"><a class="page-link" href="#">...</a></li>
            <li class="page-item" id="page3"><a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
        <?php } ?>

        <li class="page-item <?php if($page_no >= $total_records_per_page) { echo 'disabled'; } ?>" id="next">
            <a class="page-link" href="<?php if($page_no >= $total_records_per_page) { echo '#'; } else { echo "?page_no=".$page_no+1; } ?>">Next</a>
        </li>
    </ul>
</div>

</section>

<?php include('layouts/footer.php'); ?>

