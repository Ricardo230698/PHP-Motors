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
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/index.css">
</head>
<body>

    <div id="content">

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/header.php';
            // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/nav.php';
            echo $navList;
    ?>

    <h1>
    <?php
        if(isset($invInfo['invMake'])) { 
	        echo "Delete $invInfo[invMake] $invInfo[invModel]";
        }
    ?>
    </h1>
    
    <?php
        if(isset($message)) {
            echo $message;
        }
    ?>

    <form action="/phpmotors/vehicles/index.php" method="post">
        
        <label for="invMake">Make</label>
        <input type="text" id="invMake" name="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> readonly>

        <label for="invModel">Model</label>
        <input type="text" id="invModel" name="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> readonly>

        <label for="invDescription">Description</label>
        <input type="text" id="invDescription" name="invDescription" <?php if(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; } ?> readonly>

        <input type="submit" value="Delete Vehicle">

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="deleteVehicle">

        <!-- Add the action name - value pair -->
        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];} ?>">
    </form>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
</body>
</html>