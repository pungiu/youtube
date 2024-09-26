<?php

require_once 'db.php';

session_start();
session_regenerate_id();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_SESSION);
    echo "<br>";
    var_dump($_POST);

    if($_GET['action'] == 'login'){
        if (isset($_POST['mail']) && isset($_POST['geslo'])) {
            
        }
    }

    if ($_GET['action'] == 'signup') {
        if (isset($_POST['user']) && isset($_POST['mail']) && isset($_POST['geslo'])) {
            echo "vse je ok";
        }
    }
}
?>