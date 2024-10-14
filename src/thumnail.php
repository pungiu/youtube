<?php 
    require_once 'db.php';
    session_start();
    session_regenerate_id();

    $safedir = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();
        if (!empty($_FILES)) {
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['file']['name'])));

            if (is_uploaded_file($file_tmp)) {
                $mime_type = mime_content_type($_FILES['file']['tmp_name']);
                $dovoljeni_mime_tipi = ['image/png', 'image/jpeg'];
                $extensions = ["png","jpeg"];

                if (! in_array($mime_type, $dovoljeni_mime_tipi)) {
                    array_push($errors,"Tip datoteke ni dovoljen");
                    header("Location: upload");
                    exit();
                } else if (! in_array($file_ext,$extensions)) {
                    array_push($errors,"Tip datoteke ni dovoljen ampak mime je [!]");
                    header("Location: upload");
                    exit();
                } else {
                    $finalname = uniqid().'.'.$file_ext;
                    $finaldir = $safedir.'thumnails'.DIRECTORY_SEPARATOR. $finalname;
                    if(move_uploaded_file($file_tmp,$finaldir)) {
                        $vid = $_SESSION['video_id'];
                        $sql = "UPDATE vsebina SET thumnail = '$finalname' WHERE id = '$vid';";
                        if(mysqli_query($conn,$sql)) {
                            header("Location: upload");
                            exit();
                        }
                    }
                }
            }
    }
}
?>