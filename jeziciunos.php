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
					<h4>JEZICI</h4>
					<?php
						//Preuzimanje podataka iz forme za unos podataka sa prethodne php strane
						$ID=$_POST['IdJezika'];
						$Naziv=$_POST['NazivJezika'];
						//Pocetna vrednost resultset-a
						$rezultat="";

						//Kreiranje objekta Jezik
						require 'klase/KonekcijaDB.php';
						require 'klase/Jezik.php';
						$objJezik = new Jezik();
						//Izvršavanje operacije za dodelu vrednosti atributa
						$objJezik->setIDJezika($ID);
						$objJezik->setNazivJezika($Naziv);
						//Izvršavanje operacije za unos podataka u BP
						$rezultat=$objJezik->Dodavanje();
			
						//Provera uspesnosti i prikaz poruka
						if ($rezultat=="true")
						{
							echo "Jezik ".$Naziv." je uspešno upisan u bazu podataka!";    
						}
						else
						{ 
							echo "Jezik ".$Naziv." nije upisan u bazu podataka! Došlo je do greške... proverite podatke unete na prethodnoj stranici.";
							echo "<br/>";
						}

						//Uništavanje objekta Jezik
						$objJezik=null;

					//Link za povratak na novi unos
					?>
					<br/><br/>
					<a href="jezici.php"><button type="button">Povratak</button></a>
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