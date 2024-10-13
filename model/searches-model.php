<?php

    // Get search results based on user search
    function searching($userSearch){
        $db = phpmotorsConnect();

        $sql = 'SELECT *
                FROM inventory
                WHERE (invDescription LIKE CONCAT("%", :userSearch, "%"))
                OR (invColor LIKE CONCAT("%", :userSearch, "%"))';
        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userSearch', $userSearch, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }


?>