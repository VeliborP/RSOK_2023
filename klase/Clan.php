<?php
class Clan extends KonekcijaDB
{
   public $BrojClana;
   public $Prezime;
   public $Ime;
   public $Telefon;
   public $Email;
   public $BrojIndeksa;
   public $SifraZaposlenog;
   public $KorisnickaSifra;
   public $DatumIspisa;
   public $Opomena;

   public function Upis()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i ostalih promenljivih
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za unos podataka
      $upit = "INSERT INTO `clan`(`Broj clana`, `Prezime`, `Ime`, `Telefon`, `Email`, `Broj indeksa`, `Sifra zaposlenog`, `Korisnicka sifra`, `Datum ispisa`, `opomena`) VALUES ('$this->BrojClana','$this->Prezime','$this->Ime','$this->Telefon','$this->Email','$this->BrojIndeksa','$this->SifraZaposlenog','$this->KorisnickaSifra','$this->DatumIspisa','$this->Opomena');";
      //izvrsavanje SQL upita
      $result = mysqli_query($konekcija, $upit);               
      /*provera rezultata izvrsavanja SQL upita 
      i ispis informacije o gresci*/
      if(!$result)
               {
                  mysqli_error($konekcija);
               }
            else
               {
                  $uspeh="true";
               }
      //zatvaranje konekcije do BP
      $uspehzkbp=$this->ZatvaranjeKonekcije();
      return $uspeh;
   }
   
   public function Izmena($pBrClana)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka
      $upit = "UPDATE `clan` SET `Broj clana`='$this->BrojClana',`Prezime`='$this->Prezime',`Ime`='$this->Ime',`Telefon`='$this->Telefon',`Email`='$this->Email',`Broj indeksa`='$this->BrojIndeksa',`Sifra zaposlenog`='$this->SifraZaposlenog',`Korisnicka sifra`='$this->KorisnickaSifra',`Datum ispisa`='$this->DatumIspisa',`opomena`='$this->Opomena' WHERE `Broj clana`='$pBrClana';";
      //izvrsavanje SQL upita
      $result = mysqli_query($konekcija, $upit);               
      /*provera rezultata izvrsavanja SQL upita 
      i ispis informacije o gresci*/
      if(!$result)
               {
                  mysqli_error($konekcija);
               }
               else
               {
                  $uspeh="true";
               }
      //zatvaranje konekcije do BP
      $uspehzkbp=$this->ZatvaranjeKonekcije();
      return $uspeh;
   }
   
   public function Ispis($pBrClana)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka zbog ispisa
      $upit = "UPDATE `clan` SET `Datum ispisa`='$this->DatumIspisa' WHERE `Broj clana`='$pBrClana';";
      //izvrsavanje SQL upita
      $result = mysqli_query($konekcija, $upit);               
      /*provera rezultata izvrsavanja SQL upita 
      i ispis informacije o gresci*/
      if(!$result)
               {
                  mysqli_error($konekcija);
               }
               else
               {
                  $uspeh="true";
               }
      //zatvaranje konekcije do BP
      $uspehzkbp=$this->ZatvaranjeKonekcije();
      return $uspeh;
   }
   
   public function Pretraga($pPrezime)
   {
     //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
     $result = "";
     $uspehzkbp = "";
     $uspeh = "false";
     //otvaranje konekcije do BP
     $konekcija=$this->OtvaranjeKonekcije();
     //formiranje SQL upita za izdvajanje podataka
     $upit = "SELECT * FROM `clan` WHERE `Prezime` LIKE '%pPrezime%' ORDER BY `Prezime`, `Ime`;";
     //izvrsavanje SQL upita
     $result = mysqli_query($konekcija, $upit);               
     /*provera rezultata izvrsavanja SQL upita 
     i ispis informacije o gresci*/
     if(!$result)
              {
                 mysqli_error($konekcija);
              }
           else
              {
                 $uspeh="true";
              }
     //zatvaranje konekcije do BP
     $uspehzkbp=$this->ZatvaranjeKonekcije();
     return $result;
   }
   
   public function Prijava()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL upita za izdvajanje podataka
      $upit = "SELECT * FROM `clan` WHERE `clan`.`Email`='$this->Email' AND `clan`.`Korisnicka sifra`='$this->KorisnickaSifra';";
      //izvrsavanje SQL upita
      $result = mysqli_query($konekcija, $upit);               
      /*provera rezultata izvrsavanja SQL upita 
      i ispis informacije o gresci*/
      if(!$result)
               {
                  mysqli_error($konekcija);
               }
            else
               {
                  $uspeh="true";
               }
      //zatvaranje konekcije do BP
      $uspehzkbp=$this->ZatvaranjeKonekcije();
      return $result;
   }
   
   public function Odjava()
   {
      //Odjava korisnika
      $odjavljen="true";
      return $odjavljen;
   }
   
   public function PotvrdaORazduzenosti($pBrIndeksa)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
     $result = "";
     $uspehzkbp = "";
     $uspeh = "false";
     //otvaranje konekcije do BP
     $konekcija=$this->OtvaranjeKonekcije();
     //formiranje SQL upita za izdvajanje podataka
     $upit = "SELECT `clan`.*, `bibliotecka jedinica`.*, `izdata`.* FROM (`clan` INNER JOIN `izdata` ON `izdata`.`Broj clana` = `clan`.`Broj clana`) INNER JOIN `bibliotecka jedinica` ON `izdata`.`Inventarni broj`=`bibliotecka jedinica`.`Inventarni broj` WHERE `clan`.`Broj indeksa`='$pBrIndeksa';";
     //izvrsavanje SQL upita
     $result = mysqli_query($konekcija, $upit);               
     /*provera rezultata izvrsavanja SQL upita 
     i ispis informacije o gresci*/
     if(!$result)
              {
                 mysqli_error($konekcija);
              }
           else
              {
                 $uspeh="true";
              }
     //zatvaranje konekcije do BP
     $uspehzkbp=$this->ZatvaranjeKonekcije();
     return $result;
   }
   
   public function ZaduzenjaClana($pBrClana)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
     $result = "";
     $uspehzkbp = "";
     $uspeh = "false";
     //otvaranje konekcije do BP
     $konekcija=$this->OtvaranjeKonekcije();
     //formiranje SQL upita za izdvajanje podataka
     $upit = "SELECT `clan`.*, `bibliotecka jedinica`.*, `izdata`.* FROM (`clan` INNER JOIN `izdata` ON `izdata`.`Broj clana` = `clan`.`Broj clana`) INNER JOIN `bibliotecka jedinica` ON `izdata`.`Inventarni broj`=`bibliotecka jedinica`.`Inventarni broj` WHERE `clan`.`Broj clana`='$pBrClana';";
     //izvrsavanje SQL upita
     $result = mysqli_query($konekcija, $upit);               
     /*provera rezultata izvrsavanja SQL upita 
     i ispis informacije o gresci*/
     if(!$result)
              {
                 mysqli_error($konekcija);
              }
           else
              {
                 $uspeh="true";
              }
     //zatvaranje konekcije do BP
     $uspehzkbp=$this->ZatvaranjeKonekcije();
     return $result;
   }  

}
?>