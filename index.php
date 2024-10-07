<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8" />
    <title>Αρχική Σελίδα</title>
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
    
    <header><h1>Αρχική Σελίδα</h1></header>
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
        
        <h2>Καλώς ορίσατε στη σελίδα του μαθήματος σχετικά με την HTML.</h2>
        <p>
          Καλωσορίσατε στον ιστότοπο για την εκμάθηση HTML!

          Ο σκοπός αυτού του ιστότοπου είναι να σας βοηθήσει να εκμάθετε την 
          HTML (HyperText Markup Language), τη γλώσσα που χρησιμοποιείται για 
          τη δημιουργία ιστοσελίδων. Αναζητώντας τις διάφορες ιστοσελίδες του site, 
          θα ανακαλύψετε πληροφορίες και πόρους που θα σας βοηθήσουν να κατανοήσετε τα 
          θεμέλια της HTML και να αναπτύξετε τις δικές σας ιστοσελίδες.
          <br><br>
          Ο ιστότοπος περιλαμβάνει τις εξής ιστοσελίδες:
          <br>
          <b>Ανακοινώσεις:</b> Σε αυτήν τη σελίδα, θα βρείτε όλες τις σημαντικές ανακοινώσεις που 
          αφορούν τον ιστότοπο και την εκμάθηση HTML. Εδώ μπορείτε να ενημερώνεστε για τα 
          τελευταία νέα και εξελίξεις.
          <br>
          <b>Επικοινωνία:</b> Σε αυτήν τη σελίδα, έχετε τη δυνατότητα να επικοινωνείτε απευθείας 
          με τους διδάσκοντες και τους συμμετέχοντες στον ιστότοπο. Εδώ μπορείτε να 
          υποβάλλετε τα ερωτήματά σας και να συζητάτε θέματα σχετικά με την HTML.
          <br>
          <b>Έγγραφα Μαθήματος:</b> Σε αυτήν τη σελίδα, θα βρείτε πλούσιο υλικό που συμπληρώνει 
          τις διαλέξεις και τα μαθήματα σχετικά με την HTML. Μπορείτε να κατεβάσετε 
          διαφάνειες, βιβλία, και άλλα εκπαιδευτικά υλικά.
          <br>
          <b>Εργασίες:</b> Σε αυτήν τη σελίδα, θα βρείτε τις εκφωνήσεις και τα θέματα των εργασιών 
          που θα πρέπει να υλοποιήσετε ως μέρος της αξιολόγησής σας. Εδώ μπορείτε να βρείτε 
          τις οδηγίες και τα πρότυπα για τις εργασίες σας.
          <br><br>
          Είμαστε εδώ για να σας βοηθήσουμε σε αυτό το ταξίδι εκμάθησης της HTML. Αρχίστε 
          να εξερευνάτε τον ιστότοπο και να μάθετε περισσότερα για τη δημιουργία δικών σας 
          ιστοσελίδων!
        </p>

        <img src="./images/welcome.png" width="800"height="300"alt="EIKONA"/>

      </main>

    </div>
  </body>

</html>
