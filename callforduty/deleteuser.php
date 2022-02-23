
<?php
include "include/connect.php";

//Confirmation if user actually wants to delete user
if(!isset($_POST["question"])){
    echo "Are you sure you want to delete user: <em>". $_SESSION["user"]."</em>";
    echo "<form action=\"deleteuser.php\" method=\"post\">
        <label for=\"yes\">Yes</label>
        <input id=\"yes\" type=\"radio\"  value=\"1\" name=\"question\">
        <label for=\"no\">No </label>
        <input id=\"no\" type=\"radio\" value=\"0\" name=\"question\">
        <input type=\"submit\" value=\"Submit\">
    </form>";
}
else{
    if($_POST["question"]==1){
        $user=$_SESSION["user"];
        $sql="DELETE FROM login WHERE
        user=\"$user\"";
        mysqli_query($conn,$sql);
        unset($_SESSION["user"]);
    }
    echo "Taking you back to main";
    header("refresh:2; url=index.php");

}
?>
<?php
mysqli_close($conn);
?>
