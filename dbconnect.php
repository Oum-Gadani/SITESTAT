<?php

session_start();
global $db;
$GLOBALS['db'] = mysqli_connect('localhost', 'root', '', 'sitestat');
date_default_timezone_set("Asia/Kolkata");
?>