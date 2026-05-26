<?php include('layouts/header.php');?>

<?php

if (!isset($_SESSION["user_email"])) {
    header('Location: sign_in.php');
    exit;
}

if(isset($_GET['logout'])){
    if(isset($_SESSION['user_email'])){
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: sign_in.php');
        exit;
    }
}

if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    // If password don't match
    if($password !== $confirmPassword){
        header('location: account.php?error=Passwords dont match');

    // If password is less than 6 characters
    } else if(strlen($password) < 6){
        header('location: account.php?error=Password must be at least 6 characters');

    } else {
        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('ss', $hashed_password, $user_email);
        
        if($stmt->execute()){
            header('location: account.php?message=Password has been updated successfully');
        } else {
            header('location: account.php?error=Could not update password');
        }
    }
}

//Get orders
if(isset($_SESSION['user_email'])){
    
    $user_id = $_SESSION['user_id'];
    $stmt = $conn -> prepare ("SELECT * FROM orders WHERE user_id = ? ");

    $stmt -> bind_param('i', $user_id);

    $stmt -> execute();

    $orders = $stmt -> get_result();

}

?>


    <div class="account-section">

        <div class="account-info">
            <h2 class="section-title">Account Information</h2>
            <hr class="divider" style="margin-bottom: 20px;">
            <p class="info-item"><strong>Name: </strong><span><?php if(isset($_SESSION["user_name"])){echo $_SESSION["user_name"];}?></span></p>
            <p class="info-item"><strong>Email: </strong><span><?php if(isset($_SESSION["user_email"])){echo $_SESSION["user_email"];}?></span></p>
            <p class="info-item"><a href="#orders" style="text-decoration: none; color: #9999;" onmouseover="this.style.color='coral'" onmouseout="this.style.color='#9999'">Your orders</a></p>
            <p class="info-item"><a href="account.php?logout=1" style="text-decoration: none; color: #9999;" onmouseover="this.style.color='coral'" onmouseout="this.style.color='#9999'">Logout</a></p>
            <p class="error-message"><?php if(isset($_GET['error'])){echo $_GET['error']; } ?></p>
            <p class="success-message"><?php if(isset($_GET['message'])){echo $_GET['message']; } ?></p>
        </div>

        <div class="change-password">
            <h2 class="section-title">Change Password</h2>
            <hr class="divider"  style="margin-bottom: 20px;">
            <form id="change-password-form" method="POST" action="account.php">
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="password" class="form-control" placeholder="New Password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirmPassword" class="form-control" placeholder="Confirm Password">
                </div>
                <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>

<section id="orders" class="orders container my-5 py-3">
<div class="orders-container">
        <div class="orders-heading">
            <h2 class="orders-title">Your Orders</h2>
            <hr class="divider">
        </div>
    </div>

    <div class="cart-page-container">
        <table class="cart-page-table">
            <tr>
                <th>Order ID</th>
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th class="right-align">Order Details</th>
            </tr>

            <?php while($row = $orders->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <span id="product_id"><?php echo $row['order_id']; ?></span>
                    </td>
                    <td>
                        <span id="product_cost"><?php echo $row['order_cost']; ?></span>
                    </td>
                    <td>
                        <span id="product_status"><?php echo $row['order_status']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['order_date']; ?></span>
                    </td>
                    <td>
                        <form method="POST" action="order_details.php">
                            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
                            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                            <button class="checkout-btn" name="order_details_btn" type="submit">Details</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</section>

<?php include('layouts/footer.php');?>
