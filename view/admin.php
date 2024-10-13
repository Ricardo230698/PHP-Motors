<?php
    // In the PHP code block at the top of the admin.php view, write an if() test to see if the visitor is NOT logged in. If the visitor is NOT logged in, use a header function to send them to the main PHP Motors controller in order for the PHP Motors home view to be delivered.
    if(!isset($_SESSION['loggedin'])) {
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

    <main>
        <h1>
            <?php
                echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'];
                if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
            ?>
        </h1>

        <p>You are logged in</p>
        
        <ol>

            <li>ID: <?php echo $_SESSION['clientData']['clientId'] ?></li>
            <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
            <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
            <li>Email: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>

        </ol>
        <a href="/phpmotors/accounts/index.php?action=updateAccount">Update account information</a><br><br><br>

        <?php
            if($_SESSION['clientData']['clientLevel'] > 1) {
                echo "<a>VEHICLE MANAGEMENT SECTION</a>";
                echo "<p>You should use the link to administer inventory</p>";
                echo "<p><a href='/phpmotors/vehicles/'>Vehicle Management View</a></p>";
            }
        ?>
    </main>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>