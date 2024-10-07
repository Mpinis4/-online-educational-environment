<?php
require_once('../dp_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $goals = $_POST['goals'];
    $deliverables = $_POST['deliverables'];
    $date = $_POST['date'];
    
    //Εδώ βρίσκουμε το μέγιστο id και κάνουμε ένα reset το Auto_increment του id
    //ΑΡΙΒΩΣ ΙΔΙΑ ΔΙΑΔΙΚΑΣΊΑ ΠΟΥ ΚΑΝΟΥΜΕ ΚΑΙΣ ΣΤΟΝ add_announcement
    try {
        $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM homework");
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $row['max_id'];

        $newAutoIncrement = $maxId + 1;
        
        $stmt = $conn->prepare("ALTER TABLE homework AUTO_INCREMENT = :new_auto_increment");
        $stmt->bindParam(":new_auto_increment", $newAutoIncrement, PDO::PARAM_INT);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


    // Ιδια ακριβώς διαδικασία με την add_document μόνο που εδώ είναι προφανώς διαφορετικές η τιμές που εισάγονται και ο φάκελος που αποθηκεύονται οι εργασίες 
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        $allowedExtensions = array('doc', 'docx');
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            $uniqueFilename = uniqid() . '.' . $fileExtension;

            $targetDirectory = '../assignments/';
            $targetFilePath = $targetDirectory . $uniqueFilename;

            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                try {
                    $stmt = $conn->prepare("INSERT INTO homework (goals, deliverables, date, file_path) VALUES (:goals, :deliverables, :date, :file_path)");
                    $stmt->bindParam(':goals', $goals, PDO::PARAM_STR);
                    $stmt->bindParam(':deliverables', $deliverables, PDO::PARAM_STR);
                    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                    $stmt->bindParam(':file_path', $uniqueFilename, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        header('Location: ../homework.php');
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
            echo 'λάθος τύπος αρχείου';
        }
    } else {
        echo 'δεν δώθηκε αρχείο';
    }
}
?>
