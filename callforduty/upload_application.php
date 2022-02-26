<?php 

include "include/connect.php";

if (isset($_POST["formNR"]) && isset($_POST["mail"])) {
    $formNR = intval($_POST["formNR"]);

    $mail  = $_POST["mail"];

    $sql = "INSERT INTO applicants (mail, formNR)
    VALUES ('" . $mail . "', '" . $formNR . "')";

    if (mysqli_query($conn, $sql)) {
        $applicantID = mysqli_insert_id($conn);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "";

    $x = 0;
    while (isset($_POST["q" . $x])) {

        $sql = "INSERT INTO answers (applicantID, questionNR, answer) VALUES (" . $applicantID . ", " . $x . ", '" . $_POST["q" . $x] . "');";
        $x++;
    }
    if (mysqli_multi_query($conn, $sql)) {
        echo "Application published!";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

}




?>