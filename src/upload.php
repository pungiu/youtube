<?php
  require_once 'db.php';
  session_start();

  if (isset($_SESSION['user_id']) && isset($_SESSION['video_id'])) {

    $vid = $_SESSION['video_id'];
    $sql = "SELECT * FROM vsebina WHERE id = '$vid';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $thumdir = 'resources'. DIRECTORY_SEPARATOR .'thumnails'. DIRECTORY_SEPARATOR;

    $uid = $_SESSION['user_id'];
    $sqlu = "SELECT * FROM uporabniki WHERE id = '$uid'";
    $resultsu = mysqli_query($conn,$sqlu);
    $rowu = mysqli_fetch_array($resultsu,MYSQLI_ASSOC);

    $sqlikaid = $rowu['slika_id'];
    $ssql = "SELECT * FROM slike WHERE id = '$sqlikaid'";
    $sresult = mysqli_query($conn,$ssql);
    $srow = mysqli_fetch_array($sresult,MYSQLI_ASSOC);

    $k = $row['id'];
    ?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <script defer src="scripts/change.js" type="text/javascript"></script>
</head>
<body class="bg-darkMode text-white">
  <div class="hidden nor:flex nor:w-screen nor:h-screen nor:flex-row">
    <div class="nor:w-bar nor:flex nor:flex-col nor:p-2 nor:gap-6">
    <a href="http://pungi.org/"><div class="nor:flex nor:flex-row nor: items-center nor:gap-3 nor:text-2xl nor:text-white">
      <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M25.5557 11.6853C23.9112 10.5865 21.9778 10 20 10V0C23.9556 0 27.8224 1.17298 31.1114 3.37061C34.4004 5.56823 36.9638 8.69181 38.4776 12.3463C39.9913 16.0008 40.3874 20.0222 39.6157 23.9018C38.844 27.7814 36.9392 31.3451 34.1421 34.1421C31.3451 36.9392 27.7814 38.844 23.9018 39.6157C20.0222 40.3874 16.0008 39.9913 12.3463 38.4776C8.6918 36.9638 5.56823 34.4004 3.37061 31.1114C1.17298 27.8224 0 23.9556 0 20H10C10 21.9778 10.5865 23.9112 11.6853 25.5557C12.7841 27.2002 14.3459 28.4819 16.1732 29.2388C18.0004 29.9957 20.0111 30.1937 21.9509 29.8078C23.8907 29.422 25.6725 28.4696 27.0711 27.0711C28.4696 25.6725 29.422 23.8907 29.8078 21.9509C30.1937 20.0111 29.9957 18.0004 29.2388 16.1732C28.4819 14.3459 27.2002 12.7841 25.5557 11.6853Z" fill="#E50000"/>
      <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1364 5.28493e-06C10.1364 1.31322 9.87418 2.61358 9.36478 3.82684C8.85537 5.04009 8.10874 6.14248 7.16749 7.07107C6.22625 7.99966 5.10882 8.73625 3.87902 9.2388C2.64921 9.74134 1.33112 10 4.43071e-07 10L0 20C2.66225 20 5.29843 19.4827 7.75804 18.4776C10.2177 17.4725 12.4525 15.9993 14.3349 14.1421C16.2175 12.285 17.7108 10.0802 18.7296 7.65367C19.7484 5.22715 20.2727 2.62643 20.2727 0L10.1364 5.28493e-06Z" fill="#E50000"/>
      </svg>
      <p>pungi.org</p>
    </div></a>

    <a href="nastavitve"><div class="flex w-full h-13 p-12 flex-row gap-12 flex-shrink-0 bg-thumdiv rounded-meh cursor-pointer">
        <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14 9.75C12.9616 9.75 11.9466 10.0579 11.0832 10.6348C10.2199 11.2117 9.54698 12.0316 9.14962 12.9909C8.75226 13.9502 8.64829 15.0058 8.85087 16.0242C9.05344 17.0426 9.55345 17.9781 10.2877 18.7123C11.0219 19.4465 11.9574 19.9465 12.9758 20.1491C13.9942 20.3517 15.0498 20.2477 16.0091 19.8504C16.9684 19.453 17.7883 18.7801 18.3652 17.9167C18.9421 17.0534 19.25 16.0383 19.25 15C19.2485 13.6081 18.695 12.2735 17.7107 11.2893C16.7264 10.305 15.3919 9.75144 14 9.75ZM14 18.5C13.3078 18.5 12.6311 18.2947 12.0555 17.9101C11.4799 17.5256 11.0313 16.9789 10.7664 16.3394C10.5015 15.6998 10.4322 14.9961 10.5672 14.3172C10.7023 13.6382 11.0356 13.0146 11.5251 12.5251C12.0146 12.0356 12.6382 11.7023 13.3172 11.5672C13.9961 11.4322 14.6998 11.5015 15.3394 11.7664C15.9789 12.0313 16.5255 12.4799 16.9101 13.0555C17.2947 13.6311 17.5 14.3078 17.5 15C17.5 15.9283 17.1312 16.8185 16.4749 17.4749C15.8185 18.1312 14.9282 18.5 14 18.5ZM23.625 15.2362C23.6294 15.0787 23.6294 14.9212 23.625 14.7637L25.2569 12.725C25.3424 12.618 25.4017 12.4923 25.4298 12.3582C25.4579 12.2241 25.4541 12.0852 25.4187 11.9528C25.1512 10.9472 24.751 9.98171 24.2287 9.08172C24.1604 8.96394 24.0654 8.86375 23.9515 8.78913C23.8376 8.7145 23.7078 8.6675 23.5725 8.65187L20.9781 8.36312C20.8702 8.24937 20.7608 8.14 20.65 8.035L20.3437 5.43406C20.328 5.29867 20.2808 5.16883 20.206 5.05489C20.1312 4.94095 20.0308 4.84607 19.9128 4.77781C19.0125 4.25647 18.047 3.85669 17.0417 3.5889C16.9092 3.55368 16.7703 3.55008 16.6362 3.57839C16.5021 3.60669 16.3765 3.66612 16.2695 3.75187L14.2362 5.375C14.0787 5.375 13.9212 5.375 13.7637 5.375L11.725 3.7464C11.6179 3.66084 11.4923 3.60161 11.3582 3.57349C11.2241 3.54538 11.0852 3.54916 10.9528 3.58453C9.94737 3.85253 8.98192 4.25268 8.08171 4.77453C7.96393 4.84292 7.86374 4.93785 7.78912 5.05178C7.7145 5.16571 7.6675 5.29549 7.65186 5.43078L7.36311 8.02953C7.24936 8.13817 7.13999 8.24755 7.03499 8.35765L4.43405 8.65625C4.29866 8.672 4.16882 8.71916 4.05488 8.79398C3.94094 8.8688 3.84606 8.9692 3.7778 9.08718C3.25646 9.98752 2.85668 10.9529 2.5889 11.9583C2.55367 12.0908 2.55007 12.2297 2.57838 12.3638C2.60669 12.4979 2.66611 12.6235 2.75186 12.7305L4.37499 14.7637C4.37499 14.9212 4.37499 15.0787 4.37499 15.2362L2.7464 17.275C2.66083 17.382 2.6016 17.5077 2.57349 17.6418C2.54537 17.7759 2.54915 17.9148 2.58452 18.0472C2.85204 19.0528 3.25222 20.0183 3.77452 20.9183C3.84291 21.0361 3.93784 21.1362 4.05177 21.2109C4.1657 21.2855 4.29548 21.3325 4.43077 21.3481L7.02515 21.6369C7.13379 21.7506 7.24317 21.86 7.35327 21.965L7.65624 24.5659C7.67199 24.7013 7.71916 24.8312 7.79397 24.9451C7.86879 25.059 7.9692 25.1539 8.08718 25.2222C8.98751 25.7435 9.95294 26.1433 10.9583 26.4111C11.0908 26.4463 11.2297 26.4499 11.3638 26.4216C11.4979 26.3933 11.6235 26.3339 11.7305 26.2481L13.7637 24.625C13.9212 24.6294 14.0787 24.6294 14.2362 24.625L16.275 26.2569C16.382 26.3424 16.5077 26.4017 16.6418 26.4298C16.7759 26.4579 16.9148 26.4541 17.0472 26.4187C18.0528 26.1512 19.0183 25.751 19.9183 25.2287C20.036 25.1604 20.1362 25.0654 20.2109 24.9515C20.2855 24.8376 20.3325 24.7078 20.3481 24.5725L20.6369 21.9781C20.7506 21.8702 20.86 21.7608 20.965 21.65L23.5659 21.3437C23.7013 21.328 23.8312 21.2808 23.9451 21.206C24.059 21.1312 24.1539 21.0308 24.2222 20.9128C24.7435 20.0125 25.1433 19.047 25.4111 18.0417C25.4463 17.9092 25.4499 17.7703 25.4216 17.6362C25.3933 17.5021 25.3339 17.3765 25.2481 17.2695L23.625 15.2362ZM21.8641 14.5253C21.8826 14.8415 21.8826 15.1585 21.8641 15.4747C21.851 15.6912 21.9188 15.9048 22.0544 16.0741L23.6064 18.0133C23.4283 18.5793 23.2003 19.1283 22.925 19.6539L20.4531 19.9339C20.2378 19.9578 20.0391 20.0607 19.8953 20.2227C19.6848 20.4594 19.4605 20.6837 19.2237 20.8942C19.0618 21.038 18.9589 21.2368 18.935 21.452L18.6605 23.9217C18.1349 24.1971 17.5859 24.4252 17.0198 24.6031L15.0795 23.0511C14.9243 22.927 14.7314 22.8595 14.5326 22.8597H14.4801C14.164 22.8783 13.847 22.8783 13.5308 22.8597C13.3143 22.8467 13.1007 22.9145 12.9314 23.05L10.9867 24.6031C10.4207 24.425 9.87169 24.197 9.34608 23.9217L9.06608 21.4531C9.04219 21.2379 8.9393 21.0391 8.77733 20.8953C8.54055 20.6848 8.31631 20.4605 8.10577 20.2237C7.96198 20.0618 7.76322 19.9589 7.54796 19.935L5.07827 19.6594C4.80286 19.1338 4.57482 18.5848 4.39686 18.0187L5.94889 16.0784C6.08442 15.9091 6.15224 15.6955 6.13921 15.4791C6.12061 15.1629 6.12061 14.8459 6.13921 14.5297C6.15224 14.3132 6.08442 14.0996 5.94889 13.9303L4.39686 11.9867C4.57495 11.4207 4.80299 10.8717 5.07827 10.3461L7.54686 10.0661C7.76213 10.0422 7.96088 9.93931 8.10468 9.77734C8.31521 9.54055 8.53945 9.31631 8.77624 9.10578C8.93885 8.96189 9.04216 8.76268 9.06608 8.54687L9.34061 6.07828C9.86616 5.80286 10.4152 5.57483 10.9812 5.39687L12.9216 6.9489C13.0909 7.08442 13.3045 7.15225 13.5209 7.13922C13.8371 7.12062 14.1541 7.12062 14.4703 7.13922C14.6868 7.15225 14.9004 7.08442 15.0697 6.9489L17.0133 5.39687C17.5793 5.57496 18.1283 5.80299 18.6539 6.07828L18.9339 8.54687C18.9578 8.76214 19.0607 8.96089 19.2226 9.10468C19.4594 9.31522 19.6837 9.53946 19.8942 9.77625C20.038 9.93822 20.2368 10.0411 20.452 10.065L22.9217 10.3395C23.1971 10.8651 23.4252 11.4141 23.6031 11.9802L22.0511 13.9205C21.9143 14.0912 21.8464 14.307 21.8608 14.5253H21.8641Z" fill="#AFAFAF"/>
        </svg>
        <p>Nastavitve</p>
    </div></a>

    </div>
    <div class="w-full flex flex-row">
        <div class="w-full p-3 flex flex-col gap-2">
          <div class="h-full flex flex-row">
            <div class="w-full flex flex-col">
              <div class="bg-darkMode h-full">
                <img src="resources/thumnails/<?php echo $row['thumnail']; ?>" class="flex rounded-sharp aspect-w-9 h-full">
              </div>
              <div class="h-1/3 p-4">
                <form action="title" method="post" enctype="multipart/form-data" id="tle" class="w-full">
                  <input id="ter" name="vsebina" placeholder="Spremeni naslov videoposnetka" class="flex w-full h-13 p-5 flex-col justify-center items-start bg-thumdiv rounded-meh text-lg " type="text" value="<?php echo $row['naslov']; ?>"></input>
                </form>
              </div>
            </div>
            <div class="bg-blured w-1/3 p-2 rounded-sharp">

              
              <div class="p-1">
                <?php
                  $vsql = "SELECT * FROM vsecki WHERE video_id = '$k'";
                  $kq = mysqli_query($conn,$vsql);
                  $vnum = mysqli_num_rows($kq);
                ?>
                <p>st vseckov</p>
                <p><?php echo $vnum; ?></p>
              </div>
              <div class="p-1">
                <?php
                  $ksql = "SELECT * FROM komentarji WHERE video_id = '$k'";
                  $kq = mysqli_query($conn,$ksql);
                  $knum = mysqli_num_rows($kq);
                ?>
                <p>Št. komentarjev</p>
                <p><?php echo $knum; ?></p>
              </div>
              <div class="p-1">
                <p>status</p>
                <?php
                  $status = $row['aktivno'];

                  if ($status == 0) {
                    echo "ni objavljeno";
                  } else if ($status == 1) {
                    echo "Objavljeno";
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="h-full flex flex-row gap-3">
            <div class="w-full bg-blured rounded-sharp flex flex-col items-center">
              <p>PREDOGLED</p>
              <div class="w-2/3 h-crip relative text-white">
                <img class="w-full h-full rounded-meh" src="<?php echo $thumdir.$row['thumnail']; ?>" />
                <div class="flex w-full px-half py-12 absolute bottom-0 rounded-b-meh bg-thumdiv backdrop-blur-xs">
                    <img class="flex w-13 h-13 justify-center items-center flex-shrink-0 rounded-full bg-black shadow-default" src="resources/slike/<?php echo $srow['pot']; ?>">
                    <div class="flex flex-col items-start gap-y-se pl-4">
                        <p><?php echo htmlspecialchars($row['naslov']); ?></p>
                        <div class="flex items-center gap-11">
                            <p><?php echo htmlspecialchars($row['username']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="w-full bg-blured rounded-sharp flex flex-col items-center p-4 gap-1">
              <p>KOMENTARJI</p>
              
              <?php
                $idv = $row['id'];
                $sqlk = "SELECT * FROM komentarji WHERE video_id = '$idv'";
                $result = $conn->query($sqlk);

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    //echo $row["vsebina"] . "<br>";

                    $vuid = $row['uporabnik_id'];
                    $sqlu = "SELECT * FROM uporabniki WHERE id = '$vuid'";
                    $g = mysqli_query($conn,$sqlu);
                    $d = mysqli_fetch_array($g,MYSQLI_ASSOC);


                    ?>  
                      <div class="flex flex-row w-full items-center gap-2 p-1 hover:bg-blured">
                        <a class="text-xs" href="e?u=<?php echo htmlspecialchars($d['username']);  ?>"><?php echo htmlspecialchars($d['username']); ?></a>
                        <p>&#x2192;</p>
                        <p><?php echo htmlspecialchars($row['vsebina']); ?></p>
                      </div>
                    <?php

                  }
                } else {
                  echo "Ni kommentarjev";
                }
                ?>

            </div>
          </div>
        </div>
        <div class="w-1/3 flex flex-col p-2 gap-2">
          <div class="rounded-sharp h-full">
          <form action="opis" method="post" enctype="multipart/form-data" id="opis" class="w-full h-full">
            <textarea id="area" placeholder="Opis" class="flex w-full h-full bg-thumdiv rounded-meh resize-none" name="vsebina"><?php echo $row['opis']; ?></textarea>
          </form>
          </div>
          <div class="flex w-full h-13 p-12 flex-row items-start align-middle gap-12 rounded-meh bg-green cursor-pointer" onclick="potrdiObjavo()">
            <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12.04 21.44L21.91 11.57L19.95 9.61L12.04 17.52L8.05 13.53L6.09 15.49L12.04 21.44ZM14 29C12.0633 29 10.2433 28.6325 8.54 27.8975C6.83667 27.1625 5.355 26.165 4.095 24.905C2.835 23.645 1.8375 22.1633 1.1025 20.46C0.3675 18.7567 0 16.9367 0 15C0 13.0633 0.3675 11.2433 1.1025 9.54C1.8375 7.83667 2.835 6.355 4.095 5.095C5.355 3.835 6.83667 2.8375 8.54 2.1025C10.2433 1.3675 12.0633 1 14 1C15.9367 1 17.7567 1.3675 19.46 2.1025C21.1633 2.8375 22.645 3.835 23.905 5.095C25.165 6.355 26.1625 7.83667 26.8975 9.54C27.6325 11.2433 28 13.0633 28 15C28 16.9367 27.6325 18.7567 26.8975 20.46C26.1625 22.1633 25.165 23.645 23.905 24.905C22.645 26.165 21.1633 27.1625 19.46 27.8975C17.7567 28.6325 15.9367 29 14 29ZM14 26.2C17.1267 26.2 19.775 25.115 21.945 22.945C24.115 20.775 25.2 18.1267 25.2 15C25.2 11.8733 24.115 9.225 21.945 7.055C19.775 4.885 17.1267 3.8 14 3.8C10.8733 3.8 8.225 4.885 6.055 7.055C3.885 9.225 2.8 11.8733 2.8 15C2.8 18.1267 3.885 20.775 6.055 22.945C8.225 25.115 10.8733 26.2 14 26.2Z" fill="white"/>
            </svg>
            <p>Potrdi objavo</p>
          </div>
        </div>
    </div>
  </div>
    <div class="p-4 h-screen gap-2 flex flex-col nor:hidden">
        <div class="flex flex-col items-center h-1/4 gap-1">
          <img src="resources/thumnails/<?php echo $row['thumnail']; ?>" class="flex h-full rounded-sharp aspect-w-9">
          <form action="thumnail" method="post" enctype="multipart/form-data" id="thum" class="w-full">
            <input type="file" name="file" id="thufile" class="hidden">
          <label for="thufile"><div class="flex w-full h-13 p-12 flex-col gap-12 bg-red rounded-meh">
            <div class="flex items-center gap-11 self-stretch">
              <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.9446 28.6667V13.8333L7.16667 18.6113L5.19458 16.6113L13.3333 8.47208L21.4721 16.6113L19.5 18.6113L14.7221 13.8333V28.6667H11.9446ZM0 10.4167V4.77792C0 4.02792 0.275417 3.37736 0.82625 2.82625C1.37736 2.27542 2.02792 2 2.77792 2H23.8888C24.6388 2 25.2893 2.27542 25.8404 2.82625C26.3913 3.37736 26.6667 4.02792 26.6667 4.77792V10.4167H23.8888V4.77792H2.77792V10.4167H0Z" fill="#E8EAED"/>
              </svg>
              <p>Thumnail</p>
            </div>
          </div></label>
          </form>
        </div>

        <div class="">
          <p>Naslov posnetka</p>
          <form action="title" method="post" enctype="multipart/form-data" id="tle" class="w-full">
            <input id="ter" name="vsebina" placeholder="Spremeni naslov videoposnetka" class="flex w-full h-13 p-5 flex-col justify-center items-start bg-thumdiv rounded-meh text-xl" type="text" value="<?php echo $row['naslov']; ?>"></input>
          </form>
        </div>

         <div class="flex flex-col h-full">
          <form action="opis" method="post" enctype="multipart/form-data" id="opis" class="w-full h-full">
            <textarea id="area" placeholder="Opis" class="flex w-full h-full bg-thumdiv rounded-meh resize-none" name="vsebina"><?php echo $row['opis']; ?></textarea>
          </form>
        </div> 

        <div>
          <div class="flex w-full h-13 p-12 flex-row items-start align-middle gap-12 rounded-meh bg-green" onclick="potrdiObjavo()">
            <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12.04 21.44L21.91 11.57L19.95 9.61L12.04 17.52L8.05 13.53L6.09 15.49L12.04 21.44ZM14 29C12.0633 29 10.2433 28.6325 8.54 27.8975C6.83667 27.1625 5.355 26.165 4.095 24.905C2.835 23.645 1.8375 22.1633 1.1025 20.46C0.3675 18.7567 0 16.9367 0 15C0 13.0633 0.3675 11.2433 1.1025 9.54C1.8375 7.83667 2.835 6.355 4.095 5.095C5.355 3.835 6.83667 2.8375 8.54 2.1025C10.2433 1.3675 12.0633 1 14 1C15.9367 1 17.7567 1.3675 19.46 2.1025C21.1633 2.8375 22.645 3.835 23.905 5.095C25.165 6.355 26.1625 7.83667 26.8975 9.54C27.6325 11.2433 28 13.0633 28 15C28 16.9367 27.6325 18.7567 26.8975 20.46C26.1625 22.1633 25.165 23.645 23.905 24.905C22.645 26.165 21.1633 27.1625 19.46 27.8975C17.7567 28.6325 15.9367 29 14 29ZM14 26.2C17.1267 26.2 19.775 25.115 21.945 22.945C24.115 20.775 25.2 18.1267 25.2 15C25.2 11.8733 24.115 9.225 21.945 7.055C19.775 4.885 17.1267 3.8 14 3.8C10.8733 3.8 8.225 4.885 6.055 7.055C3.885 9.225 2.8 11.8733 2.8 15C2.8 18.1267 3.885 20.775 6.055 22.945C8.225 25.115 10.8733 26.2 14 26.2Z" fill="white"/>
            </svg>
            <p>Potrdi objavo</p>
          </div>
        </div>
    </div>
    <form action="publish" class="hidden" id="publ"></form>
</body>
</html>
    <?php
  } else { header("Location: http://pungi.org/"); exit(); }
?>