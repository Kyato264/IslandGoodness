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
            * {
                outline: none;
            }

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
                box-shadow: 0rem 0.25rem 0.5625rem 0rem rgba(0, 0, 0, 0.15);
                gap: 1.5em;
            }

            .formBtns {
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

            .form-row {
                display: flex;
                margin: 32px 0;
                width: 100%;
            }

            .form-row .input-data {
                width: 100%;
                height: 40px;
                position: relative;
            }

            .form-row .textarea {
                height: 70px;
            }

            .input-data input,
            .textarea textarea {
                display: block;
                width: 100%;
                height: 100%;
                border: none;
                font-size: 17px;
                border-bottom: 2px solid rgba(0, 0, 0, 0.12);
            }

            .input-data input:focus~label,
            .textarea textarea:focus~label,
            .input-data input:valid~label,
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

            .input-data input:focus~.underline:before,
            .input-data input:valid~.underline:before,
            .textarea textarea:focus~.underline:before,
            .textarea textarea:valid~.underline:before {
                transform: scale(1);
            }

            #search {
                display: flex;
                flex-direction: row;
                width: 100%;
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
                    <a id="iconAndNameLink" href="staffHome.php">
                        <img src="../images\IslandGoodnessLogoBlack.svg" width="55px">
                    </a>
                </div>

                <div id="headerLinks">
                    <a href="staffHome.php">Home</a>
                    <a href="searchOrder.php">Search Order</a>
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

                <div id="contentCrt">
                    <form action="orderSearchStaff.php" id="search" method="post">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="name" required>
                                <div class="underline"></div>
                                <label for="name">Search orders</label>
                            </div>
                        </div>

                        <div class="formBtns">
                            <input type="submit" value="Search">
                        </div>
                    </form>

                    <div id="results" class="sss">
                        <?php
                        if (isset($_GET['matchedOrderIDs'])) { ?>
                            <h2>Results</h2>
                           <?php // Unserialize the array of matched order IDs
                            $matchedOrderIDs = unserialize($_GET['matchedOrderIDs']);

                            // Loop through each matched order ID
                            foreach ($matchedOrderIDs as $orderID) {
                                $sql = "SELECT 
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
                                    orders.OrderID = $orderID
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
                                        <?php
                                    }
                                }
                            }
                        } else {
                            if (isset($_GET['error'])) { ?>
                                <p class="error">
                                    <?php echo $_GET['error']; ?>
                                </p>
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