<?php
include "retrieve_vars_set_basic.php";

$userID = $_SESSION["id"];

//Event triggered
if (isset($_POST["event"])) {
    $event = $_POST["event"];
    if ($event == 1) {
        for ($x = 0; $x < count($types); $x+=1) {
            $_SESSION[$types[$x]] = $_POST[$types[$x]];
        }
    } 
    
    else if ($event == 2) {
        $i = 0;
        $x = 0;
        while (isset($_POST["qst" . $i])) {
                if ($_POST["qst" . $i] != "") {
                $_SESSION["qst" . $x] = $_POST["qst" . $i];
                $_SESSION["qst_type" . $x] = $_POST["qst_type" . $i];
                if (isset($_POST["qst_opt" . $i])) {
                    $_SESSION["qst_opt" . $x] = $_POST["qst_opt" . $i];
                } else {
                    $_SESSION["qst_opt" . $x] = NULL;
                }
                $x++;
            }
            $i++;
        }
        while (isset($_SESSION["qst" . $x])) {
            unset($_SESSION["qst" . $x]);
            $x++;
        }
    }
    
    else if ($event == 3) {
        $i = 0;
        while (isset($_SESSION["qst" . $i])) {
            $i++;
        }
        if ($i == 0 or $_SESSION["qst" . ($i-1)] != "") {
            $_SESSION["qst" . $i] = "";
            $_SESSION["qst_type" . $i] = 0;
            $_SESSION["qst_opt" . $i] = Null;
            
        } else {
            echo '<h2 style="background-color:var(--neg);">Fyll inn det forrige spørsmålet før du genererer ett nytt</h2>'; 
        }
    }
}

include "retrieve_session_vars.php";

if (isset($event) && $event == 4) {
    if (count($qst) > 0 && isset($basic)) {
        //Inset base info
        $sql = "INSERT INTO annonser (userID, title, COLOR, descr, area) 
        VALUES (" . $userID . ", '" . $basic[$types[0]] . "', '" . $basic[$types[1]] . "', '" . $basic[$types[2]] . "', '" . $basic[$types[4]] . "');";
        
        if (mysqli_query($conn, $sql)) {$formNR = mysqli_insert_id($conn);
        } else { echo "Error: " . $sql . "<br>" . mysqli_error($conn);}

        //Insert all keywords
        $keywords = explode(", ", $basic[$types[3]]);
        
        $sql = "";

        for ($x = 0; $x < count($keywords); $x+=1) {
            $sql .= "INSERT INTO keywords (formNR, keyword) VALUES(" . $formNR . ", '" . $keywords[$x] . "');";
        }
        if (!mysqli_multi_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        while(mysqli_more_results($conn)) { //Hacking d system
            mysqli_next_result($conn);
        }

        //Insert all questions
        for ($x = 0; $x < count($qst); $x+=1) {
            
            $sql = "INSERT INTO containers (formNR, question, qtype, NR) VALUES (" . $formNR . ", '" . $qst[$x] . "', " . $qst_type[$x] . ", " . $x . ");";

            if (mysqli_query($conn, $sql)) {$containerNR = mysqli_insert_id($conn);
            } else { echo "Error: " . $sql . "<br>" . mysqli_error($conn);}

            if (in_array($qst_type[$x], $types_opt)) {
                $qst_options = explode("\r\n", $qst_opt[$x]);
                
                $sql = "";
                for ($n = 0; $n < count($qst_options); $n+=1) {
                    $sql .= "INSERT INTO additional (containerNR, info) VALUES (" . $containerNR . ", '" . $qst_options[$n] . "');";
                }
                if (!mysqli_multi_query($conn, $sql)) {echo "Error: " . $sql . "<br>" . mysqli_error($conn);}
                while(mysqli_more_results($conn)) { //Hacking d system
                    mysqli_next_result($conn);
                }
            }

        }
        include "unset_session_vars.php";
        //header("Location: index.php");
        exit();
    } else {
        echo '<h2 style="background-color:var(--neg);">Noen verdier er ikke fylt ut</h2>'; 
    }
}


?>
