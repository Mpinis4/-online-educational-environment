<?php
require_once("../dp_connection.php");

if (isset($_GET['id'])) {
    $announcementId = $_GET['id'];

    //Αν έχει εφαρμοστεί η μέθοδος post τότε προχωράμε στο update αλλίως παρακάτω γίνεται η ανάκτηση και εμφάνιση των κειμένων για την ήδη υπάρχουσα ανακοίνωση
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Παίρνουμε τις νέες τιμές για θέμα και κυρίως κείμενο από την φόρμα
        $updatedSubject = $_POST['subject'];
        $updatedText = $_POST['text'];

        try {
            // προετοιμασία ερωτήματος για να μην έχουμε injections
            $stmt = $conn->prepare("UPDATE announcements SET subject = :subject, text = :text, date = NOW() WHERE id = :id");
            $stmt->bindParam(":subject", $updatedSubject, PDO::PARAM_STR);
            $stmt->bindParam(":text", $updatedText, PDO::PARAM_STR);
            $stmt->bindParam(":id", $announcementId, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                // επιτυχής εκτέλεση που οδηγεί πίσω στην σελίδα των ανακοινώσεων
                header("Location: ../announcement.php");
                exit;
            } else {
                echo "αποτυχία update";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //εδώ παίρνουμε από την βάση δεδομένων το θέμα και το κείμενο για την συγκεκριμένη ανακοίνωση
    try {
        $stmt = $conn->prepare("SELECT subject, text FROM announcements WHERE id = :id");
        $stmt->bindParam(":id", $announcementId, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentSubject = $row['subject'];
        $currentText = $row['text'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "δεν δώθηκε το id";
}
?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8" />
    <title>Τροποίηση Ανακοίνωσης</title>
    <link rel="stylesheet" href="announcements.css" />
  </head>
  <body>
    <main><!--Εδώ έχουμε ένα form το οποίο καλεί ξανά αυτή την σελίδα με την μέθοδο post και το id της ανακοίνωσης η οποία είναι προς update-->
        <form action="edit_announcement.php?id=<?php echo $announcementId; ?>" method="post">
            <h2>Τροποίηση Ανακοίνωσης</h2>
            <br>
            <label for="subject">Θέμα:</label>
            <input type="text" id="subject" name="subject" required value="<?php echo $currentSubject; ?>"/>
            <label for="text">Κείμενο:</label>
            <textarea id="text" name="text" required ><?php echo $currentText; ?></textarea>
            
            <br>
            <input type="submit" value="Επιβεβαίωση"/>
        </form>
    </main>
  </body>
</html>
