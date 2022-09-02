<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'datalab';
$connection = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
date_default_timezone_set('Asia/Calcutta');

