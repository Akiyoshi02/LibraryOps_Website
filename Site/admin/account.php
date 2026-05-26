<?php include('layouts/header.php'); ?>

<?php 

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;
}

?>

<section class="dashboard">

<div class="dash-content">
    <div class="container mt-5">
        <div class="overview">
            <div class="title custom-flex-center">
                <h1>Account Details</h1>
            </div>
        </div>

        <div class="custom-table-responsive">
            <table class="custom-table" style="border-color: #F5793B;">
                <tbody>
                    <tr>
                        <th style="width: 30%;" scope="row">ID</th>
                        <td><?php echo $_SESSION['admin_id']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Username</th>
                        <td><?php echo $_SESSION['admin_name']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email Address</th>
                        <td><?php echo $_SESSION['admin_email']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Role</th>
                        <td>Admin</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
</section>

    <?php include('layouts/footer.php'); ?>
