<?php
session_start();
include ("dbConn.php");
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
    <title>Account</title>
    <style>
        #content {
            padding: 1.5em;
        }

        #contentCrt {
            width: 80%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
            padding: 1.5em;
            border-radius: 0.25em;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        #accHeader {
            display: flex;
            width: 100%;
            justify-content: space-around;
        }

        hr {
            background-color: #333333;
            height: 2px;
            width: 100%;
            border: none;
            margin-top: 10px;
        }

        #userInfo {
            width: 100%;
            display:flex;
            justify-content: space-around;
        }

        form {
            width: 25%;
            display: flex;
            flex-direction: column;
        }

        .form-row {
            display: flex;
            margin: 32px 0;
        }

        .form-row .input-data {
            width: 100%;
            height: 40px;
            position: relative;
        }

        .input-data input[type=password],
        .textarea textarea {
            display: block;
            width: 100%;
            height: 100%;
            border: none;
            font-size: 17px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.12);
            outline: none
        }

        .input-data input[type=password]:focus~label,
        .input-data input[type=password]:focus-visible~label,
        .textarea textarea:focus~label,
        .input-data input[type=password]:valid~label,
        .textarea textarea:valid~label {
            transform: translateY(-20px);
            font-size: 14px;
            color: #ffd22f;
            outline: none;
        }

        .textarea textarea {
            resize: none;
            padding-top: 10px;
        }

        .input-data label {
            position: absolute;
            pointer-events: none;
            bottom: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .textarea label {
            width: 100%;
            bottom: 40px;
            background: #fff;
        }

        .input-data .underline {
            position: absolute;
            bottom: 0;
            height: 2px;
            width: 100%;
            z-index: 1;
        }

        .input-data .underline:before {
            position: absolute;
            content: "";
            height: 2px;
            width: 100%;
            background: #ffd22f;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s ease;
        }

        .input-data input[type=password]:focus~.underline:before,
        .input-data input[type=password]:focus-visible~.underline:before,
        .input-data input[type=password]:valid~.underline:before,
        .textarea textarea:focus~.underline:before,
        .textarea textarea:valid~.underline:before {
            transform: scale(1);
        }
    </style>
</head>

<body>
    <div id="crt">
        <div id="header">
            <button id="menu-toggle" onclick="toggleSidebar()">☰</button>
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
                    <a href="logout.php">Logout</a>
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

        <div id="sidebar">
            <div class="sideTop">

                <div class="userInfo">
                    <div class="userNameCrt">
                        <p><b>Hi there,</b></p>
                        <h2>
                            <?php if (isset($_SESSION['FirstName'])) {
                            // echo $_SESSION['FirstName'];
                        } else { ?>

                                Guest User

                            <?php } ?>
                        </h2>
                    </div>
                </div>

                <button id="menu-Close" onclick="toggleClose()">&#10006;</button>
            </div>

            <div class="sidebarLinks">
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
            </div>
        </div>


        <div id="content">
            <div id="contentCrt">
                <div id="accHeader">
                    <div id="accHeaderText">
                        <h3>You account,</h3>
                        <h1>
                            <?php
                            $fname = $_SESSION['FirstName'];
                            $lname = $_SESSION['LastName'];
                            echo "$fname $lname" ?>
                        </h1>
                    </div>

                    <img src="images\IslandGoodnessLogoBlack.svg" width="55px">
                </div>

                <hr>

                <h3>Total orders place:
                    <?php
                    $customerID = $_SESSION['CustomerID'];

                    $query = "SELECT * FROM orders 
                            WHERE CustomerID = $customerID";
                    $result = $conn->query($query);

                    echo mysqli_num_rows($result);
                    ?>
                </h3>

                <div id="userInfo">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="password" name="currentPsw" required>
                                <div class="underline"></div>
                                <label for="currentPsw">Enter your current password</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input-data">
                                <input type="password" name="newPsw" required>
                                <div class="underline"></div>
                                <label for="newPsw">Enter your new password</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input-data">
                                <input type="password" name="reNewPsw" required>
                                <div class="underline"></div>
                                <label for="reNewPsw">Re-enter your new password</label>
                            </div>
                        </div>

                    </form>


                </div>


            </div>

        </div>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <h6>About</h6>
                        <p class="text-justify">Island Goodness is dedicated to providing top-notch food and service,
                            always accompanied by a warm smile. Our goal is to ensure that every customer enjoys
                            high-quality cuisine and friendly hospitality.</p>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <h6>Menu</h6>
                        <ul class="footer-links">
                            <li><a href="#">Soups</a></li>
                            <li><a href="#">Lasagnas</a></li>
                            <li><a href="#">Pizzas</a></li>
                            <li><a href="#">Preserves</a></li>
                            <li><a href="#">Condiments</a></li>
                            <li><a href="#">Drinks</a></li>
                        </ul>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <h6>Quick Links</h6>
                        <ul class="footer-links">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Track Orders</a></li>
                            <li><a href="Staff/staffLogin.php">Staff Portal</a></li>
                            <li><a href="index.php">Customer Portal</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <p class="copyright-text">Copyright &copy; 2024 All Rights Reserved by
                            <a href="#">Island Goodness</a>.
                        </p>
                    </div>

                </div>
            </div>
    </div>
    </footer>
    </div>
    <script src="script.js"></script>
</body>

</html>