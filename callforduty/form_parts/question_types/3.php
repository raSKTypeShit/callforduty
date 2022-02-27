<?php

$sql2 = "SELECT id, info FROM additional WHERE containerNR=" . $row["id"];
$result2 = mysqli_query($conn, $sql2);

$checked = "checked";
if (mysqli_num_rows($result2) > 0) {
    while($row2 = mysqli_fetch_assoc($result2)) {
        echo '<div><input type="checkbox" name="q' . $row["id"] . '" value="' . $row2["id"] . '" ' . $checked . '>' . $row2["info"] . '</div>';
        $checked = "";
    }
} else { echo "0 results"; }

?>