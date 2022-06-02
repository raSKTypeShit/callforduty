<?php 

include "include/connect.php";

if (isset($_POST["formNR"]) && isset($_POST["mail"]) && isset($_POST["startID"])) {
    $formNR = intval($_POST["formNR"]);
    $mail  = $_POST["mail"];
    $startID = $_POST["startID"];

    $sql = "INSERT INTO applicants (mail, formNR)
    VALUES ('" . $mail . "', '" . $formNR . "')";

    if (mysqli_query($conn, $sql)) {
        $applicantID = mysqli_insert_id($conn);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "";

    $x = $startID;
    while (isset($_POST["q" . $x])) {
        $value = $_POST["q" . $x];
        if (is_array($value)) {
            for ($n=0; $n < count($value); $n++) {
                $sql .= "INSERT INTO answers (applicantID, containerID, answer) VALUES (" . $applicantID . ", " . $x . ", '" . $value[$n] . "');";
            }

        } else {
            $sql .= "INSERT INTO answers (applicantID, containerID, answer) VALUES (" . $applicantID . ", " . $x . ", '" . $value . "');";
        } $x++;
    }
    if (mysqli_multi_query($conn, $sql)) {
        echo "Application published!";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      header("refresh:5; url=index.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Img upload</title>
</head>
<body></body>
<meta http-equiv="refresh" content="2;url=profile_page.php" />
</html>
