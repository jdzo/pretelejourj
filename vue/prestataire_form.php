<h2>Cr&eacute;ation d'un prestataire</h2>
<div class="container-fluid">
    <?php 
	$mode="save"; 
	$input_id="";
	
    if(returnValue('id_prestataire'))  {  
        $mode="update";
		$input_id="<input type='hidden' value='". returnValue('id_prestataire')."' id='id_prestataire' name='id_prestataire' />";
    }
    ?>
    <form name='formulaire' id='formulaire' action='index.php?action=<?php echo $mode;?>&cont=prestataire' 
    method='POST'enctype="multipart/form-data" class="form-horizontal" data-toggle="validator"  role="form">
    <?php 
	
	//0$label="",1$id="",2$redstar='',3$onchange="",4title="",5type de champs,6modifiable?)
echo input_type_text(array("Nom ","nom_prestataire","yes","","Nom du prestataire","text",""));
echo input_type_text(array("Prenom ","prenom_prestataire","yes","","Prenom du prestataire","text",""));
echo input_type_text(array("Adresse ","adresse_prestataire","yes","","Adresse du prestataire","text",""));
echo input_type_text(array("CP ","cp_prestataire","yes","","CP du prestataire","text",""));
echo input_type_text(array("Ville ","ville_prestataire","yes","","Ville du prestataire","text",""));

echo input_type_select(array("Type de prestation ","","yes","","Nom du prestataire","text","",$listeTypeprestataire));


    echo $input_id; 
    ?>
    <input type='submit' id='submit_form' name='submit_form'  class="btn btn-default" Value="Valider"/>
    </form>
</div>
