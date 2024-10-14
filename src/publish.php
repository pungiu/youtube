<?php
    require_once 'db.php';
    session_start();

    if (!isset($_SESSION['user_id']) || !isset($_SESSION['video_id'])) {
        header("Location: upload");
        exit();
    }
    $uid = $_SESSION['user_id'];
    $vid = $_SESSION['video_id'];

    $sql = "SELECT * FROM vsebina WHERE id = '$vid';";
    $query = mysqli_query($conn,$sql);
    $qresults = mysqli_fetch_array($query);

    if(empty($qresults['naslov'])) {
        header("Location: upload");
        exit();
    }

    $complete = "UPDATE vsebina SET aktivno = 1 WHERE id = '$vid'";
    if (mysqli_query($conn,$complete)) {
        unset($_SESSION['video_id']);
        header("Location: http://pungi.org/");
        exit();
    }
?>