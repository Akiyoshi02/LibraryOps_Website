<?php include('layouts/header.php');?>

<?php 

/*
not paid
paid
shipped
delivered
*/

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn -> prepare("SELECT * FROM order_items WHERE order_id = ?");

    $stmt -> bind_param('i', $order_id);

    $stmt -> execute();

    $order_details = $stmt -> get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);

}else{

    header('location: account.php');
    exit();
}

function calculateTotalOrderPrice($order_details) {
    $total = 0;

    foreach ($order_details as $row) {

        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price * $product_quantity);
    }
    return $total;

}


?>

<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-5">
        <h2 class="font-weight-bold text-center">Order Details</h2>
        <hr class="max-auto">
    </div>


<div class="cart-page-container">
        <table class="cart-page-table">
            <thead>
                <tr>
                    <th class="left-align">Product</th>
                    <th class="center-align">Price</th>
                    <th class="right-align">Quantity</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($order_details as $row) { ?>
            
                <tr>
                               
                    <td>
                        <div class="cart-item">
                            <img src="images/Books/<?php echo $row['product_image']; ?>" width="90px" height="120px">
                            <div class="cart-item-details">
                                <p><?php echo $row['product_name']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="left-align">
                        <span id="product_price">Rs. <?php echo $row['product_price']; ?></span>
                    </td>
                    <td class="right-align">
                        <span id="product_quantity"><?php echo $row['product_quantity']; ?></span>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php if($order_status == "not paid") { ?>

            <form method="POST" action="payment.php" class="payment-form">
    <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>">
    <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
    <button type="submit" name="order_pay_btn" class="pay-now-btn">Pay Now</button>
</form>

<?php } ?>
    </div>
</section>

<?php include('layouts/footer.php');?>
