<?php 

session_start();

include('../server/connection.php');

if (isset($_SESSION["admin_logged_in"])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST["login_btn"])) {
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["admin_id"] = $admin_id;
            $_SESSION["admin_name"] = $admin_name;
            $_SESSION["admin_email"] = $admin_email;
            $_SESSION["admin_logged_in"] = true;

            header('Location: index.php?login_success=Logged in successfully');

        } else {
            header('Location: login.php?error=Could not verify your account');

        }
    } else {
        header('Location: login.php?error=Something went wrong');

    }
}


?>



<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NDAgNTEyIj4KPHBhdGggZD0iTTMyMCAzMmMtOC4xIDAtMTYuMSAxLjQtMjMuNyA0LjFMMTUuOCAxMzcuNEM2LjMgMTQwLjkgMCAxNDkuOSAwIDE2MHM2LjMgMTkuMSAxNS44IDIyLjZsNTcuOSAyMC45QzU3LjMgMjI5LjMgNDggMjU5LjggNDggMjkxLjl2MjguMWMwIDI4LjQtMTAuOCA1Ny43LTIyLjMgODAuOGMtNi41IDEzLTEzLjkgMjUuOC0yMi41IDM3LjZDMCA0NDIuNy0uOSA0NDguMyAuOSA0NTMuNHM2IDguOSAxMS4yIDEwLjJsNjQgMTZjNC4yIDEuMSA4LjcuMyAxMi40LTIuMXM2LjMtNi4xIDcuMS0xMC40YzguNi00Mi44IDQuMy04MS4yLTIuMS0xMDguN0M5MC4zIDM0NC4zIDg2IDMyOS44IDgwIDMxNi41VjI5MS45YzAtMzAuMiAxMC4yLTU4LjcgMjcuOS04MS41YzEyLjktMTUuNSAyOS42LTI4IDQ5LjItMzUuN2wxNTctNjEuN2M4LjItMy4yIDE3LjUgLjggMjAuNyA5cy0uOCAxNy41LTkgMjAuN2wtMTU3IDYxLjdjLTEyLjQgNC45LTIzLjMgMTIuNC0zMi4yIDIxLjZsMTU5LjYgNTcuNmM3LjYgMi43IDE1LjYgNC4xIDIzLjcgNC4xczE2LjEtMS40IDIzLjctNC4xTDYyNC4yIDE4Mi42YzkuNS0zLjQgMTUuOC0xMi41IDE1LjgtMjIuNnMtNi4zLTE5LjEtMTUuOC0yMi42TDQzMy43IDM2LjFDMzM2LjEgMzMuNCAzMjguMSAzMiAzMjAgMzJ6TTMyMCA0MDhjMCAzNS4zIDg2IDcyIDE5MiA3MnMxOTItMzYuNyAxOTItNzJMMjQ5LjcgMjYyLjYgMzU0LjUgMzE0Yy0xMS4xIDQtMjIuOCA2LTM0LjUgNnMtMjMuNS0yLTM0LjUtNkwxNDMuMyAyNjIuNiAxMjggNDA4eiIvPjwvc3ZnPgo=">

</head>
<body>

<div class="custom-container">
        <div class="custom-card">
            <div class="custom-card-body">
                <div class="custom-icon-text">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>LibraryOps</span>
                </div>
            </div>
            <h5 class="custom-card-title">Admin Login</h5>
            <form method="POST" action="login.php" class="custom-form">
                <p><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></p>
                <div>
                    <label for="email" class="custom-form-label">Email address</label>
                    <input type="email" name="email" class="custom-form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div>
                    <label for="password" class="custom-form-label">Password</label>
                    <input type="password" name="password" class="custom-form-control" id="password" placeholder="Enter your password" required>
                </div>
                <div class="custom-d-grid">
                    <button type="submit" name="login_btn" class="custom-btn">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
