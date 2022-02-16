<?php

$formNR = intval($_GET["formNR"]);

$sql = "SELECT title, descr, COLOR, area FROM baseINFO WHERE formNR=" . $formNR;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    echo "<h2>" . $row["title"] . "</h2>";
    echo "<style>body > main > h2 {background-color: " . $row["COLOR"] . ";}</style>";

    echo "<section><h3>Beskrivelse av jobb</h3><p>" . $row["descr"] . "</p>
    <address><p>Lokasjon: " . $row["area"] . "</p></address></section>";

} else { echo "0 results"; }

?>
