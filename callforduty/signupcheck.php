<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "callforduty";
$conn = mysqli_connect($servername, $username, $password, $database);
?>
<!DOCTYPE html>
<html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
     </head>
     <body>
         <?php
         //sjekker om det finnes data i inputene.
         if(isset($_POST["name"]) && isset($_POST["mail"])&& isset($_POST["password"])){ 
            $name=$_POST["name"];
            $mail=$_POST["mail"];
            $pass=$_POST["password"];
            $result="SELECT * FROM login
                    WHERE \"$name\"=name AND
                    \"$mail\"=mail";
            $check=mysqli_query($conn,$result);
            //sjekker om det eksistere en bruker med samme bedrift og mail
            if(mysqli_num_rows($check)==1){
               echo "This user already exists. Use another name or mail";
               header("refresh:2; url=index.php");
               die();
            }
            else{

                $sql="INSERT INTO login (user,mail,password) Values
                (\"$name\",\"$mail\",\"$pass\")";
            $r=mysqli_query($conn,$sql);
            if(isset($r)){
                echo "Bruker laget";
                header("refresh:2; url=index.php");
                die();
            }

            else{
                echo "Noe gikk galt, prøv på nytt";
                header("refresh:2; url=index.php");
                die();
            }
         }
         mysqli_close($conn);
         ?>
     </body>
</html>