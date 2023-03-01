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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Biblioteka</title>
</head>
<body>
<?php
	echo "<table border=0>
    <tr><td>Tehnički fakultet Mihajlo Pupin</td></tr>
    <tr><td>Đure Đakovića bb</td></tr>
    <tr><td>23000 Zrenjanin</td></tr>
    <tr><td>023/550516</td></tr>
    </table>
    <h3 align='center'>SPISAK OPOMENA</h3>";
	//Kreiranje objekta Opomene
	require 'klase/KonekcijaDB.php';
	require 'klase/Izdata.php';
	$objOpomene = new Izdata();
	$upit="";
	$rezultat="";
	$brojredova=0;
	//Poziv metode za ucitavanje svih opomena
	$rezultat=$objOpomene->IzvestajOpomene();
	$brojredova = mysqli_num_rows($rezultat);
	if ($brojredova==0) //prazna tabela
		{
			echo "U biblioteci ne postoji nijedna izdata opomena!";
			echo "<br/>";
		}
		else
		{
			echo "
			<table align=center border=1>
			<th>RB</th>
			<th>Prezime</th>
			<th>Ime</th>
			<th>Broj indeksa</th>
			<th>Bibliotečka jedinica</th>
			<th>Opomena</th>";
			$red=0;
			$rb=1;
			while($red = mysqli_fetch_array($rezultat))
				{
					echo "<tr>";
					echo "<td align=center>" . $rb . "</td>";
					echo "<td>" . $red['Prezime'] . "</td>";
					echo "<td>" . $red['Ime'] . "</td>";
					echo "<td>" . $red['Broj indeksa'] . "</td>";
					echo "<td>" . $red['Naziv'] . "</td>";
					echo "<td>" . $red['Opomena'] . "</td>";
					echo "</tr>";
					$rb++;
				}// end while
				echo "</table>";
		}
				echo "<br/>
				Ukupno opomena: $brojredova<br/><br/>"; 
				echo date('d.m.Y').".";
				echo "<br/>";
				echo "У Зрењанину"; 
				echo "<p align='right'>Bibliotekar</p>"; 
				echo "<p align='right'>___________</p>"; 
?>
</body>
</html>