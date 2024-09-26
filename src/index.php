<?php 
    require_once 'db.php';
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <script defer src="scriptrs/script.js" type="text/javascript"></script>
    <body class="bg-darkMode">
    <div class="p-5 flex flex-col h-screen">
        <div class="h-full flex place-items-center text-white">
            <div class="flex flex-col w-full">
                <div class="flex justify-center">
                    <p class="text-4xl pb-5" id="textPrijava">Prijava</p>
                    <p class="text-4xl pb-5 hidden" id="textRegistracija">Registracija</p>
                </div>
            <div class="flex justify-center h-1/3">
                <div class="bg-darkWhite rounded-md w-full">
                    <div class="p-5 text-xl" id="logon">
                    <form method="post" enctype="multipart/form-data" action="a?action=login">
                            <div class="py-3">
                                <label class="mb-8">Elektronski racun ali uporabnisko ime</label>
                                <input type="text" name="mail" class="rounded w-full bg-darkWhite text-3xl p-1" autofocus>
                            </div>
                            <div class="py-3">
                                <label class="mb-8">Geslo</label>
                                <input type="password" name="geslo" class="rounded w-full bg-darkWhite text-3xl p-1">
                            </div>
                            <div class="py-3">
                                <input type="submit" name="login" class="rounded w-full bg-darkMode p-1">
                            </div>
                    </form>
                    </div>
                    <div class="p-5 text-xl hidden" id="regis">
                        <form method="post" enctype="multipart/form-data" action="a?action=signup">
                        <div class="py-3">
                            <p>Uporabnisko ime</p>
                            <input type="text" name="user" class="rounded w-full bg-darkWhite text-3xl p-1">
                        </div>
                        <div class="py-3">
                            <p>Elektronski racun</p>
                            <input type="text" name="mail" class="rounded w-full bg-darkWhite text-3xl p-1">
                        </div>
                        <div class="py-3">
                            <p>Geslo</p>
                            <input type="password" name="geslo" class="rounded w-full bg-darkWhite text-3xl p-1">
                        </div>
                        <div class="py-3">
                                <input type="submit" name="signup" class="rounded w-full bg-darkMode p-1">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex justify-center p-2" onclick="myRegistrat()">
                <p id="vprR">Nimate se racuna? Registriraj se</p>
                <p class="hidden" id="vprP">Nazaj na prijavo</p>
            </div>
            <div class="flex justify-center">
                <div class="flex flex-col">
                    <div>
                        <p>Prijava s drugimi storitvami</p>
                    </div>
                    <div class="flex flex-row">
                        <div class="bg-darkWhite">Google</div>
                        <div>Facebook</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="p-5 bg-darkWhite rounded-md text-white">Nadaljujte kot gost</div>
    </div>
</body>
</html>