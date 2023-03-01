<?php
class KonekcijaDB
{
   protected $ImeServera="localhost";
   protected $Korisnik="root";
   protected $Sifra="";
   protected $BazaPodataka="biblioteka";
   public $Konekcija;

   public function OtvaranjeKonekcije()
   {
     //Otvaranje konekcije do BP
     $this->Konekcija='';
     $this->Konekcija=mysqli_connect($this->ImeServera,$this->Korisnik,$this->Sifra,$this->BazaPodataka);
     if (!$this->Konekcija)
     {
        echo('Nije uspostavljena konekcija do baze podataka!');
     }
     return $this->Konekcija;
   }
   
   public function ZatvaranjeKonekcije()
   {
       //Zatvaranje konekcije do BP uz
       //proveru da li je otvorena pre zatvaranja
       $uspeh="false";
       if($this->Konekcija)
         {
            mysqli_close($this->Konekcija);
            $uspeh="true";
         }
       return $uspeh;
   } 

}
?>