<?php

$height = 50;

echo '
<nav class="navbar">
    <a href="index.php"><img src="images/logo.png" height="' . $height . 'px"></a>';

    if (isset($_SESSION["user"])) {
        echo '<a href="profile_page.php"><img src="images/profile_page.png" height="' . $height . 'px"></a>';
    }  

echo '</nav>';
?>