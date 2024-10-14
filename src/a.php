<?php

require_once 'db.php';

session_start();
session_regenerate_id();
    $sporocila = array();

    function isValidEmail($email) {
        // Trim whitespace
        $email = trim($email);
        
        // Check if the email is empty
        if (empty($email)) {
            return false;
        }
        
        // Validate email format
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_GET['action'] == 'login'){
        $logusername = mysqli_real_escape_string($conn,$_POST['mail']);

        $sql = "SELECT * FROM uporabniki WHERE email = '$logusername';";

        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);

        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        if ($row['google'] == 1) {
            header('Location: http://pungi.org/');
            exit();
        }


        if ($count == 1 && !$row['google'] == 1) {
            

            if (password_verify($_POST['geslo'], $row["geslo"])){

                $_SESSION["user_id"] = $row["id"];
    
                header('Location: http://pungi.org/');
                exit();
            } else {
                echo "geslo  je napacno";
            }
        } else {
            echo "Brez zapisov v bazi";
        }
    }

    if ($_GET['action'] == 'signup') {
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $mail = mysqli_real_escape_string($conn, $_POST['mail']);
        $password = $_POST['geslo'];
        $passwordIde = $_POST['gesloconf'];

        $result = mysqli_query($conn,"Select * from uporabniki where username = '$username'");
        $num = mysqli_num_rows($result);
        $resulte = mysqli_query($conn,"SELECT * FROM uporabniki WHERE email = '$mail'");
        $nume = mysqli_num_rows($resulte);

    if($num == 0 && $nume == 0){
        if (isValidEmail($mail)) {
        if ($password === $passwordIde){
            if (strlen($password) > 6){
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO uporabniki (username,geslo,email) VALUES ('$username','$password_hash','$mail')";
            if (mysqli_query($conn, $sql)) {
                    
                    $sqlpr = "SELECT * FROM uporabniki WHERE username = '$username' AND email = '$mail'";
                    $qrpr = mysqli_query($conn,$sqlpr);
                    $respr = mysqli_fetch_array($qrpr,MYSQLI_ASSOC);

                    $_SESSION["user_id"] = $respr['id'];

                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                }
            } else {
                $error_handler = "geslo mora biti dolgo vsaj 7 crk";
            }
        } else {
            $error_handler = "Gesli se ne ujemata";
        }
    } else {$error_handler = "Email ni zapisan v pravilni obliki";}
    } else if($num>0){
        $error_handler = "Uporabnisko ime je zasedeno";
    } else if ($nume>0) {
        $error_handler = "Elektronski naslov je zaseden";
    }



    header('Location: http://pungi.org/');
    exit();
    }
} else {
    header('Location: http://pungi.org/');
    exit();
}
?>