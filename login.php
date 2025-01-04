<?php
include ('dbconnect.php');
if(isset($_POST['submit']))
{
user_login($_POST);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bootstrap UI Kit">
    <meta name="keywords" content="ui kit">
    <meta name="author" content="UIdeck">

    <title>LogIn - SiteStat</title>

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
                        <a class="navbar-brand" href="index.html"><img src="img/logo-2.png" alt=""></a>
                        
                        <button ton class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Go Back</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="signup.php">New to SiteStat? SignUp</a>
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
                            <h2 class="heading-title text-center">LogIn</h2>
                        </div>
                        <!-- contact forms -->
                        <center><h4 class="sub-title">Enter Details</h4></center>
                        <!-- contact form 1 -->
                        
                        <!-- End contact form 1 -->
                        <center>
                        <div class="mb-60"></div>

                        

                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div id="contact-form-1">
                                    
                                        <form id="loginForm" data-toggle="validator" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                          <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                                          <div class="help-block with-errors"></div>
                                      </div>
                              
                                        <button type="submit" id="form-submit" class="btn btn-md btn-common btn-form-submit" name="submit">Login</button>
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

function user_login($data)
{

    $email = $data['email'];
    $password = $data['password'];
    $login_qry = "select * from users where email='$email' AND password='$password'";
    $login=mysqli_query($GLOBALS['db'],$login_qry) or die ("mysql error2".mysqli_error($GLOBALS['db']));
    $result=mysqli_fetch_array($login);
    if(mysqli_num_rows($login)>0)
    {
    $_SESSION['id']=$result['id'];
    $id = $_SESSION['id'];
    $_SESSION['email']=$result['email'];
    $_SESSION['uname']=$result['username'];
    date_default_timezone_set('Asia/Kolkata');
    $dt = date("Y-m-d H:i:s");
    $sql="update users set last_login ='$dt' where id = '$id'";
    $query=mysqli_query($GLOBALS['db'],$sql) or die("Error 2".mysqli_error($GLOBALS['db']));
    echo '<script type="text/javascript">window.location.href="dashboard.php";</script>';
    }
    else
    {
    $_SESSION['user']['id']="";
    echo '<script type="text/javascript">alert("Please Enter Correct Email and Password");</script>';
    }
}

?>