<?php
include 'api/connection.php';
// include 'checkLogin.php';
if ($_SESSION['Login'] == true) {
    header('Location: http://localhost/arcsfrontend/dashboard.php');
    die();
}
$nameErr = "";
$invalidemail = "";
$numbererror = "";
$ageerror = "";
$designationErr = "";
$gendererr = "";
$pass = "";


if (isset($_POST['submit'])) {

    $sub = "";
    if (isset($_POST['chkbox']) && $_POST['chkbox'] === 'true1') {
        // Checkbox is checked
        $sub = "true";
    } else {
        // Checkbox is not checked
        $sub = "false";
    }



    $iscorrect = "true";

    if ($_POST['country'] != "" && $_POST['state'] != "") {
        $location = $_POST['state'] . ", " . $_POST['country'];
    } else {
        $iscorrect = "false";
        $locerr = "Please enter a valid location.";
    }



    $name = $_POST['name'];
    if (empty($name)) {
        $nameErr = "Please Enter your Name";
        $iscorrect = "false";
    } else if (!(preg_match("/^([a-zA-Z' ]+)$/", $name))) {
        $nameErr = "Please Enter a valid Name.";
        $iscorrect = "false";
    }



    if (isset($_POST["gender"]) && !empty($_POST["gender"])) {
        $gender = $_POST["gender"];
    } else {
        $gendererr = "Please select a gender.";
        $iscorrect = "false";
    }





    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalidemail = "Please enter a valid E-mail.";
        $iscorrect = "false";
    }

    $qrry = "SELECT * FROM users WHERE email ='".$email."'";
    $dataa = mysqli_query($con, $qrry);
    if(mysqli_num_rows($dataa)>0){
        $invalidemail = "Email is already registered.";
        $iscorrect = "false";
    }
    

    $dob = $_POST['dob'];

    // Calculate the age
    $today = new DateTime();
    $birthdate = new DateTime($dob);
    $age = $today->diff($birthdate)->y;

    $password = $_POST['password'];
    $pass = $password;
    $cpassword = $_POST['cpassword'];
    if (strlen($password) < 8) {
        $passerr = "Password should be at atleast 8 characters";
        $iscorrect = "false";
    } else {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars) {
            $iscorrect = "false";
            $passerr = 'Password should include at least one upper case letter, one number, and one special character.';
        }
    }
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);


    $number = $_POST['number'];
    // echo $number;
    $num_length = strlen((string)$number);
    if (empty($number)) {
        $numbererror = "Please enter your number.";
        $iscorrect = "false";
    } else if (($num_length != 10)) {
        $numbererror = "Please enter valid 10 digits number.";
        $iscorrect = "false";
    }

    if ($iscorrect == "true") {

        $query = "select role_id from roles where role_slug = 'employee'";
        $data = mysqli_query($con, $query);
        $row = mysqli_fetch_array($data);


        $qry = "INSERT INTO `users`(`name`, `designation`, `email`,`number`,`age`,`gender`,`location`,`subscription`,`createdAt`,`role_id`,`password`) VALUES ('$name','employee','$email','$number','$age','$gender','$location','$sub',CURDATE(),$row[0],'$hash')";

        $success = mysqli_query($con, $qry);

        $currentDateTime = date("Y-m-d H:i:s");
        $msg = "$name has been registered on $currentDateTime. His email is $email, designation is $designation, and number is $number.";
        $qry = "INSERT INTO `msg`(`msg`,`action`) VALUES ('$msg','add')";
        mysqli_query($con, $qry);
        if ($success) {
            include 'test.php';
            $_SESSION['status'] = "success";
        }
    } else {
        // echo "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

        #errmsg {
            height: 12px;
        }
    </style>
</head>

