
<?php
//Set basic values
if (isset($_SESSION["title"])) {
    for ($x = 0; $x < count($types); $x+=1) {
        $basic[$types[$x]] = $_SESSION[$types[$x]];
    }
} else {
    for ($x = 0; $x < count($types); $x+=1) {
        $basic[$types[$x]] = "";
    }
}


//Set values for questions
$qst      = [];
$qst_type = [];
$qst_opt  = [];

$i = 0;
while (isset($_SESSION["qst" . $i])) {
    array_push($qst, $_SESSION["qst" . $i]);
    array_push($qst_type, $_SESSION["qst_type" . $i]);

    if (isset($_SESSION["qst_opt" . $i])) {
    array_push($qst_opt, $_SESSION["qst_opt" . $i]);} 
    else {array_push($qst_opt, Null);}
    $i++;
}
?>