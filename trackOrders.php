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
    <title>Template</title>
    <style>
        #content {
                padding: 1.5em;
            }

            h1 {
                padding-bottom: 1em;
                padding-top: 1em;
            }

            .sss {
                width: 100%;
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                gap: 1.5em;
                flex-wrap: wrap;
            }

            .box {
                padding: 1.5em;
                border-radius: 0.25em;
                box-shadow: 0rem 0.25rem 0.5625rem 0rem rgba(0, 0, 0, 0.15);
                transition: 0.2s ease-in-out;
                gap: 1.5em;
            }

            .box:hover {
                box-shadow: rgba(255, 210, 47, 0.4) -5px 5px, rgba(255, 219, 88, 0.3) -10px 10px;
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
                <?php
                        if(isset($_SESSION['CustomerID'])) {
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
                    

                    <?php if (isset($_SESSION['Email'])) { ?>
                        <a href="account.php">Account</a>
                        <a href="trackOrders.php">Track Orders</a>
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
        <h1>Your Current Orders</h1>
                <div id="userOrders" class="sss">
                    

                    <?php $sql = "SELECT 
            orders.OrderID, 
            orders.TimeStamp,
            orders.Status, 
            GROUP_CONCAT(CONCAT(fooditem.Name, ' (', orderitems.Quantity, ')') SEPARATOR '<br>') AS OrderItems
        FROM 
            orders
        INNER JOIN 
            orderitems ON orderitems.OrderID = orders.OrderID
        INNER JOIN 
            fooditem ON fooditem.ItemID = orderitems.ItemID
        WHERE 
            orders.Status != 'completed'
        GROUP BY 
            orders.OrderID
        ORDER BY 
        orders.Status";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div id="newOrder" class="box">
                                <h2>Order Number: <?php echo $row['OrderID']; ?></h2>
                                <h3>Time Placed: <?php echo $row['TimeStamp']; ?></h3>
                                <h3>Order Status: <?php echo $row['Status']; ?></h3>
                                <h3>Order Items:</h3>
                                <h4><?php echo $row['OrderItems']; ?></h4>
                            </div>
                        <?php }
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