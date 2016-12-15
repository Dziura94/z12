<?php
session_start();
if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
$polaczenie=@new mysqli("mysql636int.cp.az.pl", "u1230784_sa64413", "8RenOcnIBVnbW7Wa","db1230784_sa64413_main");
if ($polaczenie->connect_errno!=0)
{
	echo "Nie można połączyć się z serwerem BD";
}
else
{
	$login=$_POST['login'];
	$haslo=$_POST['haslo'];
		$login = htmlentities($login, ENT_QUOTES, 	"UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy2 WHERE 	user='%s' AND pass='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
	{
	$ilu_userow = $rezultat->num_rows;
		if($ilu_userow>0)
		{	
			$_SESSION['zalogowany'] = true;
			$wiersz = $rezultat->fetch_assoc();
			$_SESSION['id'] = $wiersz['id'];
			$_SESSION['user'] = $wiersz['user'];
			unset($_SESSION['blad']);
			$rezultat->free_result();
			if (isset($_SESSION['menu'])){
			header('Location: index.php?id=start&menu='.$_SESSION['menu'].'');
			}
			else{
			header('Location: index.php');
			}
		}
		else
		{
			$_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło!</span>';
			header('Location: index.php');
		}
	}
	$polaczenie->close();
}
?>