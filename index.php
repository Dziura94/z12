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
	<title>GEOLOKALIZATOR</title>
</head>

<body link="red">

<header id="header">
<H2>GEOLOKALIZATOR</H2>
</header>
  <ul class="menu_poziome">
	<li><a href="index.php">Strona główna</a></li>
	<li><a href="info.php">Dane Odwiedzających</a></li>
 </ul>
<section id="content">
<?php
$ipaddress = $_SERVER["REMOTE_ADDR"];
function ip_details($ip) {
$json = file_get_contents("http://ipinfo.io/{$ip}/geo");
$details = json_decode($json);
return $details;
}
$details = ip_details($ipaddress);
echo $details -> region; echo "<br>";
echo $details -> country; echo "<br>";
echo $details -> city; echo "<br>";
echo $details -> loc; echo "<br>";
echo $details -> ip; echo "<br>";
$info= $_SERVER['HTTP_USER_AGENT'] . "\n\n";
$miasto=$details->city;
$ip=$details->ip;
$loc=$details->loc;
$loc=( explode( ',', $loc ) );
echo "<iframe src='https://www.google.com/maps/embed/v1/search?key=AIzaSyBqm50AJ1Mk6yGmUHmYmogQ_-SxXiMlaw0&q=$loc[0],$loc[1]&maptype=satellite'  width='600' height='450' frameborder='0' style='border:0' allowfullscreen></iframe>";
 if(!isset($_SESSION['odwiedzone'])){
$polaczenie=@new mysqli("mysql636int.cp.az.pl", "u1230784_sa64413", "8RenOcnIBVnbW7Wa","db1230784_sa64413_main");
if ($polaczenie->connect_errno!=0)
{
	echo "Nie można połączyć się z serwerem BD";
}
else
{
	mysqli_set_charset($polaczenie, "utf8");
	$zapytanie = mysqli_query ($polaczenie,"INSERT INTO Geo(IP, Lokalizacja,info) VALUES('".$ip."','".$miasto."','".$info."') ;");
     $polaczenie->close();
	$_SESSION['odwiedzone']=1;
 }}
?>
</section>
<footer id="footer">  
 <p>Kontakt do administratora strony: <a href="mailto:mail.pl">admin</a>&nbsp;&nbsp;&nbsp;&nbsp;Gości:<?php include("licznik_wejsc.php"); ?></p>
</footer>

</body>
</html>