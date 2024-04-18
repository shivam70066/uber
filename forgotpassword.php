<?php
include 'connection.php';
if ($_SESSION['Login'] == true) {
    header('Location: http://localhost/arcsfrontend/dashboard.php');
    die();
}

$isEmailTrue = true;

$invalidemail = "";
if (isset($_POST['submit'])) {

    $iscorrect = "true";


    // // email
    $email = $_POST['email'];
    if (!(preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email))) {
        $invalidemail = "Please enter a valid email.";
        $iscorrect = "false";
    }

    if ($invalidemail == "") {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        if ($num == 0) {
            $invalidemail = "Email not found.";
            $isEmailTrue = false;
        } else {

            $invalidemail = "";
            $isEmailTrue = true;
            $id = $row['id'];
            $name = $row['name'];
            $token = bin2hex(random_bytes(40));

            $qry = "SELECT `expiry_time` FROM `user_settings`";
            $data = mysqli_query($con, $qry);
            $row1 = mysqli_fetch_array($data);
            $expire_time = $row1['expiry_time'];


            $sql = "INSERT INTO `security_tokens`(`token_type`, `token_user_id`, `token_value`, `token_expiry_time`, `created_at`) VALUES ('Forgot Password','$id','$token',NOW() + INTERVAL $expire_time MINUTE , NOW())";
            $success = mysqli_query($con, $sql);
            $link = "http://localhost/uber/changepassword.php?token=" . $token;
            if ($success) {
                $_SESSION['status'] = "success";
                // include 'emialmsgsfile/changepasswordlink.php';
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
        #formDiv {}

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
            <h1 style="margin-bottom: 40px;">Forgot Password</h1>
            <form action="" method="post" onsubmit="return validateEmail()">
                <input type="email" class="form-control" <?php if ($isEmailTrue == false) { ?> style="border: 1px solid red;" <?php } ?> placeholder="Enter email" id="email" name="email" onkeyup="validateEmail()" value="<?php echo $_POST['email'] ?>">

                <div id="errmsg">
                    <span id="emailmsg"><?PHP echo $invalidemail; ?></span>
                </div>



                <button type="submit" value="submit" name="submit" id="submit-btn" style="margin-top: 20px;">Forgot Password</button>
        </div>


        </form>
    </div>
    </div>
    <script>
        function validateEmail() {
            var emailInput = document.getElementById("email");
            var email = emailInput.value.trim();
            var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (email === "") {
                document.getElementById("emailmsg").innerHTML =
                    "Please enter an email address.";
                return false;
            } else if (!emailRegex.test(email)) {
                document.getElementById("emailmsg").innerHTML = "Please enter a valid email.";
                return false;
            } else {
                document.getElementById("emailmsg").innerHTML = "";
                return true;
            }
        }

        <?php
        if (isset($_SESSION['status'])) {

        ?>

            function sendEmail() {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'emialmsgsfile/changepasswordlink.php', true);
                var data = 'link=' + encodeURIComponent('<?php echo $link; ?>') + '&name=' + encodeURIComponent('<?php echo $name; ?>') + '&email=' + encodeURIComponent('<?php echo $email; ?>');

                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText); // Display the response
                    }
                };
                // alert("hello");
                xhr.send(data);
            }
            sendEmail();

            
            Swal.fire({
                title: "Password Reset Link Sent",
                text: "A password reset link has been sent to your email. Please check your inbox.",
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

        ?>
    </script>
</body>

</html>