<?php 
session_start();
ob_start();
include('server/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraryOps</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NDAgNTEyIj4KPHBhdGggZD0iTTMyMCAzMmMtOC4xIDAtMTYuMSAxLjQtMjMuNyA0LjFMMTUuOCAxMzcuNEM2LjMgMTQwLjkgMCAxNDkuOSAwIDE2MHM2LjMgMTkuMSAxNS44IDIyLjZsNTcuOSAyMC45QzU3LjMgMjI5LjMgNDggMjU5LjggNDggMjkxLjl2MjguMWMwIDI4LjQtMTAuOCA1Ny43LTIyLjMgODAuOGMtNi41IDEzLTEzLjkgMjUuOC0yMi41IDM3LjZDMCA0NDIuNy0uOSA0NDguMyAuOSA0NTMuNHM2IDguOSAxMS4yIDEwLjJsNjQgMTZjNC4yIDEuMSA4LjcuMyAxMi40LTIuMXM2LjMtNi4xIDcuMS0xMC40YzguNi00Mi44IDQuMy04MS4yLTIuMS0xMDguN0M5MC4zIDM0NC4zIDg2IDMyOS44IDgwIDMxNi41VjI5MS45YzAtMzAuMiAxMC4yLTU4LjcgMjcuOS04MS41YzEyLjktMTUuNSAyOS42LTI4IDQ5LjItMzUuN2wxNTctNjEuN2M4LjItMy4yIDE3LjUgLjggMjAuNyA5cy0uOCAxNy41LTkgMjAuN2wtMTU3IDYxLjdjLTEyLjQgNC45LTIzLjMgMTIuNC0zMi4yIDIxLjZsMTU5LjYgNTcuNmM3LjYgMi43IDE1LjYgNC4xIDIzLjcgNC4xczE2LjEtMS40IDIzLjctNC4xTDYyNC4yIDE4Mi42YzkuNS0zLjQgMTUuOC0xMi41IDE1LjgtMjIuNnMtNi4zLTE5LjEtMTUuOC0yMi42TDQzMy43IDM2LjFDMzM2LjEgMzMuNCAzMjguMSAzMiAzMjAgMzJ6TTMyMCA0MDhjMCAzNS4zIDg2IDcyIDE5MiA3MnMxOTItMzYuNyAxOTItNzJMMjQ5LjcgMjYyLjYgMzU0LjUgMzE0Yy0xMS4xIDQtMjIuOCA2LTM0LjUgNnMtMjMuNS0yLTM0LjUtNkwxNDMuMyAyNjIuNiAxMjggNDA4eiIvPjwvc3ZnPgo=">

</head>
<body>

<nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="site.php"><i style="font-size: 50px; color: #F5793B;" class="fa-solid fa-graduation-cap"></i><span style="font-size: 25px; color: #F5793B; margin-left: 8px; position: relative; bottom: 2px;">LibraryOps</span></a>
            <button class="navbar-toggler" type="button" onclick="toggleNavbar()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="site.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php#orders">My Books</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" onclick="toggleDropdown()">English</a>
                        <ul class="dropdown-menu">
                            <li style="list-style: none;"><a class="dropdown-item" href="site.php">EN / English</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="search-btn" method="GET" action="product_search.php" id="search_form">
                    <input class="form-control" name="search_for_books" type="search" placeholder="Search Books" aria-label="Search">
                    <button class="btn" type="submit">Search</button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="sign_in.php">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="join.php">Join</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php" class="nav-icon">
                            <i class="fa-solid fa-cart-shopping cart"></i>
                            <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] !=0) { ?>
                            <span class="badge"><?php echo $_SESSION['quantity']; ?></span>
                            <?php } ?>
                        </a>
                        <a href="account.php" class="nav-icon">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <script>
        function toggleNavbar() {
            var element = document.getElementById("navbarSupportedContent");
            element.classList.toggle("show");
        }
        function toggleDropdown() {
            var element = document.querySelector(".dropdown-menu");
            element.classList.toggle("show");
        }
    </script>