<?php include '../connection/config.php';

if (($_SESSION['c_fname']) == null && ($_SESSION['c_lname']) == null) {
    header('Location: ../auth/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700&display=swap" rel="stylesheet">
    <!-- fontaesome symbol -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard.css">

</head>

<body>
    <div class="grid-container user-container">
        <!-- header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-symbols-outlined">Menu</span>
            </div>
            <!-- <div class="header-left">
                <span class="material-symbols-outlined">search</span>
            </div> -->
            <div class="header-right">
                <!-- <span class="material-symbols-outlined">notifications</span>
                <span class="material-symbols-outlined">email</span> -->
                <i class="fa-solid fa-user"></i><?php
                                                echo $_SESSION['c_fname'];
                                                echo $_SESSION['c_lname'];

                                                ?>

            </div>
        </header>
        <!-- sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <a href="../index.php">E-Mall</a>
                </div>
                <span class="material-symbols-outlined" onclick="closeSidebar()">close</span>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item"><a href="./user.php">Dashboard</a></li>
                <li class="sidebar-list-item"><a href="./usercart.php">Cart Item</a></li>
                <li class="sidebar-list-item"><a href="./purchased-item.php">Purchased Item</a></li>
                <li class="sidebar-list-item logout"><a href="./logout.php">Log Out</a></li>
            </ul>

        </aside>




        <script src="js/script.js"></script>
</body>

</html>