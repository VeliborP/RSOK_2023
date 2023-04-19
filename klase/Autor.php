<?php
class Autor extends KonekcijaDB
{
   public $IdAutora;
   public $Prezime;
   public $Ime;
   public $Napomena;

   public function setIdAutora($p){
      $this->IdAutora=$p;
   }
   public function getIdAutora(){
      return $this->IdAutora;
   }

   public function setPrezime($p){
      $this->Prezime=$p;
   }
   public function getPrezime(){
      return $this->Prezime;
   }

   public function setIme($p){
      $this->Ime=$p;
   }
   public function getIme(){
      return $this->Ime;
   }

   public function setNapomena($p){
      $this->Napomena=$p;
   }
   public function getNapomena(){
      return $this->Napomena;
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
       $upit = "INSERT INTO `autor`(`ID autora`, `Prezime`, `Ime`, `Napomena`) VALUES ('$this->IdAutora','$this->Prezime','$this->Ime','$this->Napomena');";
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
   
   public function Izmena($pIDAutora)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka
      $upit = "UPDATE `autor` SET `ID autora`='$this->IdAutora',`Prezime`='$this->Prezime',`Ime`='$this->Ime',`Napomena`='$this->Napomena' WHERE `ID autora`='pIDAutora';";
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
   
   public function Brisanje($pIDAutora)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za brisanje podataka
      $upit = "DELETE FROM `autor` WHERE `ID autora`='pIDAutora';";
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
      $upit = "SELECT * FROM `autor` ORDER BY `ID autora` ASC;";
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
   
   public function Pretraga()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL upita za izdvajanje podataka
      $upit = "SELECT DISTINCT `ID autora`, `Prezime`, `Ime`, `Napomena` FROM `autor` WHERE `Prezime`='$this->Prezime' OR `Prezime` LIKE '%$this->Prezime%' ORDER BY `Prezime`, `Ime`;";
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