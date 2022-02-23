<?php

include "./include/color_functions.php";

$formNR = intval($_GET["formNR"]);

$sql = "SELECT title, descr, COLOR, area FROM annonser WHERE id=" . $formNR;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    $rgb = convert_hex_to_rgb_list($row["COLOR"]);
    var_dump($rgb);
    $bright = brighten($rgb, 0.1);

    echo "<h2>" . $row["title"] . "</h2>";
    echo "<section><h3>Beskrivelse av jobb</h3><p>" . $row["descr"] . "</p>
    <address><p>Lokasjon: " . $row["area"] . "</p></address></section>";


    echo "<style>
    body > main > h2 {
        background-color: " . $row["COLOR"] . ";
    } 
    body > main > section > h3 {
        background-color: rgb(" . $bright[0] . ", " . $bright[1] . ", " . $bright[2] .");
    }
    </style>";

    var_dump($rgb);

} else { echo "0 results"; }

?>
