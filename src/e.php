<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
</head>
<?php
    require_once 'db.php';
    session_start();

    $usr = $_GET['u'];

    $sql = "SELECT * FROM uporabniki WHERE username = '$usr'";
    $query = mysqli_query($conn,$sql);
    $results = mysqli_fetch_array($query, MYSQLI_ASSOC);

    $sid = $results['slika_id'];
    $ssql = "SELECT * FROM slike WHERE id = '$sid'";
    $squery = mysqli_query($conn,$ssql);
    $sresults = mysqli_fetch_array($squery, MYSQLI_ASSOC);


?>
<body class="bg-darkMode">
    <div class="w-screen h-screen p-4 flex flex-col gap-4">
    <div class="p-2 nor:hidden">
            <?php
                include 'back.html';
            ?>
        </div>
        <div class="flex flex-col items-center gap-2">
            <img class="h-thum w-thum rounded-sharp" src="resources/slike/<?php echo $sresults['pot']; ?>">
            <div class="bg-white w-2/3 h-13 rounded-sharp">
                <?php echo $results['username']; ?>
            </div>
        </div>
        <div class="overflow-y-scroll px-4 nor:grid nor:grid-cols-4 gap-2 flex flex-col">
            <?php
                $data = array();

                $dd = $results['id'];
                $sql = "SELECT id FROM vsebina WHERE uporabnik_id = '$dd'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $data[] = $row['id'];
                    }
                }

                $thumdir = 'resources'. DIRECTORY_SEPARATOR .'thumnails'. DIRECTORY_SEPARATOR;

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


        ?>
            
            <div class="w-full h-crip cursor-pointer relative text-white">
            <a href="<?php echo $it['url']; ?>" class="bg-testr"><img class="w-full h-full rounded-meh" src="<?php echo $thumdir.$it['thumnail']; ?>" /></a>
                <div class="flex w-full px-half py-12 absolute bottom-0 rounded-b-meh bg-thumdiv backdrop-blur-xs items-center gap-4">
                <?php
                    $ii = $_SESSION['user_id'];
                    if ($results['id'] === $ii) {
                        ?>
                        <a href="izbris?v=<?php echo $it['id']; ?>">
                            <div class="bg-red rounded-sharp flex flex-row p-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 21C6.45 21 5.97917 20.8042 5.5875 20.4125C5.19583 20.0208 5 19.55 5 19V6H4V4H9V3H15V4H20V6H19V19C19 19.55 18.8042 20.0208 18.4125 20.4125C18.0208 20.8042 17.55 21 17 21H7ZM17 6H7V19H17V6ZM9 17H11V8H9V17ZM13 17H15V8H13V17Z" fill="#E8EAED"/>
                                </svg>
                                <p>Izbrisi</p>
                            </div>
                        </a>
                        <a href="vitaj?g=<?php echo $it['id']; ?>">
                            <div class="bg-gray rounded-sharp p-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 19H6.425L16.2 9.225L14.775 7.8L5 17.575V19ZM3 21V16.75L16.2 3.575C16.4 3.39167 16.6208 3.25 16.8625 3.15C17.1042 3.05 17.3583 3 17.625 3C17.8917 3 18.15 3.05 18.4 3.15C18.65 3.25 18.8667 3.4 19.05 3.6L20.425 5C20.625 5.18333 20.7708 5.4 20.8625 5.65C20.9542 5.9 21 6.15 21 6.4C21 6.66667 20.9542 6.92083 20.8625 7.1625C20.7708 7.40417 20.625 7.625 20.425 7.825L7.25 21H3ZM15.475 8.525L14.775 7.8L16.2 9.225L15.475 8.525Z" fill="#E8EAED"/>
                                </svg>
                            </div>
                        </a>
                        <?php
                    }
                ?>
                    <!-- <img class="flex w-13 h-13 justify-center items-center flex-shrink-0 rounded-full bg-black shadow-default" src="resources/slike/<?php echo $tit['pot']; ?>"> -->
                    <p><?php echo htmlspecialchars($it['naslov']); ?></p>
                </div>
            </div>


        <?php
        $num++;
    }
            ?>
        </div>
    </div>
</body>
</html>