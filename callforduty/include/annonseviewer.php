<section id="annonseviewer">
    <section>
        <form action="?" method="get">
            <label for="inputArea">Område</label>
            <input id="inputArea" list="areaList" name="area">
            <datalist id="areaList">
                <option value="Randaberg">
                <option value="Stavanger">
                <option value="Sola">
                <option value="Trenches">
            </datalist>
            <label for="inputId">Id</label>
            <input id="inputId" type="number" name="id">
            <!--<label for="inputNokkel">Nøkkelord</label>
            <input id="inputNokkel" type="text" name="nokkelord">-->
            <label for="inputName">Søk</label>
            <input id="inputName" type="text" name="sokeord">
            <input type="submit" value="Søk">
        </form>
        <main>
        <?php

        //include "connect.php";
        $paramTypes = [];
        $params = [];
        $firstParam = true;

        // Init statement
        $statement = mysqli_stmt_init($conn);

    // Base sql query
    $sql = "SELECT annonser.id AS annonseids, userID, user, title, descr, COLOR, area, public FROM annonser JOIN login ON  annonser.userID= login.id";
        // Nokkelord is set
        /*if($_GET["nokkelord"])
        {
            $sql .= " JOIN keywords ON fromNR = annonseids"; //WHERE keyword = ?";
            //$firstParam = false;

            //array_push($paramTypes, "s");
            //array_push($params, $_GET["area"]);
        }*/

        // Area is spesified
        if($_GET["area"])
        {
            if($firstParam)
            {
                $sql .= " WHERE annonser.area = ?";
                $firstParam = false;
            }
            else
            {
                $sql .= " AND annonser.area = ?";
            }
            array_push($paramTypes, "s");
            array_push($params, $_GET["area"]);
        }

        // Id is spesified
        if($_GET["id"])
        {
            if($firstParam)
            {
                $sql .= " WHERE annonser.id = ?";
                $firstParam = false;
            }
            else
            {
                $sql .= " AND annonser.id = ?";
            }
            array_push($paramTypes, "i");
            array_push($params, $_GET["id"]);
        }

        // Sokeord is spesified
        if($_GET["sokeord"])
        {
            if($firstParam)
            {
                $sql .= " WHERE (annonser.title LIKE ? OR annonser.descr LIKE ?)";
                $firstParam = false;
            }
            else
            {
                $sql .= " AND (annonser.title LIKE ? OR annonser.descr LIKE ?)";
            }
            array_push($paramTypes, "s");
            array_push($paramTypes, "s");
            array_push($params, "%" . $_GET["sokeord"] . "%");
            array_push($params, "%" . $_GET["sokeord"] . "%");
        }
        
        
        mysqli_stmt_prepare($statement, $sql);

        // Set up parameters for mysqli_stmt_bind_param
        $bindParams = [$statement, implode("", $paramTypes)];

        for($i = 0; $i < count($params); $i++)
        {
            array_push($bindParams, $params[$i]);
        }

        // Call bind_param via call_user_func
        call_user_func_array("mysqli_stmt_bind_param", $bindParams);

        // Execute statement
        mysqli_stmt_execute($statement);

        // Get result from statement
        $result = mysqli_stmt_get_result($statement);

        if(mysqli_num_rows($result))
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row["public"] == 1) { 
                    echo "<a href=\callforduty/callforduty/apply.php?formNR=" . $row["annonseids"]."><article><h1>" . $row["title"] . "</h1><p id=\"pArea\">" . $row["area"] . "</p><p id=\"pCompany\">" . $row["user"] . "</p><p id=\"pDesc\">" . $row["descr"] . "</p></article></a>";
                }
            }
        }

        
        mysqli_close($conn);
        ?>
        </main>
    </section>
    <?php
        echo "<footer id=\"annonseviewerFooter\"><p>" . mysqli_num_rows($result) . " resultater</p></footer>";
    ?>
</section>
