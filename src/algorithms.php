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

    $total = count($data);

    $num = 1;
    while ($num < 6) {
        $random = array_rand($data);
        $randomPost = $data[$random];
        unset($data[$random]);
        $total = count($data);

        $sqlt = "SELECT id,username FROM uporabniki WHERE id = (SELECT uporabnik_id FROM vsebina WHERE id = '$randomPost');";
        $ka = mysqli_query($conn,$sqlt);
        $ti = mysqli_fetch_array($ka,MYSQLI_ASSOC);

        $sqli = "SELECT * FROM vsebina WHERE id = '$randomPost';";
        $ak = mysqli_query($conn,$sqli);
        $it = mysqli_fetch_array($ak,MYSQLI_ASSOC);

        ?>

            <a href="<?php echo $it['url']; ?>"><div class="flex h-[123px] py-6 items-center gap-6">
            <p><?php echo $num; ?></p>
            <div class="flex w-[172px] items-center justify-center relative">
              <div class="absolute">
                <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M26.25 15.5C26.25 21.7132 21.2132 26.75 15 26.75C8.7868 26.75 3.75 21.7132 3.75 15.5C3.75 9.2868 8.7868 4.25 15 4.25C21.2132 4.25 26.25 9.2868 26.25 15.5Z" stroke="#E4E4E7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19.8874 15.0902C20.2089 15.2688 20.2089 15.7312 19.8874 15.9098L12.8839 19.8006C12.5715 19.9742 12.1875 19.7483 12.1875 19.3909V11.6091C12.1875 11.2517 12.5715 11.0258 12.8839 11.1994L19.8874 15.0902Z" stroke="#E4E4E7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
              <img src="resources/thumnails/<?php echo $it['thumnail']; ?>" class="rounded-meh">
            </div>
            <div class="flex text-lg">
              <p><?php echo htmlspecialchars($it['naslov']);?></p>
            </div>
          </div></a>

        <?php
        $num++;
    }
?>