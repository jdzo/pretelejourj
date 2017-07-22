<?php
include("./class/class.Type_prestataires.php");
include("./class/class.Prestations.php");
include("controller.php");
$id=(isset($id) && $id<>"" && $id<>null)?$id:"";

class PrestationsController extends Controller{

	public $action="";
	public $laclass="Prestations";
	function __construct($action,$id=""){ 
		if(isset($id) && $id<>null && trim($id)<>"")$this->{$action}($id);
		else $this->{$action}();
	}
	public function voir(){
		include(PATH_VUE."/prestations_voir.php");
	}
	public function liste(){
		include(PATH_VUE."/prestations_liste.php");
	}
	public function form($id=null){
		
		include(PATH_VUE."/prestations_form.php");
		exit;
	}
}

$controller= new PrestationsController($action,$id);
?>