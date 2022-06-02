<?php

$height = 50;

if(isset($_SESSION["user"])){

  
}

  
echo '
<nav class="navbar">
<a href="index.php"><img src="images/logo.png" height="' . $height . 'px"></a>';
echo "<p id=\"meny\"> Menu</p>";

    if (isset($_SESSION["user"])) {
        echo "<section>";
        echo "<p>HELLO ". $_SESSION["user"]."</p>";
        echo '<a href="profile_page.php"><img src="images/profile_page.png" height="' . $height . 'px"></a>';
        echo "<a href="."form_generator.php".">Lag søknader</a>";
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

echo '</nav>';
?>