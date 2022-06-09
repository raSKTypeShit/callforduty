<?php
include "include/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <?php
        include "include/navbar.php";
    ?>
<table id="enkeltrespons">
<?php
    $formnr=$_GET["formNR"];

    $sql="SELECT * FROM applicants JOIN answers ON applicants.id=answers.applicantID AND applicants.formNR=$formnr";
    $r=mysqli_query($conn,$sql);
    
    $sqw="SELECT formNR,question,qtype FROM containers WHERE formNR=$formnr";
    $w=mysqli_query($conn,$sqw);
    
    
    $sqk="SELECT * FROM containers JOIN answers ON containers.qtype=answers.answer AND formNR=$formnr GROUP BY question";
    $result=mysqli_query($conn,$sqk);
    
    $sq="SELECT id, mail FROM applicants WHERE formNR=$formnr";
    $a=mysqli_query($conn,$sq);

    //Oversettelsen
    $checker=[2,3];
    $lists=[];
    
    echo "<tr>";
    echo "<th> Mail </th>";   
     
    while($row=mysqli_fetch_assoc($w)){
        
        echo "<th>".$row["question"]."</th>";
        array_push($lists, $row["qtype"]);
    }
    echo "</tr>";
    while($row=mysqli_fetch_assoc($a)){
        $i=0;
        $questionID = 999;
        echo "<tr>";
        echo "<td>".$row["mail"]."</td>";

        $answers="SELECT id, applicantID,containerID, answer FROM answers WHERE applicantID=".$row["id"];
        $temp_app_id = $row["id"];
        $answ=mysqli_query($conn,$answers);
        while($rw=mysqli_fetch_assoc($answ)){
            if ($questionID == 999) {
                echo "<td>";
            } else if (isset($questionID) && $questionID==$rw["containerID"]) {
                echo ", ";
            } else {
                echo "</td><td>";
                $i++;
            }

            if(in_array($lists[$i], $checker)) {
                $sqlask = "SELECT info FROM additional WHERE id=" . $rw["answer"];
                $query = mysqli_query($conn, $sqlask);
                if (mysqli_num_rows($query) == 1) {
                    $rowwwww = mysqli_fetch_assoc($query);
                    echo $rowwwww["info"];
                }
            } else if ($lists[$i] == 1) {
                echo ["Ja", "Nei"][$rw["answer"]-1];
            } else if ($lists[$i] == 5) {
                echo "<a href='form_parts/applicant_files/" . $rw["answer"] . "' download>Download</a>";
            } 
            
            
            else {echo $rw["answer"];}
            $questionID = $rw["containerID"];
        }
        echo "</td></tr>";
    }

    while($row=mysqli_fetch_assoc($r)){
        
       /* echo "<tr>";
        echo "<td>".$row["mail"]."</td>"; 
        echo "<td>".$row["answer"]."</td>";
        echo "</tr>";*/
    }

?>
</table>
</body>
</html>
