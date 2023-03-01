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
					<h4>RASHODOVANJE BIBLIOTEČKE JEDINICE</h4>
					<?php
						//Preuzimanje podataka iz forme sa stranice za prikaz pretrage fonda
						$InventarniBroj=$_POST['invbr'];
						//Vrednosti koje se ne unose na prethodnoj veb stranici
						$Rashodovana="1";
						//Ocitati sistemski datum kao datum otpisa
						$DatumOtpisa=date('d.m.Y');						
						//Pocetna vrednost resultset-a
						$rezultat="";
						//Kreiranje objekta BiblioteckaJedinica
						require 'klase/KonekcijaDB.php';
						require 'klase/BiblioteckaJedinica.php';
						$objJedinica = new BiblioteckaJedinica();						
						//Dodela vrednosti atributima objekta
						$objJedinica->InventarniBroj=$InventarniBroj;
						$objJedinica->Rashodovana=$Rashodovana;
						$objJedinica->DatumOtpisa=$DatumOtpisa;
						//Izvršavanje operacije za unos podataka u BP
						$rezultat=$objJedinica->Rashoduj();
						//Provera uspesnosti i prikaz poruka
						if ($rezultat=="true")
						{
							echo "Bibliotečka jedinica ".$InventarniBroj." je uspešno rashodovana!";    
						}
						else
						{ 
							echo "Bibliotečka jedinica ".$InventarniBroj." nije rashodovana! Došlo je do greške...";
							echo "<br/>";
						}
						//Uništavanje objekta Jezik
						$objJedinica=null;
					//Link za povratak na novu pretragu
					?>
					<br/><br/>
					<a href="pretragafonda.php"><button type="button">Povratak na pretragu fonda</button></a>
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