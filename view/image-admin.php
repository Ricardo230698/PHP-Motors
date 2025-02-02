<?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Management</title>
    <link rel="stylesheet" href="/phpmotors/css/index.css">
</head>
<body>

    <div id="content">

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/header.php';
            // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/nav.php';
            echo $navList;
    ?>

    <h1>Image Management</h1>
    <p>Welcome to the image management page</p>
    <p>Choose one of the options presented below:</p>

    <h2>Add New Vehicle Image</h2>
    <?php
        if (isset($message)) {
            echo $message;
        }
    ?>

    <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
        <label for="invItem">Vehicle</label>
            <?php echo $prodSelect; ?>
            <fieldset>
                <label>Is this the main image for the vehicle?</label>
                <label for="priYes" class="pImage">Yes</label>
                <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                <label for="priNo" class="pImage">No</label>
                <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
            </fieldset>
        <label>Upload Image:</label>
        <input type="file" name="file1">
        <input type="submit" class="regbtn" value="Upload">
        <input type="hidden" name="action" value="upload">
    </form>

    <hr>

    <h2>Existing Images</h2>
    <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
    <?php
        if (isset($imageDisplay)) {
            echo $imageDisplay;
        }
    ?>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>