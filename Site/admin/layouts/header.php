<?php session_start(); ?>

<?php include('../server/connection.php'); ?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

	<link rel="stylesheet" href="style.css">
    
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NDAgNTEyIj4KPHBhdGggZD0iTTMyMCAzMmMtOC4xIDAtMTYuMSAxLjQtMjMuNyA0LjFMMTUuOCAxMzcuNEM2LjMgMTQwLjkgMCAxNDkuOSAwIDE2MHM2LjMgMTkuMSAxNS44IDIyLjZsNTcuOSAyMC45QzU3LjMgMjI5LjMgNDggMjU5LjggNDggMjkxLjl2MjguMWMwIDI4LjQtMTAuOCA1Ny43LTIyLjMgODAuOGMtNi41IDEzLTEzLjkgMjUuOC0yMi41IDM3LjZDMCA0NDIuNy0uOSA0NDguMyAuOSA0NTMuNHM2IDguOSAxMS4yIDEwLjJsNjQgMTZjNC4yIDEuMSA4LjcuMyAxMi40LTIuMXM2LjMtNi4xIDcuMS0xMC40YzguNi00Mi44IDQuMy04MS4yLTIuMS0xMDguN0M5MC4zIDM0NC4zIDg2IDMyOS44IDgwIDMxNi41VjI5MS45YzAtMzAuMiAxMC4yLTU4LjcgMjcuOS04MS41YzEyLjktMTUuNSAyOS42LTI4IDQ5LjItMzUuN2wxNTctNjEuN2M4LjItMy4yIDE3LjUgLjggMjAuNyA5cy0uOCAxNy41LTkgMjAuN2wtMTU3IDYxLjdjLTEyLjQgNC45LTIzLjMgMTIuNC0zMi4yIDIxLjZsMTU5LjYgNTcuNmM3LjYgMi43IDE1LjYgNC4xIDIzLjcgNC4xczE2LjEtMS40IDIzLjctNC4xTDYyNC4yIDE4Mi42YzkuNS0zLjQgMTUuOC0xMi41IDE1LjgtMjIuNnMtNi4zLTE5LjEtMTUuOC0yMi42TDQzMy43IDM2LjFDMzM2LjEgMzMuNCAzMjguMSAzMiAzMjAgMzJ6TTMyMCA0MDhjMCAzNS4zIDg2IDcyIDE5MiA3MnMxOTItMzYuNyAxOTItNzJMMjQ5LjcgMjYyLjYgMzU0LjUgMzE0Yy0xMS4xIDQtMjIuOCA2LTM0LjUgNnMtMjMuNS0yLTM0LjUtNkwxNDMuMyAyNjIuNiAxMjggNDA4eiIvPjwvc3ZnPgo=">

</head>
<body>
    <nav>
    <div class="card-body">
            <div class="icon-text text-center">
                <i style="font-size: 50px; color: #F5793B;" class="fa-solid fa-graduation-cap"></i>
            <span style="font-size: 25px; color: #F5793B; margin-left: 10px; position: relative; top: -12px;">LibraryOps</span>
            </div>
            </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="index.php">
					<i class="fa-solid fa-house"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="orders.php">
                <i class="fa-solid fa-list-check"></i></i>
                    <span class="link-name">Manage Orders</span>
                </a></li>
                <li><a href="products.php">
					<i class="fa-solid fa-book-open"></i>
                    <span class="link-name">Manage eBooks</span>
                </a></li>
                <li><a href="add_product.php">
					<i class="fa-solid fa-circle-plus"></i>
                    <span class="link-name">Add New eBook</span>
                </a></li>
                <li><a href="users">
					<i class="fa-solid fa-people-roof"></i>
                    <span class="link-name">Manage Users</span>
                </a></li>
                <li><a href="help.php">
                <i class="fa-solid fa-question"></i></i>
                    <span class="link-name">Help</span>
                </a></li>
                
            </ul>
            
            <ul class="logout-mode">

            <li class="account" style="margin-left: 10px; margin-bottom: 20px;">
            <a href="account.php">
                <i class="uil uil-bars sidebar-toggle"></i>
                <i class="fa-solid fa-user-tie"></i>
            </a>
             </li>
        
            <li class="logout" style="margin-left: 20px;">
                <a href="logout.php?logout=1">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="link-name" name="logout">Logout</span>
                </a>
            </li>
            </ul> 

        </div>
    </nav>