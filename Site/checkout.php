<?php include('layouts/header.php');?>

<?php 

if(!empty($_SESSION['cart'])){
    //Let user in

    //Send user to home page
}else{
    header('location: site.php');
}

?>

<section class="checkout-section">
    <div class="checkout-container">
        <h2 class="checkout-title">Check Out</h2>
        <hr class="divider">
    </div>
    <div class="checkout-form-container">
        <form id="checkout-form" method="POST" action="server/place_order.php">
            <p class="checkout-message">
                <?php if(isset($_GET['message'])) { echo $_GET['message']; } ?>
                <?php if(isset($_GET['message'])) { ?>
                    <a href="sign_in.php" class="login-btn">Login</a>
                <?php } ?>
            </p>
            <div class="checkout-form-row">
                <div class="checkout-column">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-input" placeholder="Name" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-input" placeholder="Phone Number" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-input" placeholder="Address" id="address" name="address" required>
                    </div>
                </div>
                <div class="checkout-column">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-input" placeholder="Email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-input" placeholder="City" id="city" name="city" required>
                    </div>
                    <p class="total-amount">Total Amount: Rs. <?php echo $_SESSION['total'] ?></p>
                    <input type="submit" class="submit-btn" id="checkout-btn" name="place_order" value="Place Order">
                </div>
            </div>          
        </form>
    </div>
</section>

<?php include('layouts/footer.php');?>
