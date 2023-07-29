<?php include './connection/config.php';
// if (($_SESSION['c_fname']) == null && ($_SESSION['c_lname']) == null) {
//     header('Location: ./index.php');
// } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-MALL | Your shopping Partner</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="./resources/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.font-awesome.com/c4522a710f.js"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="page-container">

        <section class="header-section">


            <div id="header-top">
                <nav class="top-header">
                    <a href="./index.php" class="image"> <img src="./resources/image/E-MALL.png" alt="LOGO"> </a>
                    <a href="./index.php">
                        <span class="mall-name">E-MALL</span>
                    </a>
                    <input class="search" placeholder="Search...">
                    <button class="button" type="submit"> <i class="fas fa-search"></i> </button>
                </nav>


            </div>

            <div class="header-buttom">
                <div class="nav-contain">
                    <nav class="navbar">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Home</a></li>
                            <li><a href="./dashboard/user.php">
                                    <?php
                                    if (isset($_SESSION['c_fname'])) { ?>
                                        <i class="fa-solid fa-circle-user"></i>
                                        <?php
                                        echo $_SESSION['c_fname'];
                                        ?>

                                        <a href="./dashboard/usercart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                                    <?php
                                    } else { ?>
                                        <a href="./auth/login.php">Login</a>

                                    <?php }
                                    ?>


                                </a></li>
                        </ul>
                    </nav>
                </div>
            </div>



        </section>
    </div>