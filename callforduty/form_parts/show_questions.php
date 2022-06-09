<?php
$sql = "SELECT id, question, qtype, nr FROM containers WHERE formNR=" . $formNR . " ORDER BY NR ASC";
$result = mysqli_query($conn, $sql);

echo "<section><form action='upload_application.php' method='post' enctype='multipart/form-data'>";
echo "<div class='question'><label>Mail</label><div><input type='mail' name='mail' placeholder='Eksempel: søt.bestemor@gmail.com'></div></div>";

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        if (!isset($startID)) {$startID = $row["id"];}
        echo "<div class='question'><label>" . $row["question"] . "</label><div>";

        $questiontype = "form_parts/question_types/" . $row["qtype"] . ".php";
        include $questiontype;

        echo "</div></div>";
    }
} else { echo "0 results"; }

echo "</section>        
<input type='hidden' name='formNR' value='" . $formNR . "'>
<input type='hidden' name='startID' value='" . $startID . "'>
<input type='submit' name='submit' value='Ferdig'></form>";

$diff_types = ["Tekst", "Ja/nei", "Avkrysning", "Flervalg", "Numerisk", "Fil"];

?>
