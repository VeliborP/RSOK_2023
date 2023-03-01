<?php
class Jezik extends KonekcijaDB
{
   private $IdJezika;
   private $NazivJezika;

   public function getIDJezika()
   {
      return $this->IdJezika;
   }
   public function setIDJezika($p)
   {
	   $this->IdJezika=$p;
   }
   public function getNazivJezika()
   {
      return $this->NazivJezika;
   }
   public function setNazivJezika($p)
   {
      $this->NazivJezika=$p;
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
      $upit = "INSERT INTO `jezik`(`ID jezika`, `Naziv jezika`) VALUES ('$this->IdJezika', '$this->NazivJezika');";
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
   
   public function Izmena($pIDJezika)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka
      $upit = "UPDATE `jezik` SET `ID jezika`='$this->IdJezika',`Naziv jezika`='$this->NazivJezika' WHERE `ID jezika`='$pIDJezika';";
      //echo $upit;
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
      $upit = "SELECT * FROM `jezik` ORDER BY `Naziv jezika` ASC;";
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