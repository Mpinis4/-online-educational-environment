<?php
require('dp_connection.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Επικοινωνία</title>
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
    <header><h1>Επικοινωνία</h1></header>
    
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

        <h2>Αποστολή e-mail μέσω web φόρμας</h2>
        <p>
          Συμπληρώστε τα στοιχεία που σας ζητούνται
        </p>
        <form action="./communication_extra\sendemail.php" method="post">
          <label for="email">Το σας e-mail:</label>
          <br>
          <input type="email" name="user_email" required/>
          <br>
          <br>
          <label for="subject">Θέμα:</label>
          <br>
          <input type="text" name="subject" required />
          <br>
          <br>
          <label for="message">Κείμενο:</label>
          <br>
          <textarea id="message" name="message" style="height: 150px; width: 500px" required></textarea>
          <br>
          <input type="submit" value="Αποστολή" />
        </form>

        <h2>Αποστολή e-mail ε χρήση e-mail διεύθυνσης</h2>
        <p>
          Εναλλακτικά επικοινωνήστε μέσω email στην διεύθυνση: <a href="mailto:address">xanchathe@csd.auth.gr</a>
        </p>

      </main>

    </div>

  </body>
</html>
