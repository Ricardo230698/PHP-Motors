<?php

function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function checkFloat($number) {
    $valFloat = filter_var($number, FILTER_VALIDATE_FLOAT);
    return $valFloat;
}

function checkInt($number) {
    $valInt = filter_var($number, FILTER_VALIDATE_INT);
    return $valInt;
}

function checkURL($url) {
    $valURL = filter_var($url, FILTER_VALIDATE_URL);
    return $valURL;
}

function buildNavigation($classifications) {
    //Build a navigation bar using the $classifications array
    $navList = '<ul id="nav_menu">'; //I'm putting a class myself for it to align with my CSS
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/index.php?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';

    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}

// This function will build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles) {
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>Price: $" . number_format($vehicle['invPrice']) . "</span>";
        // Next line is step 1 enhancement:
        $dv .= '<hr>';
        $dv .= "<a href='/phpmotors/vehicles/index.php?action=seeDetails&vehicleId=$vehicle[invId]'>View Vehicle Details</a>";
        // 
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildDetailsDisplay($details) {
    $detailsInfo = '<ul id="details-display">';
    foreach ($details as $detail) {
        $detailsInfo .= '<li>';
        $detailsInfo .= "<img src='$detail[imgPath]' alt='Image of $detail[invMake] $detail[invModel] on phpmotors.com'>";
        // $detailsInfo .= '<br>';
        $detailsInfo .= "<h2>$detail[invMake] $detail[invModel]</h2>";
        // $detailsInfo .= '<br>';
        $detailsInfo .= "<span>Price: $".number_format($detail['invPrice'])."</span>";
        // $detailsInfo .= '<br>';
        $detailsInfo .= "<span>Description: $detail[invDescription]</span>";
        // $detailsInfo .= '<br>';
        $detailsInfo .= "<span>Color: $detail[invColor]</span>";
        // $detailsInfo .= '<br>';
        $detailsInfo .= "<span>Stock: $detail[invStock]</span>";
        $detailsInfo .= '</li>';
    }
    $detailsInfo .= '</ul>';
    return $detailsInfo;
}


/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}


// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}


// Build the thumbnail images
function buildThumbnails($thumbnails) {
    $td = '<ul id="thumbnail-display">';
    foreach ($thumbnails as $thumbnail) {
        $td .= '<li>';
        $td .= "<img src='$thumbnail[imgPath]' alt='$thumbnail[imgName]'>";
        $td .= '</li>';
    }
    $td .= '</ul>';
    return $td;
}

//  Build the SEARCHES display list
function buildSearchResults($results, $resultsCount) {

    $countNew = count(array_chunk($results, 10));
    $sd = "<h2>$resultsCount results found</h2>";
    $sd .= '<ul id="searches-display">';

    foreach(array_chunk($results, 10)[$_SESSION['page'] - 1] as $result) {
        $sd .= '<li>';
        $sd .= "<span>$result[invMake] $result[invModel]</span><br>";
        $sd .= "<span>$result[invColor] - $result[invPrice]</span>";
        $sd .= "<p>$result[invDescription]</p>";
        $sd .= "<img src='$result[invThumbnail]' alt='Image of $result[invMake] $result[invModel]'><br>";
        $sd .= "<a href='/phpmotors/vehicles/index.php?action=seeDetails&vehicleId=$result[invId]'>See Vehicle Details</a>";
        $sd .= '</li><hr>';
    }
    $sd .= '</ul>';

    $last = $_SESSION['page'] - 1;
    $next = $_SESSION['page'] + 1;


    if($countNew > 1) {
        $sd .= '<section id="pagination" style="width:85%; margin:0 auto; display:flex; align-items:center;">';
        $sd .= '<form action="/phpmotors/searches/" method="post" style="display:contents;">';
        if($_SESSION['page'] == 1) {
            $sd .= "<button type='submit' name='page' value='$last' style='display:none; font-size:x-large;'>⏪</button>";
        } else {
            $sd .= "<button type='submit' name='page' value='$last' style='display:contents; font-size:x-large;'>⏪</button>";
        }
        $sd .= "<input type='hidden' name='action' value='search'>";
        $sd .= '</form>';

        $sd .= '<form action="/phpmotors/searches/" method="post" style="display:flex; flex-direction:row; justify-content:center;">';
        for ($i=1; $i <= count(array_chunk($results, 10)); $i++) {
            if($_SESSION['page'] == $i) {
                $sd .= "<input type='submit' name='page' value='$i' disabled='disabled' style='width:auto;'>";
            } else {
                $sd .= "<input type='submit' name='page' value='$i' style='width:auto;'>";
            }
        }
        $sd .= "<input type='hidden' name='action' value='search'>";
        $sd .= '</form>';

        $sd .= '<form action="/phpmotors/searches/" method="post" style="display:contents;">';
        if($_SESSION['page'] == $countNew) {
            $sd .= "<button type='submit' name='page' value='$next' style='display:none; font-size:x-large;'>⏩</button>";
        } else {
            $sd .= "<button type='submit' name='page' value='$next' style='display:contents; font-size:x-large;'>⏩</button>";
        }
        $sd .= "<input type='hidden' name='action' value='search'>";
        $sd .= '</form>';
        $sd .= '</section>';
    }

    return $sd;
}


// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}



// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
}


// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}



// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
} // ends resizeImage function

?>