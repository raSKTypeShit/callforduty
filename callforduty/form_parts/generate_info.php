<?php

include "./include/color_functions.php";

$formNR = intval($_GET["formNR"]);

// View Count
$sql = "UPDATE annonser SET views = views + 1 WHERE id = " . $formNR;
mysqli_query($conn, $sql);

$sql = "SELECT userID, title, descr, COLOR, area FROM annonser WHERE id=" . $formNR;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    $sql3 = "SELECT user FROM login WHERE id = " . $row["userID"];
    $username = mysqli_fetch_assoc(mysqli_query($conn, $sql3))["user"];

    $rgb = convert_hex_to_rgb_list($row["COLOR"]);
    $bright = brighten($rgb, 0.1);

    echo "<h2>" . $row["title"] . "</h2>";
    echo "<section><h3>Beskrivelse av jobb</h3><p>" . $row["descr"] . "</p>
    <address><p>Lokasjon: " . $row["area"] . "</p><p>Bedrift: " . $username . "</p></address></section>";


    echo "<style>
    body > main > h2 {
        background-color: " . $row["COLOR"] . ";
    } 
    body > main > section > h3 {
        background-color: rgb(" . $bright[0] . ", " . $bright[1] . ", " . $bright[2] .");
    }
    </style>";


} else { echo "0 results"; }

?>
