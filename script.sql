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
enddate datetime
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
alter table tag add foreign key (projekt) references projekt(sifra);
