<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table >
<?php
    $formnr=$_GET["formNR"];

    include "include/connect.php";
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
        array_push($lists,$row["qtype"]);
    }
    echo "</tr>";
    
    while($row=mysqli_fetch_assoc($a)){
        $i=0;
        echo "<tr>";
        echo "<td>".$row["mail"]."</td>";

        $answers="SELECT applicantID,containerID, answer FROM answers WHERE applicantID=".$row["id"];
        $answ=mysqli_query($conn,$answers);
        while($rw=mysqli_fetch_assoc($answ)){
            if(in_array($lists[$i],$checker)){
                $sqlask = "SELECT info FROM additional WHERE id=" . $rw["answer"];
                $query = mysqli_query($conn, $sqlask);
                if (mysqli_num_rows($query) == 1) {
                    $rowwwww = mysqli_fetch_assoc($result);
                    echo "<td>".$rowwwww["info"]."</td>";
                }
            }
            echo "<td>".$rw["answer"]."</td>";
        }
        echo "</tr>";
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