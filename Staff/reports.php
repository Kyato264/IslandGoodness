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

            form {
                display: flex;
                align-items: center;
                align-self: end;
                gap: 1em;
            }

            select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 0;
            outline: 0;
            font: inherit;
            width: 100%;
            height: 3em;
            padding: 0 4em 0 1em;
            margin-top: 8px;
            margin-bottom: 8px;
            background: url(https://upload.wikimedia.org/wikipedia/commons/9/9d/Caret_down_font_awesome_whitevariation.svg) no-repeat right 0.8em center/1.4em, linear-gradient(to left, rgba(255, 210, 47, 1) 3em, rgba(86.3, 86.3, 86.3, .2) 3em);
            color: black;
            border-radius: 24px;
            cursor: pointer;
        }

        select option {
            color: inherit;
            background-color: rgba(255, 210, 47, .7);
        }

        select:focus {
            outline: none;
        }

        select::-ms-expand {
            display: none;
        }

        select:required:invalid {
            color: gray;
        }

        option[value=""][disabled] {
            display: none;
        }

            table {
                border-collapse: collapse;
            }

            th {
                border-bottom: 5px solid black;
            }

            td {
                padding: 1em;
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
                <div id="contentCrt">
                    <?php
                    // Default: Get the current date and time
                    $currentDate = date("Y-m-d H:i:s");
                    $selectedDate = date("Y-m-01", strtotime($currentDate));

                    // If a specific month is selected from the dropdown, use that date
                    if (isset($_POST['selectedDate'])) {
                        $selectedDate = $_POST['selectedDate'];
                    }

                    // Query to retrieve older reports
                    $olderSql = "SELECT DISTINCT DATE_FORMAT(start_date, '%Y-%m') AS month FROM monthly_reports ORDER BY start_date DESC";
                    $olderResult = $conn->query($olderSql);

                    // Display a dropdown to select older reports
                    echo "<form method='post'>";
                    echo "<select name='selectedDate'>";
                    while ($row = $olderResult->fetch_assoc()) {
                        echo "<option value='" . $row['month'] . "'";
                        if ($selectedDate == $row['month']) {
                            echo " selected";
                        }
                        echo ">" . $row['month'] . "</option>";
                    }
                    echo "</select>";
                    echo "<div class='formBtns'>";
                    echo "<input type='submit' value='Select'>";
                    echo "</div>";
                    echo "</form>";

                    // Query to retrieve the selected month's report
                    $sql = "SELECT * FROM monthly_reports WHERE start_date LIKE '$selectedDate%'";
                    $result = $conn->query($sql);

                    // Display the selected month's report
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo $row['report_content'];
                    } else {
                        echo "No report found for the selected month";
                    } ?>
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