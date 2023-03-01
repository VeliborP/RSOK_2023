<!DOCTYPE HTML>
<html>
	<?php include "head.html"; ?>
	
	<body>
	<div class="fh5co-loader"></div>
	
<!-- Meni -->

	<?php include "meniupindex.html"; ?>

<!-- Sredina stranice -->

	<div id="fh5co-course-categories">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h4>PRETRAGA BIBLIOTEČKOG FONDA</h4>
					<!-- Forma za unos podataka -->
					<form action="prikazpretragefondaindex.php" method="POST">
						<table align="center">
							<tr style="float:center; clear:left; margin-top:10px;"><td>po nazivu:</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="Naziv" maxlenth=20 size=20 autofocus tabindex=1></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>po jeziku:</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="Jezik" maxlenth=20 size=20 tabindex=2></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>po prezimenu autora:</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="Prezime" maxlenth=20 size=20 tabindex=3></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>po imenu autora:</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="Ime" maxlenth=20 size=20 tabindex=4></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>po vrsti jedinice:</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="VrstaJedinice" maxlenth=20 size=20 tabindex=5></td>
							</tr>
							<tr style="float:center; clear:left; margin-top:10px;"><td>po godini izdavanja:</td> 
								<td style="float:left; clear:right; margin-top:10px;"><input type="text" name="GodinaIzdavanja" maxlenth=20 size=20 tabindex=6></td>
							</tr>
							<tr style="float:center; clear:right; margin-top:20px;">
								<td></td>
								<td style="float:left; clear:right; margin-top:10px;">
									<input type="submit" name="snimi" value="Pronađi" tabindex=6>
									<button type="reset" name="novkriterijum" tabindex=7>Nova pretraga</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>

<!-- Meni -->

<?php include "menidownindex.html"; ?>

<!-- Footer stranice -->
  
	<?php include "footer.html"; ?>

	</body>
</html>