<?php

$dbhost = "127.0.0.1";
$dbuser = "root";
$dbpassword = "";
$bdd = "pretelejourj";
$nomweb = $_SERVER['SERVER_NAME'];
open_db();
function open_db(){
	global $dbhost, $dbuser, $dbpassword,$bdd;
	//$dbh = mysql_connect($dbhost, $dbuser, $dbpassword);
	$dbh = new mysqli($dbhost, $dbuser, $dbpassword,$bdd);
	if (!$dbh)        {
	echo "<P><B>Echec connexion serveur SQL.</B><P>";
	exit;
	}
	return $dbh;
}

function query_db($dbh, $query){
	global $bdd;
	return mysql_query($bdd, $query, $dbh);
}

function close_db()
{
	global $dbh;
	while(@mysql_close()) { }
	unset($dbh);
}

function num_query($result)
{
	$nb_ligne=@mysql_num_rows($result);
	return $nb_ligne;
}

function select_query($result)
{
	$res = @mysql_fetch_array($result);
	return $res;
}

function query_exec($query)
{
	global $bdd, $dbhost, $dbuser, $dbpassword;
	$mysqli = new mysqli($dbhost, $dbuser, $dbpassword,$bdd);
	if (!$mysqli)  {
	echo "<P><B>Echec connexion serveur SQL exec</B><P>";
	exit; }
	$result=$mysqli->query($query);
	$last_id=$mysqli->insert_id;
	if (!mysqli_close($mysqli))
	{
		echo("<P><B>Echec deconnexion SQL</B><P>");
		exit;
	}
	return $last_id;
}

function query_dbc($query)
{
	global $bdd, $dbhost, $dbuser, $dbpassword;
	$dbh = new mysqli($dbhost, $dbuser, $dbpassword,$bdd);
	if (!$dbh)        {
	echo "<P><B>Echec connexion serveur SQL dbc</B><P>";
	exit;
	}
	$result=mysql_query($bdd, $query, $dbh);
	$nb_ligne=@mysql_num_rows($result);
	if (!mysql_close($dbh))
	{
	echo "<P><B>Echec deconnexion SQL</B><P>";
	exit;
	}
	if($nb_ligne<>""){return $result;}else{return false;}
}

function query_dbr($query)
{
global $bdd, $dbhost, $dbuser, $dbpassword;
$dbh = mysql_connect($dbhost, $dbuser, $dbpassword);
if (!$dbh)        {
echo "<P><B>Echec connexion serveur SQL dbr</B><P>";
exit;
}
$result=mysql_query($bdd, $query, $dbh);
return $result;
}


function query_full($query){
	global $bdd, $dbhost, $dbuser, $dbpassword;
	$mysqli = new mysqli($dbhost, $dbuser, $dbpassword,$bdd);

	if (!$mysqli)        {
		echo "<P><B>Echec connexion serveur SQL full</B><P>";
		exit;
	}
	if (!$result = $mysqli->query($query)) {
			// Oh no! The query failed. 
			echo "Sorry, the website is experiencing problems.";

			// Again, do not do this on a public site, but we'll show you how
			// to get the error information
			echo "Error: Our query failed to execute and here is why: \n";
			echo "Query: " . $query . "\n";
			echo "Errno: " . $mysqli->errno . "\n";
			echo "Error: " . $mysqli->error . "\n";
			exit;
		}
		$res=array();
		while($row = $result->fetch_array(MYSQLI_BOTH)) { 
			$res[]=$row; 
		}
		
	return $res;
}

function lastId()
{
global $bdd, $dbhost, $dbuser, $dbpassword;
	$mysqli = new mysqli($dbhost, $dbuser, $dbpassword,$bdd);
return $mysqli->insert_id;
}
?>