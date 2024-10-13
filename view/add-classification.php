<?php
    if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1) {
        header('Location: /phpmotors/index.php');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    <link rel="stylesheet" href="/phpmotors/css/index.css">
</head>
<body>

    <div id="content">

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/header.php';
            // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/nav.php';
            echo $navList;
    ?>

    <h1>Add Car Classification</h1>

    <?php
        if(isset($message)) {
            echo $message;
        }
    ?>

    <form action="/phpmotors/vehicles/index.php" method="post">
        <label for="classificationName">Add classification</label>
        <span>Please write up to 30 characters</span>
        <input type="text" id="classificationName" maxlength="30" name="classificationName" required>

        <input type="submit" value="Add Classification">

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="addClassification">
    </form>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
</body>
</html>