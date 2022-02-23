<?php
    $host = "localhost";
    $usr = "root";
    $pass = "";
    $db = "callforduty";
    session_start();
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
    <?php
      

      if(isset($_SESSION["user"])){
          echo "<section>";
          echo "HELLO ". $_SESSION["user"];
          echo "<a href="."logout.php".">logout</a>";
          echo "<a href="."deleteuser.php".">Delete user </a>";
          echo "</section>";
          
      }
      else{
          echo "<section>
          <a href="."login.php"."> Login</a>";
          echo "<a href="."signup.php".">Create a user</a>
          </section>";
          }
          
    ?>
    <?php include "include/annonseviewer.php";?>
</body>
</html>

<?php
    mysqli_close($conn);
?>