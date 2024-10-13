<!DOCTYPE html>
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

    <h1>PHP Motors Registration</h1>

    <?php
        if(isset($message)) {
            echo $message;
        }
    ?>

    <form action="/phpmotors/accounts/index.php" method="post">
        <label for="fname">First Name</label>
        <input type="text" name="clientFirstname" id="fname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>

        <label for="lname">Last Name</label>
        <input type="text" name="clientLastname" id="lname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>

        <label for="email">Email address</label>
        <input type="email" name="clientEmail" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>

        <label for="password">Password</label>
        <span>Make sure the password is at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span>
        <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>

        <input type="submit" name="submit" id="regbtn" value="Register">

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="register">
    </form>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
</body>
</html>