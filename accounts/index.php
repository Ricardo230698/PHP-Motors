<?php

    //THIS IS THE ACCOUNTS CONTROLLER

    //Create or access a session
    session_start();

    //Get the database connection file
    require_once '../library/connections.php';

    //Get the PHP Motors Model for use as needed
    require_once '../model/main-model.php';

    //Get the accounts model for use
    require_once '../model/accounts-model.php';

    //Get the FUNCTIONS library
    require_once '../library/functions.php';

    //Get the array of classifications
    $classifications = getClassifications();

    // var_dump($classifications);
    //     exit;

    //Calling the function to bring the NAVIGATION LIST
    $navList = buildNavigation($classifications);

    //Build a navigation bar using the $classifications array
    // $navList = '<ul id="nav_menu">'; //I'm putting a class myself for it to align with my CSS
    // $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    // foreach ($classifications as $classification) {
    //     $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    // }
    // $navList .= '</ul>';

    // echo $navList;
    // exit;

    //By creating and naming the controller index.php all web traffic that comes to the phpmotors folder will automatically be directed to the controller.

    $action = filter_input(INPUT_POST, 'action'); //$action is a variable that we will use to store the type of content being requested.
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action) {
        case 'login':
            // include '/phpmotors/view/login.php';
            include '../view/login.php';
            break;

        case 'registration':
            // include '/phpmotors/view/registration.php';
            include '../view/registration.php';
            break;

        case 'Login':
            //Filter and store the data
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            //Recreate the $clientEmail variable and assign to it what is returned from calling the checkEmail($clientEmail) function
            $clientEmail = checkEmail($clientEmail);

            //Create a new $checkPassword variable and assign to it what is returneed from calling the checkPassword($clientPassword) function.
            $checkPassword = checkPassword($clientPassword);

            //Check if either of the variables are empty and if they are, set a message and call the login view using a PHP include function so the error message is displayed in the view
            if(empty($clientEmail) || empty($checkPassword)) {
                $message = '<p>Please provide information for all empty fields.</p>';
                include '../view/login.php';
                exit;
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);

            // Compare the password just submitted against the hashed password for the matching client
            $hashCheck = password_verify($checkPassword, $clientData['clientPassword']);

            // If the hashes don't match create an error and return to the login view
            if(!$hashCheck) {
                $message = '<p>Please check your password and try again</p>';
                include '../view/login.php';
                exit;
            }
    
            // If a valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;

            // Remove the password from the array
            // the array_pop function removes the last element from an array
            array_pop($clientData);

            // Store the array into the session
            $_SESSION['clientData'] = $clientData;

            // Sent them to the admin view
            include '../view/admin.php';
            exit;

            break;

        case 'Logout':
            unset($_SESSION['clientData']);
            session_destroy();
            include '../index.php';
            // include '../view/home.php';
            break;

        case 'register':
            //Filter and store the data
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            //Cchecking for an existing email address
            $existingEmail = checkExistingEmail($clientEmail);

            //Write a simple if() control structure to check if the new variable is "true"...
                //...If it is true, set a $message telling the visitor that the email address already exists and that they may want to login instead. Then include the "login" view and follow the include with an exit.
            if($existingEmail) {
                $message = '<p>That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            //Recreate the $clientEmail variable and assign to it what is returned from calling the checkEmail($clientEmail) function.
            $clientEmail = checkEmail($clientEmail);

            //Create a new $checkPassword variable and assign to it what is returned from calling the checkPassword($clientPassword) function.
            $checkPassword = checkPassword($clientPassword);

            //Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit;
            }

            //Hashed the checked password
            $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);
            
            //Sent the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

            //Check and report the result
            if($regOutcome === 1) {
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                // $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
                // include '../view/login.php';
                header('Location: /phpmotors/accounts/?action=login');
                exit;
            } else {
                $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
            break;

        case 'updateAccount':
            include '../view/client-update.php';
            break;

        case 'updateClient':
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

            //Check if the email address is different than the one in the session.
            if($clientEmail == $_SESSION['clientData']['clientEmail']) {
                $message = "<p>The new email must be different than the current one.</p>";
                $_SESSION['message'] = $message;
                include '../view/client-update.php';
                exit;
            }
            // Comparar tambien con los demas correos en la database

            //Checking for an existing email address
            $existingEmail = checkExistingEmail($clientEmail);

            //Write a simple if() control structure to check if the new variable is "true"...
                //...If it is true, set a $message telling the visitor that the email address already exists and that they may want to login instead. Then include the "login" view and follow the include with an exit.
            if($existingEmail) {
                $message = '<p>That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }
            
            //Recreate the $clientEmail variable and assign to it what is returned from calling the checkEmail($clientEmail) function.
            $clientEmail = checkEmail($clientEmail);

            //Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit;
            }

            //Process the update using an appropriate function.
            //Sent the data to the model
            $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

            //Check and report the result
            if($updateResult === 1) {
                // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "<br>Thanks for updating your info $clientFirstname.";
                // header('Location: /phpmotors/accounts/?action=login');
                // exit;
            } else {
                $_SESSION['messagePassword'] = "Sorry $clientFirstname, but the process failed. Please try again.";
                // include '../view/client-update.php';
                exit;
            }

            // Query the client data based on the clientId
            $newClientData = getClientNewInfo($clientId);

            // If a valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;

            // Remove the password from the array
            // the array_pop function removes the last element from an array
            array_pop($newClientData);

            // Store the array into the session
            $_SESSION['clientData'] = $newClientData;

            // Sent them to the admin view
            include '../view/admin.php';
            exit;

            break;


        case 'updatePassword':
            //Filter and collect the new password.
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

            //Check that it meets the password requirements (the same as during registration).
            $checkPassword = checkPassword($clientPassword);

            //Check for missing data
            if(empty($checkPassword)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit;
            }

            //Hashed the checked password
            $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);

            //Then sent THE PASSWORD to a function to be updated in the database.
            $updateResult = updatePassword($hashedPassword, $clientId);

            //Set a success or failure message and store it in the session.
            if($updateResult === 1) {
                // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "<br>Thanks for updating your password " . $_SESSION['clientData']['clientFirstname'];
                // header('Location: /phpmotors/accounts/?action=login');
                // exit;
            } else {
                $_SESSION['message'] = "Sorry $clientFirstname, but the process failed. Please try again.";
                // include '../view/client-update.php';
                // exit;
            }
            
            //Deliver the "admin.php" view where the client information will be displayed along with the success or failure message.
            include '../view/admin.php';
            exit;

            break;

        default:
            include '../view/admin.php';
            break;
    }
    //If $action had a value and our one case statement had a matching value, then it would run and the default would be ignored because the "break" statement would end the switch and the control structure would be exited.

?>