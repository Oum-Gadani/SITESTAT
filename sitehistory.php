<?php
include ('dbconnect.php');

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

  <title>Site History</title>

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
                                      
                                      <a class="dropdown-item" href="changeuname.php">Change Username</a>
                                      <a class="dropdown-item" href="changepassword.php">Change Password</a>
                                      <a class="dropdown-item" href="logout.php">Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!--<div class="container">
                    <div class="header-caption">
                        <div class="row">
                            <div class="col-12 header-content">
                                <h3 class="header-title animated fadeInDown"><span class="text-primary">Helium </span> - Bootstrap 4 UI Kit</h3>
                                <h5 class="header-text animated fadeIn">Lorem ipsum dolor sit amet, consectetuer adipiscing elit<br>Lorem ipsum dolor sit amet, consectetuer.</h5>
                                <a href="#" class="page-scroll btn btn-lg btn-default-filled animated fadeInUp">Download Now</a>
                                <a href="#" class="page-scroll btn btn-lg btn-common animated fadeInUp">Explore</a>
                            </div>
                        </div>
                    </div>
                </div>-->
            </header>
        </div>

        <!-- Headers End -->

    </div>
</div>






  <!-- Page Wrapper Start -->
  <div class="wrapper">
    <!-- Content Area Start -->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header-title">
                    <h2 class="heading-title text-center">History</h2>
                </div>
                <?php
                  onLoad();
                ?>
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

  

  function onLoad()
  {
    $id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $uname = $_SESSION['uname'];
    $getSites = "select site,port from sites where id = '$id' ";
    $exeGetSites = mysqli_query($GLOBALS['db'],$getSites) or die ("mysql error2".mysqli_error($GLOBALS['db']));
    if($exeGetSites->num_rows ==0)
    {
      echo("  
                  <div class='table-style3'>
                      <div class='sub-title'>
                        <span>No Sites</span>
                      </div>
                      <div class='table-responsive mtb'>
                        <table class='table table-hover'>
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Down Time</th>
                              <th>Up Time</th>
                              <th>Days</th>
                              <th>Hours</th>
                              <th>Minutes</th>
                              <th>Seconds</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td colspan='7'><center>Add sites to get logs</center></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  ");
    }
    else
    {
      
      while($result1=mysqli_fetch_array($exeGetSites))
      {
        $site = $result1[0];
        $port = $result1[1];
        $getLogs = "select * from sitelog where id='$id' and site='$site' and port='$port' ORDER BY downtime DESC";
        $exeGetLogs = mysqli_query($GLOBALS['db'],$getLogs) or die ("mysql error2".mysqli_error($GLOBALS['db']));
        
        if($exeGetLogs->num_rows ==0)
        {
          echo("  
                  <div class='table-style3'>
                      <div class='sub-title'>
                        <span>$site : $port</span>
                      </div>
                      <div class='table-responsive mtb'>
                        <table class='table table-hover'>
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Down Time</th>
                              <th>Up Time</th>
                              <th>Days</th>
                              <th>Hours</th>
                              <th>Minutes</th>
                              <th>Seconds</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td colspan='7'><center>NO Logs Found</center></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  ");
        }
        else
        {
          $i=1;
          echo("
          <div class='table-style3'>
          <div class='sub-title'>
            <span>$site : $port </span>
          </div>
          <div class='table-responsive mtb'>
            <table class='table table-hover'>
            <thead>
                            <tr>
                              <th>#</th>
                              <th>Down Time</th>
                              <th>Up Time</th>
                              <th>Days</th>
                              <th>Hours</th>
                              <th>Minutes</th>
                              <th>Seconds</th>
                            </tr>
                          </thead>
                          <tbody>
          ");

          while($result2=mysqli_fetch_array($exeGetLogs))
          {
            echo(" 
                <tr>
                <th scope='row'>$i</th>
                <td>$result2[4]</td>
                <td>$result2[5]</td>
                <td>$result2[6]</td>
                <td>$result2[7]</td>
                <td>$result2[8]</td>
                <td>$result2[9]</td>
              ");
              $i++;
          }
          echo("</tr>
                </tbody>
                </table>
                </div>
                </div>
          ");
      }

      }
      
    }
  }
?>