<?php
    include "include/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <?php
    if(isset($_POST["user"])&& isset($_POST["password"])){
        $user=$_POST["user"];
        $pass=$_POST["password"];
        $sql="SELECT * FROM login
        WHERE user=\"$user\" ";
        
        $r=mysqli_query($conn,$sql);
        if(mysqli_num_rows($r)==1){
            $row= mysqli_fetch_assoc($r);
            //sjekker om passord stemmer med hashing
            if(password_verify($pass,$row["password"])){  
                $_SESSION["user"]=$user;
                $_SESSION["id"]=$row["id"];
                echo "Welcome ". $_SESSION["user"];
            }
        }
        else{
            session_destroy();
            echo "Wrong username or password, please try again!";
            
            
        }
    }
        
        ?>
</body>
<meta http-equiv="refresh" content="2;url=index.php" />
</html>
<?php
mysqli_close($conn);
?>
