<?php
    include "include/connect.php";

    if (isset($_SESSION["id"])) {
        $userID = $_SESSION["id"];
        $user   = $_SESSION["user"];
    } else {
        header('Location: index.php'); 
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Call for duty - Profile page</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

</head>

<body class="profile_page">
<?php include "include/navbar.php"; ?>
<?php

$fileTypes = ["jpg", "png", "jpeg", "gif"];
$targetDir = "images/profile/" . $userID;
for ($i = 0; $i < count($fileTypes); $i++) {
    if (file_exists($targetDir . "." . $fileTypes[$i])) {
        echo "
        <style>.profile_page {
            background-image: url('" . $targetDir . "." . $fileTypes[$i] . "');}
        </style>";
    }
}

?>
    <header>
        <h1>Profile page</h1>
    </header>
    <form action="img_upload.php" method="post" enctype="multipart/form-data" class="image">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <main>
        <h2>Ads</h2>
        <section>
<?php
    //include "connect.php";

    $sql = "SELECT * FROM annonser WHERE userID=" . $userID;
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result))
    {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<a href='data_viewer.php?formNR=" . $row["id"] . "' class='dataredirect'><article><h3 style='background-color:" . $row["COLOR"] . ";'>" . $row["title"] . "</h3><p>" . $row["descr"] . "</p></article></a>";
            }
        }
    mysqli_close($conn);
?>
        <a href="form_generator.php" class="new_form">+</a>
        </section>
    </main>
</body>
</html>

