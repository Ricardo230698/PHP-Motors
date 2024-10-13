<?php
    if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1) {
        header('Location: /phpmotors/index.php');
    }
?><?php
    $classificationList = '<label for="classificationId">Choose a classification:</label>';
    $classificationList .= '<select id="classificationId" name="classificationId">';
    foreach($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'";
        if(isset($classificationId)) {
            if($classification['classificationId'] == $classificationId) {
                $classificationList .= ' selected ';
            }
        }
        $classificationList .= ">$classification[classificationName]</option>";
    }
    $classificationList .= "</select>";
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

    <h1>CONTENT GOES HERE</h1>
    <h2>*Note all fields are required</h2>

    <?php
        if(isset($message)) {
            echo $message;
        }
    ?>

    <form action="/phpmotors/vehicles/index.php" method="post">
        <?php
            echo $classificationList;
        ?>

        <label for="invMake">Make</label>
        <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} ?> required>

        <label for="invModel">Model</label>
        <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} ?> required>

        <label for="invDescription">Description</label>
        <input type="text" id="invDescription" name="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";} ?> required>

        <label for="invImage">Image</label>
        <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";} ?> required>

        <label for="invThumbnail">Thumbnail</label>
        <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required>

        <label for="invPrice">Price</label>
        <input type="number" name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required>

        <label for="invStock">Stock</label>
        <input type="number" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required>

        <label for="invColor">Color</label>
        <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} ?> required>

        <input type="submit" value="Add Vehicle">

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="addVehicle">
    </form>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
</body>
</html>