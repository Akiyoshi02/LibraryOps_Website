<?php include('layouts/header.php');?>

<?php 

if (isset($_SESSION["user_email"])) {
    header('Location: account.php');
}

?>

    <script>
        function checkPassword() {
            let pw = document.getElementById("user_password").value;
            let rpw = document.getElementById("reenter_user_password").value;
            if (pw !== rpw) {
                alert("Please Re-enter the correct password!");
                event.preventDefault();
            }
        }
    </script>

    <div class="registration-container">
        <div class="registration-form" style="margin-top: 90px;">
        <p class="text-center" style="color: red; margin-top: 40px;"><?php if(isset($_GET['error'])){echo $_GET['error']; } ?></p>
            <h2 class="form-title">Create an Account</h2>
            <form action="server/registration_handler.php" method="POST" class="form-center">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="name" class="form-control" name="txtName" id="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="txtEmail" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">User Password</label>
                    <input type="password" class="form-control" name="txtPassword" id="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Re-enter User Password</label>
                    <input type="password" class="form-control" name="txtReenterPassword" id="confirm-password" placeholder="Re-enter your password" required>
                </div>
                <button type="submit" name="btnRegister" class="btn-signin" onClick="checkPassword()">Create Account</button>
                <p class="form-terms">
                By creating an account, you agree to the LibraryOps <a href="terms.php" class="policy-link">Terms of Service</a> and <a href="privacy.php" class="policy-link">Privacy Policy</a>.
                </p>
                <p class="form-join">
                Already have an account? <a href="join.php" class="policy-link">Sign in</a>
                </p>
            </form>
        </div>
    </div>

<?php include('layouts/footer.php');?>
