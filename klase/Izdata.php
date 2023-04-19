<?php
class Izdata extends KonekcijaDB
{
   public $RbIzdavanja;
   public $DatumIzdavanja;
   public $DatumVracanja;
   public $Period;
   public $Clan;
   public $Jedinica;
   public $Bibliotekar;
   public $InventarniBroj;

   public function Izdavanje()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i ostalih promenljivih
      $resultClanIspisan = "";
      $resultOpomena = "";
      $resultRashodovana = "";
      $resultIzdataJedinica = "";
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //Prilikom izdavanja bibliotecke jedninice 
      //clanu treba proveriti:
      //1.da li je clan ispisan
      //2.da li clan ima opomenu
      //3.da li je jedinica rashodovana
      //4.da li je jedinica trenutno izdata
      //U slucaju da je ispunjen bar jedan 
      //od ova 4 uslova jedinica se ne sme izdati clanu!
      //Provera da li je clan ispisan
      $upit = "SELECT `Broj clana`, `Prezime`, `Ime`, `Telefon`, `Email`, `Broj indeksa`, `Sifra zaposlenog`, `Korisnicka sifra`, `Datum ispisa`, `Opomena` FROM `clan` WHERE `Broj clana`='$this->Clan' and `Datum ispisa` IS NOT NULL;";
      $resultClanIspisan = mysqli_query($konekcija, $upit); 
      //Provera da li je clan ima opomenu
      $upit = "SELECT `Broj clana`, `Prezime`, `Ime`, `Telefon`, `Email`, `Broj indeksa`, `Sifra zaposlenog`, `Korisnicka sifra`, `Datum ispisa`, `Opomena` FROM `clan` WHERE `Broj clana`='$this->Clan' and `Opomena` IS NOT NULL;";
      $resultOpomena = mysqli_query($konekcija, $upit); 
      //Provera da li je jedinica rashodovana ili otpisana
      $upit = "SELECT * FROM `bibliotecka jedinica` WHERE (`Datum otpisa` IS NOT NULL OR Rashodovana=1) AND `Inventarni broj`='$this->InventarniBroj';";
      $resultRashodovana = mysqli_query($konekcija, $upit); 
      //Provera da li je jedinica trenutno izdata
      $upit = "SELECT * FROM `izdata` WHERE `Datum vracanja` IS NULL AND `Inventarni broj`='$this->InventarniBroj';";
      $resultIzdataJedinica = mysqli_query($konekcija, $upit); 
      //Izdavanje jedinice clanu
      if (!$resultClanIspisan=="" && !$resultOpomena && !$resultRashodovana && !$resultIzdataJedinica)
      {
         $upit = "INSERT INTO `izdata`(`RB izdavanja`, `Broj clana`, `Inventarni broj`, `ID bibliotekara`, `Datum izdavanja`, `Datum vracanja`, `Period`) VALUES ('$this->RbIzdavanja','$this->Clan','$this->InventarniBroj','$this->Bibliotekar','$this->DatumIzdavanja','$this->DatumVracanja','$this->Period');";
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
      }
      else 
      {
         $uspeh="false";
      }          
      //zatvaranje konekcije do BP
      $uspehzkbp=$this->ZatvaranjeKonekcije();
      return $uspeh;
   }
   
   public function Vracanje()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka
      $upit = "UPDATE `izdata` SET `Datum vracanja`='$this->DatumVracanja' WHERE `RB izdavanja`='$this->RbIzdavanja';";
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
   
   public function KreiranjeOpomena($pBrClana)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $datum = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka
      //ocitati sistemski datum kao deo teksta opomene
      $datum=date('d.m.Y');
      $upit = "UPDATE `clan` SET `Opomena`='Opomena izdata ".$datum."' WHERE `Broj clana`='$pBrClana';";
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
                  //slanje poruke na email
                  //...
               }
      //zatvaranje konekcije do BP
      $uspehzkbp=$this->ZatvaranjeKonekcije();
      
      return $uspeh;
   }
   
   public function PretragaOpomena($pBrClana, $pDatum)
   {
       //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
       $result = "";
       $uspehzkbp = "";
       $uspeh = "false";
       //otvaranje konekcije do BP
       $konekcija=$this->OtvaranjeKonekcije();
       //formiranje SQL upita za izdvajanje podataka
       if (!$pBrClana=='')
       {
         $upit = "SELECT * FROM `clan` WHERE `Broj clana`='pBrClana';";
       }
       //datum opomene se nalazi u delu teksta opomene
       //i ne postoji kao poseban atribut i kolona tabele BP
       if (!$pDatum=='')
       {
         $upit = "SELECT * FROM `clan` WHERE `Opomena` LIKE '%pDatum%';";
       }
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
   
   public function IzvestajOpomene()
   {
       //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
       $result = "";
       $uspehzkbp = "";
       $uspeh = "false";
       //otvaranje konekcije do BP
       $konekcija=$this->OtvaranjeKonekcije();
       //formiranje SQL upita za izdvajanje podataka
       //datum opomene se nalazi u delu teksta opomene
       //i ne postoji kao poseban atribut i kolona tabele BP
       $upit = "SELECT `bibliotecka jedinica`.*, `izdata`.*, `clan`.* 
               FROM (`bibliotecka jedinica` INNER JOIN `izdata` ON `izdata`.`Inventarni broj` = `bibliotecka jedinica`.`Inventarni broj`) 
               RIGHT JOIN `clan` ON `izdata`.`Broj clana` = `clan`.`Broj clana` 
               WHERE Opomena<>'';";

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
   
   public function PrikazZaduzenja($pBrClana)
   {
       //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
       $result = "";
       $uspehzkbp = "";
       $uspeh = "false";
       //otvaranje konekcije do BP
       $konekcija=$this->OtvaranjeKonekcije();
       //formiranje SQL upita za izdvajanje podataka
       if (!$pBrClana=='')
       {
         //$upit = "SELECT `RB izdavanja`, `Broj clana`, `Inventarni broj`, `ID bibliotekara`, `Datum izdavanja`, `Datum vracanja`, `Period` FROM `izdata` WHERE `Broj clana`='pBrClana';";
       $upit = "SELECT `RB izdavanja`, `Broj clana`, `Inventarni broj`, `ID bibliotekara`, `Datum izdavanja`, `Datum vracanja`, `Period` 
               FROM `izdata` WHERE `Broj clana`='".$pBrClana."';";
       }
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