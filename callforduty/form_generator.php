<?php
//session_start();
include "include/connect.php";
include "form_parts/event_handler.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Call for duty - Form generator</title>
        <meta charser="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    </head>
    <body class="form_body">
        <?php include "include/navbar.php"; ?>
        <main>
            <h2>Generelt</h2>
            <?php include "form_parts/basic.php";?>
            <h2>Spørsmål</h2>
            <?php include "form_parts/generate_questions.php";?>
            <h2>Post form</h2>
            <?php include "form_parts/post_form.php";?>
        </main>
    </body>
</html>

<?php


?>
