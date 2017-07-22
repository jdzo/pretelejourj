<h2>Nouveau comparatif</h2>
<div class="container-fluid">
    <?php 
	$mode="save"; 
	$input_id="";
	
    if(returnValue('id_selection'))  {  
        $mode="update";
		//$input_id="<input type='hidden' value='". returnValue('id_selection')."' id='id_selection' name='id_selection' />";
		$input_id=input_type_hidden('id_selection');
    }
    ?>
    <form name='formulaire' id='formulaire' action='index.php?action=<?php echo $mode;?>&cont=selection' 
    method='POST'enctype="multipart/form-data" class="form-horizontal" data-toggle="validator"  role="form">
    <?php 
	
	//0$label="",1$id="",2$redstar='',3$onchange="",4title="",5type de champs,6modifiable?)
	echo input_type_text(array("Nom ","nom_prestataire","yes","","Nom du prestataire","text",""));
	foreach($modeles as $key=>$modele){
		echo input_type_text(array($modele['libelle_modele_type_prestataire'],"id_modele_type_prestataire[".$modele['id_modele_type_prestataire']."]","yes","",$modele['libelle_modele_type_prestataire'],"text",""));
	}
    echo $input_id; 
	echo input_type_hidden('id_user');
	echo input_type_hidden('id_type_prestataire');
    ?>
    <input type='submit' id='submit_form' name='submit_form'  class="btn btn-default" Value="Valider"/>
    </form>
</div>
