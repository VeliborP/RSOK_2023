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
					<h3>Prijava korisnika</h3>
					<form action="proverakorisnika.php" method="POST">
						<table align="center">
							<tr align="center" style="float:left; clear:left; margin-top:10px;"><td align="center">E-Mail:</td> 
								<td align="center" style="float:left; clear:right; margin-top:10px;">
								<input type="email" name="email" onKeyPress="if(this.value.length==20) return false;" size=22 required tabindex=1></td>
							</tr>
							<tr align="center" style="float:left; clear:left; margin-top:10px;"><td align="center">Šifra:</td> 
								<td align="center" style="float:left; clear:right; margin-top:10px;">
								<input type="password" name="sifra" onKeyPress="if(this.value.length==20) return false;" size=22 required tabindex=2></td>
							</tr>
							<tr style="float:left; clear:left; margin-top:10px; margin-left:40px">
							<td align="center">
									<input type="submit" align="center" class="btn btn-default" name="prijava" value="Prijavi se" tabindex=3>
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