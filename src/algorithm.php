<?php 
    require_once 'db.php';
    session_start();

    $data = array();
    $sql = "SELECT id FROM vsebina WHERE aktivno = 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row['id'];
        }
    }

    $thumdir = 'resources'. DIRECTORY_SEPARATOR .'thumnails'. DIRECTORY_SEPARATOR;
    $gifdir = 'resources'. DIRECTORY_SEPARATOR .'pre'. DIRECTORY_SEPARATOR;

    $total = count($data);

    $num = 0;
    $mun = mysqli_num_rows($result);
    while ($num < $mun) {
        $random = array_rand($data);
        $randomPost = $data[$random];
        unset($data[$random]);
        $total = count($data);

        $sqlt = "SELECT id,username,slika_id FROM uporabniki WHERE id = (SELECT uporabnik_id FROM vsebina WHERE id = '$randomPost');";
        $ka = mysqli_query($conn,$sqlt);
        $ti = mysqli_fetch_array($ka,MYSQLI_ASSOC);

        $sqli = "SELECT * FROM vsebina WHERE id = '$randomPost';";
        $ak = mysqli_query($conn,$sqli);
        $it = mysqli_fetch_array($ak,MYSQLI_ASSOC);

        $pfp = $ti['slika_id'];
        $sqls = "SELECT pot FROM slike WHERE id = '$pfp';";
        $aks = mysqli_query($conn,$sqls);
        $tit = mysqli_fetch_array($aks);

        ?>
            <a href="<?php echo $it['url']; ?>" class="group">
            <div class="w-full h-crip cursor-pointer relative text-white group-hover:">
                <img class="w-full h-full rounded-meh group-hover:hidden" src="<?php echo $thumdir.$it['thumnail']; ?>" />
                <img class="hidden w-full h-full rounded-meh group-hover:flex" src="<?php echo $gifdir.$it['gif']; ?>" />
                <div class="flex w-full px-half py-12 absolute bottom-0 rounded-b-meh bg-thumdiv backdrop-blur-xs">
                    <img class="w-13 h-13 justify-center items-center flex-shrink-0 rounded-full bg-black shadow-default" src="resources/slike/<?php echo $tit['pot']; ?>">
                    <div class="flex flex-col items-start gap-y-se pl-4">
                        <p><?php echo htmlspecialchars($it['naslov']); ?></p>
                        <div class="flex items-center gap-11">
                            <p><?php echo htmlspecialchars($ti['username']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <?php
        $num++;
    }
?>