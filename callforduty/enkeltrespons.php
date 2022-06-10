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
    echo "<th> Mail </th>
    <th> Kall inn </th>";   
     
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
        
        // MAILKNAPP
        $companyNavnSql = "SELECT login.user FROM login JOIN annonser ON annonser.userID = login.id WHERE annonser.id = " . $formnr;
        $companyNavnResult = mysqli_query($conn, $companyNavnSql);
        $companyNavn = mysqli_fetch_assoc($companyNavnResult)["user"];

        echo "<td>";
        echo "<input id=\"input" . $temp_app_id . "\" type=\"button\" value=\"Kall Inn\">";
        echo "<script>
            
        let button" . $temp_app_id . " = document.getElementById(\"input" . $temp_app_id . "\");

        button" . $temp_app_id . ".onclick = function() { window.open(\"mailto:" . $row["mail"] . "?subject=Innkalling til intervju&body=Hei, vi vil gjerne kalle deg inn til intervju hos oss den [DATO] ved vårt kontor ved [GATE]. Med vennlig hilsen " . $companyNavn . "\"); }

        </script> </td>";
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
        echo "</tr>";
    }

?>
</table>
</body>
</html>
