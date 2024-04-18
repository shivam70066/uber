<?php
include 'connection.php';
// if ($_SESSION['Login'] == true) {
//     header('Location: http://localhost/arcsfrontend/dashboard.php');
//     die();
// }
$invalidemail = "";
$isEmailTrue = true;
$isPasstrue = true;



if (isset($_POST['submit'])) {

    $iscorrect = "true";


    // // email
    $email = $_POST['email'];
    if (!(preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email))) {
        $invalidemail = "Please enter a valid email.";
        $iscorrect = "false";
    }


    $password = $_POST['password'];
    if (strlen($password) < 8) {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $iscorrect = "false";
            $passWrong = '';
        }
    }



    $password = $_POST['password'];
    if ($invalidemail == "") {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            $passWrong = "Invalid email or password";
            $isEmailTrue = false;
            $isPasstrue = false;
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['password'])) {
                    session_start();
                    $_SESSION['uname'] = $row['name'];
                    $_SESSION['id']  = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['role_id'] = $row['role_id'];
                    $_SESSION['isLogin'] = "true";
                    $_SESSION['LoginFromFrontEnd'] = true;
                    header('Location: http://localhost/arcsfrontend/dashboard.php');
                    die();
                } else {
                    $isEmailTrue = false;
                    $isPasstrue = false;
                    $passWrong = "Invalid username or password";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <!-- <script src="style/signup.css" ></script> -->
    <link href="style/signup.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        select {
            width: 100%;
            margin: 5px auto;
            padding: 5px 20px;
            background: #eee;
            border-radius: 10px;
        }

        .content {
            margin-top: 13%;
        }

        #errmsg {
            height: 12px;
        }

        @media only screen and (max-width: 768px) {
            .content {
                margin-top: 8%;
            }
        }
    </style>
</head>

<body>
    <div id="navbar">
        <div id="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="57" height="20" fill="none">
                <path fill="#FFF" d="M8 17.4c2.6 0 4.7-2 4.7-5.1V.3h2.9v19.4h-2.9v-1.8a7 7 0 01-5 2.1c-4.2 0-7.4-3-7.4-7.6V.4h3v11.9c0 3 2 5.1 4.6 5.1zM17.7.3h2.8v7a7 7 0 015-2c4 0 7.3 3.3 7.3 7.4 0 4-3.2 7.3-7.4 7.3a7 7 0 01-5-2.1v1.8h-2.7V.3zm7.6 17.2c2.6 0 4.8-2.1 4.8-4.9 0-2.7-2.2-4.8-4.8-4.8a4.8 4.8 0 00-4.9 4.8c0 2.8 2.2 5 4.9 5zM41.1 5.3c4 0 7 3.1 7 7.3v1H36.7c.4 2.2 2.3 4 4.7 4 1.6 0 3-.7 4-2.1l2 1.5a7.3 7.3 0 01-6 3 7.3 7.3 0 01-7.5-7.4c0-4 3.1-7.3 7.2-7.3zm-4.3 6h8.5a4.4 4.4 0 00-4.2-3.6c-2.1 0-3.8 1.5-4.3 3.6zM55.6 8c-1.8 0-3.2 1.5-3.2 3.7v8h-2.7V5.6h2.7v1.7a3.7 3.7 0 013.4-1.8h1V8h-1.2z"></path>
            </svg>
        </div>
        <div id="login">
            <a href="signup.php">Sign Up</a>
        </div>
    </div>

    <div class="content">
        <div id="formDiv">
            <h1>Log In</h1>
            <form action="" method="post" onsubmit="return validateForm()">
                <input type="email" class="form-control" <?php if ($isEmailTrue == false) { ?> style="border: 1px solid red;" <?php } ?> placeholder="Enter email" id="email" name="email" onblur="validateEmail()" value="<?php echo $_POST['email'] ?>">

                <div id="errmsg">
                    <span id="emailmsg"><?PHP echo $invalidemail; ?></span>
                </div>

                <input type="password" class="form-control" placeholder="Password" <?php if ($isPasstrue == false) { ?> style="border: 1px solid red;" <?php } ?> id="password" name="password" value="<?php echo $_POST['password'] ?>" onblur="validatePassword()">
                <div id="errmsg">
                    <span id="passwordmsg"><?PHP echo $passWrong; ?></span>
                </div>



                <button type="submit" value="submit" name="submit" id="submit-btn" style="margin-top: 20px;">Login</button>
                <a href="forgotpassword.php" style="margin-left: 34%;">Forgot Password</a>
        </div>
        </form>
    </div>
    </div>

    <script src="js/validateLoginForm.js"></script>
</body>

</html>