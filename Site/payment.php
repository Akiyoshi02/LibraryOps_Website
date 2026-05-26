<?php include('layouts/header.php');?>

<?php 

if(isset($_POSTp['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
}


?>

<section class="payment-section" margin>
    <div class="payment-container-title">
        <h2 class="payment-title">Payment</h2>
        <hr class="divider">
    </div>
    <div class="payment-container-content">

        <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
            <p class="payment-text">Total payment: Rs. <?php  echo $_SESSION['total']; ?></p>
            <input class="payment-btn" type="submit" value="Pay Now">
        
        <?php } elseif(isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
            <p class="payment-text">Total payment: Rs. <?php  echo $_POST['order_total_price']; ?></p>
            <input class="payment-btn" type="submit" value="Pay Now">

        <?php } else { ?>
            <p class="payment-text">You don't have an order</p>
        <?php } ?>

    </div>
</section>

<?php include('layouts/footer.php');?>

