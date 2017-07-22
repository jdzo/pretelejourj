<?php

error_reporting(E_ALL);

/**
 * pretelejourj - class.Type_prestataire.php
 *
 * $Id$
 *
 * This file is part of pretelejourj.
 *
 * Automatically generated on 14.07.2017, 17:45:13 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

class Type_prestataires extends Common
{
 public $table='type_prestataire';
	public static $tablestat='type_prestataire';
    public $id_type_prestataire = null;
	public $code_type_prestataire = null;
	public $libelle_type_prestataire = null;
	
	public function getId_type_prestataire()    {
      return $this->id_type_prestataire;
    }

     public function Type_prestataires($id=null)
    {
		if($id<>null){
			$info=$this->getTypePrestataire($id);
			parent::hydrate($info);
		}
    }
	
	public function setIdTypePrestataire($id){
		$this->id_type_prestataire=$id;
	}
	public function getListeModeleFromTypePrestataire(){
		$sql="SELECT * 
		FROM `type_prestataires` tp 
			INNER JOIN modele_type_prestataire mtp 
				ON tp.id_type_prestataire=mtp.id_type_prestataire_modele_type_prestataire 
		WHERE tp.id_type_prestataire=".$this->id_type_prestataire;
			$data=query_full($sql);
			return $data;
	}
	public static function  getListeAll(){
		$sql="SELECT id_type_prestataire,libelle_type_prestataire 
				FROM `type_prestataires` tp where statut_type_prestataire='actif' order by libelle_type_prestataire";
		$data=query_full($sql);
			return $data;
	}
   public function getTypePrestataire($id){
		$sql="SELECT * 
			FROM `type_prestataires` p 
			WHERE p.id_type_prestataire=".$id;
		$data=query_full($sql);
		return $data;
	}
   

     public function getLibelle_type_prestataire()
    {
		return $this->libelle_type_prestataire;
        }

    

} /* end of class Type_prestataire */

?>