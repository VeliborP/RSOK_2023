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
					<h4>IZMENA BIBLIOTEČKE JEDINICE</h4>
					<?php
						//Preuzimanje podataka iz e za prikaz sa prethodne php strane
						$InvBroj=$_POST['invbr'];
						//Ucitavanje svih podataka dela koje se menja	
						//Kreiranje objekta BiblioteckaJedinica
						require 'klase/KonekcijaDB.php';
						require 'klase/BiblioteckaJedinica.php';
						$objJedinica = new BiblioteckaJedinica();
						//Izvršavanje operacije za unos podataka u BP
						$rezultat=$objJedinica->Ucitaj($InvBroj);	
						if ($rezultat)
						{
							$brojredova=mysqli_num_rows($rezultat);
						} 
						$red="";
						//Ucitavanje podataka za izmenu
						if ($brojredova>0)
						{
							while($red = mysqli_fetch_array($rezultat))
							{
								$Naziv=$red['Naziv'];
								$Godina=$red['Godina izdavanja'];
								$IDJezika=$red['ID jezika'];
								$IDVrste=$red['ID vrste jedinice'];
								$Izdavac=$red['Izdavac'];
								$ISBN=$red['ISBN'];
								$Stanje=$red['Stanje'];
								$Opis=$red['Opis'];
							}		
						}
						else
						{
							$Naziv="";
							$Godina="";
							$IDJezika="";
							$IDVrste="";
							$Izdavac="";
							$ISBN="";
							$Stanje="";
							$Opis="";
							$InvBroj="";
						}	
					?>
					<!-- Forma za izmenu podataka -->
					<form action="jedinicaizmenasnimi.php" method="POST">
						<table align="center">
							<tr style="float:center; clear:left; margin-top:10px;"><td>Inventarni broj*</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="InventarniBroj" autofocus  value="<?php echo $InvBroj; ?>" onKeyPress="if(this.value.length==10) return false;" size=10 placeholder="Upišite inventarni broj" required tabindex=1></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>Jezik*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
									<select class="form-control" id="Jezik" name="Jezik" tabindex=2 required>
									<option value="">izaberite jezik...</option>
									<?php
										//Pocetne vrednosti promenljivih
										$result="";
										$brredova=0;
										//Kreiranje objekta Jezik
										require 'klase/Jezik.php';
										$objJezik = new Jezik();
										//Izvršavanje operacije za prikaz svih jezika
										$result=$objJezik->PrikazSvih();
										$brredova = mysqli_num_rows($result);
										if ($brredova>0)
										{
											$i=0;
											$red=0;
											while($red=mysqli_fetch_array($result))
											{
												$i++;
												$niz1[$i]=$red['Naziv jezika'];
												$niz2[$i]=$red['ID jezika'];
												//echo "<option value='$niz2[$i]'>$niz1[$i]</option>";
												if ($niz2[$i]==$IDJezika)
												{
													echo "<option value='$niz2[$i]' selected>$niz1[$i]</option>";
												}
												else
												{ 
													echo "<option value='$niz2[$i]'>$niz1[$i]</option>";
												}
											} 
										}
										$objJezik = null;
									?>
									</select>
								</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>Vrsta jedinice*</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<select class="form-control" id="VrstaJedinice" name="VrstaJedinice" tabindex=3 required>
									<option value="">izaberite vrstu jedinice...</option>
									<?php
										//Pocetne vrednosti promenljivih
										$result="";
										$brredova=0;
										//Kreiranje objekta Jedinica
										require 'klase/VrstaJedinice.php';
										$objJedinica = new VrstaJedinice();
										//Izvršavanje operacije za prikaz svih vrsta jedinica
										$result=$objJedinica->PrikazSvih();
										$brredova = mysqli_num_rows($result);
										if ($brredova>0)
										{
											$i=0;
											$red=0;
											while($red=mysqli_fetch_array($result))
											{
												$i++;
												$niz1[$i]=$red['Naziv vrste jedinice'];
												$niz2[$i]=$red['ID vrste jedinice'];
												//echo "<option value='$niz2[$i]'>$niz1[$i]</option>";
												if ($niz2[$i]==$IDVrste)
												{
													echo "<option value='$niz2[$i]' selected>$niz1[$i]</option>";
												}
												else
												{ 
													echo "<option value='$niz2[$i]'>$niz1[$i]</option>";
												}
											} 
										}
										//Uništavanje objekta
										$objJedinica = null;
									?>
									</select>
								</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>Naziv bibliotečke jedinice*</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="NazivJedinice" value="<?php echo $Naziv; ?>" onKeyPress="if(this.value.length==100) return false;" size=30 required placeholder="Upišite naziv jedinice" tabindex=4></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>Izdavač*</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="Izdavac" value="<?php echo $Izdavac; ?>" onKeyPress="if(this.value.length==50) return false;" size=30 required placeholder="Upišite izdavača" tabindex=5></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>Godina izdavanja*</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="number" name="GodinaIzdavanja" value="<?php echo $Godina; ?>" onKeyPress="if(this.value.length==4) return false;" size=10 required placeholder="Upišite godinu izdavanja" tabindex=6></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>ISBN</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="Isbn" onKeyPress="if(this.value.length==20) return false;" value="<?php echo $Izdavac; ?>" size=20 placeholder="Upišite ISBN broj" tabindex=7></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>Stanje</td> 
								<td style="float:left; clear:right; margin-top:10px;">
								<input type="radio" id="ocuvana" name="Stanje" value="ocuvana" <?php if ($Stanje=="ocuvana") {echo "checked";}?> tabindex=8> <label for="ocuvana">očuvana</label> <br/>
								<input type="radio" id="ostecena" name="Stanje" value="ostecena" <?php if ($Stanje=="ostecena") {echo "checked";}?> tabindex=9> <label for="ostecena">oštećena</label>
								</td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>Opis</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="Opis" onKeyPress="if(this.value.length==1000) return false;" value="<?php echo $Opis; ?>" size=50 placeholder="Upišite opis jedinice" tabindex=10></td>
							</tr>
							<tr style="float:center; clear:right; margin-top:20px;">
								<td></td>
								<td style="float:left; clear:right; margin-top:10px;">
									<input type='hidden' name='stariinvbr' value="<?php echo $InvBroj;?>">
									<input type="submit" name="snimi" value="Snimi izmene" tabindex=11>
									<button type="reset" name="ponisti" tabindex=11>Poništi</button>
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