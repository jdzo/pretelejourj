<?php
class Controller{

public function save($val=array()){
$_POST=array_merge($_POST, $val);
		$is_ok=new $this->laclass();
		$is_ok->save($_POST);die();
		
		header('location:index.php?cont='.$this->laclass.'&action=form&id='.$_POST[$is_ok->getTheId()].'&r=ok');
		exit;
	}
	public function update($val=array()){
	$_POST=array_merge($_POST, $val);
		$is_ok=new $this->laclass();
		$is_ok->update($_POST);
		header('location:index.php?cont='.$this->laclass.'&action=form&id='.$_POST[$is_ok->getTheId()].'&r=ok');
		exit;
	}
	
	public function delete(){}
	public function modify(){}
	public function getAction(){
		return $this->action;
	}
	public function setAction($action){
		$this->action=$action;
	}

}
?>