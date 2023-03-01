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
	
<!-- Meni gore -->

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
					<h4>ZADUŽENJA STUDENTA</h4>
					<?php 
					//Odrediti vrednosti broja clana/clanske karte iz aktivne sesije
					$pBrClana=$idkorisnika;
					//Kreiranje objekta Jedinica
					require 'klase/KonekcijaDB.php';
					require 'klase/Izdata.php';
					$objZaduzenja = new Izdata();
					$prikaz="";
					$brojredova=0;
					//Poziv metode za prikaz svih jezika u BP
					$prikaz=$objZaduzenja->PrikazZaduzenja($pBrClana);
					if ($prikaz)
						{
							$brojredova=mysqli_num_rows($prikaz);
						} 
					$red="";
					if ($brojredova>0)
						{
							//Tabelarni prikaz pronadjenih zaduzenja
							echo "<table class='table table-striped'>
							<thead>
							<tr>
							<th scope='col'>Broj člana</th>
							<th scope='col'>Naziv jedinice</th>
							<th scope='col'>Inventarni broj</th> 							
							<th scope='col'>Datum zaduživanja</th>  
							<th scope='col'>Vraćeno</th> 
							<th scope='col'>Period (mesec)</th>							
							</tr>
							</thead><tbody>";

							$red="";
							while($red = mysqli_fetch_array($prikaz))
							{
								echo "<tr>
									<td align=left>".$red['BrClana']."</td>
									<td align=left>".$red['Naziv']."</td>
									<td align=left>".$red['InvBr']."</td>
									<td align=left>".$red['Datum izdavanja']."</td>
									<td align=left>".$red['Datum vracanja']."</td>
									<td align=left>".$red['Period']."</td>
									  </tr>";
							}
							echo "</tbody>
							</table>";   
						}  
						//Uništavanje objekta Zaduzenja
						$objZaduzenja = null;               
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