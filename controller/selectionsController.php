<?php
include("./class/class.Type_prestataires.php");
include("./class/class.Selections.php");
include("controller.php");
$id=(isset($id) && $id<>"" && $id<>null)?$id:"";

class SelectionsController extends Controller{
	
	public $action="";
	public $laclass="Selections";
	function __construct($action,$id=""){ 
		if(isset($id) && $id<>null && trim($id)<>"")$this->{$action}($id);
		else $this->{$action}();
	}
	public function voir(){
		$data=$this->selection->getListeModeleFromTypePrestataire();
		include(PATH_VUE."/selection_voir.php");
	}
	public function liste(){
		include(PATH_VUE."/selection_liste.php");
	}
	public function form($id){
		$type_prestataire = new Type_prestataires($id);
		$modeles=$type_prestataire->getListeModeleFromTypePrestataire();
		$GLOBALS['id_user']=1;
		$GLOBALS['id_type_prestataire']=$id;
		
		include(PATH_VUE."/selection_form.php");
	}
	public function save($val=array()){
		$_POST=array_merge($_POST, $val);
		$is_ok=new $this->laclass();
		$is_ok->save($_POST);
		print_r($_POST);die();
		
		header('location:index.php?cont='.$this->laclass.'&action=form&id='.$_POST[$is_ok->getTheId()].'&r=ok');
		exit;
	}
	
}
$controller= new SelectionController($action,$id);
?>