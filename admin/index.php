<?php include('layouts/header.php'); ?>

<?php 
if (!isset($_SESSION["admin_logged_in"])) {
    header('Location: login.php');
    exit;
}

?>

<?php 

function getCount($conn, $tableName) {
    $sql = "SELECT COUNT(*) AS count FROM " . $tableName;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        return 0;
    }
}

$numUsers = getCount($conn, 'users');

$numProducts = getCount($conn, 'products');

$numOrders = getCount($conn, 'orders');

$conn->close();
?>

<section class="dashboard-view-dashboard">

    <div class="dashboard-view-dash-content">
        <div class="dashboard-view-container mt-5">

            <div class="dashboard-view-overview">
                <div class="dashboard-view-title dashboard-view-flex-center">
                    <h1>Dashboard</h1>
                </div>
            </div>

            <div class="dashboard-view-row">
                <div class="dashboard-view-col-4">
                    <div class="dashboard-view-stats dashboard-view-blue">
                        <div class="dashboard-view-stats-body">
                        <i style="font-size: 60px; margin-bottom: 0.5rem;" class="fa-solid fa-users"></i>
                            <h5 class="dashboard-view-stats-title">Users</h5>
                            <p class="dashboard-view-stats-text">Number of users: <?php echo $numUsers ?></p>
                        </div>
                    </div>
                </div>
                <div class="dashboard-view-col-4">
                    <div class="dashboard-view-stats dashboard-view-green">
                        <div class="dashboard-view-stats-body">
                        <i style="font-size: 60px; margin-bottom: 0.5rem;" class="fa-solid fa-book"></i>
                            <h5 class="dashboard-view-stats-title">Available Products</h5>
                            <p class="dashboard-view-stats-text">Number of products: <?php echo $numProducts ?></p>
                        </div>
                    </div>
                </div>
                <div class="dashboard-view-col-4">
                    <div class="dashboard-view-stats dashboard-view-orange">
                        <div class="dashboard-view-stats-body">
                        <i style="font-size: 60px; margin-bottom: 0.5rem;" class="fa-solid fa-cart-shopping"></i>
                            <h5 class="dashboard-view-stats-title">Orders</h5>
                            <p class="dashboard-view-stats-text">Number of orders: <?php echo $numOrders ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

<?php include('layouts/footer.php'); ?>