<?php 
    require_once 'db.php';
    session_start();

    if (empty($_SESSION['user_id'])) {
        header("Location: http://pungi.org/");
        exit();
    }

    $uid = $_SESSION['user_id'];

    $thumdir = 'resources'. DIRECTORY_SEPARATOR .'thumnails'. DIRECTORY_SEPARATOR;

    $sql = "SELECT * FROM sub WHERE uporabnik_id = '$uid'";
    $querry = mysqli_query($conn,$sql);

    if (mysqli_num_rows($querry) > 0){
        while ($row = mysqli_fetch_array($querry,MYSQLI_ASSOC)) {

            $suid = $row['narocnina'];
            $subsql = "SELECT * FROM vsebina WHERE uporabnik_id = '$suid' AND aktivno = '1'";
            $subquer = mysqli_query($conn,$subsql);

            

            while ($roww = mysqli_fetch_array($subquer,MYSQLI_ASSOC)) {
                $upouid = $roww['uporabnik_id'];
                $usql = "SELECT * FROM uporabniki WHERE id = '$upouid'";
                $usres = mysqli_query($conn,$usql);
                $usret = mysqli_fetch_array($usres,MYSQLI_ASSOC);

                $sid = $usret['slika_id'];
                $slisql = "SELECT * FROM slike WHERE id ='$sid'";
                $slique = mysqli_query($conn,$slisql);
                $sliret = mysqli_fetch_array($slique,MYSQLI_ASSOC);

                ?>
                <a href="<?php echo $roww['url']; ?>" class="">
                <div class="w-full h-crip cursor-pointer relative text-white">
                <img class="w-full h-full rounded-meh" src="<?php echo $thumdir.$roww['thumnail']; ?>" />
                <div class="flex w-full px-half py-12 absolute bottom-0 rounded-b-meh bg-thumdiv backdrop-blur-xs">
                    <img class="flex w-13 h-13 justify-center items-center flex-shrink-0 rounded-full bg-black shadow-default" src="resources/slike/<?php echo $sliret['pot']; ?>">
                    <div class="flex flex-col items-start gap-y-se pl-4">
                        <p><?php echo htmlspecialchars($roww['naslov']); ?></p>
                        <div class="flex items-center gap-11">
                            <p><?php echo htmlspecialchars($usret['username']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
                </a>
                <?php
            }
        }
    }
?>