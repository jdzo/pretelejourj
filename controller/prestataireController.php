<?php
include("./class/class.Type_prestataires.php");
include("controller.php");
$id=(isset($id) && $id<>"" && $id<>null)?$id:"";

class PrestatairesController extends Controller{

	public $action="";
	public $laclass="Prestataires";
	function __construct($action,$id=""){ 
		if(isset($id) && $id<>null && trim($id)<>"")$this->{$action}($id);
		else $this->{$action}();
	}
	public function voir(){
		include(PATH_VUE."/prestataire_voir.php");
	}
	public function liste(){
		include(PATH_VUE."/prestataire_liste.php");
	}
	public function form($id=null){
		$listeTypeprestataire=Type_prestataire::getListeAll();
		$GLOBALS['donnee']= Prestataires::getPrestataireFromId($id);
		
		include(PATH_VUE."/prestataire_form.php");
		exit;
	}
}

$controller= new PrestataireController($action,$id);
?>