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
    <title>Home Page</title>
    <style>
        h2 {
            width: 100%;
            padding-top: 1em;
            padding-bottom: 1em;
            font-size: 2.5em;
            text-align: center;
            background-color: #ffd22f;
            color: black;
        }

        .faq {
            max-width: 700px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-top: 2em;
            padding-bottom: 1em;
            margin-bottom: 1em;
            border-bottom: 2px solid #ffd22f;
            /* cursor: pointer; changes the cursor to pointer when hovered over element */
            cursor: pointer;
        }

        /* To give a slightly cleaner look on devices with screen width of less than 990px */

        @media screen and (max-width:990px) {
            .faq {
                margin-left: 1em;
                margin-right: 1em;
            }
        }

        .faq.active .answer {
            max-height: 1000px;
        }

        .faq.active img {
            transform: rotate(180deg);
        }

        img {
            transition: 0.4s ease-in;
        }

        .question {
            width: 100%;
            display: flex;
            justify-content: space-between;
            font-size: 1.5em;

        }

        .answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 1.4s ease;
        }

        .answer p {
            padding-top: 1em;
            /* line-height sets the space between lines of text */
            line-height: 1.6;
            font-size: 1.3em;
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


                <?php if (isset($_SESSION['Email'])) { ?>
                    <a href="trackOrders.php">Track Orders</a>
                    <a href="account.php">Account</a>
                    <a href="logout.php">logout</a>
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
                    <?php
                    if (isset($_SESSION['CustomerID'])) {
                        $customerID = $_SESSION['CustomerID'];

                        $query = "SELECT * FROM cart 
                                WHERE CustomerID = $customerID";
                        $result = $conn->query($query);

                        echo mysqli_num_rows($result);
                    } else {
                        echo 0;
                    }
                    ?>
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
                <a href="faq.php">FAQ</a>


                <?php if (isset($_SESSION['Email'])) { ?>
                    <a href="trackOrders.php">Track Orders</a>
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
            </div>
        </div>


        <div id="content">
            <h2>Frequently Asked Questions</h2>

            <div class="faq">
                <div class="question">
                    <h3>Is Island Goodness exclusively delivery?</h3>

                    <img src="Images/arrow.svg" alt="drop" width="30em" />
                </div>

                <div class="answer">
                    <p>Yes! Island Goodness at this current point is strictly only delivery. No pick-up and no eat-ins.
                    </p>
                </div>
            </div>

            <div class="faq">
                <div class="question">
                    <h3>Does Island Goodness accept card?</h3>

                    <img src="Images/arrow.svg" alt="drop" width="30em" />
                </div>

                <div class="answer">
                    <p>No, unfortunately Island Goodness is a cash only business despite our online presence. We
                        apologize for any inconvenience.
                    </p>
                </div>
            </div>

            <div class="faq">
                <div class="question">
                    <h3>What is the delivery radius for your restaurant?</h3>

                    <img src="Images/arrow.svg" alt="drop" width="30em" />
                </div>

                <div class="answer">
                    <p>Island Goodness delivery to the entire island. From St. Lucy down to Christ Church!
                    </p>
                </div>
            </div>

            <div class="faq">
                <div class="question">
                    <h3> How long does it take for delivery orders to arrive?</h3>

                    <img src="Images/arrow.svg" alt="drop" width="30em" />
                </div>

                <div class="answer">
                    <p>We strive to deliver your order promptly and efficiently. The delivery time can vary depending on
                        factors such as order volume, traffic conditions, and distance from our restaurant. Typically,
                        delivery orders are fulfilled within two days from the time your order is placed. During peak
                        hours, delivery times may be slightly longer, but rest assured, our delivery team works
                        diligently to get your food to you as quickly as possible.
                    </p>
                </div>
            </div>

            <div class="faq">
                <div class="question">
                    <h3>Can I track my delivery order?</h3>

                    <img src="Images/arrow.svg" alt="drop" width="30em" />
                </div>

                <div class="answer">
                    <p>Yes, we offer order tracking for all delivery orders placed through our website or mobile app.
                    </p>
                </div>
            </div>
        </div>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <h6>About</h6>
                        <p class="text-justify">Island Goodness is dedicated to providing top-notch food and
                            service,
                            always accompanied by a warm smile. Our goal is to ensure that every customer enjoys
                            high-quality cuisine and friendly hospitality.</p>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <h6>Menu</h6>
                        <ul class="footer-links">
                            <li><a href="#soup" onclick=toggleSoup()>Soups</a></li>
                            <li><a href="#lasagnas" onclick=toggleLasagna()>Lasagnas</a></li>
                            <li><a href="#pizza" onclick=togglePizza()>Pizzas</a></li>
                            <li><a href="#preserve" onclick=togglePreserve()>Preserves</a></li>
                            <li><a href="#condiment" onclick=toggleCondiment()>Condiments</a></li>
                            <li><a href="#drink" onclick=toggleDrink()>Drinks</a></li>
                        </ul>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <h6>Quick Links</h6>
                        <ul class="footer-links">
                            <li><a href="index.php">Home</a></li>
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
    <script>
        const faq = document.querySelectorAll(".faq");

        faq.forEach(faq => {
            faq.addEventListener("click", () => {
                faq.classList.toggle("active");
            })
        });
    </script>
</body>

</html>