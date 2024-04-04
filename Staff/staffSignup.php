<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images\IslandGoodnessLogoBlack.svg" type="image/x-icon">
    <title>Register</title>
    <style>
        * {
            padding: 0%;
            margin: 0%;
            box-sizing: border-box;
        }

        body,
        html {
            width: 100%;
            display: inline-block;
            font-family: Helvetica, Sans-Serif;
        }

        .crt {
            /*min-height right now is forcing the webpage to take up all of the devices viewport */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(204deg, #6d9db9, #FFD22f, #b3c1cb);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .registerCrt {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #ffff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: -500px;
            animation: drop 2s ease forwards;
        }

        @keyframes drop {
            0% {
                opacity: 0;
            }

            70% {
                transform: translateY(700px);
            }

            100% {
                transform: translateY(510px);
            }
        }

        form {
            width: 350px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .formCrt {
            padding: 20px 20px 20px 20px;
        }

        .registerHead {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px 20px 20px 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            box-sizing: border-box;
            outline: none;
            border: 2px solid transparent;
            border-radius: 24px;
            font-size: 1rem;
            background-color: gainsboro;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border: 2px rgb(255, 210, 47) solid;
        }

        input[type="submit"] {
            background: rgb(224, 242, 254);
      background: linear-gradient(204deg,
          rgba(224, 242, 254, 1) 0%,
          rgb(	255, 210, 47) 100%);
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 24px;
            transition: 0.25s;
        }

        input[type="submit"]:hover {
            opacity: 0.7;
        }

        .error {
            background-color: #F2DEDE;
            color: #A94442;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
        }

        .checkbox-wrapper-46 input[type="checkbox"] {
            display: none;
            visibility: hidden;
        }

        .checkbox-wrapper-46 .cbx {
            margin: auto;
            -webkit-user-select: none;
            user-select: none;
            cursor: pointer;
        }

        .checkbox-wrapper-46 .cbx span {
            display: inline-block;
            vertical-align: middle;
            transform: translate3d(0, 0, 0);
        }

        .checkbox-wrapper-46 .cbx span:first-child {
            position: relative;
            width: 18px;
            height: 18px;
            border-radius: 3px;
            transform: scale(1);
            vertical-align: middle;
            border: 1px solid #FFD22f;
            transition: all 0.2s ease;
        }

        .checkbox-wrapper-46 .cbx span:first-child svg {
            position: absolute;
            top: 3px;
            left: 2px;
            fill: none;
            stroke: #FFFFFF;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 16px;
            stroke-dashoffset: 16px;
            transition: all 0.3s ease;
            transition-delay: 0.1s;
            transform: translate3d(0, 0, 0);
        }

        .checkbox-wrapper-46 .cbx span:first-child:before {
            content: "";
            width: 100%;
            height: 100%;
            background: #FFD22f;
            display: block;
            transform: scale(0);
            opacity: 1;
            border-radius: 50%;
        }

        .checkbox-wrapper-46 .cbx span:last-child {
            padding-left: 8px;
        }

        .checkbox-wrapper-46 .cbx:hover span:first-child {
            border-color: #FFD22f;
        }

        .checkbox-wrapper-46 .inp-cbx:checked+.cbx span:first-child {
            background: #FFD22f;
            border-color: #FFD22f;
            animation: wave-46 0.4s ease;
        }

        .checkbox-wrapper-46 .inp-cbx:checked+.cbx span:first-child svg {
            stroke-dashoffset: 0;
        }

        .checkbox-wrapper-46 .inp-cbx:checked+.cbx span:first-child:before {
            transform: scale(3.5);
            opacity: 0;
            transition: all 0.6s ease;
        }

        .signup {
            display: flex;
            justify-content: left;
            color: black;
            text-decoration: none;
            text-align: center;
            padding: .5rem 0 .5rem 0;
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

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            align-items: center;
            justify-content: center;
        }

        /* Styles for the pop-up content */
        .popup {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 25%;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .popup label {
            font-weight: bold;
        }

        .Btns {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            width: 100%;
        }

        .adminSub,
        .adminClose {
            background: white;
            color: #FFD22f;
            border: 2px solid #FFD22f;
            font-size: 1rem;
            padding: 1rem;
            text-shadow: none;
            transition: 0.3s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .adminSub:hover,
        .adminClose:hover {
            background-color: #FFD22f;
            color: white;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        .adminSub:active,
        .adminClose:active {
            transform: translate(0px, 10px);
        }

        @keyframes wave-46 {
            50% {
                transform: scale(0.9);
            }
        }

        @media screen and (max-width: 768px) {
            .popup {
                width: auto;
            }
        }
    </style>
</head>

<body>
    <div class="crt">
        <div class="registerCrt" id="con2">
            <div class="registerHead">
            <a href="../index.php"><img src="../images\IslandGoodnessLogoBlack.svg" width="100px"></a>
                <h1>Please Signup</h1>
            </div>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?php echo $_GET['error']; ?>
                </p>
            <?php } ?>

            <div class="registerForm">
                <form action="staffSignupProcessing.php" method="post" autocomplete="off">
                    <div class="formCrt">
                        <label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" />

                        <label for="position" style="font-weight: bold">Select Position</label>
                        <select name="position" id="position" required>
                            <option value="" disabled selected>--Select Position--</option>
                            <option value="management">Management</option>
                            <option value="chef">Chef</option>
                            <option value="driver">Driver</option>
                        </select>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" id="password" />

                        <label for="psw"><b>Confirm Password</b></label>
                        <input type="password" placeholder="Re-enter Password" name="repsw" id="rePassword" />

                        <div class="checkbox-wrapper-46">
                            <input class="inp-cbx" id="cbx-46" type="checkbox" onclick="showPass()" />
                            <label class="cbx" for="cbx-46"><span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg></span><span>Show Password</span>
                            </label>
                        </div>

                        <a href="staffLogin.php" class="signup">
                            <b>Already have an account? <span style="color: #FFD22f;">Login now</span></b>
                        </a>

                        <input type="submit" value="Register" />
                    </div>
                </form>

            </div>
        </div>

        <div class="overlay" id="overlay">
            <div class="popup">
                <label for="password">Enter management password:</label>
                <input type="password" id="adminPassword">
                <div class="Btns">
                    <button class="adminSub" onclick="checkPassword()">Submit</button>
                    <button class="adminClose" onclick="closePassword()">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showPass() {
            var x = document.getElementById("password");
            var y = document.getElementById("rePassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        }

        function showPopup() {
            document.getElementById('overlay').style.display = 'flex';
        }

        // Function to check the password
        function checkPassword() {
            var password = document.getElementById('adminPassword').value;

            // Replace 'yourPassword' with the actual password
            if (password === 'Password1234') {
                alert('Password correct!'); // You can replace this with your own logic
                document.getElementById('overlay').style.display = 'none';
                // Add your logic to perform the action for the selected option here
            } else {
                alert('Incorrect password. Please try again.');
            }
        }

        // Event listener for the select tag
        document.getElementById('position').addEventListener('change', function () {
            var selectedOption = this.value;

            // Replace 'option3' with the value of the option you want to protect
            if (selectedOption === 'management') {
                showPopup();
            }
        });

        function closePassword() {
            var selectedIndex = 0;
            var select = document.getElementById('position');

            document.getElementById('overlay').style.display = 'none';

            select.selectedIndex = selectedIndex;
        }
    </script>
</body>

</html>