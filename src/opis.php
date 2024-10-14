<?php
require_once 'db.php';
    session_start();
    session_regenerate_id();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['vsebina'])) {
            $t = mysqli_real_escape_string($conn,$_POST['vsebina']);
            $vid = $_SESSION['video_id'];

            $sql = "UPDATE vsebina SET opis = '$t' WHERE id = '$vid';";
            if (mysqli_query($conn, $sql)) {
                header("Location: upload");
                exit();
            }
        }
    }
?>