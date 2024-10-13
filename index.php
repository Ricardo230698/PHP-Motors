<?php

    //Create or access a session
    session_start();

    //Get the database connection file
    require_once 'library/connections.php';

    //Get the PHP Motors Model for use as needed
    require_once 'model/main-model.php';

    //Get the FUNCTIONS library
    require_once 'library/functions.php';

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

    if(isset($_COOKIE['firstname'])) {
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    switch ($action) {
        case 'template':
            include 'view/template.php';
            break;
        default:
            include 'view/home.php';
            break;
    }
    //If $action had a value and our one case statement had a matching value, then it would run and the default would be ignored because the "break" statement would end the switch and the control structure would be exited.

?>