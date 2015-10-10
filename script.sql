drop database if exists zdravZivot;
create database zdravZivot character set utf8 collate utf8_general_ci;
use zdravZivot;
create table korisnik (
sifra int not null primary key auto_increment,
ime varchar(250),
prezime varchar(250),
email varchar(250),
ulica text,
mjesto varchar(250),
kontakt varchar(250),
lozinka varchar(250),
device varchar(500) default 'Unknown'
)engine=innodb;

create table opg (
sifra int not null primary key auto_increment,
naziv text,
paypal varchar(250),
kratakopis text,
avatar varchar(250),
korisnik int
)engine=innodb;

create table kategorija(
sifra int not null primary key auto_increment,
naziv text
)engine=innodb;

create table proizvod(
sifra int not null primary key auto_increment,
naziv text,
cijena decimal(7,2),
slika text,
opg int,
kategorija int
)engine=innodb;

create table komentar(
sifra int not null primary key auto_increment,
komentar text,
korisnik int,
opg int,
vrijeme datetime
)engine=innodb;

create table pracenje(
sifra int not null primary key auto_increment,
opg int,
korisnik int
)engine=innodb;

alter table opg add foreign key(korisnik) references korisnik(sifra);
alter table proizvod add foreign key(opg) references opg(sifra);
alter table proizvod add foreign key(kategorija) references kategorija(sifra);
alter table komentar add foreign key(opg) references opg(sifra);
alter table komentar add foreign key(korisnik) references korisnik(sifra);
alter table pracenje add foreign key(opg) references opg(sifra);
alter table pracenje add foreign key(korisnik) references korisnik(sifra);
 
insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('Antun', 'Matanović', 'antun.matanovic@gmail.com', md5('lozinka'), 'Lj. Posavskog 66', 'Osijek', '031/555444');
insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('Tena', 'Vilček', 'vilcek.tena@gmail.com', md5('nfx'), 'Školska 58', 'Beli Manastir', '031/402444');
insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('Manuela', 'Mikulecki', 'mmikluecki@ffos.hr', md5('mani'), 'Ulica bana Josipa Jelačića 87', 'Đakovo', '031/223458');
insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('Ana', 'Leh', 'aleh@ffos.hr', md5('anci'), 'Ulica Ljudevita Gaja 100', 'Valpovo', '031/847788');
insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('Dajana', 'Stojanović', 'dstojanovic@ffos.hr', md5('daja'), 'Ulica Ivana Zajca 23', 'Donji Miholjac', '031/222654');
insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('Mirna', 'Marić', 'mmaric@gmail.com', md5('mirna'), 'Svilajska ulica 21', 'Čepin', '031/569555');
insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('Luka', 'Buljan', 'lbuljan@ffos.hr', md5('luka55'), 'Ulica Josipa Kozarca 21', 'Antunovac', '031/444212');
insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('Barbara', 'Kujavec', 'kujavec@gmail.com', md5('miska'), 'Ulica Ivana Bakića 232', 'Erdut', '031/466789');

insert into opg (naziv, paypal, kratakopis, avatar, korisnik) values ('OPG Matanović', 'antun.matanovic-facilitator@gmail.com', 'OPG Matanović aktivno se bavi poljoprivredom već 37 godina. Od povrća se najviše bavimo uzgojem bundeva i tikvica, a od voća uzgojem šljiva.', 'slike/avatar1.jpg', 1);
insert into opg (naziv, kratakopis, avatar, korisnik) values ('OPG Vilček', 'Obiteljsko poljoprivredno gospodarstvo Vilček nalazi se u Belom Manastiru. Bavimo se proizvodnjom i uzgojem raznog voća i povrća. Posebno smo bazirani na uzgoj jabuka. Proizvodimo i prirodni sok od rajčice koji također možete vidjeti u našoj ponudi.', 'slike/avatar_1.jpg', 2);
insert into opg (naziv, kratakopis, avatar, korisnik) values ('OPG Leh', 'Leh obiteljsko poljoprivredno gospodarstvo bavi se uzgojem povrća (grašak, krumpir, špinat, mrkva, rajčice, paprika). U cjelokupnoj proizvodnji sudjeluju svi članovi obitelji Leh, od najstarijih (72 godine) pa do najmlađih (11 godina). OPG se nalazi na području Valpova.', 'slike/avatar4.jpg', 4);
insert into opg (naziv, kratakopis, avatar, korisnik) values ('OPG Stojanović', 'OPG Stojanović bavi se uzgojem jagoda, višanja i lubenica. Također, uvelike se bavimo proizvodnjom luka i rotkvica. Imanje obitelji Stojanović nalazi se na području Donjeg Miholjca. ', 'slike/avatar8.jpg', 5);
insert into opg (naziv, kratakopis, avatar, korisnik) values ('OPG Kujavec', 'Obitelj Kujavec na svojim prostorima vinograda uzgaja vinovu lozu, kruške i šljive. U svojoj ponudi Vam također nudimo i proizvode nastale od uzgoja ovoga voća, a to su razne rakije i vino. Naravno, rakija je među nama poznata i kao lijek, a čaša crnog vina dnevno poboljšat će Vašu krvnu sliku.', 'slike/avatar3.jpg', 8);

