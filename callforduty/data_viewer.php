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
    <p><strong>Tittel:</strong>" . $row["title"] . "</p>
    <p><strong>Lokasjon:</strong> " . $row["area"] . "</p>
    <p><strong>Fargekode:</strong> " . $row["COLOR"] . "</p>
    <p><strong>Beskrivelse av jobb: </strong>" . $row["descr"] . "</p>";


} else { echo "0 results"; }


?>
        </section>
        <h2>Statistikk</h2>
    </main>
</body>
</html>

