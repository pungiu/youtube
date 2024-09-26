<?php

require_once 'db.php';

session_start();
session_regenerate_id();
    $sporocila = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_GET['action'] == 'login'){
        $logusername = mysqli_real_escape_string($conn,$_POST['mail']);

        $sql = "SELECT * FROM uporabniki WHERE email = '$logusername';";

        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

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

    if($num == 0){
        if ($password === $passwordIde){
            if (strlen($password) > 6){
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO uporabniki (username,geslo,email) VALUES ('$username','$password_hash','$mail')";
            if (mysqli_query($conn, $sql)) {
                    echo "Records inserted successfully.";
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                }
            } else {
                $error_handler = "geslo mora biti dolgo vsaj 7 crk";
            }
        } else {
            $error_handler = "Gesli se ne ujemata";
        }
    } else if($num>0){
        $error_handler = "Uporabnisko ime je zasedeno";
    }



    header('Location: http://pungi.org/');
    exit();
    }
}
?>
