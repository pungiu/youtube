<?php
    require_once 'db.php';
    session_start();

    $safedir = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;

    if (empty($_SESSION['user_id'])) {
        header("Location: http://pungi.org/");
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();
        if (!empty($_FILES)) {
            $file_tmp = $_FILES['upfp']['tmp_name'];
            $file_name = $_FILES['upfp']['name'];
            $file_size = $_FILES['upfp']['size'];
            $file_type = $_FILES['upfp']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['upfp']['name'])));


            if (is_uploaded_file($file_tmp)) {
                $mime_type = mime_content_type($_FILES['upfp']['tmp_name']);
                $dovoljeni_mime_tipi = ['image/png', 'image/jpeg'];
                $extensions = ["png","jpeg"];

                if (! in_array($mime_type, $dovoljeni_mime_tipi)) {
                    array_push($errors,"Tip datoteke ni dovoljen");
                    header("Location: u");
                    exit();
                } else if (! in_array($file_ext,$extensions)) {
                    array_push($errors,"Tip datoteke ni dovoljen ampak mime je [!]");
                    header("Location: u");
                    exit();
                } else {
                    $finalname = uniqid().'.'.$file_ext;
                    $finaldir = $safedir.'slike'.DIRECTORY_SEPARATOR. $finalname;
                    echo $finaldir;
                    if(move_uploaded_file($file_tmp,$finaldir)) {
                        $sl = "INSERT INTO slike (pot) VALUES ('$finalname')";
                        if (mysqli_query($conn,$sl)) {
                            $csl = "SELECT * FROM slike WHERE pot = '$finalname'";
                            $zts = mysqli_query($conn,$csl);
                            $csl = mysqli_fetch_array($zts,MYSQLI_ASSOC);
                        
                            $ty = $csl['id'];
                            $uid = $_SESSION['user_id'];
                            $sql = "UPDATE uporabniki SET slika_id = '$ty' WHERE id = '$uid';";
                            if(mysqli_query($conn,$sql)) {
                                header("Location: http://pungi.org/u");
                                exit();
                            }
                        }
                    }
                }
            }

            print_r($errors);
    }
}
?>