<?php
require_once ('../dp_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Στοιχεία από την φόρμα στο communication.php
    $user_email = $_POST['user_email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    try {
        //Για όλους τους users με role="Tutor" αποστέλεται email
        $stmt = $conn->prepare("SELECT username FROM users WHERE role = 'Tutor'");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $to = $row['username'];
            $headers = "From: $user_email";
            $headers .= "Content-Type: text/html; charset=UTF-8";


            mail($to, $subject, $message, $headers);
            header('Location: ../communication.php');
            
        }
    } catch (PDOException $e) {
        echo "Σφάλμα κατά την ανάκτηση των χρηστών: " . $e->getMessage();
    }
} else {
    echo "Άκυρο αίτημα αποστολής e-mail.";
}
?>