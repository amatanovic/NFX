drop database if exists nfx;
create database nfx character set utf8 collate utf8_general_ci;
use nfx;
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

create table transakcije(
sifra int not null primary key auto_increment,
korisnik int,
proizvod int,
vrijeme datetime
)engine=innodb;

create table komentar(
sifra int not null primary key auto_increment,
komentar text,
korisnik int,
opg int,
vrijeme datetime
)engine=innodb;

alter table opg add foreign key(korisnik) references korisnik(sifra);
alter table proizvod add foreign key(opg) references opg(sifra);
alter table proizvod add foreign key(kategorija) references kategorija(sifra);
alter table transakcije add foreign key(korisnik) references korisnik(sifra);
alter table transakcije add foreign key(proizvod) references proizvod(sifra);
alter table komentar add foreign key(opg) references opg(sifra);
alter table komentar add foreign key(korisnik) references korisnik(sifra);

insert into korisnik (ime, prezime, email, lozinka, ulica, mjesto, kontakt) values ('Antun', 'Matanović', 'antun.matanovic@gmail.com', md5('lozinka'), 'Lj. Posavskog 66', 'Osijek', '031/555444');