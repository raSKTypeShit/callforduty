<?php
    include "include/connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Call for Duty</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
    <?php
      if(isset($_SESSION["user"])){
          echo "<section>";
          echo "<p>HELLO ". $_SESSION["user"]."</p>";
          echo "<a href="."logout.php".">logout</a>";
          echo "<a href="."form_generator-php".">Lag søknader</a>";
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
    </nav>
    <?php include "include/annonseviewer.php";
    mysqli_close($conn);
    ?>
</body>
</html>

