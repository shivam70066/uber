<?php include 'getrequest.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>uber</title>
    <link rel="stylesheet" href="styleuber.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
</head>

<body>
    <div style="background-color: black; height: 100vh;">
        <nav style="display: flex; justify-content: space-around;">
            <div id="left">

                <ul style="display: flex; list-style-type: none; align-items: center; margin-right: 20px;">
                    <li id="logo"> <a href="#" style="font-weight: bold;">Uber</a></li>
                    <li><a href="#">Ride</a></li>
                    <li><a href="#">Drive</a></li>
                    <li><a href="#">Business</a></li>
                    <li><a href="#">Uber Eats</a></li>
                    </li><a href="#">About <i class="fa fa-caret-down"></i></i></a>
                </ul>
            </div>
            <div id="right">
                <ul style="display: flex; list-style-type: none; align-items: center; margin-top: 5px;">
                    <li><a href="#"><i class="fa fa-globe"></i> EN</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="login.php">Log in</a></li>
                    <li><a href="signup.php" id="signup">Sign up</a></li>

                </ul>
            </div>
        </nav>

        <section id="middle">
            <div id="content">
                <div id="contentleft">
                    <h1 style="color: white; font-size: 56px;">Go anywhere with Uber</h1>
                    <p style="margin: 5% 0px; font-size: 20px;">Request a ride, hop in, and go.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter Location">
                        <br>
                        <input type="text" placeholder="Enter Destination">
                        <button id="btn">See Prices</button>
                    </form>
                </div>
                <div id="contentright">
                    <img src="ber.webp" alt="" class="responsive" width="600">
                </div>

            </div>
        </section>
    </div>
    <section id="middle">
        <div id="content">
            <div id="contentright" style="padding-left: 40px;">
                <img src="22.webp" alt="" class="responsive" width="800">
            </div>
            <div id="contentleft">
                <h1 style="color: rgb(0, 0, 0); font-size: 56px;">Drive when you want, make what you need</h1>
                <p style="margin: 5% 0px; font-size: 20px; color: black;">Make money on your schedule with deliveries or
                    rides—or both. You can use your own car or choose a rental through Uber.</p>

                <form action="#">
                    <button id="btn-inverse">Get Started</button> <Span style="color: black;"><a href="" style="color: black;"> Already have an account? Sign in</a></Span>
                </form>
            </div>


        </div>
    </section>

    <section id="middle">
        <div id="content">

            <div id="contentleft">
                <h1 style="color: rgb(0, 0, 0); font-size: 56px;">The Uber you know, reimagined for business</h1>
                <p style="margin: 5% 0px; font-size: 20px; color: black;">Uber for Business is a platform for managing
                    global rides and meals, and local deliveries, for companies of any size.</p>

                <form action="#">
                    <button id="btn-inverse">Get Started</button> <Span style="color: black;"><a href="" style="color: black;">Check out our solutions</a></Span>
                </form>
            </div>

            <div id="contentright" style="padding-left: 40px;">
                <img src="33.webp" alt="" class="responsive" width="800">
            </div>


        </div>
    </section>

    <section id="middle">
        <div id="content" class="contact_content">



            <div id="contentright" style="padding-left: 40px; width: 55%;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3431.723800259219!2d76.72738137594555!3d30.66990518866563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fef724f4664b1%3A0x5cf04152a26499fa!2sArcs%20Infotech!5e0!3m2!1sen!2sin!4v1709187157306!5m2!1sen!2sin" width="100%" height="450" style="border:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div id="contentleft1" class="contact">
                <h1 style="color: rgb(0, 0, 0);">Contact Us</h1>
                <form method="post" onsubmit="return validateForm()">
                    <div>
                        <input type="text" name="name" id="name" placeholder="Name" onblur="validateName()">
                        <span id="namemsg"> <?php echo $nameErr; ?></span>
                    </div>
                    <div>
                        <input type="email" name="email" id="email" placeholder="E-mail" onblur="validateEmail()" >
                        <span id="emailmsg"> <?php echo $invalidemail; ?></span>
                    </div>

                    <div>
                        <input type="number" name="number" id="number" placeholder="Number" maxlength="10" oninput="this.value = this.value.slice(0, this.maxLength);" onblur="validateMobileNumber()">
                        <span id="numbermsg"> <?php echo $numbererror; ?></span>
                    </div>
                    <div>
                        <input type="text" name="subject" id="subject" placeholder="Subject" onblur="validateSubject()">
                        <span id="subjectmsg"> <?php echo $subjecterr ?> </span>
                    </div>
                    <div>
                        <textarea id="message" name="message" rows="6" placeholder="Enter your message." onblur="validateMessage()"></textarea>
                        <span id="messagemsg"> <?php echo $messageerr ?> </span>
                    </div>
                    <button id="btn-inverse" type="submit" class="contact-btn" value="submit" name="submit">Contact</button>
                </form>
            </div>


        </div>
    </section>

    <div id="scanner" style="background-color: rgba(128, 128, 128, 0.151); padding: 40px 0px 0px 0px;">
        <div id="scanneritems">
            <div id="h3" style="margin-bottom: 20px;">
                <h3>It’s easier in the apps</h3>
            </div>

            <div id="twodivscan">
                <div class="scandiv">
                    <img src="qr.webp" alt="">
                    <div>
                        <h4>Download the uber app</h4>
                        <p>Scan to download</p>
                    </div>
                    <a href="" style="color: black;"><i class="fa fa-angle-right" style="font-size: 46px"></i></a>

                </div>
                <div class="scandiv">
                    <img src="qr.webp" alt="">
                    <div>
                        <h4>Download the uber app</h4>
                        <p>Scan to download</p>
                    </div>
                    <a href="" style="color: black;"><i class="fa fa-angle-right" style="font-size: 46px"></i></a>

                </div>
            </div>
        </div>

        <div id="footer" style="background-color: black; padding: 20px 0px; color: white;">
            <div id="footerdiv">
                <a href="">
                    <p>Uber</p>
                </a>
                <a href="">
                    <p>Visit Help Center</p>
                </a>
                <div style="display: flex; justify-content: space-between;">
                    <div id="footer4div">
                        <h2>Company</h2>

                        <a href="">
                            <p>About us</p>
                        </a>
                        <a href="">
                            <p>Our offerings</p>
                        </a>
                        <a href="">
                            <p>Newsroom</p>
                        </a>
                        <a href="">
                            <p>Investors</p>
                        </a>
                        <a href="">
                            <p>Blog</p>
                        </a>
                        <a href="">
                            <p>Careers</p>
                        </a>
                        <a href="">
                            <p>AI</p>
                        </a>
                        <a href="">
                            <p>Gift Cards</p>
                        </a>
                    </div>
                    <div id="footer4div">
                        <h2>Products</h2>

                        <a href="">
                            <p>Ride</p>
                        </a>
                        <a href="">
                            <p>Drive</p>
                        </a>
                        <a href="">
                            <p>Deliver</p>
                        </a>
                        <a href="">
                            <p>Eat</p>
                        </a>
                        <a href="">
                            <p>Uber for business</p>
                        </a>
                        <a href="">
                            <p>Uber Frieght</p>
                        </a>
                    </div>
                    <div id="footer4div">
                        <h2>Global citizenship</h2>

                        <a href="">
                            <p>Safety</p>
                        </a>
                        <a href="">
                            <p>Diversity and inclusion</p>
                        </a>
                    </div>
                    <div id="footer4div">
                        <h2>Travel</h2>

                        <a href="">
                            <p>Reserve</p>
                        </a>
                        <a href="">
                            <p>Cities</p>
                        </a>
                    </div>
                </div>
                <div id="icons" style="display: flex; margin-top: 10px; justify-content: space-between;">
                    <div id="iconss" style="width: 60%;">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </div>
                    <div id="iconsleft" style="display: flex; align-items: center;">
                        <a href="#"><i class="fa fa-globe" aria-hidden="true"></i><span> English</span></a>
                        <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span> Mohali</span></a>

                    </div>
                </div>
                <div style="display: flex; align-items: center;">
                    <img src="gp.svg" alt="" width="200px" height="50px" style="margin: 40px 0px;">
                    <img src="aapl.svg" alt="" width="200px" height="50px">
                </div>
                <p style="color: rgba(255, 255, 255, 0.76); margin:15px 0px">@2023 Uber Technologies Inc.</p>
            </div>


        </div>

        <script>
            <?php
            if (isset($_SESSION['status'])) {

            ?>
                Swal.fire({
                    text: "Your message has been sent successfully. Thank you! Our Team will contact you in shortly.",
                    icon: "success",
                    showCloseButton: true,
                    confirmButtonText: `Okay`,
                    confirmButtonColor: "black",
                }).then((result) => {
                    <?php
                    unset($_SESSION['status']);
                    ?>
                    window.location.href = "uber.php";
                });
            <?php } ?>
        </script>
</body>

</html>