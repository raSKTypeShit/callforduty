<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <?php include "include/navbar.php"; ?>
    <form id="login" action="logincheck.php" method="post">
        <label for="user">Brukernavn</label>
        <input id="user"name="user">
        <label for="password"> Passord </label>
        <input id="password" name="password" type="password">
        <input type="submit" value="ok">
   </form>
</body>
</html>