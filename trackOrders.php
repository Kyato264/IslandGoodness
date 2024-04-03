<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

   
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images\IslandGoodnessLogoBlackNoWords.svg" type="image/x-icon">
    <title>Order tracking </title>
</head>

<style>
    
    body {
        margin: 0; 
        font-family: 'Montserrat', sans-serif; 
    }

    #content {
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        padding: 20px; 
    }

    #order-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .order-item {
        border: 2px solid transparent;
        border-radius: 5px;
        padding: 20px;
        width: 400px; 
        background-color: #f9f9f9;
        font-size: 16px;
        margin-bottom: 20px;
        position: relative; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .order-item:hover {
        border-color: #ffc107; 
    }

    .status-buttons {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }

    .status-buttons button {
        margin-left: 5px;
    }
</style>

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

                <a href="cart.php"><img src="images/cart.svg" alt="cart" width="20px">0</a>
            </div>
        </div>

        <div id="sidebar">
            <div class="sideTop">
                <div class="userInfo">
                    <div class="userNameCrt">
                        <p><b>Hi there,</b></p>
                        <h2>
                            <?php if (isset($_SESSION['FirstName'])) { 
                              
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

        <?php include("dbconn.php"); ?>

        <div id="content">
            <h2>Current Orders</h2>   
            <div id="order-list">
                <?php
                $sql = "SELECT * FROM orderitems";
                $result = $conn->query($sql);

                
                if ($result->num_rows > 0) {
                   
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="order-item">';
                        echo '<p>Order Item ID: ' . $row['OrderItemID'] . '</p>';
                        echo '<p>Order ID: ' . $row['OrderID'] . '</p>';
                        echo '<p>Item ID: ' . $row['ItemID'] . '</p>';
                        echo '<p>Quantity: ' . $row['Quantity'] . '</p>';

                        echo '<div class="status-buttons">';
                        echo '<button onclick="updateStatus(' . $row['OrderID'] . ', \'In Progress\')">In Progress</button>';
                        echo '<button onclick="updateStatus(' . $row['OrderID'] . ', \'Out for Delivery\')">Out for Delivery</button>';
                        echo '<button onclick="updateStatus(' . $row['OrderID'] . ', \'Completed\')">Completed</button>';
                        echo '</div>';

                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>
        </div>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <h6>About</h6>
                        <p class="text-justify">Island Goodness is dedicated to providing top-notch food and service, always accompanied by a warm smile. Our goal is to ensure that every customer enjoys high-quality cuisine and friendly hospitality.</p>
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
        </footer>
    </div>
    <script src="script.js"></script>
</body>
</html>
