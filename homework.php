<?php
require('dp_connection.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Εργασίες</title>
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
    <header><h1>Εργασίες Έγγραφα Μαθήματος</h1></header>
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
          $stmt = $conn->prepare("SELECT * FROM homework");
          $stmt->execute();
           //σε περίπτωση που είναι δάσκαλος δυνατότητα εισαγωγής
          if($_SESSION['role']==='Tutor'){
            echo'<a href=./homework_extra\add_homework.html><h2>[Προσθήκη Εργασίας]</h2></a>';
            echo '<hr>';

          }
          echo '<div>';
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            echo '<h2> Eργασία ' . htmlspecialchars($row['id']) . ' :</h2>';
            echo '<p>';
            echo '<b> Στόχοι εργασίας:</b> ' . htmlspecialchars($row['goals']);
            echo '<br><br>';
            echo '<b>Παραδοτέα:</b> ' . htmlspecialchars($row['deliverables']) ;
            echo'<br><br>';
            echo'<i>Εδώ θα βρείτε την αναλυτική εκφώνηση της εργασίας</i> <a href="./homework_extra\homework_download.php?homework_id=' . $row['id'] . '">Download</a>';
            echo '<br><br>';
            echo '<b>Ημερομηνία παράδοσης: </b>' . htmlspecialchars($row['date']);
            echo '</p>';
            echo '<hr>';

          }
          echo'</div>';
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
