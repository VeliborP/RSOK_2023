<?php 
		session_start(); //Pocetak, tj. aktiviranje/kreiranje sesije
		
		//Preuzimanje vrednosti iz rubrika za unos sa iste ove stranice
		$loginusername=$_POST['email'];
		$loginpassword=$_POST['sifra'];

		//Pocetne vrednosti promenljivih za proveru korisnika
		$logsucc=0;
		$rezultatprijave="";
		$status="clan";
		$idclana="";
        $brredova=0;
		
		//Kreiranje objekata korisnik i bibliotekar
		require 'klase/KonekcijaDB.php';
		require 'klase/Clan.php';
		require 'klase/Bibliotekar.php';
		$objClan = new Clan();
		$objBibliotekar = new Bibliotekar();
		$objClan->KorisnickaSifra=$loginpassword;
		$objClan->Email=$loginusername;
		
		//Poziv metode za proveru sifre i korisnickog imena
		$rezultatprijave=$objClan->Prijava();
        $brredova=mysqli_num_rows($rezultatprijave);
        
		if ($brredova==0) //Ne postoji clan, sledi provera da li postoji bibliotekar
		{
			$objBibliotekar->KorisnickaSifra=$loginpassword;
			$objBibliotekar->Email=$loginusername;
			//Poziv metode za proveru sifre i korisnickog imena
			$rezultatprijave=$objBibliotekar->Prijava();
            $brredova=mysqli_num_rows($rezultatprijave);
			$status="bibliotekar";
		}
		if ($brredova==1) //postoji korisnik
			{
				$red=0;
				$logsucc=1;
				while($red = mysqli_fetch_array($rezultatprijave))
					{
						//dodela vrednosti promenljivama u sesiji
						$username=$red['Email'];
						$ime=$red['Ime'];
						$prezime=$red['Prezime'];
						if ($status=="bibliotekar")
						{
							$idclana=$red['ID bibliotekara'];
						}
						else
						{
							$idclana=$red['Broj clana'];
						}
						$_SESSION["ime"] = $ime;
						$_SESSION["prezime"] = $ime;
						$_SESSION["username"] = $username;
						$_SESSION["status"] = $status;
						$_SESSION["idclana"] = $idclana;
					}
			}
			//Unistavanje objekata
			$objClan=null;
			$objBibliotekar=null;  
			if ($logsucc==1) 
			{
				//redirektovanje aplikacije na pocetnu stranicu sa menijem
				header('Location:pocetna.php');
			} 
			else //brredova
			{
				//unistavanje sesije
				session_destroy();
				session_unset();
				//redirektovanje stranice, povratak na pocetnu, ako sifra i/ili korisnicko ime nisu pronadjeni u bazi
		  		header('Location:prijava.php');
                
			}
            //echo $logsucc;
            //echo $status;
?>