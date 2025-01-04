<?php
include ('dbconnect.php');
if(isset($_POST['cpassword']))
{
    changPassword($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="check your site status">
        <meta name="keywords" content="site stat">
        <meta name="author" content="VPMP POLITECHNIC">

        <title>Change Password</title>

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
                <!-- Headers Start -->
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
                                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="editsites.php">Edit Sites</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="editemails.php">Edit Mails</a>
                                    </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="sitehistory.php">Site History</a>
                                                <a class="dropdown-item" href="changeuname.php">Change Username</a>
                                                <a class="dropdown-item" href="logout.php">Log Out</a>
                                            </div>
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
                </div>



                <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-title">
                            <h2 class="heading-title text-center">Settings</h2>
                        </div>
                        <!-- contact forms -->
                        <center><h4 class="sub-title"><?php $email1 =$_SESSION['email'];  echo("Hello  $email1! ");?>Enter Details to be Changed</h4></center>
                        <!-- contact form 1 -->
                        
                        <!-- End contact form 1 -->
                        <center>
                        <div class="mb-60"></div>

                        

                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div id="contact-form-1">
                                    
                                    <form id="loginForm" data-toggle="validator" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" placeholder="Old Password" name="oldpassword" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="newpassword" placeholder="New Password" name="newpassword" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="cnfnewpassword" placeholder="Confirm New Usernmae" name="cnfnewpassword" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                              
                                        <div class="standard-button">
                                        <div class="standard-button-inner mtb-50">
                                            <div class="download">
                                            <center>
                                                <button name="cpassword" type="submit" class="btn std-btn btn-info-filled">
                                                    Change Password
                                                </button>
                                            </center>
                                            </div>
                                        </div>



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
            <!-- Content Area End -->
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

function changPassword($data)
{
    $id=$_SESSION['id'];
    $email = $_SESSION['email'];
    $oldPass = mysqli_real_escape_string($GLOBALS['db'],$data['oldpassword']);
    $newPass = mysqli_real_escape_string($GLOBALS['db'],$data['newpassword']);
    $cnfNewPass = mysqli_real_escape_string($GLOBALS['db'],$data['cnfnewpassword']);
    if($newPass==$cnfNewPass)
    {
        $checkOldPass = "select * from users where id = '$id' and password = '$oldPass'";
        $exeCheckOldPass = mysqli_query($GLOBALS['db'],$checkOldPass);
        if(mysqli_num_rows($exeCheckOldPass)>0)
        {
            $updPass = "update users set password='$newPass' where id='$id'";
            $exeUpdPass = mysqli_query($GLOBALS['db'],$updPass);
            echo '<script type="text/javascript">alert("Password Changed Successfully.");</script>';
        }
    }
    else{
        echo '<script type="text/javascript">alert("Password and Confirm Password Must Be Same");</script>';
    }
    

}

?>