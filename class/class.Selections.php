<?php

error_reporting(E_ALL);

/**
 * pretelejourj - class.Selections.php
 *
 * $Id$
 *
 * This file is part of pretelejourj.
 *
 * Automatically generated on 14.07.2017, 17:45:12 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

include "class.Prestataires.php";
include "class.Prestations.php";
/**
 * Short description of class Selection
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 */
class Selections extends common
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * Short description of attribute id_selection
     *
     * @access public
     * @var Integer
     */
    public $id_selection = null;

    /**
     * Short description of attribute user
     *
     * @access public
     * @var Integer
     */
    public $user = null;

    /**
     * Short description of attribute prestation
     *
     * @access public
     * @var Prestation
     */
    public $prestation = null;

    /**
     * Short description of attribute type_prestataire
     *
     * @access public
     * @var Type_prestataire
     */
    public $type_prestataire = null;

    /**
     * Short description of attribute date_creation
     *
     * @access public
     * @var Integer
     */
    public $date_creation = null;

    /**
     * Short description of attribute date_modification
     *
     * @access public
     * @var Integer
     */
    public $date_modification = null;

    /**
     * Short description of attribute statut
     *
     * @access public
     * @var Integer
     */
    public $statut = null;

    // --- OPERATIONS ---

    /**
     * Short description of method Selection
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
	 
	 public $table="selections";
	 public static $tablestat="selections";
    public function Selection()
    {
     }

   public function getId_selection()
    {
	return $this->id_selection;
    }

     public function getUser()
    {
	return $this->id_user;
    }

    public function getPrestation()
    {
    }

     public function getTypePrestataire()
    {
    }
	public function getTheId(){
		return "id_selection";
	}
    
    public function getStatut()
    {
    }
	public function prepareSaveSelection($values){
		//Création du prestataire//
		$prestataire=new Prestataires();
		$is_ok=$prestataire->save($values);
		$values[$prestataire->getTheId()]=$is_ok;
		
		preprint_r($values);
		return $values;
	}
    public function save($values){
		$values=$this->prepareSaveSelection($values);
		print_r($values);
		$last_id=parent::save($values);
		
		$values[$this->getTheId()]=$last_id;
		echo "last_id is ".$last_id;
		foreach($values['id_modele_type_prestataire'] as $presta){
			$prestation=new Prestations();
			$array_presta=array($this->getTheId()=>$last_id,'id_modele_type_prestataire'=>$presta[0],'valeur_prestation'=>$presta[1]);
			$is_ok=$prestation->save($array_presta);
		}
	}
	public function getSelectionsFromTypePresta($id){
		$sql="SELECT s.*,tp.libelle_type_prestataire
			FROM `selections` s 
			INNER JOIN type_prestataires tp ON s.id_type_prestataire=tp.id_type_prestataire
			WHERE s.id_type_prestataire='".$id."'
			";//id_user?
		$data=query_full($sql);
		return $data;
	}
    public function delete()
    {
    }
	

} /* end of class Selection */

?>