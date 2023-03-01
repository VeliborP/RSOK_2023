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
					<h4>UNOS NOVE BIBLIOTEČKE JEDINICE</h4>
					<?php
						//Preuzimanje podataka iz forme za unos podataka sa stranice za unos nove jedinice
						$InventarniBroj=$_GET['InventarniBroj'];
						$Jezik=$_GET['Jezik'];
						$VrstaJedinice=$_GET['VrstaJedinice'];
						$NazivJedinice=$_GET['NazivJedinice'];
						$Izdavac=$_GET['Izdavac'];
						$GodinaIzdavanja=$_GET['GodinaIzdavanja'];
						$Isbn=$_GET['Isbn'];
						$Stanje=$_GET['Stanje'];
						$Opis=$_GET['Opis'];
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
						$rezultat=$objJedinica->Unos();
			
						//Provera uspesnosti i prikaz poruka
						if ($rezultat=="true")
						{
							echo "Bibliotečka jedinica ".$NazivJedinice." je uspešno upisana u bazu podataka!";    
						}
						else
						{ 
							echo "Bibliotečka jedinica ".$NazivJedinice." nije upisana u bazu podataka! Došlo je do greške... proverite podatke unete na prethodnoj stranici.";
							echo "<br/>";
						}

						//Uništavanje objekta Jezik
						$objJedinica=null;

					//Link za povratak na novi unos
					?>
					<br/><br/>
					<a href="novajedinica.php"><button type="button">Povratak</button></a>
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