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
korisnik int
)engine=innodb;

create table tag (
sifra int not null primary key auto_increment,
naziv text,
projekt int
)engine=innodb;

create table slike (
sifra int not null primary key auto_increment,
projekt int,
avatar boolean,
putanja text
)engine=innodb;

alter table projekt add foreign key (kategorija) references kategorija(sifra);
alter table projekt add foreign key (korisnik) references korisnik(sifra);
alter table tag add foreign key (projekt) references projekt(sifra);
alter table slike add foreign key (projekt) references projekt(sifra);

insert into korisnik (email, ime, prezime, lozinka, ziroracun) values ('antun.matanovic@gmail.com', 'Antun', 'Matanović', md5('lozinka'), 'HR541287512151');
insert into kategorija (naziv) values ('Poljoprivreda');
insert into kategorija (naziv) values ('Sport');
insert into kategorija (naziv) values ('Obrazovanje');
insert into projekt (naziv, kratakopis, detaljanopis, kategorija, enddate, korisnik) values ('Naziv projekta', 'Kratak opis projekta', 'Detaljan opis ovog projekta koji je super', 1, '2015-12-12 23:59:00', 1);