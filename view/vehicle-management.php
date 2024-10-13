<?php
    if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1) {
        header('Location: /phpmotors/index.php');
        exit;
    }
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
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

    <h1>Vehicle Management</h1>
    <ul>
        <li><a href="/phpmotors/vehicles/index.php?action=newClassification">Add Classification</a></li>
        <li><a href="/phpmotors/vehicles/index.php?action=newVehicle">Add Vehicle</a></li>
    </ul>

    <?php
        if (isset($message)) { 
            echo $message; 
        } 
        if (isset($classificationList)) { 
            echo '<h2>Vehicles By Classification</h2>'; 
            echo '<p>Choose a classification to see those vehicles</p>'; 
            echo $classificationList; 
        }
    ?>

    <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>

    <table id="inventoryDisplay"></table>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
    
    <script src="../js/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>