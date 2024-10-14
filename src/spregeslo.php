<?php
    require_once "db.php";
    session_start();

    if (empty($_SESSION['user_id'])) {
        header("Location: http://pungi.org/");
        exit();
    }
    $uid = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $s1 = $_POST['ge1'];
        $s2 = $_POST['ge2'];
        if (empty($s1) || empty($s2)) {
            header("Location: http://pungi.org/u");
            exit();
        }

        if (strcmp($s1,$s2) != 0) {
            header("Location: http://pungi.org/u");
            exit();
        }

        if (strlen($s1) > 6) {
            
            $passhash = password_hash($s1, PASSWORD_DEFAULT);

            $sqlu = "UPDATE uporabniki SET geslo = '$passhash' WHERE id = '$uid'";
            if (mysqli_query($conn,$sqlu)) {
                header("Location: u");
                exit();
            }

        }
        

    }
?>