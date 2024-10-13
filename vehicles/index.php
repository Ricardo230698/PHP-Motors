<?php

    //THIS IS THE VEHICLES CONTROLLER

    //Create or access a session
    session_start();
    
    //Get the database connection file
    require_once '../library/connections.php';

    //Get the PHP Motors Model for use as needed
    require_once '../model/main-model.php';

    //Get the VECHICLES MODEL for use as needed
    require_once '../model/vehicles-model.php';

    //Get the FUNCTIONS library
    require_once '../library/functions.php';

    //Get the uploads MODEL
    require_once '../model/uploads-model.php';

    //Get the array of classifications
    $classifications = getClassifications();

    //Calling the function to bring the NAVIGATION LIST
    $navList = buildNavigation($classifications);

    //Build a navigation bar using the $classifications array
    // $navList = '<ul id="nav_menu">'; //I'm putting a class myself for it to align with my CSS
    // $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    // foreach ($classifications as $classification) {
    //     $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    // }
    // $navList .= '</ul>';


    //This is to build a dynamic drop-down list
    // $classificationList = '<label for="classification">Choose a classification:</label>';
    // $classificationList .= '<select id="classification" name="classification" required>';
    // foreach($classifications as $classification) {
    //     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    // }
    // $classificationList .= "</select>";


    //Watch for and capture name-value pairs for decision making.
    $action = filter_input(INPUT_POST, 'action'); //$action is a variable that we will use to store the type of content being requested.
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }


    //Contain control structures to deliver views
    switch ($action) {
        case 'newVehicle':
            include '../view/add-vehicle.php';
            break;

        case 'addVehicle':
            //Filter and store the data
            $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            //Recreate some variables after VALIDATING them
            // $invImage = checkURL($invImage);
            // $invThumbnail = checkURL($invThumbnail);
            $invPrice = checkFloat($invPrice);
            $invStock = checkInt($invStock);

            //Check for missing data
            if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
                $message = "<p>Please provide information for all fields.</p>";
                include '../view/add-vehicle.php';
                exit;
            }

            //Send the data to the model
            $regOutcome = regInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
        
            //If the new vehicle is added successfully, a message to that affect must be displayed in the "add new vehicle" view.
            if($regOutcome === 1) {
                $message = "<p>The $invMake $invModel was added succesfully.</p>";
                include '../view/add-vehicle.php';
                exit;
            } else {
                $message = "<p>The insertion has failed. Try again.</p>";
                include '../view/add-vehicle.php';
                exit;
            }
            break;

        case 'newClassification':
            include '../view/add-classification.php';
            break;

        case 'addClassification':
            //Filter and store the data
            $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            //Check for missing data
            if(empty($classificationName)) {
                $message = "<p>Please provide the classification's name.</p>";
                include '../view/add-classification.php';
                exit;
            }

            //Sent the data to the model
            $regOutcome = regCarClassification($classificationName);
            
            //When the data is sent for insertion to the controller and if the insertion works, the vehicles controller should call itself using a header() function and pass no name - value pair. This should result in the "vehicle management" view being displayed and the new classification should appear as part of the navigation menu.
            header('Location: /phpmotors/vehicles/index.php?action=');

            //There will NOT be a success message. The classification item appearing in the navigation bar will be the indication of success. However, if it fails, then a clear failure message should be displayed in the add new classification view.
            if($regOutcome != 1) {
                $message = "<p>The insertion has failed. Try again.</p>";
                include '../view/add-classification.php';
                exit;
            }
            break;

        // Get vehicles by classificationId
        // Used for starting Update & Delete process
        case 'getInventoryItems':
            //Get the classificationId
            $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

            //Fetch the vehicles by classificationId from the DB
            $inventoryArray = getInventoryByClassification($classificationId) ;

            //Convert the array to a JSON object and send it back
            echo json_encode($inventoryArray);
            break;

        case 'mod':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo) < 1) {
                $message = 'Sorry, no vehicle information could be found.';
            }
            include '../view/vehicle-update.php';
            exit;
            break;

        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo) < 1) {
                $message = 'Sorry, no vehicle information could be found.';
            }
            include '../view/vehicle-delete.php';
            exit;
            break;
    
        case 'updateVehicle':
            $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
                $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
                include '../view/vehicle-update.php';
                exit;
            }

            $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
            if ($updateResult) {
                $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
                include '../view/vehicle-update.php';
                exit;
            }
            break;

        case 'deleteVehicle':
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            $deleteResult = deleteVehicle($invId);
            if ($deleteResult) {
                $message = "<p class='notice'>Congratulations the, $invMake $invModel was successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            }
            break;

        
        case 'classification':
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vehicles = getVehiclesByClassification($classificationName);
            if(!count($vehicles)) {
                $message = "<p>Sorry, no $classificationName vehicles could be found.</p>";
            } else {
                $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
            // echo $vehicleDisplay;
            // exit;
            include '../view/classification.php';
            break;

        case 'seeDetails':
            $classificationId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);
            $details = getInvItemInfo($classificationId);
            if(!count($details)) {
                $message = "<p>Sorry, no vehicle could be found.</p>";
            } else {
                $detailsDisplay = buildDetailsDisplay($details);
            }
            // echo $detailsDisplay;
            // exit;

            $thumbnailsPaths = getThumbnailPaths($classificationId);
            $thumbnailsDisplay = buildThumbnails($thumbnailsPaths);
            include '../view/vehicle-detail.php';
            break;

        default:
            $classificationList = buildClassificationList($classifications);
            include '../view/vehicle-management.php';
            break;
    }


?>