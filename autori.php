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
					<h4>Autori</h4>
					<!-- Forma za unos podataka -->
					<form action="autorunos.php" method="POST">
						<table align="center">
							<tr style="float:center; clear:left; margin-top:10px;">
								<td>ID autora*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="number" name="IdAutora" maxlength=3 size=10 required tabindex=1>
							</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;">
								<td>Prezime autora*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="text" name="Prezime" maxlength=30 size=20 required tabindex=2>
							</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;">
								<td>Ime autora*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="text" name="Ime" maxlength=30 size=20 required tabindex=3>
							</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;">
								<td>Napomena*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="text" name="Napomena" maxlength=30 size=20 required tabindex=4>
							</td>
							</tr>
							<tr style="float:center; clear:right; margin-top:20px;">
								<td></td>
								<td style="float:left; clear:right; margin-top:10px;">
									<input type="submit" name="snimi" value="Unos novog" tabindex=6>
									<button type="reset" name="ponisti" tabindex=7>Poništi</button>
								</td>
							</tr>
						</table>
					</form>
					<?php 
					//Kreiranje objekta Jezik
					require 'klase/KonekcijaDB.php';
					require 'klase/Autor.php';
					$objAutor = new Autor();
					$prikaz="";
					$brojredova=0;
					//Poziv metode za prikaz svih jezika u BP
					$prikaz=$objAutor->PrikazSvih();
					if ($prikaz)
						{
							$brojredova=mysqli_num_rows($prikaz);
						} 
					if ($brojredova>0)
						{
							//echo "Uneto jezika: ".$brojredova;
							//Tabelarni prikaz svih jezika u BP
							echo "<table class='table table-striped'>
							<thead>
							<tr>
							<th scope='col'>ID</th>
							<th scope='col'>Prezime</th>  
							<th scope='col'>Ime</th>
							<th scope='col'>Napomena</th>                                   
							<th scope='col'>Akcija</th>
							</tr>
							</thead><tbody>";

							while($red = mysqli_fetch_array($prikaz))
							{
								echo "<br/>";
								echo "<tr>";
								echo "<td align=left>".$red['ID autora']."</td>";
								echo "<td align=left>".$red['Prezime']."</td>";
								echo "<td align=left>".$red['Ime']."</td>";
								echo "<td align=left>".$red['Napomena']."</td>"; 
										
									$id=$red['ID autora'];
									$prezime=$red['Prezime'];
									$ime=$red['Ime'];
									$napomena=$red['Napomena'];
									
									echo "<td align=left> <form action=' ' method='POST'>";
									echo "<input type='hidden' name='id' value='$id'>";
									echo "<input type='hidden' name='prezime' value='$prezime'>";
									echo "<input type='hidden' name='ime' value='$ime'>";
									echo "<input type='hidden' name='napomena' value='$napomena'>";
									echo "<input type='submit' name='izmena' value='Izmena'>";
									echo "</form> </td>";
									echo "</tr>"; 
							}
							echo "</tbody>
							</table>";   
						}  
						//Uništavanje objekta Jezik
						$objAutor = null;               
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