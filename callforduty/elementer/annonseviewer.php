<style>
    #annonseviewer {
        border: 1px solid black;
        display: flex;
        width: 80vw;
        margin-left: 10vw;
        justify-content: space-evenly;
        align-items: space-evenly;
        flex-wrap: wrap;
        background-color: rgb(85, 170, 170);
    }

    #annonseviewer > article {
        width: 20vw;
        height: 20vw;
        border-top: 2px solid white;
        border-left: 2px solid white;
        border-bottom: 2px solid black;
        border-right: 2px solid black;
        background-color: rgb(195, 198, 202);
        display: grid;
        grid-template-rows: 2fr 1fr 7fr;
        grid-template-columns: 1fr 1fr;
        margin-bottom: 5%;
    }
    
    #annonseviewer > article > h1 {
        margin-top: 0;
        padding-left: 5%;
        color: white;
        background-color: rgb(34, 0, 169);
        grid-column: 1 / 3;
        grid-row: 1 / 2;
    }

    #annonseviewer > article > p {
        margin-top: 0;
        margin-bottom: 5%;
        margin-left: 5%;
        margin-right: 5%;
    }

    #pArea {
        grid-column: 1 / 2;
        grid-row: 2 / 3;
    }

    #pCompany {
        grid-column: 2 / 3;
        grid-row: 2 / 3;
        justify-self: end;
    }

    #pDesc {
        background-color: white;
        grid-column: 1 / 3;
        grid-row: 3 / 4;
    }
</style>
<section id="annonseviewer">
    <?php

    include "dbConn.php";

    $sql = "SELECT * FROM annonser";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result))
    {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<article><h1>" . $row["title"] . "</h1><p id=\"pArea\">" . $row["area"] . "</p><p id=\"pCompany\">" . $row["userID"] . "</p><p id=\"pDesc\">" . $row["descr"] . "</p></article>";
            }
        }

    ?>
</section>