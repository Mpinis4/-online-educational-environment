<?php
require_once('../dp_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    
    // έλεγχος αν ανέβηκε το αρχείο
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // έλεγχος για σωστό τύπο αρχείου εισαγωγής
        $allowedExtensions = array('doc', 'docx');
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            // μοναδικό αναγνωριστικό-όνομα για κάθε αρχείο που ανεβαίνει ώστε να μην χρειάζεται να το παρέχει ο χρήστης
            $uniqueFilename = uniqid() . '.' . $fileExtension;

            // αποθήκευση των αρχείων στον φάκελο class_docs
            $targetDirectory = '../class_docs/';
            $targetFilePath = $targetDirectory . $uniqueFilename;

            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                // επιτιχείς αποθήκευση του αρχείου στον φάκελο που ορίσαμε
                try {
                    $stmt = $conn->prepare("INSERT INTO documents (title, description, file_path) VALUES (:title, :description, :file_path)");
                    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                    $stmt->bindParam(':file_path', $uniqueFilename, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        //επιτυχείς δημοσίευση εγγράφου στην σελίδα του μαθήματος και επιστροφή σε αυτήν
                        header('Location: ../documents.php');
                        exit;
                    } else {
                        echo 'αποτυχία δημοσίευσης';
                    }
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            } else {
                echo 'αποτυχία ανεβάσματος αρχείου';
            }
        } else {
            echo 'λάθος τύπος';
        }
    } else {
        echo 'δεν δώθηκε αρχείο';
    }
}
?>
