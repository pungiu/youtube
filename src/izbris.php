<?php
    require_once 'db.php';
    session_start();

    $vid = $_GET['v'];
    $uid = $_SESSION['user_id'];
    if (empty($uid)) {
        header("Location: http://pungi.org/");
        exit();
    }
    if (empty($vid)) {
        header("Location: http://pungi.org/");
        exit();
    }

    $vsql = "SELECT * FROM vsebina WHERE id = '$vid'";
    $vquer = mysqli_query($conn,$vsql);
    $vres = mysqli_fetch_array($vquer, MYSQLI_ASSOC);

    $vu = $vres['uporabnik_id'];

    if ($vu === $uid) {
        
        $sqld = "DELETE FROM vsebina WHERE id = '$vid'";
        mysqli_query($conn,$sqld);

        $usql = "SELECT * FROM uporabniki WHERE id = '$uid'";
        $uquer = mysqli_query($conn,$usql);
        $ug = mysqli_fetch_array($uquer, MYSQLI_ASSOC);

        $ff = $ug['username'];
        header("Location: http://pungi.org/e?u=$ff");
        exit();

    } else {
        header("Location: http://pungi.org/");
        exit();
    }
?>