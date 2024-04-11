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
    <title>Cart</title>
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
            gap: 1.5em;
        }

        .error {
            background-color: #F2DEDE;
            color: #A94442;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
        }


        .pass {
            background-color: #def2de;
            color: #42a944;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
        }

        #cartItems {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5em;
        }

        #cartItem {
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;

        }

        #cartItem a,
        #cartItem a:visited {
            text-decoration: none;
            color: #A94442;
            font-weight: bold;
            padding: 10px;
            border: solid transparent;
            transition: 0.2s ease-in-out;
        }

        #cartItem a:hover {
            border: solid #A94442;
        }

        #cartItem a:active {
            transform: translate(0px, 5px);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 150;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            gap: 1.5em;
            background-color: white;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        hr {
            background-color: #333333;
            height: 2px;
            width: 100%;
            border: none;
            margin-top: 10px;
        }

        #deliveryInfo {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        #map {
            height: 400px;
            width: 100%;
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
            width: 100%;
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
                    <a href="trackOrders.php">Track Orders</a>
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
                <?php if(isset($_SESSION['CustomerID'])) { ?>
                <h1>YOUR CART</h1>

                <?php if (isset($_GET['error'])) { ?>
                    <p class="error">
                        <?php echo $_GET['error']; ?>
                    </p>
                <?php } ?>

                <?php if (isset($_GET['pass'])) { ?>
                    <p class="pass">
                        <?php echo $_GET['pass']; ?>
                    </p>
                <?php } ?>


                <div id="cartItems">

                    <?php
                    $id = $_SESSION['CustomerID'];

                    $query = "SELECT * FROM cart 
                            INNER JOIN fooditem ON cart.ItemID = fooditem.ItemID
                            WHERE cart.CustomerID = $id";
                    $result = $conn->query($query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <div id="cartItem">
                                <div id="itemName">
                                    <h3>Item:
                                        <?php echo $row['Name']; ?>
                                    </h3>
                                </div>

                                <div id="itemQty">
                                    <h3>Qty:
                                        <?php echo $row['Quantity']; ?>
                                    </h3>
                                </div>

                                <div id="itemPrice">
                                    <h3>Price:BBD$
                                        <?php echo $row['Quantity'] * $row['Price']; ?>
                                    </h3>
                                </div>

                                <div id="confirmationModal" class="modal">
                                    <div class="modal-content">
                                        <p style="color: #A94442">Are you sure you want to delete this item?</p>
                                        <?php
                                        $encodedCartID = urlencode($row['CartID']);
                                        echo '<a href="deleteItem.php?CartID=' . $encodedCartID . '">Delete</a>';
                                        ?>
                                        <a href="#" onclick="cancelAction()">No</a>
                                    </div>
                                </div>

                                <a href="#" onclick="return showConfirmation()">Delete</a>
                            </div>



                        <?php }
                        ?>
                    <?php } else { ?>
                        <h3 style="text-align: center;">Cart is empty.</h3>
                    <?php }
                    ?>
                </div>

                <hr>

                <h3 id="total">Total: BBD$<?php 
                $id = $_SESSION['CustomerID'];

                $query = "SELECT * FROM cart 
                INNER JOIN fooditem ON cart.ItemID = fooditem.ItemID
                WHERE cart.CustomerID = $id";
                $result = mysqli_query($conn, $query);
                
                $sum = 0;
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $sum += ($row['Quantity'] * $row['Price']);
                }

                echo $sum;
                ?></h3>

                <hr>

                <div id="deliveryInfo">
                    <h3>Select delivery Location:</h3>
                    <div id="map"></div>
                    <form action="cardPayProcessing.php" method="post">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <div class="formBtns">
                            <input type="submit" formaction="cashPaymentProcessing.php" value="Place Order">
                        </div>
                    </form>
                </div>
            <?php } else { ?>
                <h3>Login to see your cart!</h3>
            <?php } ?>

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
        function showConfirmation() {
            var modal = document.getElementById("confirmationModal");
            modal.style.display = "flex";
            return false; // Prevent form submission
        }

        function cancelAction() {
            var modal = document.getElementById("confirmationModal");
            modal.style.display = "none";
        }

        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 13.1939, lng: -59.5432 },
                zoom: 8
            });

            var marker = new google.maps.Marker({
                position: { lat: 13.1939, lng: -59.5432 },
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function (event) {
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });
        }

    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChufpGKSGUHukJqJeRhlwakQigNd3Tvpw&libraries=places&callback=initMap"
        async defer></script>
</body>

</html>