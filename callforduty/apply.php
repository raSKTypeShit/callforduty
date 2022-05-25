<?php
include "include/connect.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Call for duty - Apply</title>
        <meta charser="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    </head>
    <body class="form_body">
        <main>
            <?php include "form_parts/generate_info.php"; ?>
            <h2>Spørsmål</h2>
            <?php include "form_parts/show_questions.php"; ?>
        </main>
    </body>
</html>

<?php


?>