insert into kategorija (naziv) values ('Voće');
insert into kategorija (naziv) values ('Povrće');
insert into kategorija (naziv) values ('Gotovi proizvodi');

insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Narančasta buča', 3.75 , 'slike/bundeva1.jpg', 1 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Tikvica', 9.00 , 'slike/tikvica1.jpg', 1 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Šljive', 11.50 , 'slike/sljiva1.jpg', 1 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Prirodni sok od rajčice', 7.00 , 'slike/sok4.jpg', 2 , 3);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Jabuka King Jonagold', 5.00 , 'slike/jabuka3.jpg', 2 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Jabuka Pinova i Granny Smith', 5.50 , 'slike/jabuka1.jpg', 2 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Cvjetača', 9.00 , 'slike/karfiol1.jpg', 2 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Grašak', 7.00 , 'slike/grasak2.jpg', 3 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Bijeli krumpir', 2.50 , 'slike/krumpir3.jpg', 3 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Špinat', 4.50 , 'slike/spinat1.jpg', 3 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Mrkva', 5.00 , 'slike/mrkva3.jpg', 3 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Rajčica', 9.50 , 'slike/rajcica2.jpg', 3 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Paprika babura (razne boje)', 7.00 , 'slike/paprika3.jpg', 3 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Jagode (korpica)', 17.00 , 'slike/jagoda2.jpg', 4 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Višnje', 14.00 , 'slike/visnja3.jpg', 4 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Lubenica', 5.00 , 'slike/lubenica1.jpg', 4 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Crveni luk', 2.50 , 'slike/luk1.jpg', 4 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Rotkvica', 10.00 , 'slike/rotkvica3.jpg', 4 , 2);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Kruške', 8.00 , 'slike/kruska2.jpg', 5 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Šljive', 11.00 , 'slike/sljiva2.jpg', 5 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Bijelo grožđe', 9.00 , 'slike/grozdje1.jpg', 5 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Crno grožđe', 11.00 , 'slike/grozdje2.jpg', 5 , 1);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Crno vino', 11.00 , 'slike/vino3.jpg', 5 , 3);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Rakija od šljive', 30.00 , 'slike/rakija2.jpg', 5 , 3);
insert into proizvod (naziv, cijena, slika, opg, kategorija) values ('Rakija od kruške', 50.00 , 'slike/rakija1.jpg', 5 , 3);


insert into komentar (komentar, korisnik, opg, vrijeme) values ('Proizvodi obitelji Leh su me oduševili. Točno se osjeti razlika proizvoda obiteljske proizvodnje i običnog proizvoda iz trgovine.', 3 , 3, '2015-10-09 13:55');
insert into komentar (komentar, korisnik, opg, vrijeme) values ('Sok OPG-a Vilček je savršen. Od kad ga pijem nemam problema sa tlakom. Iako ne zvuči kao nešto ukusno, zaista je.', 6 , 2 , '2015-10-10 10:50');
insert into komentar (komentar, korisnik, opg, vrijeme) values ('Slažem se s gospodinom Buljanom u vezi rakije. Vaše rakije su iznimno dobre kvalitete. Imala sam slučaj u obitelji gdje je član uganuo gležanj, i pomoću obloga od rakije noga je prošla za 2 dana.', 6 , 5 , '2015-08-02 13:05');
insert into komentar (komentar, korisnik, opg, vrijeme) values ('Vino mi je zaista poboljšalo krvnu sliku. Imao sam problema sa željezom. Rakije su također od velike pomoći kao oblog.', 7 , 5 , '2015-07-07 09:05');
insert into komentar (komentar, korisnik, opg, vrijeme) values ('Buče i tikve obitelji Matanović prekrasne su. Djeca ih posebice vole, a zanimljive su i za vrijeme Noći vještica.', 3 , 1 , '2015-05-28 12:55');
insert into komentar (komentar, korisnik, opg, vrijeme) values ('Jagode su fenomenalne.', 7 , 4 , '2015-04-09 13:55');

insert into pracenje (opg, korisnik) values (3, 3);	
insert into pracenje (opg, korisnik) values (1, 3);	
insert into pracenje (opg, korisnik) values (2, 6);	
insert into pracenje (opg, korisnik) values (5, 6);	
insert into pracenje (opg, korisnik) values (4, 7);	
insert into pracenje (opg, korisnik) values (5, 7);	
insert into pracenje (opg, korisnik) values (4, 6);	
