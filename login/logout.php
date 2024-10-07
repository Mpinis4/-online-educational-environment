<?php
session_start();
session_destroy();//διαγραφή σεσιον για αποσύνδεση χρήστη
header("Location: login.html");
exit;
?>