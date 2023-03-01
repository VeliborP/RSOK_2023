<?php
class BiblioteckaJedinica extends KonekcijaDB
{
   public $InventarniBroj;
   public $Naziv;
   public $Izdavac;
   public $GodinaIzdavanja;
   public $Isbn;
   public $Stanje;
   public $Opis;
   public $Rashodovana;
   public $DatumOtpisa;
   public $Jezik;
   public $VrstaJedinice;

   public function Unos()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i ostalih promenljivih
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za unos podataka
      $upit = " INSERT INTO `bibliotecka jedinica`(`Inventarni broj`, `ID jezika`, `ID vrste jedinice`, `Naziv`, `Izdavac`, `Godina izdavanja`, `ISBN`, `Stanje`, `Opis`, `Rashodovana`, `Datum otpisa`) VALUES ('$this->InventarniBroj','$this->Jezik','$this->VrstaJedinice','$this->Naziv','$this->Izdavac','$this->GodinaIzdavanja','$this->Isbn','$this->Stanje','$this->Opis','$this->Rashodovana','$this->DatumOtpisa');";
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
   
   public function Izmena($pInvBroj)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka
      $upit = "UPDATE `bibliotecka jedinica` SET `Inventarni broj`='$this->InventarniBroj',`ID jezika`='$this->Jezik',`ID vrste jedinice`='$this->VrstaJedinice',`Naziv`='$this->Naziv',`Izdavac`='$this->Izdavac',`Godina izdavanja`='$this->GodinaIzdavanja',`ISBN`='$this->Isbn',`Stanje`='$this->Stanje',`Opis`='$this->Opis',`Rashodovana`='$this->Rashodovana',`Datum otpisa`='$this->DatumOtpisa' WHERE `Inventarni broj`='$pInvBroj';";
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
   
   public function Brisanje($pInvBroj)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za brisanje podataka
      $upit = "DELETE FROM `bibliotecka jedinica` WHERE `Inventarni broj`='$pInvBroj';";
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
   
