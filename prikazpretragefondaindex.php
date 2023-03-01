<!DOCTYPE HTML>
<html>
	<?php include "head.html"; ?>
	
	<body>
	<div class="fh5co-loader"></div>
	
<!-- Meni gore -->

	<?php include "meniupindex.html"; ?>

<!-- Sredina stranice -->

	<div id="fh5co-course-categories">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h4>REZULTAT PRETRAGE BIBLIOTEČKOG FONDA</h4>
					<?php 
					//Dodela vrednosti parametrima
					$pNazivJedinice=$_POST['Naziv'];
					$pVrstaJedinice=$_POST['VrstaJedinice'];
					$pAutorPrezime=$_POST['Prezime']; 
					$pAutorIme=$_POST['Ime']; 
					$pGodina=$_POST['GodinaIzdavanja']; 
					$pJezik=$_POST['Jezik'];
					//Kreiranje objekta Jedinica
					require 'klase/KonekcijaDB.php';
					require 'klase/BiblioteckaJedinica.php';
					$objJedinica = new BiblioteckaJedinica();
					$prikaz="";
					$brojredova=0;
					//Poziv metode za prikaz svih jezika u BP
					$prikaz=$objJedinica->Pretraga($pNazivJedinice, $pVrstaJedinice, $pAutorPrezime, $pAutorIme, $pGodina, $pJezik);
					if ($prikaz)
						{
							$brojredova=mysqli_num_rows($prikaz);
						} 
					$red="";
					if ($brojredova>0)
						{
							//Tabelarni prikaz pronadjenih jedinica
							echo "<table class='table table-striped'>
							<thead>
							<tr>
							<th scope='col'>IBR</th>
							<th scope='col'>Naziv</th>                                   
							<th scope='col'>Autor</th>   
							<th scope='col'>Godina</th> 
							<th scope='col'>Vrsta</th>                         
							<th scope='col'</th>
							</tr>
							</thead><tbody>";

							$red="";
							while($red = mysqli_fetch_array($prikaz))
							{
								$autor=$red['Prezime']." ".$red['Ime'];
								echo "<tr>
									<td align=left>".$red['InvBr']."</td>
									<td align=left>".$red['Naziv']."</td>
									<td align=left>".$autor."</td>
									<td align=left>".$red['Godina izdavanja']."</td>
									<td align=left>".$red['Naziv vrste jedinice']."</td>
									</td></tr>";
								}							
							echo "</tbody>
							</table>
							<br/>";   
						}
						else 
						{
							echo "Za izabrani kriterijum pretrage nemate nijednu bibliotečku jedinicu u fondu!";
						}	
						//Uništavanje objekta Jedinica
						$objJedinica= null;               
						?>
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