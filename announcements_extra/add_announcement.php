<?php
require_once("../dp_connection.php");
//αν έχει κληθεί η post από την παρακάτω φόρμα προχωράμε σε εισαγωγή
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //στοιχεία από την φόρμα παρακάτω 
    $newSubject = $_POST['subject'];
    $newText = $_POST['text'];

    //Εδώ βρίσκουμε το μέγιστο id και κάνουμε ένα reset το Auto_increment του id
    try {
        //το ορίζουμε ως max_id και αρχικοποειούμε το id ώστε να εμφανίζονται με την σειρά οι Ανακοινώσεις 1,2,3...
        $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM announcements");
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $row['max_id'];
        //μέγιστο id συν ένα ώστε η ανακοίνωση που πάμε να κάνουμε εισαγωγή να γίνεται με το σωστό id
        $newAutoIncrement = $maxId + 1;
        
        $stmt = $conn->prepare("ALTER TABLE announcements AUTO_INCREMENT = :new_auto_increment");
        $stmt->bindParam(":new_auto_increment", $newAutoIncrement, PDO::PARAM_INT);
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    try {
        //δημιουργεία query και αποθήκευση του σε ένα statement
        $stmt = $conn->prepare("INSERT INTO announcements (subject, text, date) VALUES (:subject, :text, NOW())");
        $stmt->bindParam(":subject", $newSubject, PDO::PARAM_STR);
        $stmt->bindParam(":text", $newText, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // επιτυχία εισαγωγής,πίσω στις ανακοινώσεις
            header("Location: ../announcement.php");
            exit;
        } else {
            echo "Αποτυχία εκτέλεσης";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Προσθήκη Ανακοίνωσης</title>
    <link rel="stylesheet" href="announcements.css" />
</head>

<body>
    <main>
        <!--Φόρμα που καλεί το ίδιο αρχείο για την εισαγωγή νέας ανακοίνωσης -->
        <form action="add_announcement.php" method="post">
            <h2>Προσθήκη Ανακοίνωσης</h2>
            <br>
            <label for="subject">Θέμα:</label>
            <input type="text" id="subject" name="subject" required />
            <label for="text">Κείμενο:</label>
            <textarea id="text" name="text" required ></textarea>

            <br>
            <input type="submit" value="Επιβεβαίωση" />
        </form>
    </main>
</body>

</html>