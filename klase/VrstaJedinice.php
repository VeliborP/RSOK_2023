<?php
class VrstaJedinice extends KonekcijaDB
{
   public $IdVrsteJedinice;
   public $NazivVrsteJedinice;

   public function Dodavanje()
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za unos podataka
      $upit = "INSERT INTO `vrsta jedinice`(`ID vrste jedinice`, `Naziv vrste jedinice`) VALUES ('$this->IdVrsteJedinice', '$this->NazivVrsteJedinice');";
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
   
   public function Izmena($pIDVrsteJedinice)
   {
      //pocetne vrednosti result-seta (dvodimenzionalna matrica, tj. tabela) i promenljive uspeh
      $result = "";
      $uspehzkbp = "";
      $uspeh = "false";
      //otvaranje konekcije do BP
      $konekcija=$this->OtvaranjeKonekcije();
      //formiranje SQL DML upita za izmenu podataka
      $upit = "UPDATE `vrsta jedinice` SET `ID vrste jedinice`='$this->IdVrsteJedinice',`Naziv vrste jedinice`='$this->NazivVrsteJedinice' WHERE `ID vrste jedinice`='$pIDVrsteJedinice';";
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
      $upit = "SELECT * FROM `vrsta jedinice` ORDER BY `Naziv vrste jedinice` ASC;";
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