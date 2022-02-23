<?php
    $host = "localhost";
    $usr = "root";
    $pass = "root";
    $db = "callforduty";

    $conn = mysqli_connect($host, $usr, $pass, $db);

    if(!$conn)
    {
        die("connection failed: " . mysqli_connect_error());
    }
    ?>