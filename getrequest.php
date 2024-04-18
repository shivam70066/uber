<?php
include 'connection.php';
// include 'checkLogin.php';
$nameErr = "";
$invalidemail = "";
$numbererror = "";

if (isset($_POST['submit'])) {
    

    $iscorrect = "true";

    $name = $_POST['name'];
    if (empty($name)) {
        $nameErr = "Please Enter your Name";
        $iscorrect = "false";
    } else if (!(preg_match("/^([a-zA-Z' ]+)$/", $name))) {
        $nameErr = "Please Enter a valid Name.";
        $iscorrect = "false";
    }




    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalidemail = "Please enter a valid E-mail.";
        $iscorrect = "false";
    }


    $number = (int) $_POST['number'];
    $num_length = strlen((string)$number);
    if (empty($number)) {
        $numbererror = "Please enter your number.";
        $iscorrect = "false";
    } else if (($num_length != 10)) {
        $numbererror = "Please enter valid 10 digits number.";
        $iscorrect = "false";
    }
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    // $message = mysqli_real_escape_string($mysqli, htmlspecialchars($message));
    $message = str_replace("'", "", $message);

    if ($iscorrect == "true") {
        $qry = "INSERT INTO `contact`(`name`, `email`,`number`,`subject`,`message`,`recieveAt`) VALUES ('$name','$email','$number','$subject','$message',CURDATE())";
        $success = mysqli_query($con, $qry);

        if ($success) {
            $_SESSION['status'] = "success";
        }
        else {
            // If there was an error, you can retrieve the error message
            $error_message = mysqli_error($con);
            // Handle the error, for example, display an error message or log it
            echo "Error: " . $error_message;
        }
    }
}


?>