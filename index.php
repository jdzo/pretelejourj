<?php 
require"include/connexion.inc.php";
include "class/class.common.php";
/*
pretelejourj.localhost/index.php?cont=prestataire&action=lire&id=5
pretelejourj.localhost/index.php?cont=prestataire&action=supprimer&id=5
pretelejourj.localhost/index.php?cont=prestataire&action=ajouter
*/
include("vue/menu.php");
if(!isset($_GET['cont'])){echo "erreur";die();}
include("controller/".$_GET['cont']."Controller.php");

