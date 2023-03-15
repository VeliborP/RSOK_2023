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
					<h4>BIBLIOTEKARI - IZMENA</h4>
					<?php
						//Preuzimanje podataka iz forme za unos podataka sa prethodne php strane
						$IdBibliotekara = $_POST['id'];
                        $Prezime = $_POST['prezime'];
                        $Ime = $_POST['ime'];
                        $Email = $_POST['email'];
                        $Sifra = $_POST['sifra'];			
					?>
					<!-- Forma za unos/izmenu podataka -->
					<form action="bibliotekariizmenasnimi.php" method="POST">
						<table align="center">
							<tr style="float:center; clear:left; margin-top:10px;">
								<td>ID bibliotekara*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="number" name="IdBibliotekara" maxlength=3 size=10 required tabindex=1>
							</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;">
								<td>Prezime bibliotekara*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="text" name="Prezime" maxlength=30 size=20 required tabindex=2>
							</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;">
								<td>Ime bibliotekara*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="text" name="Ime" maxlength=30 size=20 required tabindex=3>
							</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;">
								<td>Email*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="text" name="Email" maxlength=30 size=20 required tabindex=4>
							</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;">
								<td>Korisnicka sifra*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="text" name="KorisnickaSifra" maxlength=30 size=20 required tabindex=5>
							</td>
							</tr>
							<tr style="float:center; clear:right; margin-top:20px;">
								<td></td>
								<td style="float:left; clear:right; margin-top:10px;">
                                    <input type='hidden' name='stariid' value="<?php echo $IdBibliotekara;?>">
									<input type="submit" name="snimi" value="Unos novog" tabindex=6>
									<button type="reset" name="ponisti" tabindex=7>Poništi</button>
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