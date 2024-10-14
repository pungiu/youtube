<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <script defer src="scripts/t.js" type="text/javascript"></script>
</head>
<?php 
    require_once 'db.php';
    session_start();

    if (isset($_SESSION['user_id'])) {
        $r = $_SESSION['user_id'];
        $s = "SELECT * FROM uporabniki INNER JOIN slike ON uporabniki.slika_id = slike.id WHERE uporabniki.id = '$r'";
        $q = mysqli_query($conn, $s);
        $a = mysqli_fetch_array($q,MYSQLI_ASSOC);


    } else {
        header("Location: http://pungi.org/");
        exit();
    }
    
?>
<body class="bg-darkMode nor:justify-center nor:flex">
    <div class="w-screen h-screen text-white nor:w-1/3 nor:flex nor:flex-col">
        <div class="p-2 nor:hidden">
            <?php
                include 'back.html';
            ?>
        </div>
        <div class="flex justify-center text-3xl">
            <p>SPREMENI PODATKE RACUNA</p>
        </div>
        <div class="flex justify-center">
            <div class="flex flex-col gap-4 w-full items-center p-4">
                <img src="resources/slike/<?php echo $a['pot']; ?>" class="h-thum w-thum rounded-sharp">
                <p><?php echo $a['username']; ?></p>
                <form method="post" enctype="multipart/form-data" action="pfp" class="w-full" id="qwe">
                    <input type="file" id="pfpupload" class="hidden" name="upfp">
                    <label class="bg-red flex flex-row gap-4 p-3 rounded-meh items-center" for="pfpupload">
                        <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9446 28.6667V13.8333L7.16667 18.6113L5.19458 16.6113L13.3333 8.47208L21.4721 16.6113L19.5 18.6113L14.7221 13.8333V28.6667H11.9446ZM0 10.4167V4.77792C0 4.02792 0.275417 3.37736 0.82625 2.82625C1.37736 2.27542 2.02792 2 2.77792 2H23.8888C24.6388 2 25.2893 2.27542 25.8404 2.82625C26.3913 3.37736 26.6667 4.02792 26.6667 4.77792V10.4167H23.8888V4.77792H2.77792V10.4167H0Z" fill="#E8EAED"/>
                          </svg>
                          <p>Zamenjaj sliko profila</p>
                    </label>
                </form>
            </div>
        </div>
        <div class="p-4 gap-2 flex flex-col">
            <div class="p-4 bg-blured flex flex-col rounded-sharp gap-2">
                <p class="text-xl">Uporabnisko ime</p>
                <form action="upoime" method="post" enctype="multipart/form-data" id="upoime">
                    <input class="w-full bg-blured p-3 rounded-sharp text-xl" type="class" name="imep">
                </form>
            </div>
            <div class="bg-green p-4 rounde rounded-sharp flex flex-row items-center gap-3 text-xl cursor-pointer" onclick="spremembeUI()">
                <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.04 21.44L21.91 11.57L19.95 9.61L12.04 17.52L8.05 13.53L6.09 15.49L12.04 21.44ZM14 29C12.0633 29 10.2433 28.6325 8.54 27.8975C6.83667 27.1625 5.355 26.165 4.095 24.905C2.835 23.645 1.8375 22.1633 1.1025 20.46C0.3675 18.7567 0 16.9367 0 15C0 13.0633 0.3675 11.2433 1.1025 9.54C1.8375 7.83667 2.835 6.355 4.095 5.095C5.355 3.835 6.83667 2.8375 8.54 2.1025C10.2433 1.3675 12.0633 1 14 1C15.9367 1 17.7567 1.3675 19.46 2.1025C21.1633 2.8375 22.645 3.835 23.905 5.095C25.165 6.355 26.1625 7.83667 26.8975 9.54C27.6325 11.2433 28 13.0633 28 15C28 16.9367 27.6325 18.7567 26.8975 20.46C26.1625 22.1633 25.165 23.645 23.905 24.905C22.645 26.165 21.1633 27.1625 19.46 27.8975C17.7567 28.6325 15.9367 29 14 29ZM14 26.2C17.1267 26.2 19.775 25.115 21.945 22.945C24.115 20.775 25.2 18.1267 25.2 15C25.2 11.8733 24.115 9.225 21.945 7.055C19.775 4.885 17.1267 3.8 14 3.8C10.8733 3.8 8.225 4.885 6.055 7.055C3.885 9.225 2.8 11.8733 2.8 15C2.8 18.1267 3.885 20.775 6.055 22.945C8.225 25.115 10.8733 26.2 14 26.2Z" fill="white"/>
                </svg>
                <p>Potrdi spremembe</p>
            </div>
        </div>

        <div class="p-4 flex flex-col gap-2">
            <div class="p-4 bg-blured flex flex-col rounded-sharp">
                <form action="spregeslo" method="post" enctype="multipart/form-data" id="tojeto">
                    <label class="text-xl">Spremenite geslo</label>
                    <input type="password" class="w-full bg-blured p-3 rounded-sharp text-xl" name="ge1">
                    <label class="text-xl">Ponovi geslo</label>
                    <input type="password" class="w-full bg-blured p-3 rounded-sharp text-xl" name="ge2">
                </form>
            </div>
            <div class="bg-green p-4 rounde rounded-sharp flex flex-row items-center gap-3 text-xl cursor-pointer" onclick="spremembeGES()">
                <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.04 21.44L21.91 11.57L19.95 9.61L12.04 17.52L8.05 13.53L6.09 15.49L12.04 21.44ZM14 29C12.0633 29 10.2433 28.6325 8.54 27.8975C6.83667 27.1625 5.355 26.165 4.095 24.905C2.835 23.645 1.8375 22.1633 1.1025 20.46C0.3675 18.7567 0 16.9367 0 15C0 13.0633 0.3675 11.2433 1.1025 9.54C1.8375 7.83667 2.835 6.355 4.095 5.095C5.355 3.835 6.83667 2.8375 8.54 2.1025C10.2433 1.3675 12.0633 1 14 1C15.9367 1 17.7567 1.3675 19.46 2.1025C21.1633 2.8375 22.645 3.835 23.905 5.095C25.165 6.355 26.1625 7.83667 26.8975 9.54C27.6325 11.2433 28 13.0633 28 15C28 16.9367 27.6325 18.7567 26.8975 20.46C26.1625 22.1633 25.165 23.645 23.905 24.905C22.645 26.165 21.1633 27.1625 19.46 27.8975C17.7567 28.6325 15.9367 29 14 29ZM14 26.2C17.1267 26.2 19.775 25.115 21.945 22.945C24.115 20.775 25.2 18.1267 25.2 15C25.2 11.8733 24.115 9.225 21.945 7.055C19.775 4.885 17.1267 3.8 14 3.8C10.8733 3.8 8.225 4.885 6.055 7.055C3.885 9.225 2.8 11.8733 2.8 15C2.8 18.1267 3.885 20.775 6.055 22.945C8.225 25.115 10.8733 26.2 14 26.2Z" fill="white"/>
                </svg>
                <p>Potrdi spremembe</p>
            </div>
        </div>
    </div>
</body>
</html>