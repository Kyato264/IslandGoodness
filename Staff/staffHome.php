<?php
session_start();

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