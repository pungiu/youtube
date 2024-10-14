<?php
// Initialize the session - is required to check the login state.
require_once '/var/www/youtube/src/db.php';
session_start();
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['google_loggedin'])) {
    header('Location: login.php');
    exit;
}
// Retrieve session variables
$google_loggedin = $_SESSION['google_loggedin'];
$google_email = $_SESSION['google_email'];
$google_name = $_SESSION['google_name'];
$google_picture = $_SESSION['google_picture'];

var_dump($_SESSION);
$sql = "SELECT * FROM uporabniki WHERE email = '$google_email'";
$q = mysqli_query($conn,$sql);
$c = mysqli_num_rows($q);

if ($c > 0) {
    echo "Prijava";
    $mail = mysqli_real_escape_string($conn,$google_email);

        $gus = "SELECT * FROM uporabniki WHERE email = '$mail'";
        $guid = mysqli_query($conn,$gus);
        $gur = mysqli_fetch_array($guid,MYSQLI_ASSOC);

        $_SESSION['user_id'] = $gur['id'];

        header("Location: http://pungi.org/");
        exit();
} else if ($c == 0) {
    echo "Registracija";
    $username = str_replace(' ','',$google_name);
    $fiuser = mysqli_real_escape_string($conn,$username);
    $mail = mysqli_real_escape_string($conn,$google_email);
    $password = password_hash($mail,PASSWORD_DEFAULT);

    $uiq = uniqid().".png";
    $img = '/var/www/youtube/src/resources/slike/'.$uiq; 
  
    // Function to write image into file 
    file_put_contents($img, file_get_contents($google_picture));
    $sli = "INSERT INTO slike (pot) VALUES ('$uiq')";
    $sqr = mysqli_query($conn,$sli);
    $slc = "SELECT * FROM slike WHERE pot = '$uiq'";
    $sqc = mysqli_query($conn,$slc);
    $rqc = mysqli_fetch_array($sqc,MYSQLI_ASSOC);

    $sid = $rqc['id'];

    $rt = "INSERT INTO uporabniki (username, email, geslo, slika_id, google) VALUES ('$fiuser','$mail','$password','$sid',1)";
    if(mysqli_query($conn,$rt)){
        $gus = "SELECT * FROM uporabniki WHERE email = '$mail'";
        $guid = mysqli_query($conn,$gus);
        $gur = mysqli_fetch_array($guid,MYSQLI_ASSOC);

        $_SESSION['user_id'] = $gur['id'];

        header("Location: http://pungi.org/");
        exit();
    }

}

?>