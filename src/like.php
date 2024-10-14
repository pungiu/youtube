<?php
    require_once "db.php";
    session_start();


    if (empty($_SESSION['vid'])) {
        header("Location: http://pungi.org/");
        exit();
    }

    $vid = $_SESSION['vid'];

    $vsql = "SELECT * FROM vsebina WHERE id = '$vid'";
    $vq = mysqli_query($conn,$vsql);
    $rq = mysqli_num_rows($vq);

    if ($rq == 0){
        header("Location: http://pungi.org/");
        exit();
    }

    $nq = mysqli_fetch_array($vq, MYSQLI_ASSOC);
    $url = $nq['url'];

    if (empty($_SESSION['user_id'])) {
        header("Location: http://pungi.org/$url");
        exit();
    }

    $uid = $_SESSION['user_id'];

    $data = array();

    $sdl = "SELECT * FROM vsecki WHERE uporabnik_id = '$uid' AND video_id = '$vid';";

    $lq = mysqli_query($conn,$sdl);
    $lr = mysqli_fetch_array($lq, MYSQLI_ASSOC);
    
    if (mysqli_num_rows($lq) == 0) {
        $sqli = "INSERT INTO vsecki (uporabnik_id,video_id) VALUES ('$uid','$vid');";
        if (mysqli_query($conn,$sqli)) {
            header("Location: http://pungi.org/$url");
            exit();
        }
    } else {
        $slid = "DELETE FROM vsecki WHERE uporabnik_id = '$uid' AND video_id = '$vid';";
        if (mysqli_query($conn,$slid)) {
            header("Location: http://pungi.org/$url");
            exit();
        }
    }
    

?>