
## Badges

Add badges from somewhere like: [shields.io](https://shields.io/)

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
[![GPLv3 License](https://img.shields.io/badge/License-GPL%20v3-yellow.svg)](https://opensource.org/licenses/)
[![AGPL License](https://img.shields.io/badge/license-AGPL-blue.svg)](http://www.gnu.org/licenses/agpl-3.0)


## Table of Contents
## O projektu

Cilj tega projekta je ustvariti funkcionalni klon YouTuba z edinstvenim in ločenim uporabniškim vmesnikom (UI). Cilj projekta je posnemati osnovne značilnosti in funkcionalnosti izvirnega spletnega mesta YouTube, hkrati pa uvesti svež in inovativen dizajn.


## Databaza

![App Screenshot](https://imgur.com/6nv7GPF)

Koda:
    
    vrste {
	id integer pk increments unique
	vrsta_ integer unique
    }

    uporabniki {
	id integer pk increments unique
	username varchar(1024)
	email varchar(1024)
	geslo varchar(1024)
	vrsta_id integer def(1)
	slika_id integer def(0)
	google integer def(0)
    }

    slike {
	id integer pk increments unique
	pot varchar
    }

    sub {
	id integer pk increments unique
	uporabnik_id integer
	narocnina integer
    }

    komentarji {
	id integer pk increments unique
	vsebina varchar(8192)
	uporabnik_id integer
	video_id integer
    }

    vsebina {
	id integer pk increments unique
	naslov varchar(1024) null
	datum timestamp null def(CURRENT_TIMESTAMP)
	opis varchar(8192) null
	pot varchar(256) null
	aktivno tinyint def(0)
	url varchar(256)
	thumnail varchar(256)
	gif varchar(128)
    }

    vsecki {
	id integer pk increments unique
	uporabnik_id integer
	video_id integer
    }


## Deployment

Če želite uvesti ta projekt, zaženite XAMPP ter se prepričajte, da imate MYSQL naložen. Narediti boste morali še databaza s imenom "projekt".

```bash
    git clone https://github.com/pungiu/youtube.git
```


## Uporaba

Za to stran boste morali imeti racun, ki ga naredite na zacetni strani. Na strani, nato lahko brskate po vsebinah drugih uporabnikov ali pa nalozite svoj videjo.