<body>
    <div id="navbar" >
        <div id="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="57" height="20" fill="none">
                <path fill="#FFF" d="M8 17.4c2.6 0 4.7-2 4.7-5.1V.3h2.9v19.4h-2.9v-1.8a7 7 0 01-5 2.1c-4.2 0-7.4-3-7.4-7.6V.4h3v11.9c0 3 2 5.1 4.6 5.1zM17.7.3h2.8v7a7 7 0 015-2c4 0 7.3 3.3 7.3 7.4 0 4-3.2 7.3-7.4 7.3a7 7 0 01-5-2.1v1.8h-2.7V.3zm7.6 17.2c2.6 0 4.8-2.1 4.8-4.9 0-2.7-2.2-4.8-4.8-4.8a4.8 4.8 0 00-4.9 4.8c0 2.8 2.2 5 4.9 5zM41.1 5.3c4 0 7 3.1 7 7.3v1H36.7c.4 2.2 2.3 4 4.7 4 1.6 0 3-.7 4-2.1l2 1.5a7.3 7.3 0 01-6 3 7.3 7.3 0 01-7.5-7.4c0-4 3.1-7.3 7.2-7.3zm-4.3 6h8.5a4.4 4.4 0 00-4.2-3.6c-2.1 0-3.8 1.5-4.3 3.6zM55.6 8c-1.8 0-3.2 1.5-3.2 3.7v8h-2.7V5.6h2.7v1.7a3.7 3.7 0 013.4-1.8h1V8h-1.2z"></path>
            </svg>
        </div>
        <div id="login">
            <a href="login.php">Login</a>
        </div>
    </div>

    <div class="content">
        <div id="formDiv">
            <h1>Sign Up</h1>
            <form action="" method="post" onsubmit="return validateForm()">
                <input type="text" name="name" id="name" class="name" placeholder="Enter name" value="<?php echo $name; ?>" onblur="validateName()">
                <div id="errmsg">
                    <span id="namemsg"></span>
                </div>

                <input type="email" name="email" id="email" class="email" placeholder="Enter email" onblur="validateEmail()" value="<?php echo $email; ?>">
                <div id="errmsg">
                    <span id="emailmsg"><?php echo $invalidemail; ?></span>
                </div>

                <input type="password" name="password" id="password" class="password"  placeholder="Enter password" onblur="validatePassword()" value="<?php echo $pass; ?>">
                <div id="errmsg">
                    <span id="passwordmsg"></span>
                </div>


                <input type="password" name="cpassword" id="cpassword" value="<?php echo $pass; ?>" class="cpassword" placeholder="Confirm password" onblur="validateConfirmPassword()">
                <div id="errmsg">
                    <span id="cpassmsg"></span>
                </div>

                <input type="number" name="number" id="number" class="number" placeholder="Enter number" value="<?php echo $_POST['number']; ?>" maxlength="10" oninput="this.value = this.value.slice(0, this.maxLength);" onblur="validateMobileNumber()">
                <div id="errmsg">
                    <span id="numbermsg"></span>
                </div>

                <input type="date" name="dob" max="2030-12-31" id="dob" class="dob" style="margin-bottom: 2px;" value="<?php echo $dob; ?>"onblur="validateDOB()">
                <div id="errmsg" style="margin-bottom :15px;" >
                    <span id="dobmsg"></span>
                </div>

                <div id="gender">
                    <label>
                        <input style="margin-right: 5px;" type="radio" name="gender" value="Male">
                        Male
                    </label>
                    <label>
                        <input type="radio" name="gender" style="margin-right: 5px;" value="Female">
                        Female
                    </label>
                </div>
                <div id="errmsg">
                    <span class="error-ms" id="genderError" style="color: red;"><?php echo $gendererr ?></span>
                </div>
                <div style="display: flex;justify-content:space-around; margin-top:10px;">
                    <label style="margin-right:10px; padding-left:10px">Location: </label>
                    <div style="width:60%">
                        <select class="form-select country search-box" name="country"  id="countrySelect" style="margin-bottom:4px; " onchange="loadStates()" onblur="validateLocation()">
                            <option selected value="select">Select Country</option>
                        </select> <br>
                        <select class="form-select state search-box" name="state" style="margin-bottom:4px;" id="stateSelect" onblur="validateLocation()">
                            <option selected value="select">Select State</option>
                        </select>
                    </div>
                </div>
                <div id="errmsg">
                    <span class="error-ms" id="locmsg"><?php echo $locerr; ?></span>
                </div>
                <div style="display: block;">
                    <label>
                        <input type="checkbox" value="true1" name="chkbox" style="width:10%;margin:20px 5px"> Subscribe to our newsletter.
                    </label>
                </div>
                <button type="submit" value="submit" name="submit" id="submit-btn"> Sign Up</button>
        </div>
        </form>
    </div>
    </div>
    <script>
        <?php
        if (isset($_SESSION['status'])) {

        ?>
            Swal.fire({
                title: "Registered",
                icon: "success",
                showCloseButton: true,
                confirmButtonText: `Okay`,
                confirmButtonColor: "#ff651b",
            }).then((result) => {
                <?php
                unset($_SESSION['status']);
                ?>
                window.location.href = "signup.php";
            });
        <?php }

        ?>

        $(document).ready(function() {
            var timeoutId; // Initialize a variable to hold the timeout ID

            $('#email').on('input', function() {
                clearTimeout(timeoutId); // Clear the previous timeout

                // Start a new timeout
                timeoutId = setTimeout(function() {
                    var email = $(this).val();
                    var emailInput = document.getElementById("email");
                    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                    if (!emailRegex.test(email)) {
                        document.getElementById("emailmsg").innerHTML = "Please enter a valid email.";
                        return;
                    }

                    // Execute the AJAX request after debouncing
                    $.ajax({
                        url: 'checkEmailUsers.php',
                        type: 'POST',
                        data: {
                            email: email
                        },
                        success: function(response) {
                            $('#emailmsg').html(response);
                        }
                    });
                }.bind(this), 500); // Set the debounce time to 500 milliseconds (adjust as needed)
            });
        });
    </script>
    <script src="api/contries.js"></script>
    <script src="js/validateform.js"></script>
</body>

</html>