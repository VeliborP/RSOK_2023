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
						$ID=$_POST['id'];
						$Naziv=$_POST['naziv'];					
					?>
					<!-- Forma za unos/izmenu podataka -->
					<form action="vrstejedinicaizmenasnimi.php" method="POST">
						<table align="center">
							<tr style="float:center; clear:left; margin-top:10px;"><td>ID vrste jedinice*</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="number" name="IdVrsteJedinice" value="<?php echo $ID;?>" maxlenth=3 size=10 required tabindex=1></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>Naziv vrste jedinice*</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="NaziVrsteJedinice" value="<?php echo $Naziv;?>" maxlenth=20 size=20 required tabindex=2></td>
							</tr>
							<tr style="float:center; clear:right; margin-top:20px;">
								<td></td>
								<td style="float:left; clear:right; margin-top:10px;">
									<input type='hidden' name='stariid' value="<?php echo $ID;?>">
									<input type="submit" name="snimi" value="Snimi izmene" tabindex=3>
									<button type="reset" name="ponisti" tabindex=4>Odustani</button>
								</td>
							</tr>
						</table>
					</form>
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