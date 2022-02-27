<?php
    include "include/connect.php";

    $properInfo = 0;

    if (isset($_GET["formNR"]) && isset($_SESSION["id"])) {
        $userID = $_SESSION["id"];
        $formNR = $_GET["formNR"];

        $sql = "SELECT * FROM annonser WHERE id=" . $formNR;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row["userID"] == $userID) {
                $properInfo = 1;
            } 
        }
    }

    if ($properInfo != 1) {
        header('Location: index.php'); 
        exit();
    }

    $diff_types = ["Tekst", "Ja/nei", "Avkrysning", "Flervalg", "Numerisk", "Fil"];
    $mult_choice  = [1, 2, 3];
    $additional_types = [2, 3];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Call for duty - Data viewer</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    
</head>

<body class="data_viewer">

    <main>
        <h2>Settings</h2>
        <section class="buttons">
            <div><button onclick="navigator.clipboard.writeText('localhost/callforduty/callforduty/apply.php?formNR=<?php echo $formNR ?>');">Copy URL</button></div>
            <div>Upload images</div>
            <div>View form</div>
            <div>Public</div>
            <div>Delete</div>
            <div>Enkeltresponser</div>
        </section>

        <h2>Info</h2>

        <section>
<?php
$sql = "SELECT title, descr, COLOR, area FROM annonser WHERE id=" . $formNR;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    echo "
    <p><strong>Tittel:</strong> " . $row["title"] . "</p>
    <p><strong>Lokasjon:</strong> " . $row["area"] . "</p>
    <p><strong>Fargekode:</strong> " . $row["COLOR"] . "</p>
    <p><strong>Beskrivelse av jobb: </strong>" . $row["descr"] . "</p>";
} else { echo "0 results"; }
?>
        </section>
        <h2>Statistikk</h2>
        <section>
<?php

$sql = "SELECT id, question, qtype, nr FROM containers WHERE formNR=" . $formNR . " ORDER BY NR ASC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<article>
        <h3>Spørsmål: " . $row["question"] . "</h3>

        <ul>
            <li>Nummer: " . ($row["nr"]+1) . "</li>
            <li>Type respons: " . $diff_types[$row["qtype"]] . "</li>";

        if (in_array($row["qtype"], $mult_choice)) {
            $show = [];
            $countVal = [];
            $count = [];
            $rgbs = [];

            if ($row["qtype"] == 1) {
                $show = ["Ja", "Nei"];
                $countVal = ["1", "2"];
            }

            if (in_array($row["qtype"], $additional_types)) {
                $sql2 = "SELECT additional.info AS answer, additional.id AS value FROM additional, containers
                WHERE additional.containerNR = containers.id 
                AND containers.formNR = " . $formNR . " 
                AND containers.NR=" . $row["nr"];

                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        array_push($show, $row2["answer"]);
                        array_push($countVal, $row2["value"]);
                    }
                }

            }

            echo "<li>Valg:<ol>";
            for ($i = 0; $i < count($show); $i++) {
                $sql2 = "SELECT COUNT(*) AS a FROM answers WHERE answers.answer = '" . $countVal[$i] . "' AND answers.containerID = " . $row["id"] . " GROUP BY answers.answer;";
                $result2 = mysqli_query($conn, $sql2);

                if (mysqli_num_rows($result2) == 1) {
                    // output data of each row
                    $amount = mysqli_fetch_assoc($result2)["a"];
                } else {$amount = 0;}
                array_push($count, $amount);
                $rrgb = [rand(0, 255), rand(0, 255), rand(0, 255)];
                array_push($rgbs, $rrgb);
                echo "<li style='color:rgb(" . $rrgb[0] . ", " . $rrgb[1] . ", " . $rrgb[2] . ");'>⬤ <strong>" . $show[$i] . ": " . $amount . "</strong></li>";
            }
            echo "</ol></li>";

            echo '</ul>
            <svg height="200" width="60%" viewBox="0 0 20 20">
            <circle r="10" cx="10" cy="10" fill="white" />';
            $sum  = array_sum($count);
            $delta = 100/$sum;
            $past_sum = 0;
            for ($i = 0; $i < count($show); $i++) {
                echo '
                    <circle r="5" cx="10" cy="10" fill="transparent"
                            stroke="rgb(' . $rgbs[$i][0] . ', ' . $rgbs[$i][1] . ', ' . $rgbs[$i][2] . ')"
                            stroke-width="10"
                            stroke-dasharray="calc(' . (100-$past_sum*$delta) . '* 31.4 / 100) 31.4"
                            transform="rotate(-90) translate(-20)" />';
                $past_sum += $count[$i];
                }
            echo '</svg>
            </article>';
        } else {
            echo "</ul>";
        } echo "</article>";
    }
} else { echo "0 results"; }

?>
        </section>
    </main>
</body>
</html>

