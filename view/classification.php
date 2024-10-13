<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
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
        <?php echo $classificationName; ?> vehicles
    </h1>

    <?php
        if(isset($message)) {
            echo $message;
        }

        if(isset($vehicleDisplay)) {
            echo $vehicleDisplay;
        }
    ?>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
</body>
</html>