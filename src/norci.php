<?php

    require_once 'db.php';
    session_start();

    $uid = $_SESSION['user_id'];
    if(empty($uid)) {
        header("Location: http://pungi.org/");
        exit();
    }

    $subid = $_GET['u'];

    if (empty($subid)) {
        header("Location: http://pungi.org/");
        exit();
    }

    if(strcmp($uid,$subid) == 0) {
        header("Location: http://pungi.org/");
        exit();
    }
    $sqlcheck = "SELECT * FROM sub WHERE uporabnik_id = '$uid' AND narocnina = '$subid'";
    $querycheck = mysqli_query($conn,$sqlcheck);
    $numcheck = mysqli_num_rows($querycheck);

    if ($numcheck == 0) {
        $sql = "INSERT INTO sub (uporabnik_id, narocnina) VALUES ('$uid','$subid')";
        if (mysqli_query($conn,$sql)) {
            $vidform = $_SESSION['vid'];
            if (isset($vidform)) {
                $returnsql = "SELECT * FROM vsebina WHERE id = '$vidform';";
                $returnquery = mysqli_query($conn,$returnsql);
                $returnarr = mysqli_fetch_array($returnquery, MYSQLI_ASSOC);

                $returnurl = $returnarr['url'];
                header("Location: $returnurl");
                exit();
            } else {
                header("Location: http://pungi.org/");
                exit();
            }
        } else {
            header("Location: http://pungi.org/");
            exit();
        }
    } else if ($numcheck > 0) {
        $sql = "DELETE FROM sub WHERE uporabnik_id = '$uid' AND narocnina = '$subid';";
        if (mysqli_query($conn,$sql)) {
            $vidform = $_SESSION['vid'];
            if (isset($vidform)) {
                $returnsql = "SELECT * FROM vsebina WHERE id = '$vidform';";
                $returnquery = mysqli_query($conn,$returnsql);
                $returnarr = mysqli_fetch_array($returnquery, MYSQLI_ASSOC);

                $returnurl = $returnarr['url'];
                header("Location: $returnurl");
                exit();
            } else {
                header("Location: http://pungi.org/");
                exit();
            }
        } else {
            header("Location: http://pungi.org/");
            exit();
        }
    }