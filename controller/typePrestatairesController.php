<?php
include("./class/class.Type_prestataires.php");
include("./class/class.Selections.php");
include("controller.php");
$id=(isset($id) && $id<>"" && $id<>null)?$id:"";


class TypePrestatairesController extends Controller{
	public $action="";
	public $typePrestataire;
	public $tableName="type_prestataires";
	function __construct($action,$id=null){ 
		$this->typePrestataire = new Type_prestataires($id);
		$this->setAction($action);
		$this->{$action}();
	}
	
	public function voir(){
		
		$selection = new Selections();
		$selections = $selection->getSelectionsFromTypePresta($this->typePrestataire->getId_type_prestataire());
		$libelle_type_prestataire= $this->typePrestataire->getLibelle_type_prestataire();
		include(PATH_VUE."/typeprestataire_voir.php");
	}
	public function liste(){
		include(PATH_VUE."/typeprestataire_liste.php");
	}
	public function form(){
		include(PATH_VUE."/typeprestataire_form.php");
	}
	public function getAction(){
		return $this->action;
	}
	public function setAction($action){
		$this->action=$action;
	}
}
$controller= new TypePrestatairesController($action,$id);
?>