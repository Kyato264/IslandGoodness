<?php
session_start();
include ("../dbConn.php");

if (isset($_SESSION["StaffID"]) && isset($_SESSION["UserName"])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles.css">

        <!--FONTS-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
            rel="stylesheet">
        <link rel="shortcut icon" href=../images\IslandGoodnessLogoBlackNoWords.svg type="image/x-icon">
        <title>Staff Home</title>
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

            .formBtns {
                width: 100%;
                display: flex;
                justify-content: space-around;
                padding: 20px 0px;
            }

            .formBtns input {
                background: white;
                color: #ffd22f;
                border-style: solid;
                border-color: #ffd22f;
                height: 50px;
                width: 100px;
                text-shadow: none;
                transition: 0.3s ease-in-out;
            }

            .formBtns input:hover {
                background-color: #ffd22f;
                color: white;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .formBtns input:active {
                transform: translate(0px, 10px);
            }
        </style>
    </head>

    <body>
        <div id="crt">
            <div id="header">
                <button id="menu-toggle" onclick="toggleSidebar()">☰</button>
                <div id="iconAndName">
                    <a id="iconAndNameLink" href="staffHome.php">
                        <img src="../images\IslandGoodnessLogoBlack.svg" width="55px">
                    </a>
                </div>

                <div id="headerLinks">
                    <a href="staffHome.php">Home</a>
                    <a href="updateMenu.php">Update Menu</a>
                    <?php if ($_SESSION['Position'] == 'management') { ?>
                        <a href="reports.php">Reports</a>
                    <?php } ?>
                    <a href="../customerPortal.php">Logout</a>

                </div>
            </div>

            <div id="sidebar">
                <div class="sideTop">

                    <div class="userInfo">
                        <div class="userNameCrt">
                            <p><b>Hi there,</b></p>
                            <h2>
                                <?php if (isset($_SESSION['UserName'])) {
                                    echo $_SESSION['UserName'];
                                } else { ?>

                                    Guest User

                                <?php } ?>
                            </h2>
                        </div>
                    </div>

                    <button id="menu-Close" onclick="toggleClose()">&#10006;</button>
                </div>

                <div class="sidebarLinks">
                    <a href="staffHome.php">Home</a>
                    <a href="updateMenu.php">Update Menu</a>
                    <a href="../customerPortal.php">Logout</a>
                </div>
            </div>


            <div id="content">
                <h1>New Orders</h1>
                <div id="newOrders" class="sss">


                    <?php $sql = "SELECT 
            orders.OrderID, 
            orders.TimeStamp, 
            GROUP_CONCAT(CONCAT(fooditem.Name, ' (', orderitems.Quantity, ')') SEPARATOR '<br>') AS OrderItems
        FROM 
            orders
        INNER JOIN 
            orderitems ON orderitems.OrderID = orders.OrderID
        INNER JOIN 
            fooditem ON fooditem.ItemID = orderitems.ItemID
        WHERE 
            orders.Status = 'awaiting'
        GROUP BY 
            orders.OrderID";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div id="newOrder" class="box">
                                <h2>Order Number: <?php echo $row['OrderID']; ?></h2>
                                <h3>Time Placed: <?php echo $row['TimeStamp']; ?></h3>
                                <h3>Order Items:</h3>
                                <h4><?php echo $row['OrderItems']; ?></h4>
                                <form action="" method="POST">
                                    <input type="hidden" name="OrderID" value="<?php echo $row['OrderID']; ?>">
                                    <div class="formBtns">
                                        <input type="submit" formaction="in-progress.php" value="In-progress">
                                        <input type="submit" formaction="delivery.php" value="Out For Delivery">
                                        <input type="submit" formaction="Completed.php" value="Completed">
                                    </div>
                                </form>
                            </div>
                        <?php }
                    }
                    ?>
                </div>

                <h1>Current Orders</h1>
                <div id="CurrentOrders" class="sss">
                    <?php $sql = "SELECT 
            orders.OrderID, 
            orders.TimeStamp, 
            GROUP_CONCAT(CONCAT(fooditem.Name, ' (', orderitems.Quantity, ')') SEPARATOR '<br>') AS OrderItems
        FROM 
            orders
        INNER JOIN 
            orderitems ON orderitems.OrderID = orders.OrderID
        INNER JOIN 
            fooditem ON fooditem.ItemID = orderitems.ItemID
        WHERE 
            orders.Status = 'In-progress'
        GROUP BY 
            orders.OrderID";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div id="newOrder" class="box">
                                <h2>Order Number: <?php echo $row['OrderID']; ?></h2>
                                <h3>Time Placed: <?php echo $row['TimeStamp']; ?></h3>
                                <h3>Order Items:</h3>
                                <h4><?php echo $row['OrderItems']; ?></h4>
                                <form action="" method="POST">
                                    <input type="hidden" name="OrderID" value="<?php echo $row['OrderID']; ?>">
                                    <div class="formBtns">
                                        <input type="submit" formaction="awaiting.php" value="awaiting">
                                        <input type="submit" formaction="delivery.php" value="Out For Delivery">
                                        <input type="submit" formaction="Completed.php" value="Completed">
                                    </div>
                                </form>
                            </div>
                        <?php }
                    }
                    ?>
                </div>

                <h1>Our For Delivery</h1>
                <div id="outForDelivery" class="sss">
                    <?php $sql = "SELECT 
            orders.OrderID, 
            orders.TimeStamp, 
            GROUP_CONCAT(CONCAT(fooditem.Name, ' (', orderitems.Quantity, ')') SEPARATOR '<br>') AS OrderItems
        FROM 
            orders
        INNER JOIN 
            orderitems ON orderitems.OrderID = orders.OrderID
        INNER JOIN 
            fooditem ON fooditem.ItemID = orderitems.ItemID
        WHERE 
            orders.Status = 'Delivery'
        GROUP BY 
            orders.OrderID";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div id="newOrder" class="box">
                                <h2>Order Number: <?php echo $row['OrderID']; ?></h2>
                                <h3>Time Placed: <?php echo $row['TimeStamp']; ?></h3>
                                <h3>Order Items:</h3>
                                <h4><?php echo $row['OrderItems']; ?></h4>
                                <form action="" method="POST">
                                    <input type="hidden" name="OrderID" value="<?php echo $row['OrderID']; ?>">
                                    <div class="formBtns">
                                        <input type="submit" formaction="awaiting.php" value="awaiting">
                                        <input type="submit" formaction="in-progress.php" value="In-progress">
                                        <input type="submit" formaction="Completed.php" value="Completed">
                                    </div>
                                </form>
                            </div>
                        <?php }
                    }
                    ?>
                </div>

                <h1>Completed Today</h1>
                <div id="completedToday" class="sss">
                    <?php $sql = "SELECT 
            orders.OrderID, 
            orders.TimeStamp,
            orders.CompletedTime, 
            GROUP_CONCAT(CONCAT(fooditem.Name, ' (', orderitems.Quantity, ')') SEPARATOR '<br>') AS OrderItems
        FROM 
            orders
        INNER JOIN 
            orderitems ON orderitems.OrderID = orders.OrderID
        INNER JOIN 
            fooditem ON fooditem.ItemID = orderitems.ItemID 
            WHERE DATE(CompletedTime) = DATE(CompletedTime)
        GROUP BY 
            orders.OrderID";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div id="newOrder" class="box">
                                <h2>Order Number: <?php echo $row['OrderID']; ?></h2>
                                <h3>Time Placed: <?php echo $row['TimeStamp']; ?></h3>
                                <h3>Time Completed: <?php echo $row['CompletedTime']; ?></h3>
                                <h3>Order Items:</h3>
                                <h4><?php echo $row['OrderItems']; ?></h4>
                                <form action="" method="POST">
                                    <input type="hidden" name="OrderID" value="<?php echo $row['OrderID']; ?>">
                                    <div class="formBtns">
                                        <input type="submit" formaction="awaiting.php" value="awaiting">
                                        <input type="submit" formaction="in-progress.php" value="In-progress">
                                        <input type="submit" formaction="delivery.php" value="Out For Delivery">
                                    </div>
                                </form>
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
                            <p class="text-justify">Island Goodness is dedicated to providing top-notch food and
                                service,
                                always accompanied by a warm smile. Our goal is to ensure that every customer enjoys
                                high-quality cuisine and friendly hospitality.</p>
                        </div>

                        <div class="col-xs-6 col-md-3">
                            <h6>Quick Links</h6>
                            <ul class="footer-links">
                                <li><a href="staffHome.php">Home</a></li>
                                <li><a href="updateMenu.php">Update Menu</a></li>
                                <li><a href="staffLogin.php">Staff Portal</a></li>
                                <li><a href="../customerPortal.php">Customer Portal</a></li>
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
        <script src="../script.js"></script>
    </body>

    </html>

    <?php
} else {
    header("Location: staffLogin.php");
    exit();
}
?>