<?php
    require_once 'db.php';
    session_start();

    if (isset($_SESSION['user_id'])) {
        $uid = $_SESSION['user_id'];

        $likesql = "SELECT * FROM vsecki WHERE uporabnik_id = '$uid'";
        $likequerry = mysqli_query($conn, $likesql);

        $thumdir = 'resources'. DIRECTORY_SEPARATOR .'thumnails'. DIRECTORY_SEPARATOR;
        
        if (mysqli_num_rows($likequerry) > 0) {
            while ($row = mysqli_fetch_array($likequerry,MYSQLI_ASSOC)) {

                $vid = $row['video_id'];
                $sql = "SELECT * FROM vsebina WHERE id = '$vid'";
                $result = mysqli_query($conn,$sql);
                $quer = mysqli_fetch_array($result,MYSQLI_ASSOC);

                $uuid = $quer['uporabnik_id'];
                $usql = "SELECT * FROM uporabniki WHERE id = '$uuid'";
                $uresu = mysqli_query($conn,$usql);
                $u = mysqli_fetch_array($uresu,MYSQLI_ASSOC);

                $slikid = $u['slika_id'];
                $sliql = "SELECT * FROM slike WHERE id = '$slikid'";
                $slire = mysqli_query($conn,$sliql);
                $s = mysqli_fetch_array($slire,MYSQLI_ASSOC);

                
                ?>
                <a href="<?php echo $quer['url']; ?>">
                <div class="w-full h-crip cursor-pointer relative text-white">
                    <img class="w-full h-full rounded-meh" src="<?php echo $thumdir.$quer['thumnail']; ?>" />
                    <div class="flex w-full px-half py-12 absolute bottom-0 rounded-b-meh bg-thumdiv backdrop-blur-xs">
                        <img class="flex w-13 h-13 justify-center items-center flex-shrink-0 rounded-full bg-black shadow-default" src="resources/slike/<?php echo $s['pot']; ?>">
                        <div class="flex flex-col items-start gap-y-se pl-4">
                            <p><?php echo htmlspecialchars($quer['naslov']); ?></p>
                            <div class="flex items-center gap-11">
                                <p><?php echo htmlspecialchars($u['username']); ?></p>
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