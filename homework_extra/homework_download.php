<?php
require_once('../dp_connection.php');

// ΑΚΡΙΒΩΣ ΙΔΙΑ ΔΙΑΔΙΚΑΣΙΑ ΜΕ ΤΗΝ download_document.php
if (isset($_GET['homework_id'])) {
    $documentId = $_GET['homework_id'];

    $query = "SELECT file_path FROM homework WHERE id = :homework_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':homework_id', $documentId, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && isset($row['file_path'])) {
        $filePath = '../assignments/' . $row['file_path']; 

        if (file_exists($filePath)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Content-Length: ' . filesize($filePath));

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