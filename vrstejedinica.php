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
					<h4>VRSTE BIBLIOTEČKIH JEDINICA</h4>
					<!-- Forma za unos podataka -->
					<form action="vrstejedinicaunos.php" method="POST">
						<table align="center">
							<tr style="float:center; clear:left; margin-top:10px;"><td>ID vrste jedinice*</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="number" name="IdVrsteJedinice" maxlenth=3 size=10 required tabindex=1></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>Naziv vrste jedinice*</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="NaziVrsteJedinice" maxlenth=20 size=20 required tabindex=2></td>
							</tr>
							<tr style="float:center; clear:right; margin-top:20px;">
								<td></td>
								<td style="float:left; clear:right; margin-top:10px;">
									<input type="submit" name="snimi" value="Unos nove" tabindex=3>
									<button type="reset" name="ponisti" tabindex=4>Poništi</button>
								</td>
							</tr>
						</table>
					</form>
					<?php 
					//Kreiranje objekta
					require 'klase/KonekcijaDB.php';
					require 'klase/VrstaJedinice.php';
					$objVrstaJedinice = new VrstaJedinice();
					$prikaz="";
					$brojredova=0;
					$prikaz=$objVrstaJedinice->PrikazSvih();
					if ($prikaz)
						{
							$brojredova=mysqli_num_rows($prikaz);
						} 
					if ($brojredova>0)
						{
							//echo "Uneto vrsta jedinica: ".$brojredova;
							echo "<table class='table table-striped'>
							<thead>
							<tr>
							<th scope='col'>ID</th>
							<th scope='col'>Naziv</th>                                   
							<th scope='col'>Akcija</th>
							</tr>
							</thead>";

							while($red = mysqli_fetch_array($prikaz))
							{
								echo "<br/>
									<tr>
									<td align=left>".$red['ID vrste jedinice']."</td>
									<td align=left>".$red['Naziv vrste jedinice']."</td>"; 
										
									$id=$red['ID vrste jedinice'];
									$naziv=$red['Naziv vrste jedinice'];
									
									echo "<td align=left> <form action='vrstejedinicaizmena.php' method='POST'>";
									echo "<input type='hidden' name='id' value='$id'>";
									echo "<input type='hidden' name='naziv' value='$naziv'>";
									echo "<input type='submit' name='izmena' value='Izmena'>";
									echo "</form> </td>"; 
							}
							echo "</tbody>
							</table>";   
						}  
						//Uništavanje objekta
						$objVrstaJedinice = null;               
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