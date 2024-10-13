<?php

    //This is the ACCOUNTS MODEL

    //This new function will handle SITE REGISTRATIONS
    function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
        
        //Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();
        
        //The SQL statement
        $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
            VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';

        //Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        //The next four lines replace the placeholders (marcadores) in the SQL statement with the actual values in the variables and tells the databse the type of data it is
        $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
        $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

        //Insert the data
        $stmt->execute();

        //Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        //Close the database interaction
        $stmt->closeCursor();

        //Return the indication of success
        return $rowsChanged;

    }

    //This new function will check for an existing email address
    function checkExistingEmail($clientEmail) {
        //Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();

        //The SQL statement
        $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';

        //Create the prepared statement using the phpmotors connection function
        $stmt = $db->prepare($sql);

        //The next line replaces the placeholder (marcador) in the SQL statement eith the actual value in the variable and tells the database the type of data it is
        $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);

        $stmt->execute();

        //We only want to get a single row from the database if a match is found, so use a "fetch()" not a "fetchAll()". In addition, we can indicate that we only want a simple numeric array by adding a parameter to the fetch of "PDO::FETCH_NUM"
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);

        $stmt->closeCursor();

        if(empty($matchEmail)) {
            return 0;
            // echo 'Nothing found';
            // exit;
        } else {
            return 1;
            // echo 'Match found';
            // exit;
        }
    }

    //Get client data based on an email address
    function getClient($clientEmail) {
        $db = phpmotorsConnect();
        $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->execute();
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $clientData;
    }

   // Get new client information by clientId
    function getClientNewInfo($clientId){
        $db = phpmotorsConnect();
        $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $clientNewInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $clientNewInfo;
    }


    // Update the client information
    function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId) {
        
        //Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();

        //The SQL statement
        $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';

        //Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        //The next lines replace the placeholders (marcadores) in the SQL statement with the actual values in the variables and tells the database the type of data it is
        // $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
        $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

        //Insert the data
        $stmt->execute();

        //Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        //Close the database interaction
        $stmt->closeCursor();

        //Return the indication of success
        return $rowsChanged;

    }

    function updatePassword($clientPassword, $clientId) {
        //Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();
        
        //The SQL statement
        $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';        

        //Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        //The next four lines replace the placeholders (marcadores) in the SQL statement with the actual values in the variables and tells the databse the type of data it is
        $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);

        //Insert the data
        $stmt->execute();

        //Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        //Close the database interaction
        $stmt->closeCursor();

        //Return the indication of success
        return $rowsChanged;
    }

?>