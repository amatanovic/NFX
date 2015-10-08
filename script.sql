drop database if exists nfx;
create database nfx character set utf8 collate utf8_general_ci;
use nfx;

create table korisnik (
sifra	int not null primary key auto_increment,
email	text not null,
ime 	varchar(250),
prezime varchar(250),
lozinka varchar(250),
ziroracun varchar(250)
)engine=innodb;

create table kategorija (
sifra int not null primary key auto_increment,
naziv text
)engine=innodb;

create table projekt (
sifra	int not null primary key auto_increment,
naziv text,
kratakopis text,
detaljanopis text,
kategorija int,
enddate datetime,
tag text,
korisnik int
)engine=innodb;

create table slike (
sifra int not null primary key auto_increment,
projekt int,
avatar boolean,
putanja text
)engine=innodb;

create table komentari (
sifra int not null primary key auto_increment,
vrijeme datetime,
korisnik int,
komentar text,
projekt int
)engine=innodb;

alter table projekt add foreign key (kategorija) references kategorija(sifra);
alter table projekt add foreign key (korisnik) references korisnik(sifra);
alter table slike add foreign key (projekt) references projekt(sifra);
alter table komentari add foreign key (korisnik) references korisnik(sifra);
alter table komentari add foreign key (projekt) references projekt(sifra);

insert into korisnik (email, ime, prezime, lozinka, ziroracun) values ('antun.matanovic@gmail.com', 'Antun', 'Matanović', md5('lozinka'), 'HR541287512151');
insert into korisnik (email, ime, prezime, lozinka, ziroracun) values ('tenica@gmail.com', 'Tena', 'Milček', md5('tenatena'), 'HR541287512152');
insert into korisnik (email, ime, prezime, lozinka, ziroracun) values ('ankica.mala@gmail.com', 'Ankica', 'Vrljić', md5('ankica'), 'HR541287512153');
insert into kategorija (naziv) values ('Poljoprivreda');
insert into kategorija (naziv) values ('Sport');
insert into kategorija (naziv) values ('Obrazovanje');
insert into projekt (naziv, kratakopis, detaljanopis, kategorija, enddate, tag, korisnik) values ('Projekt o sadnji paprike', 'Paprika je vrlo bitna za posaditi i trebaju mi novci', 'Od antičkih vremena ljudi sadiše paprike pa evo tako i ja jadnik krenio...', 1, '2015-12-12 23:59:00', 'paprika, sadnja, poljoprivreda', 1);
insert into projekt (naziv, kratakopis, detaljanopis, kategorija, enddate, tag, korisnik) values ('Financiranje izgradnje staklenika', 'Obitelj treba plastenik kako bi mogli cijele godine uzgajati voće i povrće', 'Otac četrnaesteročlane obitelji iz sela Šopatovci intenzivno se bavi poljoprivredom već dugi niz godina. Poljoprivreda je jedini način na koji ova velika obitelj preživljava, a s obzirom na konstante kiše njihov urod je sve slabiji i slabiji. Zbog toga je potrebno financirati u izgradnju plastenika kako bi ova obitelj mogla normalno nastaviti sa svojim životom', 1, '2015-11-11 23:59:00', 'staklenik, obitelj', 1);
insert into projekt (naziv, kratakopis, detaljanopis, kategorija, enddate, tag, korisnik) values ('Potrebna školska dvorana', 'Financiranje izgradnje sportske dvorane OŠ Jagodica iz Prpanovca.', 'Osnovna škola Jagodica iz Prpanovaca od svog osnutka pa sve do danas nema prikladno mjesto u kojem bi se održavala tjelesno zdravstvena kultura. S obzirom da je iz godine u godinu sve više učenika, potreba za sportskom dvoranom postaje sve veća. Najveći problem javlja se tijekom zime, kada se nastava tjelesne i zdravstvene kulture mora održavati u učionicama. Također, kako bi se učenicima pružili potrebni uvjeti za razvoj motoričkih sposobnosti, iznimno je važno imati prikladnu sportsku dvoranu. ', 3, '2015-09-09 23:59:00', 'djeca, školska dvorana', 2);
insert into projekt (naziv, kratakopis, detaljanopis, kategorija, enddate, tag, korisnik) values ('Želimo na europsko natjecanje u Helsinki (HŽSR)', 'Put na europsko prvenstvno HŽSR u Helskinki', 'Hrvatska ženska streličarska reprezentacija ima želju otići na europsko natjecanje u Helsinki. S obzirom na probleme koje su snašli reprezentaciju posljednje dvije godine, proračun je uvelike opao zbog nenadanog požara u dvorani. Kao što je već poznato, tijekom požara izgorila je dvorana u kojoj je bila i sva potrebna oprema. Zbog velikih ulaganja u novu opremu i dvoranu, reprezentacija je ostala bez potrebnih financija za odlazak u Helsinki.', 2, '2015-10-10 23:59:00', 'djeca, školska dvorana', 3);
insert into slike (projekt, avatar, putanja) values (1, 1, 'slike/avatar.jpg');
insert into slike (projekt, avatar, putanja) values (1, 0, 'slike/galerija1.jpg');
insert into slike (projekt, avatar, putanja) values (1, 0, 'slike/galerija2.jpg');

insert into slike (projekt, avatar, putanja) values (1, 1, 'slike/avatarstaklenik.jpg');
insert into slike (projekt, avatar, putanja) values (1, 0, 'slike/slikakisa.jpg');
insert into slike (projekt, avatar, putanja) values (1, 0, 'slike/obiteljslika.jpg');

insert into slike (projekt, avatar, putanja) values (2, 1, 'slike/avatarskola.jpg');
insert into slike (projekt, avatar, putanja) values (2, 0, 'slike/skoladjeca.jpg');
insert into slike (projekt, avatar, putanja) values (2, 0, 'slike/seloskola.jpg');

insert into slike (projekt, avatar, putanja) values (3, 1, 'slike/strelicarstvo.jpg');
insert into slike (projekt, avatar, putanja) values (3, 0, 'slike/dvoranaslika.jpg');
insert into slike (projekt, avatar, putanja) values (3, 0, 'slike/strelicarka.jpg');
insert into slike (projekt, avatar, putanja) values (3, 0, 'slike/strel.jpg');

insert into komentari (vrijeme, korisnik, komentar, projekt) values ('2015-08-10 10:00:00', 1, 'Ovo je jedan predobar projekt', 1);
insert into komentari (vrijeme, korisnik, komentar, projekt) values ('2015-08-10 10:05:00', 1, 'Donirat ću', 1);