<?php
session_start();
include("dbConn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href=images\IslandGoodnessLogoBlackNoWords.svg type="image/x-icon">
    <title>Home Page</title>
</head>

<body>
    <div id="crt">
        <div id="header">
            <div id="iconAndName">
                <a id="iconAndNameLink" href="index.php">
                    <img src="images\IslandGoodnessLogoBlack.svg" width="55px">
                </a>
            </div>

            <div id="headerLinks">
                <a href="index.php">Home</a>
                <a href="trackOrders.php">Track Orders</a>

                <?php if (isset($_SESSION['Email'])) { ?>
                    <a href="account.php">Account</a>
                <?php } ?>

                <?php if (!isset($_SESSION['Email'])) { ?>
                    <div id="loginAndSignUp">
                        <div id="login">
                            <a href="login.php">Login</a>
                        </div>

                        <div id="signup">
                            <a href="signup.php">Signup</a>
                        </div>
                    </div>
                <?php } ?>

                <a href="cart.php"><img src="images/cart.svg" alt="cart" width="20px">
                    0
                </a>

            </div>
        </div>


        <div id="content">
            <div id="title">
                <div id="toMenu">
                    <h1>On The Menu</h1>
                    <a href="#menu">VIEW FULL MENU</a>
                </div>

                <div id="titleItems">
                    <div id="titleItemCard">
                        <img src="images\burger.jpg">
                        <div id="titleItemCardInfo">
                            <h3>Burger</h3>
                            <p>This is very good burger you should buy!</p>
                        </div>
                    </div>

                    <div id="titleItemCard">
                        <img src="images\burger.jpg">
                        <div id="titleItemCardInfo">
                            <h3>Burger</h3>
                            <p>This is very good burger you should buy!</p>
                        </div>
                    </div>

                    <div id="titleItemCard">
                        <img src="images\burger.jpg">
                        <div id="titleItemCardInfo">
                            <h3>Burger</h3>
                            <p>This is very good burger you should buy!</p>
                        </div>
                    </div>

                </div>
            </div>

            <div id="menu">
                <div id="menuHeader">
                    <h1>OUR MENU</h1>
                    <hr>
                </div>

                <div id="menuLinks">
                    <a href="#soup">Soups</a>
                    <a href="#lasagna">Lasagnas</a>
                    <a href="#pizza">Pizzas</a>
                    <a href="#preserves">Preserves</a>
                    <a href="#condiments">Condiments</a>
                    <a href="#drink">Drinks</a>
                </div>
        </div>
    </div>

    <div id="footer">
        <h3>Island Goodness &copy; 2024</h3>
    </div>
    </div>
    <script src="script.js"></script>
</body>

</html>