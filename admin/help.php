<?php include('layouts/header.php'); ?>

<?php 

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;
}

?>

<section class="dashboard-section">

<div class="dashboard-content">
    <div class="help-container mt-5">

        <div class="dashboard-overview">
            <div class="dashboard-title custom-flex-center">
                <h1>Help</h1>
            </div>
        </div>

        <div class="custom-row">
            <div class="custom-col-md-6">
                <div class="help-card mb-4">
                    <div class="help-card-body">
                        <h5 class="help-card-title">Contact Admin</h5>
                        <p class="help-card-text">Please contact us via email:</p>
                        <p class="help-card-text"><a href="mailto:akiyoshiyapa@gmail.com" style="text-decoration: none; color: coral;">akiyoshiyapa@gmail.com</a></p>
                    </div>
                </div>
            </div>
            <div class="custom-col-md-6">
                <div class="help-card mb-4">
                    <div class="help-card-body">
                        <h5 class="help-card-title">Call Us</h5>
                        <p class="help-card-text">Please call our support team:</p>
                        <p class="help-card-text"  style="color: coral;">+94 77 7581295</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</section>

    <?php include('layouts/footer.php'); ?>
