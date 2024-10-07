<?php
require_once('../dp_connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //στοιχεία που δώθηκαν
    $givenUsername = $_POST["username"];
    $givenPassword = $_POST["password"];

    //δημιουργέια query και εκτέλεση του μέσω statement για να δούμε αν υπάρχει ο χρήστης
    $query="SELECT * FROM users WHERE username = '$givenUsername'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':givenUsername', $givenUsername, PDO::PARAM_STR);
    if ($stmt->execute()){

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $userPassword=$user['password'];

            if($givenPassword===$userPassword)
            {
                session_start();//αρχή σεσιον για διατήρηση των στοιχείων σύνδεση 
                $_SESSION['name'] = $user['name'];
                $_SESSION['surname']=$user['surname'];
                $_SESSION['role']=$user['role'];
                
                header("Location:../index.php");
                exit;
            }
            else{
                echo "Λάθος κωδικός";
                header("refresh:2;url=login.html");
            }

        }else {
            echo "Δεν βρέθηκε χρήστης με αυτό το email";
            header("refresh:2;url=login.html");
        }
    } else {
        echo "ερορ";
    }

}
?>