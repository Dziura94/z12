<?php
session_start();
?>
<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="pit.css" />
	<title>Serwer plikow</title>
</head>

<body link="red">

<header id="header">
<H2>Serwer plikow</H2>
</header>
	<?php
	 if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true)){
	 echo ' <ul class="menu_poziome">';
	 echo'<li><a href="logout.php" class="linkmenu">Wyloguj się!</a></li>';
echo ' </ul><section id="content">';
$login=$_SESSION['user'];
 $dir = "pliki/$login";
 if ( !file_exists($dir) ) {
     $oldmask = umask(0);  
     mkdir ($dir, 0744);
 }
echo"<H2>Twoje pliki</H2>";
$files = scandir("pliki/$login",1);
$dlugosc=count ($files);
echo"Zawartość Folderu $login";
print'<table CELLPADDING=5 BORDER=1>
<tr><td>Nazwa</td><td>Akcja</td></tr>';
for ($i=0;$i<($dlugosc-2);$i++)
{
echo "<tr><td>$files[$i]</td><td>Akcja</td></tr>";
}
echo'</table>';


}
else {
echo '<section id="content">';
print	"Korzystanie z komunikatora wymaga zalogowania<br/><form action='zaloguj.php' method='post'>
		Login: <br /> <input type='text' name='login' /> <br />
		Hasło: <br /> <input type='password' name='haslo' /> <br /><br />
		<input type='submit' value='Zaloguj się' />
	</form>";

	 if(isset($_SESSION['blad'])){
  echo $_SESSION['blad'];}
  	echo'<br/><a href="rejestracja.php" >Zarejestruj się</a>';
 }
?>
</section>
<footer id="footer">  
 <p>Kontakt do administratora strony: <a href="mailto:mail.pl">admin</a>&nbsp;&nbsp;&nbsp;&nbsp;Gości:<?php include("licznik_wejsc.php"); ?></p>
</footer>

</body>
</html>