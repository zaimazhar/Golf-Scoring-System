<?php

include_once("../ServiceProvider.php");

use php\logic\Competition;

$competition = new Competition;

$comp_data = $competition->getCurrentCompetition((int) $_GET['cid']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $comp_data['competition_name'] ?></title>
</head>
<body>
    <p></p>
</body>
</html>