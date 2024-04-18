<?php
include 'connection.php';
if ($_SESSION['isLogin'] == true) {
    header('Location: http://localhost/arcsfrontend/dashboard.php');
    die();
}
$token = $_GET['token'];
$qry = "SELECT * FROM `security_tokens` WHERE `token_value` = '" . $token . "'";
$result = mysqli_query($con, $qry);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($num == 0) {
    header('Location: http://localhost/uber/login.php');
}
$id = $row['token_user_id'];

$iscorrect = true;

$createTime = new DateTime($row['created_at']);
$expiryTime = new DateTime($row['token_expiry_time']);



$current_time = new DateTime();

// Check if the expiry time is less than the current time
if ($expiryTime < $current_time || $expiryTime->format('Y-m-d') != $current_time->format('Y-m-d')) {
    $_SESSION['tokenExpired'] = true;
    $qry = "DELETE FROM `security_tokens` WHERE `token_value` = '" . $token . "'";
    $result = mysqli_query($con, $qry);
    $iscorrect = false;
}




if ($iscorrect) {
    if (isset($_POST['submit'])) {
        $npassword = $_POST['npassword'];
        $hash = password_hash($npassword, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `password`='$hash',`modifiedAt`=CURDATE() WHERE id=$id";

        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['status'] = "success";
            $qry = "DELETE FROM `security_tokens` WHERE `token_value` = '" . $token . "'";
            $result = mysqli_query($con, $qry);
            // include 'emailChangePassword.php';
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
            height: 22px;
        }

        @media only screen and (max-width: 768px) {
            .content {
                margin-top: 8%;
            }
        }

        #formDiv h1 {
            font-size: 36px;
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
    </div>

    <div class="content">
        <div id="formDiv">
            <h1 style="margin-bottom: 36px;">Forgot Password</h1>
            <form action="" method="post" onsubmit="return validateForm()">
                <input type="password" placeholder="New Password" id="npassword" name="npassword" onblur="">

                <div id="errmsg">
                    <span id="npassmsg"><?PHP echo $npassmsg; ?></span>
                </div>

                <input type="password" placeholder="Confirm Password" id="cpassword" name="cpassword">
                <div id="errmsg">
                    <span id="cpassmsg"><?PHP echo $cpassmsg; ?></span>
                </div>



                <button type="submit" value="submit" name="submit" id="submit-btn" style="margin-top: 20px;">Change Password</button>
                <p><?php echo $link; ?></p>
        </div>
        </form>
    </div>
    </div>
    <script>
        function validateForm() {
            var npassword = document.getElementById("npassword").value;
            var cpassword = document.getElementById("cpassword").value;

            document.getElementById("npassmsg").innerHTML = "";
            document.getElementById("cpassmsg").innerHTML = "";

            // Password validation rules
            var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;

            // Check if old password is empty
            if (npassword.trim() === "") {
                document.getElementById("npassmsg").innerHTML = "Please enter a valid password.";
                return false;
            }

            if (!passwordRegex.test(npassword)) {
                document.getElementById("npassmsg").innerHTML = "Password: 8+ characters,1 uppercase,1 lowercase,1 digit, <br> &nbsp &nbsp 1 special character.";
                return false;
            }

            // Check if confirm password matches new password
            if (npassword !== cpassword) {
                document.getElementById("cpassmsg").innerHTML = "Passwords do not match.";
                return false;
            } else {
                document.getElementById("cpassmsg").innerHTML = "";
            }

            // If all validations pass, return true to submit the form
            return true;
        }

        <?php
        if (isset($_SESSION['status'])) {

        ?>
            Swal.fire({
                title: "Password Changed",
                icon: "success",
                showCloseButton: true,
                confirmButtonText: "Okay",
                confirmButtonColor: "black",
            }).then((result) => {
                <?php
                unset($_SESSION['status']); // Clear the success message from session
                ?>
                window.location.href = "login.php"; // Change "index.php" to the desired page
            });
        <?php }

        if (isset($_SESSION['tokenExpired'])) {

        ?>
            Swal.fire({
                title: "Link Expired!",
                text: "Please request for a password reset again.",
                icon: "error",
                showCloseButton: true,
                confirmButtonText: "Okay",
                confirmButtonColor: "black",
            }).then((result) => {
                <?php
                unset($_SESSION['tokenExpired']); // Clear the success message from session
                ?>
                window.location.href = "forgotpassword.php"; // Change "index.php" to the desired page
            });
        <?php }

        ?>
    </script>
</body>

</html>