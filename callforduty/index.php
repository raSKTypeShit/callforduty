<?php
    $host = "localhost";
    $usr = "root";
    $pass = "root";
    $db = "";

    $conn = mysqli_connect($host, $usr, $pass, $db);

    if(!$conn)
    {
        die("connection failed: " . mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Call for Duty</title>
</head>
<body>
    
</body>
</html>

<?php
    mysqli_close($conn);
?>