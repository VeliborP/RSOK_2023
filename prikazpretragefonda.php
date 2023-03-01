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
							<th scope='col'>Rashod</th>                                 
							<th scope='col'>Akcije:</th>
							<th scope='col'</th>
							</tr>
							</thead><tbody>";

							$red="";
							while($red = mysqli_fetch_array($prikaz))
							{
								$autor=$red['Prezime']." ".$red['Ime'];
								if ($red['Rashodovana']=="1")
								{
									$rashod="Da";
								}
								else
								{
									$rashod="-";
								}
								echo "<tr>
									<td align=left>".$red['InvBr']."</td>
									<td align=left>".$red['Naziv']."</td>
									<td align=left>".$autor."</td>
									<td align=left>".$red['Godina izdavanja']."</td>
									<td align=left>".$red['Naziv vrste jedinice']."</td>
									<td align=left>".$rashod."</td>";

									$invbr=$red['InvBr'];
									
									if ($rashod=="-")
									{
									echo "<td align=left> <form action='jedinicaizmeni.php' method='POST'>";
									echo "<input type='hidden' name='invbr' value='$invbr'>";
									echo "<input type='submit' name='izmena' value='Izmena'>";
									echo "</form> </td>"; 

									echo "<td align=left> <form action='jedinicaobrisi.php' method='POST'>";
									echo "<input type='hidden' name='invbr' value='$invbr'>";
									echo "<input type='submit' name='brisanje' value='Brisanje'>";
									echo "</form> </td>";
									
									echo "<td align=left> <form action='jedinicarashoduj.php' method='POST'>";
									echo "<input type='hidden' name='invbr' value='$invbr'>";
									echo "<input type='submit' name='rashoduj' value='Rashoduj'>";
									echo "</form> </td>";
									
									echo "<td align=left> <form action='jedinicaautori.php' method='POST'>";
									echo "<input type='hidden' name='invbr' value='$invbr'>";
									echo "<input type='submit' name='autori' value='Autor(i)'>";
									echo "</form> </td>	</tr>";
								}
							}							
							echo "</tbody>
							</table>
							<br/>";   
						}
						else 
						{
							echo "Za izabrani kriterijum pretrage nemate nijednu bibliotečku jedinicu u fondu!";
						}	
						//Taster za povratak na pretragu
						echo "<a href='pretragafonda.php'><button type='button'>Nova pretraga</button></a>";
						//Uništavanje objekta Jezik
						$objJedinica= null;               
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