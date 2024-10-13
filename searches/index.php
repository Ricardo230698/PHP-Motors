<?php

    //THIS IS THE SEARCHES CONTROLLER

    //Create or access a session
    session_start();

    //Get the database connection file
    require_once '../library/connections.php';

    //Get the PHP Motors Model for use as needed
    require_once '../model/main-model.php';
    
    //Get the VECHICLES MODEL for use as needed
    require_once '../model/vehicles-model.php';

    //Get the SEARCHES MODEL for use as needed
    require_once '../model/searches-model.php';
    
    //Get the FUNCTIONS library
    require_once '../library/functions.php';
    
    //Get the uploads MODEL
    require_once '../model/uploads-model.php';

    //Get the array of classifications
    $classifications = getClassifications();

    //Calling the function to bring the NAVIGATION LIST
    $navList = buildNavigation($classifications);


    //Watch for and capture name-value pairs for decision making
    $action = filter_input(INPUT_POST, 'action'); //$action is a variable that we will use to store the type of content being requested.
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
    

    //Contain control structures to deliver views
    switch($action) {
        case 'search':
            $userSearch = filter_input(INPUT_POST, 'userSearch', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $searchPage = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_NUMBER_INT);

            if ($userSearch == NULL) {
                $userSearch = $_SESSION['search'];
            }

            //Check for missing data
            if(empty($userSearch)) {
                $_SESSION['message'] = 'Please provide information for all fields.';
                include '../view/searches.php';
                exit;
            }
            
            //Send the data to the model
            $results = searching($userSearch);
            $resultsCount = count($results);

            //Check the results and build the results on the view
            if(count($results) >= 1) {
                $_SESSION['search'] = $userSearch;
                $_SESSION['page'] = $searchPage;
                $buildSearchResults = buildSearchResults($results, $resultsCount);
                // include '../view/searches.php';
                // exit;
            } else {
                $_SESSION['message'] = 'No results found';
                // include '../view/searches.php';
                // exit;
            }

            include '../view/searches.php';
            
        break;
            
        default:
            include '../view/searches.php';
        break;
    }


?>