let state = true;
var meni = document.getElementById('meni');
var dol = document.getElementById('dol');
var gor = document.getElementById('gor');

var min = document.getElementById('mobilein');
var mli = document.getElementById('mobilelik');
var sub = document.getElementById('mobilesub');
var liked = document.getElementById('likedbutton');
var rec = document.getElementById('recommended');
var dli = document.getElementById('likedis');
var subsec = document.getElementById('submob');
var mma = document.getElementById('maindis');
var vsec = document.getElementById('vsecdi');
var gen = document.getElementById('genedi');
var nas = document.getElementById('nasdis');
var gunas = document.getElementById('nasdi');
var narci = document.getElementById('nardis');
var narie = document.getElementById('narodi');
var log = document.getElementById('logo');

let content = 1;
min.classList.replace('hidden','flex');
mli.classList.replace('flex','hidden');

  
function lidedDes() {
    dli.classList.replace('nor:hidden','nor:grid');
    mma.classList.replace('nor:grid','nor:hidden');
    nas.classList.replace('nor:flex','nor:hidden');
    narci.classList.replace('nor:grid','nor:hidden');

    vsec.classList.replace('nor:bg-black','nor:bg-red');
    gen.classList.replace('nor:bg-red','nor:bg-black');
    gunas.classList.replace('nor:bg-red','nor:bg-black');
    narie.classList.replace('nor:bg-red','nor:bg-black');
}
function generalDes() {
    dli.classList.replace('nor:grid','nor:hidden');
    mma.classList.replace('nor:hidden','nor:grid');
    nas.classList.replace('nor:flex','nor:hidden');
    narci.classList.replace('nor:grid','nor:hidden');

    vsec.classList.replace('nor:bg-red','nor:bg-black');
    gen.classList.replace('nor:bg-black','nor:bg-red');
    gunas.classList.replace('nar:bg-red','nor:bg-black');
    narie.classList.replace('nor:bg-red','nor:bg-black');
}
function nasDes() {
    nas.classList.replace('nor:hidden','nor:flex');
    dli.classList.replace('nor:grid','nor:hidden');
    mma.classList.replace('nor:grid','nor:hidden');
    narci.classList.replace('nor:grid','nor:hidden');

    vsec.classList.replace('nor:bg-red','nor:bg-black');
    gen.classList.replace('nor:bg-red','nor:bg-black');
    gunas.classList.replace('nor:bg-black','nor:bg-red');
    narie.classList.replace('nor:bg-red','nor:bg-black');
}
function naroDes() {
    dli.classList.replace('nor:grid','nor:hidden');
    mma.classList.replace('nor:grid','nor:hidden');
    nas.classList.replace('nor:flex','nor:hidden');
    narci.classList.replace('nor:hidden','nor:grid');

    vsec.classList.replace('nor:bg-red','nor:bg-black');
    gen.classList.replace('nor:bg-red','nor:bg-black');
    gunas.classList.replace('nor:bg-red','nor:bg-black');
    narie.classList.replace('nor:bg-black','nor:bg-red');
}

document.getElementById("fileselect").onchange = function() {
    document.getElementById("form").submit();
};
document.getElementById("fileselectd").onchange = function() {
    document.getElementById("formd").submit();
};

function mode1() {
    if (content === 1) {
        min.classList.replace('flex','hidden');
        mli.classList.replace('hidden','flex');
        sub.classList.replace('flex','hidden');

        liked.classList.replace('bg-black','bg-red');
        rec.classList.replace('bg-red','bg-black');
        subsec.classList.replace('bg-red','bg-black');
    }
}
function mode2() {
    min.classList.replace('hidden','flex');
    mli.classList.replace('flex','hidden');
    sub.classList.replace('flex','hidden');

    liked.classList.replace('bg-red','bg-black');
    rec.classList.replace('bg-black','bg-red');
    subsec.classList.replace('bg-red','bg-black');
}
function mode3() {
    sub.classList.replace('hidden','flex');
    min.classList.replace('flex','hidden');
    mli.classList.replace('flex','hidden');

    liked.classList.replace('bg-red','bg-black');
    rec.classList.replace('bg-red','bg-black');
    subsec.classList.replace('bg-black','bg-red');
}

function myToolBar() {
    if(state === true) {
        meni.classList.remove('hidden');
        meni.classList.add('flex');
        gor.classList.remove('hidden');
        dol.classList.add('hidden');

        state = false;
    } else if (state === false) {
        meni.classList.remove('flex');
        meni.classList.add('hidden');
        gor.classList.add('hidden');
        dol.classList.remove('hidden');

        state = true;
    }
}