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

    echo $properInfo;

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
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        $("#link").click(function(){
        var holdtext = $("#Clipboard").innerText;
        Copied = holdtext.createTextRange();
        Copied.execCommand("Copy");
        });
    </script>
</head>

<body class="data_viewer">

    <main>
        <section class="buttons">
            <div><button onclick="copyToClipboard()">Copy URL</button>
</div>
            <div>Upload images</div>
            <div>View form</div>
            <div>Public</div>
            <div>Delete</div>
        </section>

        <section>
            <article>
                <h3>Spørsmål?</h3>
                <svg height="100" width="100"></svg>
            </article>
        </section>
    </main>
</body>
</html>

