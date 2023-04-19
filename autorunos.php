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
					<h4>Autori</h4>
					<?php
						//Preuzimanje podataka iz forme za unos podataka sa prethodne php strane
                        $IdAutora = $_POST['IdAutora'];
                        $Prezime = $_POST['Prezime'];
                        $Ime = $_POST['Ime'];
                        $Napomena = $_POST['Napomena'];

						//Pocetna vrednost resultset-a
						$rezultat="";

						//Kreiranje objekta Jezik
						require 'klase/KonekcijaDB.php';
						require 'klase/Autor.php';
						$objAutor = new Autor();
						//Izvršavanje operacije za dodelu vrednosti atributa
						$objAutor->setIdAutora($IdAutora);
						$objAutor->setPrezime($Prezime);
                        $objAutor->setIme($Ime);
                        $objAutor->setNapomena($Napomena);
						//Izvršavanje operacije za unos podataka u BP
						$rezultat=$objAutor->Dodavanje();
			
						//Provera uspesnosti i prikaz poruka
						if ($rezultat=="true")
						{
							echo "Autor ".$Ime." ".$Prezime." je uspešno upisan u bazu podataka!";    
						}
						else
						{ 
							echo "Autor ".$Ime." ".$Prezime." nije upisan u bazu podataka! Došlo je do greške... proverite podatke unete na prethodnoj stranici.";
							echo "<br/>";
						}

						//Uništavanje objekta Autor
						$objAutor=null;

					//Link za povratak na novi unos
					?>
					<br/><br/>
					<a href="autori.php"><button type="button">Povratak</button></a>
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