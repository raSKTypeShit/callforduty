<section id="annonseviewer">
    <?php

    //include "connect.php";

    $sql = "SELECT * FROM annonser";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result))
    {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<article><h1>" . $row["title"] . "</h1><p id=\"pArea\">" . $row["area"] . "</p><p id=\"pCompany\">" . $row["userID"] . "</p><p id=\"pDesc\">" . $row["descr"] . "</p></article>";
            }
        }
    mysqli_close($conn);
    ?>
</section>