<?php
    require_once 'db.php';
    session_start();
    session_regenerate_id();

    if (empty($_GET['g'])) {
        header("Location: http://pungi.org/");
        exit();
    }

    $g = $_GET['g'];
    
    if (empty($_SESSION['user_id'])){
        header("Location: http://pungi.org/");
        exit();
    }  

    $u = $_SESSION['user_id'];

    $sql = "SELECT * FROM vsebina WHERE id = '$g'";
    $querry = mysqli_query($conn,$sql);
    $res = mysqli_fetch_array($querry,MYSQLI_ASSOC);

    if ($u === $res['uporabnik_id']) {
        if(isset($_SESSION['video_id'])) {
            unset($_SESSION['video_id']);
        }
        $_SESSION['video_id'] = $g;

        header("Location: upload");
        exit();
    } else {
        header("Location: http://pungi.org/");
        exit();
    }
?>