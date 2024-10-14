<?php
    require_once 'db.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_SESSION['user_id'])) {
            header("Location: u");
            exit();
        }

        if (empty($_POST['imep'])) {
            header("Location: u");
            exit();
        }
        $w = $_SESSION['user_id'];

        $f = $_POST['imep'];
        $c = mysqli_real_escape_string($conn,$f);

        $d = "UPDATE uporabniki SET username = '$c' WHERE id = '$w'";
        $s = mysqli_query($conn,$d);

        header("Location: u");
        exit();
    }
?>