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
    <style>
        * {
            outline: none;
        }

        #content {
            padding: 1.5em;
        }

        #formCrt {
            width: 80%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
            padding: 1.5em;
            border-radius: 0.25em;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        #options {
            width: 80%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            margin: 10px;
            padding-bottom: 10px;
            border-bottom: 3px solid #ffd22f;
        }

        #options h2,
        #options a:visited {
            text-decoration: none;
            color: black;
            font-weight: bold;
            padding: 10px;
            border: solid transparent;
            transition: 0.2s ease-in-out;
        }

        #options h2:hover {
            border: solid black;
        }

        #options h2:active {
            transform: translate(0px, 5px);
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

        #formCrt form {
            width: 80%;
            display: flex;
            flex-direction: column;
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

        @media screen and (max-width: 720px) {
            #options {
                flex-wrap: wrap;
            }

            .formBtns {
                gap: 20px;
            }
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
                                echo $_SESSION['FirstName'];
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
            <div id="formCrt">
                <div id="options">
                    <h2 onclick="toggleCreate()">Create</h2>
                    <h2 onclick="toggleUpdate()">Update</h2>
                    <h2 onclick="toggleDelete()">Delete</h2>
                </div>

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

                <form action="createProcessing.php" method="post" id="createForm" enctype="multipart/form-data" autocomplete="off">
                    <h1 style="text-align: center;">CREATE</h1>
                    <div class="form-row">
                        <div class="input-data">
                            <input type="text" name="name" required>
                            <div class="underline"></div>
                            <label for="name">Item Name</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-data textarea">
                            <textarea name="description" cols="30" rows="10" required></textarea>
                            <div class="underline"></div>
                            <label for="description">Item Description</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-data">
                            <input type="text" name="price" required>
                            <div class="underline"></div>
                            <label for="price">Item Price</label>
                        </div>
                    </div>

                    <label for="category">Select Category</label>
                        <select name="category" id="position">
                            <option value="" disabled selected>--Select Category--</option>
                            <option value="soup">Soup</option>
                            <option value="lasagna">Lasagnas</option>
                            <option value="pizza">Pizzas</option>
                            <option value="preserve">Preserves</option>
                            <option value="condiment">Condiments</option>
                            <option value="drink">Drinks</option>
                        </select>


                    <label for="image">Item Image</label>
                    <input type="file" name="image" accept="image/*">

                    <div class="formBtns">
                        <input type="submit" value="Create">
                        <input type="reset" value="Reset">
                    </div>
                </form>

                <form style="display: none;" action="updateProcessing.php" method="post" id="updateForm" enctype="multipart/form-data" autocomplete="off">
                    <h1 style="text-align: center;">UPDATE</h1>
                    <div class="form-row">
                        <div class="input-data">
                            <input type="text" name="cname" required>
                            <div class="underline"></div>
                            <label for="cname">Current Item Name</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-data">
                            <input type="text" name="newName" required>
                            <div class="underline"></div>
                            <label for="newName">New Item Name</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-data textarea">
                            <textarea name="newDescription" cols="30" rows="10" required></textarea>
                            <div class="underline"></div>
                            <label for="newDescription">New Item Description</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-data">
                            <input type="text" name="newPrice" required>
                            <div class="underline"></div>
                            <label for="newPrice">New Item Price</label>
                        </div>
                    </div>

                    <label for="image">Item Image</label>
                    <input type="file" name="image" accept="image/*">

                    <div class="formBtns">
                        <input type="submit" value="Update">
                        <input type="reset" value="Reset">
                    </div>
                </form>

                <form style="display: none;" action="deleteProcessing.php" method="post" id="deleteForm" autocomplete="off">
                    <h1 style="text-align: center;">DELETE</h1>
                    <div class="form-row">
                        <div class="input-data">
                            <input type="text" name="name" required>
                            <div class="underline"></div>
                            <label for="name">Item Name To Be Deleted</label>
                        </div>
                    </div>

                    <div class="formBtns">
                        <input type="submit" value="Delete">
                        <input type="reset" value="Reset">
                    </div>
                </form>
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
                            <li><a href="Staff/staffLogin.php">Staff Portal</a></li>
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
    <script>
        const createForm = document.getElementById("createForm");
        const updateForm = document.getElementById("updateForm");
        const deleteForm = document.getElementById("deleteForm");

        function toggleUpdate() {
            createForm.style.display = "none";
            updateForm.style.display = "flex";
            deleteForm.style.display = "none";
        }

        function toggleCreate() {
            createForm.style.display = "flex";
            updateForm.style.display = "none";
            deleteForm.style.display = "none";
        }

        function toggleDelete() {
            createForm.style.display = "none";
            updateForm.style.display = "none";
            deleteForm.style.display = "flex";
        }
    </script>
</body>

</html>

<?php
} else {
    header("Location: staffLogin.php");
    exit();
}
?>