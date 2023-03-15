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
					<h4>Bibliotekari</h4>
					<?php
						//Preuzimanje podataka iz forme za unos podataka sa prethodne php strane
                        $IdBibliotekara = $_POST['IdBibliotekara'];
                        $Prezime = $_POST['Prezime'];
                        $Ime = $_POST['Ime'];
                        $Email = $_POST['Email'];
                        $Sifra = $_POST['KorisnickaSifra'];

						//Pocetna vrednost resultset-a
						$rezultat="";

						//Kreiranje objekta Jezik
						require 'klase/KonekcijaDB.php';
						require 'klase/Bibliotekar.php';
						$objBibliotekar = new Bibliotekar();
						//Izvršavanje operacije za dodelu vrednosti atributa
						$objBibliotekar->setIdBibliotekara($IdBibliotekara);
						$objBibliotekar->setPrezime($Prezime);
                        $objBibliotekar->setIme($Ime);
                        $objBibliotekar->setEmail($Email);
                        $objBibliotekar->setKorisnickaSifra($Sifra);
						//Izvršavanje operacije za unos podataka u BP
						$rezultat=$objBibliotekar->Dodavanje();
			
						//Provera uspesnosti i prikaz poruka
						if ($rezultat=="true")
						{
							echo "Bibliotekar ".$Ime." ".$Prezime." je uspešno upisan u bazu podataka!";    
						}
						else
						{ 
							echo "Bibliotekar ".$Ime." ".$Prezime." nije upisan u bazu podataka! Došlo je do greške... proverite podatke unete na prethodnoj stranici.";
							echo "<br/>";
						}

						//Uništavanje objekta Bibliotekar
						$objBibliotekar=null;

					//Link za povratak na novi unos
					?>
					<br/><br/>
					<a href="bibliotekari.php"><button type="button">Povratak</button></a>
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