<section id="annonseviewer">
    <?php

    include "connect.php";

    $sql = "SELECT * FROM annonser JOIN login ON annonser.userID = login.id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result))
    {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<a href=\"" . $row["id"] . "\"><article><h1>" . $row["title"] . "</h1><p id=\"pArea\">" . $row["area"] . "</p><p id=\"pCompany\">" . $row["user"] . "</p><p id=\"pDesc\">" . $row["descr"] . "</p></article></a>";
            }
        }
    mysqli_close($conn);
    ?>
</section>