<?php
for ($x = 0; $x < count($types); $x+=1) {
    unset($_SESSION[$types[$x]]);
}

$i = 0;
while (isset($_SESSION["qst" . $i])) {
    unset($_SESSION["qst" . $i]);
    unset($_SESSION["qst_type" . $i]);
    unset($_SESSION["qst_opt" . $i]);
    $i++;
}

?>