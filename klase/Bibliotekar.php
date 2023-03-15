<?php
class Bibliotekar extends KonekcijaDB
{
   public $IdBibliotekara;
   public $Prezime;
   public $Ime;
   public $Email;
   public $KorisnickaSifra;

   public function getIdBibliotekara()
   {
      return $this->IdBibliotekara;
   }
   public function setIdBibliotekara($p)
   {
	   $this->IdBibliotekara=$p;
   }

   public function getPrezime()
   {
      return $this->Prezime;
   }
   public function setPrezime($p)
   {
	   $this->Prezime=$p;
   }
   
   public function getIme()
   {
      return $this->Ime;
   }
   public function setIme($p)
   {
	   $this->Ime=$p;
   }
   
   public function getEmail()
   {
      return $this->Email;
   }
   public function setEmail($p)
   {
	   $this->Email=$p;
   }
   
   public function getKorisnickaSifra()
   {
      return $this->KorisnickaSifra;
   }
   public function setKorisnickaSifra($p)
   {
	   $this->KorisnickaSifra=$p;
   }

   public function Dodavanje()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i ostalih promenljivih
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za unos podataka
      $upit = "INSERT INTO `bibliotekar` (`ID bibliotekara`, `Prezime`, `Ime`, `Email`, `Korisnicka sifra`) 
               VALUES ('$this->IdBibliotekara','$this->Prezime','$this->Ime','$this->Email','$this->KorisnickaSifra');";
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
   
   public function Izmena($pIDbibliotekara)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka
      $upit = "UPDATE `bibliotekar` 
               SET `ID bibliotekara`='$this->IdBibliotekara',`Prezime`='$this->Prezime',`Ime`='$this->Ime',`Email`='$this->Email',`Korisnicka sifra`='$this->KorisnickaSifra' 
               WHERE `ID bibliotekara`='pIDbibliotekara';";
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
   
   public function PrikazSvih()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL upita za izdvajanje podataka
      $upit = "SELECT * FROM `bibliotekar` ORDER BY Prezime ASC;";
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
      $upit = "SELECT `ID bibliotekara`, `Prezime`, `Ime`, `Email`, `Korisnicka sifra` FROM `bibliotekar` WHERE `bibliotekar`.`Email`='$this->Email' AND `bibliotekar`.`Korisnicka sifra`='$this->KorisnickaSifra';";
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

}
?>