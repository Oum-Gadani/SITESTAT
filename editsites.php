<?php
include ('dbconnect.php');
if(isset($_POST['add']))
{
addSite($_POST);
}
if(isset($_POST['delete']))
{
deleteSite($_POST);
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

        <title>Edit Sites</title>

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
                                            <a class="nav-link" href="editemails.php">Edit Mails</a>
                                        </li>
                                        
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="sitehistory.php">Site History</a>
                                                <a class="dropdown-item" href="changeuname.php">Change Username</a>
                                                <a class="dropdown-item" href="changepassword.php">Change Password</a>
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

                <!-- Headers End -->
                



                <div class="row">
                    <div class="col-12">
                      <div class="page-header-title">
                        <h2 class="heading-title text-center">You can Edit your Sites from Here</h2>
                      </div>
                      <!-- Standard Button -->
                      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                        <h3><center>

                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div id="contact-form-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="url" placeholder="www.example.com" name="url" size="30" required>
                                            <div class="help-block with-errors"></div> 
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="port" placeholder="If not know type 80" name="port" min="0" max="65535" size="10" width="10">
                                            <div class="help-block with-errors"></div> 
                                        </div>
                                </div>
                            </div>
                        
                        </center></h3>
                        <div class="standard-button">
                            <div class="standard-button-inner mtb-50">
                                <div class="download">
                                <center>
                                    <button name="add" type="submit" class="btn std-btn btn-info-filled">
                                        Add
                                    </button>
                                    <button name="delete" type="submit" class="btn std-btn btn-filled">
                                        Delete
                                    </button>
                                </center>
                            </div>
                       </div>
                    </form>
                    </div>
                </div>

                <?php
                   onload();
                ?>


            </div>
            <!-- Page Wrapper End -->
            <!-- Page Wrapper Start -->
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

function addSite($data)
{
    $id=$_SESSION['id'];
    $site = $data['url'];
    if(!isset($data['port']))
    {
        $port=80;
    }
    else
    {
        $port=$data['port'];
    }
    
    $qry=mysqli_query($GLOBALS['db'],"select * from sites where id='$id' and site='$site' and port='$port'");

    if($qry->num_rows >0)
    {
        echo "<script>alert('Site is alreday added.')</script>";
    }
    else
    {
        $insert_qry = "insert into sites (id,site,status,port) values ('$id', '$site',false,'$port')";
        $insert=mysqli_query($GLOBALS['db'],$insert_qry) or die ("mysql error2".mysqli_error($GLOBALS['db']));
    }

}

function deleteSite($data)
{
    $id=$_SESSION['id'];
    $site = $data['url'];
    if(!isset($data['port']))
    {
        $port=80;
    }
    else
    {
        $port=$data['port'];
    }
    $delete_qry = "delete from sites where id='$id' and site='$site' and port = '$port'";
    $delete=mysqli_query($GLOBALS['db'],$delete_qry) or die ("mysql error2".mysqli_error($GLOBALS['db']));

}

function onLoad()
{
    $id=$_SESSION['id'];
    
    $qry=mysqli_query($GLOBALS['db'],"select * from sites where id='$id'");

    if($qry->num_rows ==0)
    {
        echo "
            <div class='table-responsive mtb'>
                  <table class='table table-hover'>
                    <thead>
                      <tr>
                        <th>&nbsp;&nbsp;#</th>
                        <th>Sites</th>
                        <th>Port</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope='row' colspan=3><center>No Sites Added</center></th>
                      </tr>
                      </tbody>
                      </table>
                </div>";
    }
    else
    {
        $i=1;
        echo "
            <div class='table-responsive mtb'>
                  <table class='table table-hover'>
                    <thead>
                      <tr>
                        <th>&nbsp;&nbsp;#</th>
                        <th>Mails</th>
                        <th>Port</th>
                      </tr>
                    </thead>
                    <tbody>";
        while($result=mysqli_fetch_array($qry))
        {
            echo "<tr>
                        <th scope='row'>&nbsp;&nbsp;$i</th>
                        <td>$result[1]</td>
                        <td>$result[6]</td>
                      </tr>";
            $i++;
        }
        echo "         
                    </tbody>
                  </table>
                </div>";
    }

}


?>