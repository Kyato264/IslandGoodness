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
            <div id="title">
                <div id="toMenu">
                    <h1>On The Menu</h1>
                    <a href="#menu">VIEW FULL MENU</a>
                </div>


                <!-- <div id="titleImg">
                    <img src="images/titleImage.png" alt="">
                </div> -->
            </div>

            <div id="menu">
                <div id="menuHeader">
                    <h1>OUR MENU</h1>
                    <hr>
                </div>

                <div id="menuLinks">
                    <!-- me being lazy and creating a different toggle for each menu section -->
                    <p onclick=toggleSoup()>Soups</p>
                    <p onclick=toggleLasagna()>Lasagnas</p>
                    <p onclick=togglePizza()>Pizzas</p>
                    <p onclick=togglePreserve()>Preserves</p>
                    <p onclick=toggleCondiment()>Condiments</p>
                    <p onclick=toggleDrink()>Drinks</p>
                </div>

                <div id="soup" class="menuSection">
                    <div id="menuHeader">
                        <h2>SOUPS</h2>
                        <hr>
                    </div>
                    <div id="items">
                        <?php
                        $query = "SELECT * FROM fooditem WHERE Category = 'soup'";
                        $result = $conn->query($query);

                        // Check if query executed successfully
                        if (!$result) {
                            echo "Error: " . $mysqli->error;
                        } else {
                            // Iterate through the result set
                            while ($row = $result->fetch_assoc()) {
                                // Generate links for each menu item
                                $encodedName = urlencode($row['Name']);
                                echo '<a href="menuItemDetails.php?Name=' . $encodedName . '">';
                                echo '<div id="menuItem">';
                                echo '<div id="menuItemImg">';
                                echo '<img src="data:image/jpeg;base64, ' . $row['Image'] . '" alt="' . $row['Name'] . '">';
                                echo '</div>';
                                echo '<div id="menuItemInfo">';
                                echo '<h3>' . $row["Name"] . '</h3>';
                                echo '<h4 style="color: rgba(73, 73, 73, 1);">BBD$ ' . $row['Price'] . '</h4>';
                                echo '<div id="addToCart"><img src="images/addToCart.svg"></div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <div id="lasagna" class="menuSection" style="display:none;">
                    <div id="menuHeader">
                        <h2>LASAGNAS</h2>
                        <hr>
                    </div>
                    <div id="items">
                        <?php
                        $query = "SELECT * FROM fooditem WHERE Category = 'lasagna'";
                        $result = $conn->query($query);

                        // Check if query executed successfully
                        if (!$result) {
                            echo "Error: " . $mysqli->error;
                        } else {
                            // Iterate through the result set
                            while ($row = $result->fetch_assoc()) { ?>
                                <div id="menuItem">
                                    <div id="menuItemImg">
                                        <img src="data:image/jpeg;base64, <?php echo $row['Image']; ?>"
                                            alt="<?php echo $row['Name']; ?>">
                                    </div>

                                    <div id="menuItemInfo">
                                        <h3>
                                            <?php echo $row["Name"]; ?>
                                        </h3>

                                        <h4 style="color: rgba(73, 73, 73, 1);">BBD$
                                            <?php echo $row['Price']; ?>
                                        </h4>

                                        <div id="addToCart"><img src="images/addToCart.svg"></div>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                </div>

                <div id="pizza" class="menuSection" style="display:none;">
                    <div id="menuHeader">
                        <h2>PIZZAS</h2>
                        <hr>
                    </div>
                    <div id="items">
                        <?php
                        $query = "SELECT * FROM fooditem WHERE Category = 'pizza'";
                        $result = $conn->query($query);

                        // Check if query executed successfully
                        if (!$result) {
                            echo "Error: " . $mysqli->error;
                        } else {
                            // Iterate through the result set
                            while ($row = $result->fetch_assoc()) { ?>
                                <div id="menuItem">
                                    <div id="menuItemImg">
                                        <img src="data:image/jpeg;base64, <?php echo $row['Image']; ?>"
                                            alt="<?php echo $row['Name']; ?>">
                                    </div>

                                    <div id="menuItemInfo">
                                        <h3>
                                            <?php echo $row["Name"]; ?>
                                        </h3>

                                        <h4 style="color: rgba(73, 73, 73, 1);">BBD$
                                            <?php echo $row['Price']; ?>
                                        </h4>

                                        <div id="addToCart"><img src="images/addToCart.svg"></div>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                </div>

                <div id="preserve" class="menuSection" style="display:none;">
                    <div id="menuHeader">
                        <h2>PRESERVES</h2>
                        <hr>
                    </div>
                    <div id="items">
                        <?php
                        $query = "SELECT * FROM fooditem WHERE Category = 'preserves'";
                        $result = $conn->query($query);

                        // Check if query executed successfully
                        if (!$result) {
                            echo "Error: " . $mysqli->error;
                        } else {
                            // Iterate through the result set
                            while ($row = $result->fetch_assoc()) { ?>
                                <div id="menuItem">
                                    <div id="menuItemImg">
                                        <img src="data:image/jpeg;base64, <?php echo $row['Image']; ?>"
                                            alt="<?php echo $row['Name']; ?>">
                                    </div>

                                    <div id="menuItemInfo">
                                        <h3>
                                            <?php echo $row["Name"]; ?>
                                        </h3>

                                        <h4 style="color: rgba(73, 73, 73, 1);">BBD$
                                            <?php echo $row['Price']; ?>
                                        </h4>

                                        <div id="addToCart"><img src="images/addToCart.svg"></div>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                </div>

                <div id="condiment" class="menuSection" style="display:none;">
                    <div id="menuHeader">
                        <h2>CONDIMENTS</h2>
                        <hr>
                    </div>
                    <div id="items">
                        <?php
                        $query = "SELECT * FROM fooditem WHERE Category = 'condiment'";
                        $result = $conn->query($query);

                        // Check if query executed successfully
                        if (!$result) {
                            echo "Error: " . $mysqli->error;
                        } else {
                            // Iterate through the result set
                            while ($row = $result->fetch_assoc()) { ?>
                                <div id="menuItem">
                                    <div id="menuItemImg">
                                        <img src="data:image/jpeg;base64, <?php echo $row['Image']; ?>"
                                            alt="<?php echo $row['Name']; ?>">
                                    </div>

                                    <div id="menuItemInfo">
                                        <h3>
                                            <?php echo $row["Name"]; ?>
                                        </h3>

                                        <h4 style="color: rgba(73, 73, 73, 1);">BBD$
                                            <?php echo $row['Price']; ?>
                                        </h4>

                                        <div id="addToCart"><img src="images/addToCart.svg"></div>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                </div>

                <div id="drink" class="menuSection" style="display:none;">
                    <div id="menuHeader">
                        <h2>DRINKS</h2>
                        <hr>
                    </div>
                    <div id="items">
                        <?php
                        $query = "SELECT * FROM fooditem WHERE Category = 'drink'";
                        $result = $conn->query($query);

                        // Check if query executed successfully
                        if (!$result) {
                            echo "Error: " . $mysqli->error;
                        } else {
                            // Iterate through the result set
                            while ($row = $result->fetch_assoc()) { ?>
                                <div id="menuItem">
                                    <div id="menuItemImg">
                                        <img src="data:image/jpeg;base64, <?php echo $row['Image']; ?>"
                                            alt="<?php echo $row['Name']; ?>">
                                    </div>

                                    <div id="menuItemInfo">
                                        <h3>
                                            <?php echo $row["Name"]; ?>
                                        </h3>

                                        <h4 style="color: rgba(73, 73, 73, 1);">BBD$
                                            <?php echo $row['Price']; ?>
                                        </h4>

                                        <div id="addToCart"><img src="images/addToCart.svg"></div>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
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
    <script>
        const soup = document.getElementById("soup");
        const lasagna = document.getElementById("lasagna");
        const pizza = document.getElementById("pizza");
        const preserve = document.getElementById("preserve");
        const condiment = document.getElementById("condiment");
        const drink = document.getElementById("drink");

        function toggleSoup() {
            soup.style.display = "block"
            lasagna.style.display = "none"
            pizza.style.display = "none"
            preserve.style.display = "none"
            condiment.style.display = "none"
            drink.style.display = "none"
        }

        function toggleLasagna() {
            soup.style.display = "none"
            lasagna.style.display = "block"
            pizza.style.display = "none"
            preserve.style.display = "none"
            condiment.style.display = "none"
            drink.style.display = "none"
        }

        function togglePizza() {
            soup.style.display = "none"
            lasagna.style.display = "none"
            pizza.style.display = "block"
            preserve.style.display = "none"
            condiment.style.display = "none"
            drink.style.display = "none"
        }

        function togglePreserve() {
            soup.style.display = "none"
            lasagna.style.display = "none"
            pizza.style.display = "none"
            preserve.style.display = "block"
            condiment.style.display = "none"
            drink.style.display = "none"
        }

        function toggleCondiment() {
            soup.style.display = "none"
            lasagna.style.display = "none"
            pizza.style.display = "none"
            preserve.style.display = "none"
            condiment.style.display = "block"
            drink.style.display = "none"
        }

        function toggleDrink() {
            soup.style.display = "none"
            lasagna.style.display = "none"
            pizza.style.display = "none"
            preserve.style.display = "none"
            condiment.style.display = "none"
            drink.style.display = "block"
        }
    </script>
</body>

</html>