
		
<?php
$i=1;
foreach($selections as $s){
	$prestation = new Prestations();
	
	echo "<div class='block_selection'>";
	echo "<span>Choix ".$s['libelle_type_prestataire']. " ".$i."</span>";
	$prestations= $prestation->getPrestationsFromSelection($s['id_selection']);
	foreach($prestations as $p){
	
		echo "<div class='block_prestation'>";
		echo "<span>Prestation : ".$p['libelle_modele_type_prestataire']."</span>";
		echo "<span>Prix : ".$p['valeur_prestation']."</span>";
		echo "</div>";
		echo "<i class='fa fa-times-circle' aria-hidden='true'></i><a href='".Prestations::getLink("delete",$p['id_prestation'])."'>Supprimer</a>";
		echo "<i class='fa fa-pencil' aria-hidden='true'></i><a href='".Prestations::getLink("modify",$p['id_prestation'])."'> Modifier</a>";

	}
	echo "</div>";
	$i++;
}
echo "<i class='fa fa-plus-circle' aria-hidden='true'></i><a href='".selections::getLink("form","")."'> Ajouter un ".$libelle_type_prestataire;
?>
