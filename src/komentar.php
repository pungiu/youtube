<?php
    require_once "db.php";
    session_start();

    $get = $_GET['v'];
    if (empty($_GET['v'])) {
        header("Location: http://pungi.org/");
        exit();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: http://pungi.org/$get");
        exit();
    }

    $post = $_POST['komentar'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($post)) {
            header("Location: http://pungi.org/$get");
            exit();
        }

        $check = mysqli_real_escape_string($conn,$post);

        $sqla = "SELECT * FROM vsebina WHERE url = '$get';";
        $quera = mysqli_query($conn,$sqla);
        $resa = mysqli_fetch_array($quera,MYSQLI_ASSOC);

        $vid = $resa['id'];
        $vuid = $resa['uporabnik_id'];
        $u = $_SESSION['user_id'];


        $sql = "INSERT INTO komentarji (vsebina, uporabnik_id, video_id) VALUES ('$check','$u','$vid');";
        mysqli_query($conn,$sql);
        
        header("Location: http://pungi.org/$get");
        exit();

    }