let prip = true;
var registracija = document.getElementById('regis');
var prijava = document.getElementById('logon');
var txtP = document.getElementById('textPrijava');
var txtR = document.getElementById('textRegistracija');
var strar1 = document.getElementById('vprR');
var strar2 = document.getElementById('vprP');

function myRegistrat() {
    if(prip === true){
        prijava.classList.add('hidden');
        registracija.classList.remove('hidden');
        txtP.classList.add('hidden');
        txtR.classList.remove('hidden');
        strar1.classList.add('hidden');
        strar2.classList.remove('hidden');

        prip = false;
    } else if(prip === false) {
        prijava.classList.remove('hidden');
        registracija.classList.add('hidden');
        txtP.classList.remove('hidden');
        txtR.classList.add('hidden');
        strar1.classList.remove('hidden');
        strar2.classList.add('hidden');

        prip = true;
    }
}
