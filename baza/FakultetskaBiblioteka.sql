/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     17.03.2022. 14:50:02                         */
/*==============================================================*/

drop procedure if exists Zaduzenja;

drop table if exists Autor;

drop table if exists `Bibliotecka jedinica`;

drop table if exists Bibliotekar;

drop table if exists Clan;

drop table if exists Izdata;

drop table if exists Jezik;

drop table if exists Napisao;

drop table if exists `Vrsta jedinice`;

/*==============================================================*/
/* Table: Autor                                                 */
/*==============================================================*/
create table Autor
(
   `ID autora`          int not null auto_increment,
   Prezime              varchar(30) not null,
   Ime                  varchar(30) not null,
   Napomena             varchar(50),
   primary key (`ID autora`)
);

/*==============================================================*/
/* Table: `Bibliotecka jedinica`                                */
/*==============================================================*/
create table `Bibliotecka jedinica`
(
   `Inventarni broj`    varchar(10) not null,
   `ID jezika`          int not null,
   `ID vrste jedinice`  tinyint not null,
   Naziv                varchar(100) not null,
   Izdavac              varchar(50) not null,
   `Godina izdavanja`   int not null,
   ISBN                 varchar(20),
   Stanje               varchar(15) not null,
   Opis                 text,
   Rashodovana          bool not null,
   `Datum otpisa`       date,
   primary key (`Inventarni broj`)
);

/*==============================================================*/
/* Table: Bibliotekar                                           */
/*==============================================================*/
create table Bibliotekar
(
   `ID bibliotekara`    tinyint not null,
   Prezime              varchar(30) not null,
   Ime                  varchar(30) not null,
   Email                varchar(30) not null,
   `Korisnicka sifra`   varchar(20) not null,
   primary key (`ID bibliotekara`)
);

/*==============================================================*/
/* Table: Clan                                                  */
/*==============================================================*/
create table Clan
(
   `Broj clana`         int not null,
   Prezime              varchar(30) not null,
   Ime                  varchar(30) not null,
   Telefon              varchar(30),
   Email                varchar(30) not null,
   `Broj indeksa`       char(12),
   `Sifra zaposlenog`   smallint,
   `Korisnicka sifra`   varchar(20) not null,
   `Datum ispisa`       date,
   primary key (`Broj clana`)
);

/*==============================================================*/
/* Table: Izdata                                                */
/*==============================================================*/
create table Izdata
(
   `RB izdavanja`       bigint not null,
   `Broj clana`         int not null,
   `Inventarni broj`    varchar(10) not null,
   `ID bibliotekara`    tinyint not null,
   `Datum izdavanja`    date not null,
   `Datum vracanja`     date,
   Period               tinyint not null default 1,
   primary key (`Broj clana`, `Inventarni broj`, `ID bibliotekara`, `RB izdavanja`)
);

/*==============================================================*/
/* Table: Jezik                                                 */
/*==============================================================*/
create table Jezik
(
   `ID jezika`          int not null auto_increment,
   `Naziv jezika`       varchar(30) not null,
   primary key (`ID jezika`)
);

/*==============================================================*/
/* Table: Napisao                                               */
/*==============================================================*/
create table Napisao
(
   `ID autora`          int not null,
   `Inventarni broj`    varchar(10) not null,
   primary key (`ID autora`, `Inventarni broj`)
);

/*==============================================================*/
/* Table: `Vrsta jedinice`                                      */
/*==============================================================*/
create table `Vrsta jedinice`
(
   `ID vrste jedinice`  tinyint not null,
   `Naziv vrste jedinice` varchar(20) not null,
   primary key (`ID vrste jedinice`)
);

/*==============================================================*/
/* References                                                   */
/*==============================================================*/
alter table `Bibliotecka jedinica` add constraint FK_Napisana foreign key (`ID jezika`)
      references Jezik (`ID jezika`) on delete restrict on update cascade;

alter table `Bibliotecka jedinica` add constraint FK_Pripada foreign key (`ID vrste jedinice`)
      references `Vrsta jedinice` (`ID vrste jedinice`) on delete restrict on update cascade;

alter table Izdata add constraint FK_ClanuIzdata foreign key (`Broj clana`)
      references Clan (`Broj clana`) on delete restrict on update cascade;

alter table Izdata add constraint FK_IzdaBibliotekar foreign key (`ID bibliotekara`)
      references Bibliotekar (`ID bibliotekara`) on delete restrict on update cascade;

alter table Izdata add constraint FK_IzdataClanu foreign key (`Inventarni broj`)
      references `Bibliotecka jedinica` (`Inventarni broj`) on delete restrict on update cascade;

alter table Napisao add constraint FK_Napisao foreign key (`ID autora`)
      references Autor (`ID autora`) on delete restrict on update cascade;

alter table Napisao add constraint FK_Napisao2 foreign key (`Inventarni broj`)
      references `Bibliotecka jedinica` (`Inventarni broj`) on delete restrict on update cascade;


/*==============================================================*/
/* Stored Procedure                                             */
/*==============================================================*/
delimiter //
create procedure Zaduzenja (IN pautorime varchar(30), IN pautorprezime varchar(30))
begin
select `Bibliotecka jedinica`.`Inventarni broj`,`Bibliotecka jedinica`.Naziv,
`Bibliotecka jedinica`.Izdavac, Clan.`Broj clana`, Clan.Prezime, Clan.Ime,
Izdata.`Datum izdavanja`, Izdata.`Datum vracanja`
from Izdata, Clan, `Bibliotecka jedinica`
where Clan.`Broj clana` = Izdata.`Broj clana` and
`Bibliotecka jedinica`.`Inventarni broj` = Izdata.`Inventarni broj` and
Clan.Ime=pautorime and Clan.Prezime=pautorprezime;
end //
delimiter;

/*==============================================================*/
/* Naknadne izmene                                              */
/*==============================================================*/
ALTER TABLE `clan` ADD `Opomena` nvarchar(250) null;