<?php
session_start();
include ("dbConn.php"); ?>
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

        .error {
            background-color: #F2DEDE;
            color: #A94442;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
        }

        #itemInfo {
            width: 100%;
            display: flex;
            gap: 4rem;
        }

        #itemImage {
            width: 30%;
            display: flex;
            justify-content: center;
        }

        #itemImage img {
            width: 200px;
            height: 200px;
        }

        #itemText {
            width: 70%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5em;
        }

        #itemText h4 {
            color: rgb(73, 73, 73);
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

        .input-data input[type=number],
        .textarea textarea {
            display: block;
            width: 100%;
            height: 100%;
            border: none;
            font-size: 17px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.12);
            outline: none
        }

        .input-data input[type=number]:focus~label,
        .input-data input[type=number]:focus-visible~label,
        .textarea textarea:focus~label,
        .input-data input[type=number]:valid~label,
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

        .input-data input[type=number]:focus~.underline:before,
        .input-data input[type=number]:focus-visible~.underline:before,
        .input-data input[type=number]:valid~.underline:before,
        .textarea textarea:focus~.underline:before,
        .textarea textarea:valid~.underline:before {
            transform: scale(1);
        }

        .formBtns {
            width: 100%;
            display: flex;
            justify-content: space-around;
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
                <a href="trackOrders.php">Track Orders</a>

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
            </div>
        </div>


        <div id="content">
            <div id="contentCrt">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error">
                        <?php echo $_GET['error']; ?>
                    </p>
                <?php } ?>

                <?php
                if (isset($_GET["Name"])) {
                    $encodedName = $_GET['Name'];
                    $name = urldecode($encodedName);
                    $query = "SELECT * FROM fooditem WHERE Name = '$name'";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc(); ?>
                        <div id="titleName">
                            <h1>
                                <?php echo $row['Name']; ?>
                                <h1>
                        </div>

                        <div id="itemInfo">
                            <div id="itemImage">
                                <?php echo '<img src="data:image/jpeg;base64, ' . $row['Image'] . '" alt="' . $row["Name"] . '">'; ?>
                            </div>

                            <div id="itemText">
                                <div id="itemTDescription">
                                    <h3>Description</h3>
                                    <h4>
                                        <?php echo $row['Description']; ?>
                                    </h4>
                                </div>

                                <div id="itemPrice">
                                    <h3>Price</h3>
                                    <h4>
                                        $BBD
                                        <?php echo $row['Price']; ?>
                                    </h4>
                                </div>

                                <form action="cartProcessing.php" method="post">
                                    <div id="shhh" style="display: none;">
                                        <input type="number" name="ItemID" value="<?php echo $row['ItemID']; ?>">
                                    </div>
                                    <div class="form-row">
                                        <div class="input-data">
                                            <input type="number" name="quantity" oninput="maxLengthCheck(this)" maxlength="1" max="5" required>
                                            <div class="underline"></div>
                                            <label for="quantity">Quantity</label>
                                        </div>
                                    </div>

                                    <div class="formBtns">
                                        <input type="submit" value="ADD TO CART">
                                    </div>
                                </form>

                            </div>
                        </div>
                    <?php } else {
                        echo 'Menu item not found.';
                    }
                } else {
                    echo 'Menu item ID not provided.';
                }
                ?>

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
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength) {
                object.value = object.value.slice(0, object.maxLength);
            }
        }
    </script>
</body>

</html>