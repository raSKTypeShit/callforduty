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
    <form  id="signup" action="signupcheck.php" method="post">
        <label for="name">Bedriftnavn</label>
        <input id="name" name="name" placeholder="For eksempel: Equinor">
        <label for="mail">Mail</label>
        <input id="mail" name="mail" placeholder="For eksempel: Ola.Nordmann@norge.org">
        <label for="password">Passord </label>
        <input id="password" name="password">
        <input type="submit" value="Lag bruker">
    </form>
</body>
</html>