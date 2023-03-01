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
					<h4>VRSTE BIBLIOTEČKIH JEDINICA - IZMENA</h4>
					<?php
						//Preuzimanje podataka iz forme za unos podataka sa prethodne php strane
						$ID=$_POST['IdVrsteJedinice'];
						$Naziv=$_POST['NaziVrsteJedinice'];
						$StariID=$_POST['stariid'];
						$rezultat="";

						//Kreiranje objekta Vrsta biliotecke jedinice
						require 'klase/KonekcijaDB.php';
						require 'klase/VrstaJedinice.php';
						$objVrstaJedinice = new VrstaJedinice();
						$objVrstaJedinice->IdVrsteJedinice=$ID;
						$objVrstaJedinice->NazivVrsteJedinice=$Naziv;
						//Izvršavanje operacije za izmenu podataka u BP
						$rezultat=$objVrstaJedinice->Izmena($StariID);
				
						//Provera uspesnosti i prikaz poruka
						if ($rezultat)
						{
							echo "Vrsta bibliotečke jedinice ".$Naziv." je uspešno promenjena u bazi podataka!";    
						}
						else
						{ 
							echo "Bibliotečka jedinica ".$Naziv." nije promenjena u bazi podataka! Došlo je do greške... proverite podatke promenjene na prethodnoj stranici.";
							echo "<br/>";
						}

						//Uništavanje objekta Vrsta biliotecke jedinice
						$objVrstaJedinice=null;

					//Link za povratak na unos i prikaz
					?>
					<br/><br/>
					<a href="vrstejedinica.php"><button type="button">Povratak</button></a>
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