<?php
require_once('../dp_connection.php');

if (isset($_GET['document_id'])) {
    $documentId = $_GET['document_id'];

    // query που θα αποθηκευτεί σε statement
    $query = "SELECT file_path FROM documents WHERE id = :document_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':document_id', $documentId, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //παίρνω την σειρά που αντιστοιχεί στο document_id
    if ($row && isset($row['file_path'])) {
        //ορισμός μονόματιου στον φάκελο δηλαδή που έχει αποθηκευτει το εγγραφο
        $filePath = '../class_docs/' . $row['file_path'];

        //Αν υπάρχει αυτός ο φάκελος
        if (file_exists($filePath)) {
            
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Content-Length: ' . filesize($filePath));

            // κατέβασμα
            readfile($filePath);
            exit;
        } else {
            echo 'δεν βρεθηκε ο φάκελος';
        }
    } else {
        echo 'δεν βρέθηκε το αρχείο';
    }
} else {
    echo 'ερορ';
}
?>