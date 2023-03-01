<?php 
	session_start();
	$status=$_SESSION["status"];
	$username=$_SESSION["username"];
	$prezime=$_SESSION["prezime"];
	$ime=$_SESSION["ime"];
	$idkorisnika=$_SESSION["idclana"];
	if ($status=="") //provera statusa zbog sprecavanja direktnog pristupa stranici
		{
			header ('Location:index.php');
		}
?>
<!DOCTYPE HTML>
<html>
	<?php include "head.html"; ?>
	
	<body>
	<div class="fh5co-loader"></div>
	
<!-- Meni -->

<?php 
	//prikaz odgovarajuceg sadrzaja menija
	if ($status=="bibliotekar")
	{
		include "meniupbibliotekar.html";
	}
	if ($status=="clan")
	{
		include "meniupclan.html";
	}
?>

<!-- Sredina stranice -->

	<div id="fh5co-course-categories">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h4>IZMENA BIBLIOTEČKE JEDINICE</h4>
					<?php
						//Preuzimanje podataka iz forme za izmenu podataka sa stranice za unos nove jedinice
						$StariInventarniBroj=$_POST['stariinvbr'];
						$InventarniBroj=$_POST['InventarniBroj'];
						$Jezik=$_POST['Jezik'];
						$VrstaJedinice=$_POST['VrstaJedinice'];
						$NazivJedinice=$_POST['NazivJedinice'];
						$Izdavac=$_POST['Izdavac'];
						$GodinaIzdavanja=$_POST['GodinaIzdavanja'];
						$Isbn=$_POST['Isbn'];
						$Stanje=$_POST['Stanje'];
						$Opis=$_POST['Opis'];
						//Vrednosti koje se ne unose na prethodnoj veb stranici
						$Rashodovana="0";
						$DatumOtpisa="";
						//Pocetna vrednost resultset-a
						$rezultat="";

						//Kreiranje objekta BiblioteckaJedinica
						require 'klase/KonekcijaDB.php';
						require 'klase/BiblioteckaJedinica.php';
						$objJedinica = new BiblioteckaJedinica();
						//Dodela vrednosti atributima objekta
						$objJedinica->InventarniBroj=$InventarniBroj;
						$objJedinica->Naziv=$NazivJedinice;
						$objJedinica->Izdavac=$Izdavac;
						$objJedinica->GodinaIzdavanja=$GodinaIzdavanja;
						$objJedinica->Isbn=$Isbn;
						$objJedinica->Stanje=$Stanje;
						$objJedinica->Opis=$Opis;
						$objJedinica->Rashodovana=$Rashodovana;
						$objJedinica->DatumOtpisa=$DatumOtpisa;
						$objJedinica->Jezik=$Jezik;
						$objJedinica->VrstaJedinice=$VrstaJedinice;
						//Izvršavanje operacije za unos podataka u BP
						$rezultat=$objJedinica->Izmena($StariInventarniBroj);
			
						//Provera uspesnosti i prikaz poruka
						if ($rezultat=="true")
						{
							echo "Bibliotečka jedinica ".$NazivJedinice." je uspešno promenjena u bazi podataka!";    
						}
						else
						{ 
							echo "Bibliotečka jedinica ".$NazivJedinice." nije promenjena u bazi podataka! Došlo je do greške... proverite podatke izmenjene na prethodnoj stranici.";
							echo "<br/>";
						}
						//Uništavanje objekta Jezik
						$objJedinica=null;
					//Link za povratak na novi unos
					?>
				</div>
			</div>
		</div>
	</div>

<!-- Meni -->

<?php 
	//prikaz odgovarajuceg sadrzaja menija
	if ($status=="bibliotekar")
	{
		include "menidownbibliotekar.html";
	}
	if ($status=="clan")
	{
		include "menidownclan.html";
	}
?>

<!-- Footer stranice -->
  
	<?php include "footer.html"; ?>

	</body>
</html>