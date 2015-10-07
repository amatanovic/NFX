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

alter table projekt add foreign key (kategorija) references kategorija(sifra);
alter table projekt add foreign key (korisnik) references korisnik(sifra);
alter table slike add foreign key (projekt) references projekt(sifra);

insert into korisnik (email, ime, prezime, lozinka, ziroracun) values ('antun.matanovic@gmail.com', 'Antun', 'Matanović', md5('lozinka'), 'HR541287512151');
insert into kategorija (naziv) values ('Poljoprivreda');
insert into kategorija (naziv) values ('Sport');
insert into kategorija (naziv) values ('Obrazovanje');
insert into projekt (naziv, kratakopis, detaljanopis, kategorija, enddate, tag, korisnik) values ('Projekt o sadnji paprike', 'Paprika je vrlo bitna za posaditi i trebaju mi novci', 'Od antičkih vremena ljudi sadiše paprike pa evo tako i ja jadnik krenio...', 1, '2015-12-12 23:59:00', 'paprika, sadnja, poljoprivreda', 1);
insert into slike (projekt, avatar, putanja) values (1, 1, 'slike/avatar.jpg');
insert into slike (projekt, avatar, putanja) values (1, 0, 'slike/galerija1.jpg');
insert into slike (projekt, avatar, putanja) values (1, 0, 'slike/galerija2.jpg');