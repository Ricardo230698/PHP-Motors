<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>

    <div id="content">

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/header.php';
            // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/nav.php';
            echo $navList;
    ?>

    <h1>PHP Motors Login</h1>

    <?php
        // if(isset($message)) {
        //     echo $message;
        // }
        if(isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
    ?>

    <form action="/phpmotors/accounts/" method="post">
        <label for="email">Email address</label>
        <input type="email" name="clientEmail" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>

        <label for="password">Password</label>
        <!-- <span>Make sure the password is at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span> -->
        <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>

        <button>Login</button>

        <a href="/phpmotors/accounts/index.php?action=registration">No account? Sing-up</a>

        <!-- Note: the key will be "action", but the "value" should not be the same that you used to deliver the login view. For example, if you used the value "login" to deliver the view, then use "Login" to submit the login data. -->
        <input type="hidden" name="action" value="Login">


    </form>

    <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>    

    </div>
</body>
</html>