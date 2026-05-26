<?php include('layouts/header.php'); ?>

<?php 

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;
}

if(isset($_GET['order_id'])){
  $order_id = $_GET['order_id'];
  $stmt = $conn -> prepare("SELECT * FROM orders WHERE order_id = ?");
  $stmt -> bind_param('i', $order_id);
  $stmt -> execute();

  $order = $stmt -> get_result();

}elseif(isset($_POST['edit_order'])){

  $order_status = $_POST['order_status'];
  $order_id = $_POST['order_id'];

  $stmt = $conn->prepare("UPDATE orders SET order_status = ?  WHERE order_id = ?");
  $stmt -> bind_param('si', $order_status, $order_id);

  if($stmt -> execute()){
      header('location: orders.php?order_updated=Order has been updated successfully');
  }else{
      header('location: orders.php?order_falied=Error occured, try again');
  }

}else{
  header('location: order.php');
  exit;
}

?>

    <section class="dashboard-section">

    <div class="dashboard-content">
        <div class="product-container mt-5">
            <div class="overview-section">
                <div class="title custom-flex-center">
                    <h1>Edit Order</h1>
                </div>
            </div>

            <form enctype="multipart/form-data" method="POST" action="edit_order.php" class="custom-form">
            <?php foreach($order as $r) { ?>
                <div class="form-group">
                    <label for="orderId" class="form-label">Order ID</label>
                    <input type="text" class="form-control" id="orderId" value="<?php echo $r['order_id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="orderPrice" class="form-label">Order Price</label>
                    <input type="text" class="form-control" id="orderPrice" value="<?php echo $r['order_cost']; ?>" readonly>
                </div>

                <input type="hidden" name="order_id" value="<?php echo $r['order_id']; ?>">

                <div class="form-group">
                    <label for="orderStatus" class="edit-form-label">Order Status</label>
                    <select class="edit-select" id="orderStatus" name="order_status" required>
                        <option value="not paid" <?php if($r['order_status'] == 'not paid') { echo "selected"; } ?>>Not Paid</option>
                        <option value="paid" <?php if($r['order_status'] == 'paid') { echo "selected"; } ?>>Paid</option>
                        <option value="shipped" <?php if($r['order_status'] == 'shipped') { echo "selected"; } ?>>Shipped</option>
                        <option value="delivered" <?php if($r['order_status'] == 'delivered') { echo "selected"; } ?>>Delivered</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="orderDate" class="form-label">Order Date</label>
                    <input type="text" class="form-control" id="orderDate" value="<?php echo $r['order_date']; ?>" readonly>
                </div>

                <button type="submit" class="custom-btn" name="edit_order">Save Changes</button>
                <?php } ?>
            </form>
        </div>
    </div>
</section>

<?php include('layouts/footer.php'); ?>