   public function Pretraga($pNazivJedinice, $pVrstaJedinice, $pAutorPrezime, $pAutorIme, $pGodina, $pJezik)
   {
       //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
       $result = "";
       $uspehzkbp = "";
       $uspeh = "false";
       $osnovniupit="";
       //otvaranje konekcije do BP
       $konekcija=$this->OtvaranjeKonekcije();
       //formiranje SQL upita za izdvajanje podataka u zavisnosti od kriterijuma pretrage
       //$osnovniupit="SELECT Prezime, Ime, `bibliotecka jedinica`.`Inventarni broj` AS InvBr, `Jezik`.`Naziv jezika`, `Jezik`.`ID jezika`, `bibliotecka jedinica`.`ID vrste jedinice`, `Vrsta jedinice`.`Naziv vrste jedinice`, `Naziv`, `Izdavac`, `Godina izdavanja`, `ISBN`, `Stanje`, `Opis`, `Rashodovana`, `Datum otpisa` FROM `Bibliotecka jedinica`, `Vrsta jedinice`,`Autor`, `Jezik`, `Napisao` WHERE `Autor`.`ID autora`=`Napisao`.`ID autora` AND `bibliotecka jedinica`.`Inventarni broj`=`Napisao`.`Inventarni broj` AND `bibliotecka jedinica`.`ID jezika`=`Jezik`.`ID jezika` AND `bibliotecka jedinica`.`ID vrste jedinice`=`Vrsta jedinice`.`ID vrste jedinice` ";
       $osnovniupit="SELECT `bibliotecka jedinica`.`Inventarni broj` AS InvBr, `bibliotecka jedinica`.`Rashodovana`, `bibliotecka jedinica`.`ID vrste jedinice`, `bibliotecka jedinica`.`ID jezika`, `bibliotecka jedinica`.`Naziv`, `vrsta jedinice`.`Naziv vrste jedinice`, `jezik`.`Naziv jezika`, `autor`.`Prezime`, `autor`.`Ime`, `napisao`.`ID autora`, `bibliotecka jedinica`.`Godina izdavanja` ";
       $osnovniupit=$osnovniupit."FROM `bibliotecka jedinica` "; 
       $osnovniupit=$osnovniupit."LEFT JOIN `vrsta jedinice` ON `bibliotecka jedinica`.`ID vrste jedinice` = `vrsta jedinice`.`ID vrste jedinice` "; 
       $osnovniupit=$osnovniupit."LEFT JOIN `jezik` ON `bibliotecka jedinica`.`ID jezika` = `jezik`.`ID jezika` ";
       $osnovniupit=$osnovniupit."LEFT JOIN `napisao` ON `bibliotecka jedinica`.`Inventarni broj` = `napisao`.`Inventarni broj` ";
       $osnovniupit=$osnovniupit."LEFT JOIN `autor` ON `napisao`.`ID autora` = `autor`.`ID autora` ";
       
       if (!$pNazivJedinice=='')
       {
         $upit = $osnovniupit." WHERE `Naziv` LIKE '%$pNazivJedinice%' ORDER BY `Naziv` ASC;";
       }
       if (!$pVrstaJedinice=='')
       {
         $upit = $osnovniupit." WHERE `Vrsta jedinice`.`Naziv vrste jedinice`='$pVrstaJedinice' ORDER BY `Naziv` ASC;";
       }
       if (!$pAutorPrezime=='')
       {
         $upit = $osnovniupit." WHERE `Autor`.`Prezime` LIKE '%$pAutorPrezime' ORDER BY `Naziv` ASC;";
       }
       if (!$pAutorIme=='')
       {
         $upit = $osnovniupit." WHERE `Autor`.`Ime` LIKE '%$pAutorIme' ORDER BY `Naziv` ASC;";
       }
       if (!$pGodina=='')
       {
         $upit = $osnovniupit." WHERE `Godina izdavanja`='$pGodina' ORDER BY `Naziv` ASC;";
       }
       if (!$pJezik=='')
       {
         $upit = $osnovniupit." WHERE `Jezik`.`Naziv jezika`='$pJezik' ORDER BY `Naziv` ASC;";
       }
       //Ništa nije izabrano za kriterijum pretrage
       if ($pNazivJedinice=='' && $pJezik=='' && $pGodina=='' && $pAutorIme=='' && $pVrstaJedinice=='' && $pAutorPrezime=='')
       {
         $upit = $osnovniupit." ORDER BY `Naziv` ASC;";
       }
       //echo $upit;
       //izvrsavanje SQL upita
       $result = mysqli_query($konekcija, $upit);               
       /*provera rezultata izvrsavanja SQL upita 
       i ispis informacije o gresci*/
       if(!$result)
                {
                   mysqli_error($konekcija);
                }
       //zatvaranje konekcije do BP
       $uspehzkbp=$this->ZatvaranjeKonekcije();
       return $result;
   }

   public function Rashoduj()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka
      $upit = "UPDATE `bibliotecka jedinica` SET `Rashodovana`='$this->Rashodovana',`Datum otpisa`='$this->DatumOtpisa' WHERE `Inventarni broj`='$this->InventarniBroj';";
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

   public function Ucitaj($pInvBroj)
   {
       //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
       $result = "";
       $uspehzkbp = "";
       $uspeh = "false";
       //otvaranje konekcije do BP
       $konekcija=$this->OtvaranjeKonekcije();
       $upit="SELECT * FROM `bibliotecka jedinica` WHERE `Inventarni broj`='$pInvBroj'";
       //izvrsavanje SQL upita
       $result = mysqli_query($konekcija, $upit);               
       /*provera rezultata izvrsavanja SQL upita 
       i ispis informacije o gresci*/
       if(!$result)
                {
                   mysqli_error($konekcija);
                }
       //zatvaranje konekcije do BP
       $uspehzkbp=$this->ZatvaranjeKonekcije();
       return $result;
   }

}
?>