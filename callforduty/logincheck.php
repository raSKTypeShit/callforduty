
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include "include/connect.php";
    if(isset($_POST["user"])&& isset($_POST["password"])){
        $user=$_POST["user"];
        $pass=$_POST["password"];

        $sql="SELECT * FROM login
        WHERE user=\"$user\"
        AND password=\"$pass\" ";

        $r=mysqli_query($conn,$sql);
        if(isset($r)){
            $_SESSION["user"]=$user;
            echo "Welcome ". $_SESSION["user"];
        }
    }
        else{
            session_destroy();
            echo "Wrong username or password, please try again!";
            
            
        }
        header("refresh:2; url=index.php");
        die();
        ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
