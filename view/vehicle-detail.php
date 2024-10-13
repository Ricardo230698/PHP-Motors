<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php
        print_r($details[0]['invMake'] . " " . $details[0]['invModel'] . " | PHP Motors, Inc.");
    ?>
    </title>
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
            print_r($details[0]['invMake'] . " " . $details[0]['invModel']) ;
        ?>
    </h1>

    <?php
        if(isset($message)) {
            echo $message;
        }
    ?>

    <div id="details-grid">
    
    <?php
        if(isset($thumbnailsDisplay)) {
            echo $thumbnailsDisplay;
        }
    ?>
    
    <h2 id="thummbnail-heading">Thumbnail Images</h2>
    
    <?php
        if(isset($detailsDisplay)) {
            echo $detailsDisplay;
        }
    ?>
    </div>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
</body>
</html>