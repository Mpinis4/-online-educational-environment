<?php
require_once('dp_connection.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Ανακοινώσεις</title>
    <link rel="stylesheet" href="StyleSheet.css" />
    <script>
      <?php
      //έλεγχος αν υπάρχει σύνδεση αλλίως πίσω στην login
      session_start();
        if (!isset($_SESSION['name'])) {
            session_destroy();
            echo "window.location.href = './login/login.html';";
        }
      ?>
    </script>
  </head>
  <body>
    <header><h1>Ανακοινώσεις</h1></header>
    <div class="contex">

      <ul class="navigation_bar">
          
          <li class="navigation_bar_item">
            <a href="index.php"><img src="./images/home.png" title="Home-page" alt="Home-page button" width="40" height="40" /></a>
          </li>

          <li class="navigation_bar_item">
            <a href="announcement.php"><img src="./images/announcement.png" title="Announcement" alt="announcement button" width="40" height="40" /></a>
          </li>

          <li class="navigation_bar_item">
            <a href="communication.php"><img src="./images/communication.png" title="Communication" alt="communication button" width="40" height="40" /></a>
          </li>

          <li class="navigation_bar_item">
            <a href="documents.php"><img src="./images/documents.png" title="Documents" alt="documents button" width="40" height="40" /></a>
          </li>
          
          <li class="navigation_bar_item">
            <a href="homework.php"><img src="./images/homework.png" title="Homework" alt="homework button" width="40" height="40" /></a>
          </li>

          <li class="navigation_bar_item">
            <?php echo $_SESSION['name']." ".$_SESSION['surname']?>
            <br>
            <a href="./login/logout.php">Αποσύνδεση</a>
          </li>

      </ul>

      <main>
        <?php
          try {
              $stmt = $conn->prepare("SELECT * FROM announcements");
              $stmt->execute();
              //σε περίπτωση που είναι δάσκαλος δυνατότητα εισαγωγής
              if($_SESSION['role']==='Tutor'){
                echo'<a href=./announcements_extra\add_announcement.php><h2>[Προσθήκη Ανακοίνωσης]</h2></a>';
                echo '<hr>';

              }
              //εμφάνιση μία μία τις ανακοινώσεις
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div>';
                echo '<h2> Ανακοίνωση ' . htmlspecialchars($row['id']) . ' :</h2>';
                echo '<p>';
                echo '<b>Ημερομηνία:</b> ' . htmlspecialchars($row['date']) . '<br><br>';
                echo '<b>Θέμα:</b> ' . htmlspecialchars($row['subject']) . '<br><br>';
                echo htmlspecialchars($row['text']);
                echo '<br><br>';
                $isHomework="εργασία";
                if(strpos($row['subject'],$isHomework)){
                  echo 'Μπορείτε να βρείτε περισσότερες λεπτομέρειες <a href="homework.php">εδώ</a>';
                }
                echo '<br><br>';
                //σε περίπτωση που είναι δάσκαλος δυνατότητα διαγραφής και επεκεργασίας της εκάστοτε ανακοίνωσης
                if($_SESSION['role']==='Tutor'){
                  echo'<a href=./announcements_extra/delete_announcement.php?id=' . $row['id'] . '>[Διαγραφή]</a> <a  href=./announcements_extra\edit_announcement.php?id=' . $row['id'] . '>[Επεξεργασία]</a>';

                }
                echo '</p>';
                echo '</div>';
                echo '<hr>';
              }
            } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        ?>
        
        <div class="to_the_top">
          <br>
          <a href="#"><b>Αρχή ιστοσελίδας</b></a>
        </div>

      </main>

    </div>

  </body>
</html>
