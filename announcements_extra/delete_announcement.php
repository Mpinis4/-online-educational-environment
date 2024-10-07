<?php
require_once("../dp_connection.php");

if (isset($_GET['id'])) {
    $announcementId = $_GET['id'];

    try {
        //δημιουργία query και αποθήκευση του σε ένα statement
        $stmt = $conn->prepare("DELETE FROM announcements WHERE id = :id");
        $stmt->bindParam(":id", $announcementId, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            //επιτυχής διαγραφή
            //header("Location: ../announcement.php"); 
            //exit;
        } else {
            echo "αποτυχία διαγραφής";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "δεν δόθηκε id";
}
// κάνουμε update ώστε οι επόμενες, αυτής που διαγράψαμε, ανακοίνωσης ανακοινώσεις να μειώσουν το id τους κατά ένα
$query = "UPDATE announcements SET id = id - 1 WHERE id > :announcementId";

try {
    $stmt= $conn->prepare($query);
    $stmt->bindParam(":announcementId", $announcementId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        //επιτυχημένο update επιστροφή στην announcement
        header("Location: ../announcement.php");
        exit;
    } else {
        echo "αποτυχία update";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
