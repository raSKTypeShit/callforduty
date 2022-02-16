<?php
$sql = "SELECT id, question, qtype FROM containers WHERE formNR=" . $formNR;
$result = mysqli_query($conn, $sql);

echo "<section><form>";

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='question'><label>" . $row["question"] . "</label><div>";

        $questiontype = "form_parts/question_types/" . $row["qtype"] . ".php";
        include $questiontype;

        echo "</div></div>";
    }
} else { echo "0 results"; }

echo "</section></form>";

$diff_types = ["Tekst", "Ja/nei", "Avkrysning", "Flervalg", "Numerisk", "Fil"];

?>
