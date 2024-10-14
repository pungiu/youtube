<?php
    require_once 'db.php';
    session_start();
    session_regenerate_id();

    $safedir = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "test1";

        $errors= array();

            if (!empty($_FILES)) {
                $file_tmp = $_FILES['file']['tmp_name'];
                $file_name = $_FILES['file']['name'];
                $file_size = $_FILES['file']['size'];
                $file_type = $_FILES['file']['type'];
                $file_ext = strtolower(end(explode('.',$_FILES['file']['name'])));

                if (is_uploaded_file($file_tmp)) {
                    $mime_type = mime_content_type($_FILES['file']['tmp_name']);
                    $dovoljeni_mime_tipi = ['video/mp4', 'video/x-msvideo', 'video/webm','video/avi','video/x-matroska','video/quicktime'];
                    $extensions = ["mov","mp4","mkv","webm","avi"];

                    if (! in_array($mime_type, $dovoljeni_mime_tipi)) {
                        array_push($errors,"Tip datoteke ni dovoljen");
                    } else if (! in_array($file_ext,$extensions)) {
                        array_push($errors,"Tip datoteke ni dovoljen ampak mime je [!]");
                    } else {
                        
                        if (isset($_SESSION['user_id'])) {
                            $uid = $_SESSION['user_id'];
                        
                            $sql = "SELECT * FROM uporabniki WHERE id = '$uid';";
                            $quer = mysqli_query($conn,$sql);
                            $userrow = mysqli_fetch_array($quer,MYSQLI_ASSOC);
                            $cou = mysqli_num_rows($quer);

                            if ($cou == 1) {
                                $url = generateRandomString();

                                $sql = "SELECT * FROM vsebina WHERE pot = '$url';";
                                $rezu = mysqli_query($conn,$sql);
                                $preveridobavljivost = mysqli_num_rows($rezu);

                                while($preveridobavljivost >= 1){
                                    $url = generateRandomString();
                                }
                                    
                                $filefinalname = $userrow['username'].$url;
                                $filefullname = $filefinalname.'.'. $file_ext;
                                $finaldest = $safedir.'load'. DIRECTORY_SEPARATOR .$filefullname;

                                if(move_uploaded_file($file_tmp,$finaldest)) {
                                    $skup = uniqid();
                                    $thuname = $skup .'.png';

                                    echo shell_exec('ffmpeg -ss 1 -i '.$finaldest.' -frames 1 '.$safedir.'thumnails/'.$thuname);
                                    
                                    $gifname = $skup . '.gif';
                                    $gif = $safedir.'pre/'. $gifname;
                                    echo shell_exec('ffmpeg -i '.$finaldest.' -filter_complex "fps=6, scale=-1:360" '. $gif);


                                    $sqlvsebina = "INSERT INTO vsebina (uporabnik_id, url, pot, thumnail, gif) VALUES ('$uid','$url','$filefullname','$thuname','$gifname');";

                                    if(mysqli_query($conn,$sqlvsebina)){
                                        $vsql = "SELECT * FROM vsebina WHERE url = '$url'";
                                        $vquery = mysqli_query($conn,$vsql);
                                        $vrow = mysqli_fetch_array($vquery,MYSQLI_ASSOC);
                                        if(isset($_SESSION['video_id'])) {
                                            unset($_SESSION['video_id']);
                                        }
                                        $_SESSION['video_id'] =  $vrow['id'];
                                        header("Location: upload");
                                        exit();
                                    } else {
                                        array_push($errors,"Napaka pri zapisovanju v tabelo");
                                        hubReturn();
                                    }
                                } else {
                                    array_push($errors,"Datoteke ni bilo mogoce naloziti");
                                    hubReturn();
                                }

                            }
                        } else {
                            array_push($errors,"Niste prijavljeni");
                            hubReturn();
                        }

                    }

                } else {
                    hubReturn();
                }
            }
    } else {
        hubReturn();
    }

    function hubReturn() {
        $_SESSION['err'] = $errors;

        header("Location: http://pungi.org/");
        exit();
    }

    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
?>