<?php
include('dbconnect.php');

if(isset($_POST['submit']))
{
$msg= user_signup($_POST);
}

?>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bootstrap UI Kit">
    <meta name="keywords" content="ui kit">
    <meta name="author" content="UIdeck">

    <title>Signup - SiteStat</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Fonts icons -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

</head>

<body>
    <!-- Page Wrapper Start -->
    <div class="wrapper">
        <!-- Content Area Start -->
        <div id="content">
          <div id="headers">
            <!-- Light header -->
            <header id="header-style-1">
                <nav class="navbar navbar-expand-lg navbar-light bg-faded">
                    <div class="container">
                        <a class="navbar-brand" href="index.php"><img src="img/logo-2.png" alt=""></a>
                        
                        <button ton class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Go Back</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php">Alredy A User? LogIn.</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="container">
                    <div class="header-caption">
                        <div class="row">
                            <!--<div class="col-12 header-content">
                                <h3 class="header-title animated fadeInDown"><span class="text-primary">Helium </span> - Bootstrap 4 UI Kit</h3>
                                <h5 class="header-text animated fadeIn">Lorem ipsum dolor sit amet, consectetuer adipiscing elit<br>Lorem ipsum dolor sit amet, consectetuer.</h5>
                                <a href="#" class="page-scroll btn btn-lg btn-default-filled animated fadeInUp">Download Now</a>
                                <a href="#" class="page-scroll btn btn-lg btn-common animated fadeInUp">Explore</a>
                            </div>-->
                        </div>
                    </div>
                </div>
            </header>


            
            
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-title">
                            <h2 class="heading-title text-center">SignUp</h2>
                        </div>
                        
                            <!-- contact forms -->
                            <center><h4 class="sub-title">Enter Details</h4></center>
                            <!-- contact form 1 -->
                        
                            <!-- End contact form 1 -->

                            <div class="mb-60"></div>

                        
                            <center>
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div id="contact-form-1">
                                    <form id="signupForm" data-toggle="validator" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" max="15" placeholder="Username" name="uname" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" placeholder="Email" max="50" name="email" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                          <input type="password" class="form-control" id="password" placeholder="Password" max="18" name="pass" required>
                                          <div class="help-block with-errors"></div>
                                      </div>
                                      <div class="form-group">
                                        <input type="password" class="form-control" id="cnfPassword" placeholder="Confirm Password" max="18" name="cnfpass" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                        <button type="submit" name="submit" id="form-submit" class="btn btn-md btn-common btn-form-submit">SignUp</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        
                        </div>
                        </center>
                        <div class="mb-60"></div>

                    
                    </div>
                </div>
            </div>
        
        </div>
        <!-- Content Area End -->
    </div>
    <!-- Footer -->
    <footer class="default-footer text-center">
                <div class="container">
                    <img class="mb-1 footer-logo" src="img/logo-2.png" alt="">
                    <span class="copy-right dis-blk">College Project Crafted <i class="fa fa-heart cyan-color"></i> By VPMP Polytechnic Students.</span>
                    <span class="social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </span>
                </div>
            </footer>

        <div class="mb-60"></div>

        <!-- Light Footer -->
        <footer class="light-footer">
            <div class="container">
                <p class="footer-info"><strong>SiteStat</strong> -  © 2023 - All Rights Reserved.</p>
            </div>
        </footer>
    <!-- Page Wrapper End -->

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>

    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/main.js"></script>
</body>

</html>


<?php

function user_signup($data)
{


$name = mysqli_real_escape_string($GLOBALS['db'],$data['uname']);
$email = mysqli_real_escape_string($GLOBALS['db'],$data['email']);
$password = mysqli_real_escape_string($GLOBALS['db'],$data['pass']);
$cnfpass = mysqli_real_escape_string($GLOBALS['db'],$data['cnfpass']);
date_default_timezone_set('Asia/Kolkata');
$dt = date("Y-m-d H:i:s");
$qry=mysqli_query($GLOBALS['db'],"select * from users where email='$email'");

if($qry->num_rows >0)
{
echo "<script>alert('Email Id already exists.')</script>";
}
elseif(!($password==$cnfpass))
{
    echo "<script>alert('Password and Confirm Password Must Be The Same.')</script>";
}
else
{
$sql="insert into users(username,email,password,last_login,data_created) VALUES('$name','$email','$password',' $dt ','$dt')";
$query=mysqli_query($GLOBALS['db'],$sql) or die("Error 2".mysqli_error($GLOBALS['db']));
if($query)
{
    $login_qry = "select * from users where email='$email' AND password='$password'";
    $login=mysqli_query($GLOBALS['db'],$login_qry) or die ("mysql error2".mysqli_error($GLOBALS['db']));
    $result=mysqli_fetch_array($login);
    if(mysqli_num_rows($login)>0)
    {
        $_SESSION['id']=$result['id'];
        $_SESSION['email']=$result['email'];
        $_SESSION['uname']=$result['username'];
    }
    $id = $_SESSION['id'];
    $qry = mysqli_query($GLOBALS['db'],"insert into mails values ('$id','$email')");
    $sms_msg
    = "Thank You for registering with us.<br>Regards,<br>onTime
    Infotech,<br>https://www.ontimeinfotech.com/";
    echo "<script>alert('Congratulations!! Registration has been done successfully.')</script>";
    echo '<script>window.location.href="dashboard.php";</script>';
}
}
}
?>