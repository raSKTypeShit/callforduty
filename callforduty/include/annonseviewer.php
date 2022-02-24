<section id="annonseviewer">
    <?php

    //include "connect.php";

    $sql = "SELECT * FROM annonser JOIN login ON annonser.userID = login.id";
    $result = mysqli_query($conn, $sql);
    $link="SELECT * FROM containers JOIN annonser ON containers.formNR= annonser.id";
    $r=mysqli_query($conn,$link);

    if(mysqli_num_rows($result)&& isset($r))
    {
            while($row = mysqli_fetch_assoc($r)){
                $lnk=$row["formNR"];
            }
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<a href=apply.php?formNR=$lnk><article><h1>" . $row["title"] . "</h1><p id=\"pArea\">" . $row["area"] . "</p><p id=\"pCompany\">" . $row["user"] . "</p><p id=\"pDesc\">" . $row["descr"] . "</p></article></a>";
            }
        }
    mysqli_close($conn);
    ?>
</section>