<?php

function getActivities() {
    $conn = getConnection();

 
    $sql = "SELECT * FROM activities";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}

?>
