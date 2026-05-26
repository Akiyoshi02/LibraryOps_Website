<?php include('layouts/header.php');?>

<?php 

if (isset($_SESSION["user_email"])) {
    header('Location: account.php');
    exit;
}

?>

<div class="registration-container">
        <div class="registration-form">
            <h2 class="form-title">Sign in</h2>
            <form action="server/login_handler.php" method="POST" class="form-center">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="txtEmail" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="txtPassword" id="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="btnSignin" class="btn-signin">Sign In</button>
                <p class="form-terms">
                    By signing in, you agree to LibraryOps <a href="terms.php" class="policy-link">Terms of Service</a> and <a href="privacy.php" class="policy-link">Privacy Policy</a>.
                </p>
                <p class="form-join">
                    New to LibraryOps? <a href="join.php" class="policy-link">Join Now</a>
                </p>
            </form>
        </div>
    </div>

<?php include('layouts/footer.php');?>
