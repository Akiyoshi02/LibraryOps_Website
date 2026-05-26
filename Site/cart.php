<?php include('layouts/header.php');?>

<?php

    if (isset($_POST['add_to_cart'])) {

        // If user has already added a product to cart
        if (isset($_SESSION['cart'])) {

            $products_array_ids = array_column($_SESSION['cart'], "product_id"); //[2, 3, 4, 10, 15]

            // If product has already been added to cart or not
            if (!in_array($_POST['product_id'], $products_array_ids)) {

                $product_id = $_POST['product_id'];

                $product_array = array(
                    'product_id' => $_POST['product_id'],
                    'product_name' => $_POST['product_name'],
                    'product_price' => $_POST['product_price'],
                    'product_image' => $_POST['product_image'],
                    'product_quantity' => $_POST['product_quantity']
                );

                $_SESSION['cart'][$product_id] = $product_array;

                // Product has already been added
            } else {
                echo '<script>alert("Product was already added to cart");</script>';
            }

        } else {
            // If this is the first product
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];

            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity
            );

            $_SESSION['cart'][$product_id] = $product_array;
            // [ 2=>[], 3=>[], 5=>[] ]
        }

        // Calculate total
        calculateTotalCart();

        // Remove product from cart
    } elseif (isset($_POST['remove_product'])) {
        
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);

        // Calculate total
        calculateTotalCart();

    } elseif (isset($_POST['edit_quantity'])) {
        // We get id and quantity from the form
        $product_id = $_POST['product_id'];
        $product_quantity = $_POST['product_quantity'];

        // Get the product array from the session
        $product_array = $_SESSION['cart'][$product_id];

        // Update product quantity
        $product_array['product_quantity'] = $product_quantity;

        // Return array back its place 
        $_SESSION['cart'][$product_id] = $product_array;

        // Calculate total
        calculateTotalCart();

    } else {
        // Redirect to site if no valid form action
        // header('Location: site.php');
    }

    // Function to calculate the total cart value
    function calculateTotalCart() {
        $total_price = 0;
        $total_quantity = 0;

        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key];
            $price = $product['product_price'];
            $quantity = $product['product_quantity'];

            $total_price = $total_price + ($price * $quantity);
            $total_quantity = $total_quantity + $quantity;
        }

        $_SESSION['total'] = $total_price;
        $_SESSION['quantity'] = $total_quantity;
}



?>

<main>

<div class="cart-page-container">
        <table class="cart-page-table">
            <thead>
                <tr>
                    <th class="left-align">Product</th>
                    <th class="center-align">Quantity</th>
                    <th class="right-align">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($_SESSION['cart'])) { ?>
                <?php foreach($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                    <td>
                        <div class="cart-item">
                            <img src="Images/Books/<?php echo $value['product_image']; ?>" width="90px" height="120px">
                            <div class="cart-item-details">
                                <p><?php echo $value['product_name']; ?></p>
                                <small>Rs. <?php echo $value['product_price']; ?></small>
                                <br>
                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                                    <input class="remove-btn" type="submit" name="remove_product" value="Remove"/>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                            <div class="quantity-wrapper">
                                <input type="number" class="quantity-input" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                                <button class="edit-btn" type="submit" name="edit_quantity">Edit</button>
                            </div>
                        </form>
                    </td>
                    <td class="right-align">
                        <span>Rs.</span>
                        <span class="subtotal-price"><?php echo $value['product_quantity'] * $value['product_price']; ?>.00</span>
                    </td>
                </tr>
                <?php } ?>
                <?php } ?>
            </tbody>
        </table>

        <div class="total-container">
            <table class="total-table">
                <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <?php if(isset($_SESSION['cart'])) { ?>
                        <td>Rs. <?php echo $_SESSION['total']; ?>.00</td>
                    </tr>
                    <?php if (!empty($_SESSION['total']) && $_SESSION['total'] > 0): ?>
                    <tr>
                        <td>Tax+Delivery</td>
                        <td>Rs. 350.00</td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td>Total</td>
                        <td>Rs. <?php echo !empty($_SESSION['total']) && $_SESSION['total'] > 0 ? $_SESSION['total'] + 350.00 : 0; ?>.00</td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="checkout-wrapper">
            <form method="POST" action="checkout.php">
                <button class="checkout-btn" type="submit">Checkout</button>
            </form>
        </div>
    </div>

</main>

<?php include('layouts/footer.php');?>
